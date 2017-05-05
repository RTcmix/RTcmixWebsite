<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - HOLO</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>HOLO</b> -- stereo FIR filter to perform crosstalk cancellation
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>HOLO</b>(outsk, insk, dur, AMP, XTALKMULT)
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = crosstalk amplitude multipler

   p3 (amplitude) and p4 (crosstalk amplitude multipler) can receive dynamic
   updates from a table or real-time control source.

   Author Doug Scott
</pre>
<br>
<hr>
<br>

<b>HOLO</b>
is a simulation of the fun Carver Sonic Hologram generator (yeah,
we grew up in the late 70's...).  It does some monkey-business with
phase-cancellation between the two outputs of a stereo signal.

<h3>Usage Notes</h3>


Try it out to see how it affects the stereo 'image'.  It can be used
to create a very (deceptively) wide stereo field.  Psychoacoustics in
action!
<p>
<b>HOLO</b> only operates on stereo input files and only writes stereo
output files.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 2)
   load("HOLO")

   rtinput("mysoundfile.aiff")

   HOLO(0, 0, 7.8, 0.7, 0.5)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="MIX.php">MIX</a>,
<a href="STEREO.php">STEREO</a>
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

