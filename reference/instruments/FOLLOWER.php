<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - FOLLOWER</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>FOLLOWER</b> -- simple envelope follower
<br>
<i>in RTcmix/insts/jg/FOLLOWER</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>FOLLOWER</b>(outsk, insk, dur, CARAMP, MODAMP, windowsize, SMOOTHNESS[, PAN])
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
   p7  = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]

   p3 (carrier amp), p4 (modulator amp), p6 (smoothness) and p7 (pan) can
   receive dynamic updates from a table or real-time control source.

   Author: John Gibson, 1/5/03; rev for v4, JGG, 7/24/04
</pre>
<br>
<hr>
<br>


<b>FOLLOWER</b>
extracts the amplitude of an audio input signal and applies it
to another signal.  The source code for this instrument is probably
very useful for deriving similar kinds of instruments.  See also
the
<a href="FOLLOWBUTTER.php">FOLLOWBUTTER</a> or
<a href="FOLLOWGATE.php">FOLLOWGATE</a>
instruments for examples.

<h3>Usage Notes</h3>


<b>FOLLOWER</b> applies the amplitude envelope of the modulator to the carrier.
The carrier is supplied as the "left" channel, the modulator as the
"right" channel.
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
nd modulator signals from the left and right channels of the same sound file.
<p>
The envelope follower consists of a power gauge that measures the
average power of the modulator signal.  The "windowsize" (p5) is
the number of samples to average.  Large values (&gt; 1000) track only
gross amplitude changes; small values (&lt; 10) track very minute
changes.  If the power level changes abruptly, as it does especially
with long windows, you'll hear zipper noise.  Reduce this by
increasing the "SMOOTHNESS" (p6).  This applies a low-pass filter
to the power gauge signal, smoothing any abrupt changes.
<p>
You'll probably always need to boost the modulator amplitude
multiplier ("MODAMP", p4) beyond what you'd expect, because we're using
the RMS power of the modulator to affect the carrier, and this
is always lower than the peak amplitude of the modulator signal.
<p>
The output of <b>FOLLOWER</b> can be either mono or stereo.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("WAVETABLE")
   load("FOLLOWER")
   
   source_listen = 0  /* set to 1 to hear carrier and modulator separately */
   
   dur = 20
   
   /* play carrier to bus 0 */
   bus_config("WAVETABLE", "aux 0 out")
   waveform = maketable("wave", 1000, 1, .5, .2)
   amp = 15000
   WAVETABLE(0, dur, amp, freq = 440, 0, waveform)
   WAVETABLE(0, dur, amp, freq * 1.02, 0, waveform)
   
   /* play modulator to bus 1 */
   bus_config("WAVETABLE", "aux 1 out")
   ampenv = maketable("line", 1000, 0,0, 1,1, 19,1, 20,0)
   reset(20000)
   incr = base_incr = 0.15
   notedur = base_incr * 0.3
   freq = 1000
   for (st = 0; st < dur; st = st + incr) {
      amp = irand(5000, 30000)
      WAVETABLE(st, notedur, amp*ampenv, freq, 0, waveform)
      incr = base_incr * irand(0.5, 2)
   }
   reset(1000)
   
   /* apply modulator's amp envelope to carrier */
   bus_config("FOLLOWER", "aux 0-1 in", "out 0-1")
   setline(0,0, 1,1, 10,1, 20,0)
   caramp = 1.0
   modamp = 4.0
   winlen = 10       /* number of samples for power gauge to average */
   smooth = 0.5      /* how much to smooth the power gauge curve */
   pctleft = 0.5
   if (source_listen) {
      bus_config("MIX", "aux 0-1 in", "out 0-1")
      MIX(0, 0, dur, 1, 0, 1)
   }
   else
      FOLLOWER(0, inskip = 0, dur, caramp, modamp, winlen, smooth, pctleft)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/bus_config.php">bus_config</a>,
<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="AM.php">AM</a>,
<a href="COMPLIMIT.php">COMPLIMIT</a>,
<a href="FOLLOWBUTTER.php">FOLLOWBUTTER</a>,
<a href="FOLLOWGATE.php">FOLLOWGATE</a>
<a href="MIX.php">MIX</a>,
<a href="SPLITTER.php">SPLITTER</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

