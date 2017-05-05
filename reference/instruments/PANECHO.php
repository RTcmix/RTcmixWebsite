<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - PANECHO</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>PANECHO</b> -- stereo echo with feedback
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>PANECHO</b>(outsk, insk, dur, AMP, CHAN_0_DELAY, CHAN_1_DELAY, FEEDBACK, ringdowndur[, inputchan])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = left channel delay time (seconds)
   p5 = right channel delay time (seconds)
   p6 = delay feedback (i.e., regeneration multiplier) [0-1]
   p7 = ring-down duration (seconds)
   p8 = input channel [optional; default is 0]

   p3 (amplitude), p4 (left delay time), p5 (right delay time) and
   p6 (feedback) can receive dynamic updates from a table or real-time
   control source.

   Author:  Brad Garton;  rev. for v4.0 by JGG, 7/10/04
</pre>
<br>
<hr>
<br>

<b>PANECHO</b> is a more complex stereo delay instrument than
<a href="DELAY.php">DELAY</a>.
<b>PANECHO</b> takes an input signal and "ping-pongs" the delays between
the left and right channels.

<h3>Usage Notes</h3>

The input signal will first appear in channel 0 of the output after
"CHAN_0_DELAY" seconds.  This is then fed into the delay for channel 1,
where it will appear "CHAN_1_DELAY" seconds after channel 0.  This then
feeds back into the delay line of channel 0 after being multiplied
by p6 ("FEEDBACK").  Obviously p6 should be < 1.0.
<p>
The point of the ring-down duration parameter (p7) is to let you control
how long the delay will sound after the input has stopped.  Too short
a time, and the sound may be cut off prematurely as the echoes die away.
<p>
Any amplitude control information coming through p3 will be applied
to the audio input over the duration (p2) of the note -- the envelope
will be finished during the ring-down period.
<p>
The delay lines are allocated based on the pfield parameters, so
arbitrarily long delays are possible (at some point you use up
available computer memory...)
<p>
<b>PANECHO</b> can only process one channel at a time; however two
<b>PANECHO</b> notes (acting on different input channels) can work
simultaneously.  <b>PANECHO</b> assumes stereo output.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 2)
   load("PANECHO")

   rtinput("mysoundfile.aif")

   ampenv = maketable("line", 1000, 0,0, 0.5,1, 3.5,1, 7,0)
   PANECHO(0, 0, 7, 0.7*ampenv, .14, 0.069, .7, 3.5)
   
   ampenv= maketable("line", 1000, 0,0, 0.1,1, 1.5,0.21, 3.5,1, 7,0)
   PANECHO(4.9, 0, 7, 1*ampenv, 3.14, 0.5, 0.35, 9.5)
</pre>
<br>
<br>

another basic score:
<pre>
   set_option("full_duplex_on")
   rtsetparams(44100, 2)
   load("PANECHO")

   rtinput("AUDIO", "MIC")

   ampenv = maketable("line", 1000, 0,1, 100, 1)
   PANECHO(0, 0, 14, 0.9*ampenv, 5.14, 1.14, .7, 9.5)
   PANECHO(10, 0, 7, 0.5*ampenv, 1.14, 0.14, .7, 3.5)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="COMBIT.php">COMBIT</a>,
<a href="DEL1.php">DEL1</a>,
<a href="DELAY.php">DELAY</a>,
<a href="FLANGE.php">FLANGE</a>,
<a href="JDELAY.php">JDELAY</a>,
<a href="ROOM.php">ROOM</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>



