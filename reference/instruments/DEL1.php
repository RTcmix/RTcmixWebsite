<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - DEL1</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>DEL1</b> -- simple stero delay of input signal
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>DEL1</b>(outsk, insk, dur, AMP, DELAYTIME, DELAYAMP[, inputchan, ringdowndur])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = output duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = right channel [channel 1] delay time (seconds)
   p5 = right channel amplitude multiplier (relative to left channel)
   p6 = input channel [optional, default is 0]
   p7 = ring-down duration [optional, default is first delay time value] 

   p3 (amplitude), p4 (delay time) and p5 (delay amplitude) can receive
   dynamic updates from a table or real-time control source.
</pre>
<br>
<hr>
<br>

<b>DEL1</b>
is a simple, non-regenerating delay instrument which takes an input
soundfile or real-time source and mixes it with a delayed copy of itself
with an optional difference in amplitude.  The resulting sound is placed
left (channel 0, non-delayed) and right (channel 1, delayed)
in a stereo field.

<h3>Usage Notes</h3>

This is a good instrument for generating a "slap-back" delay effect,
or for generating interesting spatial-placement illusions using
two speakers (very short delay times).
<p>
The point of the ring-down duration parameter is to let you control
how long the delay will sound after the input has stopped.  If the
delay time is constant, <b>DEL1</b> will figure out the correct ring-down
duration for you.  If the delay time is dynamic, you must specify a
ring-down duration if you want to ensure that your sound will not be
cut off prematurely.
<p>
<b>DEL1</b> writes only stereo output.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 2) // output has to be stereo
   load("DEL1")

   rtinput("somefile.aif")

   // delayed sound in right channel will be 0.14 seconds after the left
   DEL1(0, 0, 7, 1.0, .14, 1.0)
</pre>
<br>
<br>
more advanced:
<pre>
   set_option("full_duplex_on")
   rtsetparams(44100, 2, 512)
   load("DEL1")

   rtinput("AUDIO")

   ampenv = maketable("line", 1000, 0,0, 1,1, 16,1, 17,0)
   DEL1(0, 0, 17, 1*ampenv, 4.3, 1)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="DELAY.php">DELAY</a>,
<a href="PANECHO.php">PANECHO</a>,
<a href="COMBIT.php">COMBIT</a>,
<a href="JDELAY.php">JDELAY</a>



<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
