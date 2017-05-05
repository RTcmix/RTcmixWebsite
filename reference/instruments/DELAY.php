<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - DELAY</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>DELAY</b> -- delay an input signal with feedback
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>DELAY</b>(outsk, insk, indur, AMP, DELAYTIME, FEEDBACK, ringdowndur[, inputchan, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = delay time (seconds)
   p5 = delay feedback (regeneration multiplier, 0-1)
   p6 = ring-down duration (seconds)
   p7 = input channel [optional, default is 0]
   p8 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   p3 (amplitude), p4 (delay time), p5 (feedback) and p8 (pan) can receive
   dynamic updates from a table or real-time control source.
</pre>
<br>
<hr>
<br>

<b>DELAY</b> is a simple, regenerating delay instrument.
It has parameters for regeneration (amount of feedback) and for ring-down time, so that the delay decays naturally.  The original and delayed signals
are mixed in mono, but will be placed in a stereo field at a point
determined by the optional pan parameter (p8).

<h3>Usage Notes</h3>

The point of the ring-down duration parameter is to let you control
how long the delay will sound after the input has stopped.  Too short
a time, and the sound may be cut off prematurely.
<p>
<b>DELAY</b> can produce mono or stereo output.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 1)
   load("DELAY")

   rtinput("somesound.aif")

   DELAY(0, 0, 7, 0.7, .14, 0.7, 3.5)
   DELAY(3.5, 0, 7, 0.9, 1.4, 0.3, 5)
</pre>
<br>
<br>

more advanced:
<pre>
   rtsetparams(44100, 2, 512)
   load("DELAY")

   rtinput("AUDIO")

   ampenv = maketable("line", 1000, 0,0, 1,1, 90,1, 100,1)
   DELAY(0, 0, 14, 0.7*ampenv, .078, 0.8, 3.5, 0, 0.1)

   ampenv = maketable("line", 1000, 0,0, 50,1, 90,1, 100,0)
   panner = makeLFO("sine", 0.5, 0, 1)
   DELAY(7, 0, 10, 1*ampenv, .415, 0.5, 3, 0, panner)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="DEL1.php">DEL1</a>,
<a href="PANECHO.php">PANECHO</a>,
<a href="COMBIT.php">COMBIT</a>,
<a href="JDELAY.php">JDELAY</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
