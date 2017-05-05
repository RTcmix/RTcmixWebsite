<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - FOLLOWBUTTER</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>FOLLOWBUTTER</b> -- simple envelope follower, controlling cutoff frequency of a Butterworth filter
<br>
<i>in RTcmix/insts/jg/FOLLOWER</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>FOLLOWBUTTER</b>(outsk, insk, dur, CARAMP, MODAMP, windowsize, SMOOTHNESS, FILTTYPE, MINFREQ, MAXFREQ, steepness, PAN[, BANDWIDTH])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0  = output start time (seconds)
   p1  = input start time (seconds)
   p2  = duration (seconds)
   p3  = carrier amplitude multiplier (relative multiplier)
   p4  = modulator amplitude multiplier (relative multiplier)
   p5  = power gauge window length (samples; try 100)
   p6  = smoothness -- how much to smooth the power gauge output (0-1; try .8)
   p7  = type of filter ("lowpass", "highpass", "bandpass", "bandreject";
      or numeric codes for the filter type (1: lowpass, 2: highpass, 3: bandpass, 4: bandreject)
   p8  = minimum cutoff (or center) frequency (Hz)
   p9  = maximum cutoff (or center) frequency (Hz)
   p10 = steepness (> 0) (1 is a good starting value)
   p11 = pan (0-1 stereo; 0.5 is middle)
   p12 = filter bandwidth for bandpass/reject types (Hz if positive;
      if negative, the '-' sign acts as a flag to interpret the bw values
      as a multiplier (0.0-1.0) of the current center frequency.
      [optional; only used for "bandpass" or "bandreject" filters])

   p3 (carrier amp), p4 (modulator amp), p6 (smoothness), p7 (filter type),
   p8 (min. cutoff), p9 (max. cutoff), p11 (pan) and p12 (bandwidth) can
   receive dynamic updates from a table or real-time control source.
   p7 (filter type) can be updated only when using numeric codes.

   Author: John Gibson, 8/7/03; rev for v4, JGG, 7/24/04
</pre>
<br>
<hr>
<br>


<b>FOLLOWBUTTER</b>
extracts the amplitude of an audio input signal and uses it to control
the cutoff frequency of the
<a href="BUTTER.php">BUTTER</a>
instrument, a
(Butterworth) filter -- i.e. lowpass, highpass, bandpass, bandreject
(depending on the parameters).
See the
<a href="FOLLOWER.php">FOLLOWER</a>
instrument for the more general amplitude-envelope follower.

<h3>Usage Notes</h3>

<b>FOLLOWBUTTER</b> maps the amplitude envelope of the modulator to the cutoff
frequency of a filter applied to the carrier.  This filter works as
described in the documentation for the
<a href="BUTTER.php">BUTTER</a>
instrument, except that
there is no balance parameter.  The carrier is supplied as the "left"
channel, the modulator as the "right" channel.
<p>
The "left" input channel comes from the bus with the lower number;
the "right" input channel from the bus with the higher number.
See the
<a href="/reference/scorefile/bus_config.php">bus_config</a>
scorefile command for information about how RTcmix busses are used.
<p>
Currently in RTcmix it's not possible for an instrument to take
input from both an "in" bus and an "aux in" bus at the same time.
So, for example, if you want the modulator to come from a microphone,
which must enter via an "in" bus, and the carrier to come from a
<a href="WAVETABLE.php">WAVETABLE</a>
instrument via an "aux" bus, then you must route the
mic into the
<a href="MIX.php">MIX</a>
instrument as a way to convert it from "in" to
"aux in".  If you want the carrier to come from a file, then it
must first go through
<a href="MIX.php">MIX</a>
(or some other instrument) to send it
into an aux bus.  Since the instrument is usually taking input
from an aux bus, the input start time for this instrument must be
zero.  The only exception would be if you're taking the carrier
and modulator signals from the left and right channels of the same sound file.
<p>
The envelope follower consists of a power gauge that measures the
average power of the modulator signal.  The "windowsize" parameter (p5) is
the number of samples to average.  Large values (&gt; 1000) track only
gross amplitude changes; small values (&lt; 10) track very minute
changes.  If the power level changes abruptly, as it does especially
with long windows, you'll hear zipper noise.  Reduce this by
increasing the "SMOOTHNES" parameter (p6).  This applies a low-pass filter
to the power gauge signal, smoothing any abrupt changes.
<p>
You'll probably always need to boost the modulator amplitude
multiplier (p4) beyond what you'd expect, because we're using
the RMS power of the modulator to affect the carrier, and this
is always lower than the peak amplitude of the modulator signal.
<p>
Maximum cutoff ("MAXFREQ", p9) is the cutoff frequency you get when the power
gauge reads 1.0.  Whether the guage reaches -- or exceeds -- 1.0
depends on the modulator amplitude multiplier, and is signal
dependent.  In other words, just play around with the combination
of max. cutoff and modulator amp. 
<p>
The "steepness" (p10) is just the number of filters to add in series.
Using more than 1 steepens the slope of the filter.  You may need
to change p3 ("CARAMP") to adjust for loss of power caused
by connecting several filters in series.  Guard your ears!
<p>
The output of <b>FOLLOWBUTTER</b> can be either mono or stereo.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("WAVETABLE")
   load("FOLLOWBUTTER")
   
   source_listen = 0  // set to 1 to hear carrier and modulator separately
   
   dur = 20
   
   // play carrier to bus 0
   bus_config("WAVETABLE", "aux 0 out")
   wavet = maketable("wave", 8000, "buzz10")
   amp = 15000
   WAVETABLE(0, dur, amp, freq = 140, 0, wavet)
   WAVETABLE(0, dur, amp, freq * 1.002, 0, wavet)
   
   // play modulator to bus 1
   bus_config("WAVETABLE", "aux 1 out")
   env = maketable("line", 1000, 0,0, 1,1, 2,0)
   reset(20000)
   srand(2)
   incr = base_incr = 0.14
   notedur = base_incr * 0.35
   freq = 1000
   for (st = 0; st < dur; st += incr) {
      db = irand(40, 92)
      WAVETABLE(st, notedur, ampdb(db) * env, freq, 0, wavet)
      incr = base_incr * irand(0.25, 4)
   }
   reset(1000)
   
   // apply modulator's amp envelope to carrier
   bus_config("FOLLOWBUTTER", "aux 0-1 in", "out 0-1")
   env = maketable("line", 1000, 0,0, 1,1, 19,1, 20,0)
   caramp = 4.0
   modamp = 1.5
   winlen = 10         // number of samples for power gauge to average
   smooth = 0.8        // how much to smooth the power gauge curve
   type = "bandpass"   // "lowpass", "highpass", "bandpass", "bandreject"
   mincf = 120
   maxcf = 12000
   bw = -0.3
   steepness = 2
   pan = 0.5
   if (source_listen) {
      bus_config("MIX", "aux 0-1 in", "out 0-1")
      MIX(0, 0, dur, 1, 0, 1)
   }
   else
      FOLLOWBUTTER(0, inskip = 0, dur, caramp, modamp, winlen, smooth, type,
         mincf, maxcf, steepness, pan, bw)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/bus_config.php">bus_config</a>,
<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="AM.php">AM</a>,
<a href="COMPLIMIT.php">COMPLIMIT</a>,
<a href="FOLLOWER.php">FOLLOWER</a>,
<a href="FOLLOWGATE.php">FOLLOWGATE</a>
<a href="MIX.php">MIX</a>,
<a href="SPLITTER.php">SPLITTER</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

