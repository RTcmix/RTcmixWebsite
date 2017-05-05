<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - SCRUB</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>SCRUB</b> -- dynamically transpose an input signal using sync interpolation
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>SCRUB</b>(outsk, insk, outdur, AMP, SPEEDMULT, syncwidth, oversampling[, inputchan, pan])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = output duration (or endtime if negative) (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = speed multiplier
   p5 = sync width (samples)
   p6 = sync oversampling (samples)
   p7 = input channel [optional; default is 0]
   p8 = percent to left [optional; default is .5]

   p3 (amplitude), p4 (speed multiplier) can receive dynamic updates
   from a table or real-time control source

   Author:  Doug Scott, based on interpolation and i/o code by Tobias Kunze-Briseno.
</pre>
<br>
<hr>
<br>

<b>SCRUB</b> is a pitch-shifting instrument using an interesting interpolation
scheme.  This approach allows for the 'scrubbing' of sound samples down to
0 (and reversed!) to achieve an effect similar to the sound of analog tape
being moved back and forth against a playback tape head.

<h3>Usage Notes</h3>


The main parameter to use is the "SPEEDMULT" (p4), which can change dynamically.
A value of 1.0 will play the input sound normally, a value of -1.0 will
play it in reverse (you will need to set the input start time (p1)
accordingly).  2.0 will play the file at twice the speed, and -0.5
will play it backwards at 1/2 speed.  A valu of 0 will stop the sound
altogether, just like 'scrubbing' a tape on a tape head (ancient
people can recall this...).
<p>
The "syncwidth" (p5) and "oversampling" (p6) parameters determine how
the buffer used for scrubbing will be set up.  These don't seem to
have an obvious effect on the sound.  It also seems that they should
be &lt; the buffer size set in
<a href="/reference/scorefile/rtsetparams.php">rtsetparams</a>.
<p>
The buffer size set in
<a href="/reference/scorefile/rtsetparams.php">rtsetparams</a>
seems to have a significant effect on the sound.
<p>
The output of <b>SCRUB</b> can be either mono or stereo

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("SCRUB")
   
   rtinput("mysound.aif")

   speed = 1
   dur = DUR(0)
   skip = 0
   // Play forward from time 0
   SCRUB(0, skip, dur, 1, speed, 16, 40)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2, 2048)
   load("SCRUB")

   rtinput("mysound.wav")

   speedchange = maketable("line", 8192, 0,1, 1,-1)
   dur = DUR(0) * 2
   skip = 0
   // Play file, moving from normal speed to reverse normal
   SCRUB(0, skip, dur, 1, speedchange, 16, 40)
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2, 256)
   load("SCRUB")

   rtinput("mysound.aif")

   speed = -1
   skip = DUR(0)
   dur = skip
   // Play backwards from end to beginning in channel 0
   SCRUB(0, skip, dur, 1, speed, 16, 40, 0, 0)

   speed = -0.5
   skip = DUR(0)
   dur = DUR(0) * 2
   // Play reversed at half-speed from end in channel 1
   SCRUB(0, skip, dur, 1, speed, 16, 40, 0, 1)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="TRANS.php">TRANS</a>,
<a href="TRANS3.php">TRANS3</a>,
<a href="TRANSBEND.php">TRANSBEND</a>,
<a href="MOCKBEND.php">MOCKBEND</a>,
<a href="REVMIX.php">REVMIX</a>,
<a href="MIX.php">MIX</a>,
<a href="STEREO.php">STEREO</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

