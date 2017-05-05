<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - COMBIT</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>COMBIT</b> -- comb filter an input signal
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>COMBIT</b>(outsk, insk, dur, AMP, FREQ (Hz), REVERBTIME[, inputchan, PAN, ringdowndur])
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = frequency (Hz)
   p5 = reverb time (seconds)
   p6 = input channel [optional, default is 0]
   p7 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]
   p8 = ring-down duration [optional, default is first reverb time value]

   p3 (amplitude), p4 (frequency), p5 (reverb time) and p7 (pan) can receive
   dynamic updates from a table or real-time control source.
</pre>
<br>
<hr>
<br>

<b>COMBIT</b>
applies a comb filter -- a short feedback delay line -- to an input signal.
This delay line of delay time <i>T</i>, when applied to an incoming signal,
causes the sound to ring at frequency <i>1/T</i> for an amount of time which
decays exponentially proportional to the percentage of feedback (adapted
from Roads, 1997).  <b>COMBIT</b> thus takes an input soundfile or real-time
audio input and makes it ring at the frequency specified in p4 of
the instrument,
with a decay time in seconds of p5.  The efficacy of the comb filter is
dependent on the amount of that frequency already present in the incoming
signal (thus, a very low filter frequency applied to a high-pitched soundfile
will not ring as well as it would applied to a low-sounding signal).

<h3>Usage Notes</h3>

The point of the ring-down duration parameter (p8, optional) is to let
you control how long the combs will ring after the input has stopped.  If
the reverb time is constant, <b>COMBIT</b> will figure out the correct
ring-down duration for you based on the reverb time (p5).  If the reverb
time is dynamic, you must specify a ring-down duration if you want to
ensure that your sound will not be cut off prematurely.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 2)
   load("COMBIT")

   rtinput("somesound.aif")

   // two resonating filters a fifth apart in separate channels
   // the sound of the second will be slightly delayed (0.2 seconds)
   COMBIT(0, 0, 3.5, 0.3, cpspch(7.09), .5, 0, 0)
   COMBIT(0.2, 0, 3.5, 0.3, cpspch(7.07), .5, 0, 1)
</pre>
<br>
<br>
more advanced:
<pre>
   rtsetparams(44100, 2)
   load("COMBIT")
   control_rate(1000)

   rtinput("AUDIO")

   dur = 0.1
   ampenv = maketable("line", 1000, 0,0, 0.1,1, 1,0) 
   for (outsk = 0; outsk < 14.0; outsk = outsk + 0.1) {
      insk = random() * 7.0
      pitch = random() * 500 + 100
      COMBIT(outsk, insk, dur, 0.1*ampenv, pitch, .5, 0, random());
   }
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="MULTICOMB.php">MULTICOMB</a>,
<a href="FLANGE.php">FLANGE</a>,
<a href="DELAY.php">DELAY</a>,
<a href="JDELAY.php">JDELAY</a>,
<a href="REVERBIT.php">REVERBIT</a>,
<a href="REV.php">REV</a>,
<a href="IIR.php">IIR</a>
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
