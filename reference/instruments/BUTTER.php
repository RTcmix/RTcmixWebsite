<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - BUTTER</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>BUTTER</b> time-varying low/high/band/bandreject-pass filter (Butterworth)
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>BUTTER</b>(outsk, insk, dur, INAMP, FILTTYPE, steepness, ampbalance, inputchan, PAN, BYPASS, FREQENV[, BANDWIDTH, ringdur, OUTAMP])
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = type of filter ("lowpass", "highpass", "bandpass", "bandreject";
        or numeric codes for the filter type (1: lowpass, 2: highpass, 
        3: bandpass, 4: bandreject)
   p5 = steepness (> 0) (1 is a good starting value)
   p6 = balance output and input signals (0:no, 1:yes) (usually use 1)
   p7 = input channel
   p8 = pan (0-1 stereo; 0.5 is middle)
   p9 = bypass filter (0: bypass off, 1: bypass on) (usually use 0)
   p10 = filter frequency (Hz)
   p11 = filter bandwidth for bandpass/reject types (Hz if positive;
         if negative, the '-' sign acts as a flag to interpret the bw values
         as a multiplier (0.0-1.0) of the current center frequency.
         [optional; only used for "bandpass" or "bandreject" filters])
   p12 = ringdown duration [optional, default is 0.1]
   p13 = output amplitude multiplier [optional, default is 1.0]

   p3 (amplitude), p4 (type), p8 (pan), p9 (bypass), p10 (freq), p11 (bandwidth) 
   and p13 (outamp) can receive dynamic updates from a table or real-time 
   control source. p4 (type) can be updated only when using numeric codes.

   Author: John Gibson (johgibso at indiana dot edu), 12/1/01; 
   rev for v4, JGG, 7/24/04
</pre>
<br>
<hr>
<br>

<b>BUTTER</b> uses the <i>butterowrth</i> digital filter algorithm
to design and instantiate various filter types.

<h3>Usage Notes</h3>

The numeric codes for the "FILTTYPE" (p4) parameter are useful in
embedded applications where strings may not be passed correctly into
the parser.
<p>
p5 ("steepness") is just the number of filters to add in series.  Using more
than 1 steepens the slope of the filter.  If you don't set p6 ("ampbalance")
to 1, you'll need to change p3 ("AMP") to adjust for loss of power caused
by connecting several filters in series.  Guard your ears!
<p>
p6 ("ampbalance") tries to adjust the output of the filter so that it has
the same power as the input.  This means there's less fiddling around
with p3 to get the right amplitude when steepness is > 1.  However,
it has drawbacks: it can introduce a click at the start of the sound, it
can cause the sound to pump up and down a bit, and it eats extra CPU time.
<p>
p12 ("ringdown duration") controls how long the filter will ring once the input
duration has elapsed. This is relevant only when the bandwidth is narrow
enough to produce an audible ring. Very narrow bandwidths could require
quite a long time to ring down (5-10 seconds or more).
<p>
p13 ("output amplitude multiplier") lets you apply an amplitude envelope
that spans the entire note, whose total duration is the sum of the input duration and the ringdown duration.
<p>
The output of <b>BUTTER</b> can be either mono or stereo.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 1)
   load("BUTTER")

   rtinput("mysound.aif")

   ampenv = maketable("window", 1000, "hanning")

   BUTTER(0, 0, 8.7, ampenv, "bandpass", 3, 1, 0, 0, 0, 778, 90.0)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("WAVETABLE")
   load("BUTTER")
   
   /* feed wavetable into filter */
   bus_config("WAVETABLE", "aux 0 out")
   bus_config("BUTTER", "aux 0 in", "out 0-1")
   
   dur = 10.0
   amp = 10000
   pitch = 7.00
   waveform = maketable("wave", 1000,
      1, 1/2, 1/3, 1/4, 1/5, 1/6, 1/7, 1/8, 1/9, 1/10, 1/11, 1/12,
      1/13, 1/14, 1/15, 1/16, 1/18, 1/19, 1/20, 1/21, 1/22, 1/23, 1/24)  /* saw */
   reset(10000)

   WAVETABLE(0, dur, amp, pitch, 0, waveform)
   WAVETABLE(0, dur, amp, pitch+.0005, 0, waveform)
   
   type = 1 // 1: lowpass, 2: highpass, 3: bandpass, 4: bandreject
   amp = 1.0
   sharpness = 5
   
   if (type == 1) {
      balance = 0
      lowcf = 500
      highcf = 5000
   }
   else if (type == 2) {
      balance = 1
      amp = amp * .4
      lowcf = 1
      highcf = 1400
   }
   ampenv = maketable("line", 1000, 0,0, 1,1, 7,1, 10,0)
   filtfreqenv = maketable("line", "nonorm", 1000,
      0,lowcf, dur*.2,lowcf, dur*.5,highcf, dur*.9,lowcf, dur,lowcf)

   BUTTER(0, 0, dur, amp*ampenv, type, sharpness, balance, 0, 0.5, 0, filtfreqenv)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/bus_config.php">bus_config</a>,
<a href="ELL.php">ELL</a>,
<a href="EQ.php">EQ</a>,
<a href="FIR.php">FIR</a>,
<a href="FILTSWEEP.php">FILTSWEEP</a>,
<a href="FILTERBANK.php">FILTERBANK</a>,
<a href="FOLLOWBUTTER.php">FOLLOWBUTTER</a>,
<a href="IIR.php">IIR</a>,
<a href="JFIR.php">JFIR</a>,
<a href="MOOGVCF.php">MOOGVCF</a>,
<a href="MULTEQ.php">MULTEQ</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

