<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - DISTORT</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>DISTORT</b> -- non-linear distortion of an input signal
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>DISTORT</b>(outsk, insk, dur, AMP, disttype, PREAMP, LOWPASSFREQ[, inputchan, PAN, BYPASS])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = type of distortion (1: soft clip, 2: tube)
   p5 = gain (before distortion) (relative multiplier)
   p6 = cutoff freq for low-pass filter (Hz)  (0 to disable filter)
   p7 = input channel [optional; default is 0]
   p8 = percent to left channel [optional; default is .5]
   p9 = bypass (0: bypass off, 1: bypass on) [optional; default is 0]

   p3 (amplitude), p5 (gain), p6 (cutoff), p8 (pan) and p9 (bypass) can
   receive dynamic updates from a table or real-time control source.

   Author: John Gibson (johgibso at indiana dot edu), 8/12/03, rev for v4, 7/10/04.
</pre>
<br>
<hr>
<br>


<b>DISTORT</b> applies waveshaping (clipping) distortion and an optional
lowpass filter to an input sound

<h3>Usage Notes</h3>



<b>DISTORT</b>
will apply a non-linear distortion algoritm ("clipping") to an
input sound and then (optionally) lowpass filter the result.
The distortion algorithm used is taken from the
<a href="STRUM.php">STRUM</a> instrument, code originally written
by Charles Sullivan.
<b>DISTORT</b> is similar in action to
<a href="SHAPE.php">SHAPE</a>.
<p>
The "tube" setting for p4 ("disttype") doesn't work correctly yet.
<p>
The optional low-pass filter (p6 &gt; 0) is a simple butterworth
filter design.  The cutoff frequency may be modulated dynamically.
The filter comes after the distortion in the signal chain.
<p>
<b>DISTORT</b> can produce either mono or stereo output.


<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("DISTORT")

   rtinput("AUDIO")
   
   // distort output
   type = 1   // 1: soft clip, 2: tube
   amp = 1.0
   ampenv = maketable("line", 1000, 0,0, 2,1, 4,1, 5,0)
   gain = 10.0
   cf = 2000 // lowpass filter
   DISTORT(0, 0, 5.0, amp*ampenv, type, gain, cf, 0, 1)
   DISTORT(0.2, 0, 5.0, amp*ampenv, type, gain, cf, 0, 0)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("WAVETABLE")
   load("DISTORT")
   
   bus_config("WAVETABLE", "aux 0 out")
   bus_config("DISTORT", "aux 0 in", "out 0-1")
   
   dur = 6.0
   amp = 10000
   pitch = 7.00
   wavetable = maketable("wave", 1000, 
      1, 1/2, 1/3, 1/4, 1/5, 1/6, 1/7, 1/8, 1/9, 1/10, 1/11, 1/12,
      1/13, 1/14, 1/15, 1/16, 1/18, 1/19, 1/20, 1/21, 1/22, 1/23, 1/24)  // saw
   reset(10000) 
   WAVETABLE(0, dur, amp, pitch, 0, wavetable)
   WAVETABLE(0, dur, amp, pitch+.0002, 0, wavetable)
   
   // distort wavetable output
   bypass = 0
   type = 1   // 1: soft clip, 2: tube
   amp = 1.2
   ampenv = maketable("line", 1000, 0,0, 1,1, 7,1, 10,0)
   gain = 30.0
   cf = 0
   DISTORT(0, 0, dur, amp*ampenv, type, gain, cf, 0, 1, bypass)
   DISTORT(0.2, 0, dur, amp*ampenv, type, gain, cf, 0, 0, bypass)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="BUTTER.php">BUTTER</a>,
<a href="COMPLIMIT.php">COMPLIMIT</a>,
<a href="DECIMATE.php">DECIMATE</a>,
<a href="SHAPE.php">SHAPE</a>,
<a href="STRUMFB.php">STRUMFB</a>,
<a href="WAVESHAPE.php">WAVESHAPE</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

