<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - SGRANR</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>SGRANR</b> -- stochastic granular synthesis
<br>
<i>in RTcmix/insts/std/MARAGRAN</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>SGRANR</b>(outsk, dur, amp, rate, p4-7: ratevar, p8-11: duration, p12-15: location, p16-19: transposition[, grainlayers (not used), seed])
	<ul>
	This instrument has no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
   default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude multiplier (relative multiplier of input signal)
   p3 = grain rate (seconds)
   p4-7 = rate variance (between 0.0 and 1.0; it is the % variation in rate - 100% being the rate)
   p8-11 = duration values (seconds)
   p12-15 = location values (0-1 stereo; 0.5 is middle)
   p16-19 = pitch values (Hz)
   p20 = grainlayers [optional; default is 0]
   p21 = random number seed [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sysystem should be used:

   assumes function table 1 is the amplitude envelope
   function table 2 is the synthesis waveform,
   function table 3 is grain amplitude envelope

   Parameters after the [bracket] are optional and default to 0 unless
   otherwise noted.

   Author: Mara Helmuth (mara dot helmuth at uc dot edu)
</pre>
<br>
<hr>
<br>

<b>SGRANR</b>
does stochastic granular synthesis.  It's a fairly powerful instrument,
with lots of snazzy gen-envelope controls to produce evolving granular
textures.  To best understand the concepts behind the design of
this instrument, see Mara Helmth's
<a href="http://ccm.uc.edu/music/cmt/events/computermusic/software">papers</a>
on the use of these techniques.
<p>
It was originally adapted from the older <i>sgran</i> Cmix instrument,
also written by Mara.

<h3>Usage Notes</h3>

At present the setting of the buffer size in
<a href="/reference/scorefile/rtsetparams.php">rtsetparams</a>
appears to have a significant effect on the output of this instrument.
<p>
<b>SGRANR</b> produces stereo output.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 2)
   load("SGRANR")

   makegen(1, 7, 1000, 1, 950, 1, 50, 0)
   makegen(2, 10, 1000, 1)
   makegen(3, 7, 1000, 0, 500, 1, 500, 0)

   start = 0.0
   SGRANR(start, 9.7, 20000, 
   /* grain rate, ratevar values (must be positive, 
      % until next grain possible displacement): */
   .1, 0.1, 0.1, 0.1, 1.0,
   /* duration values: */
   .1,.1,.1,2, 
   /* location values: */
   0.0,.5,1.0,1.0, 
   /* pitch values: */
   800,1000,9700,2,
   /* granlyrs, seed */
   1,1)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="GRANULATE.php">GRANULATE</a>,
<a href="GRANSYNTH.php">GRANSYNTH</a>,
<a href="JCHOR.php">JCHOR</a>,
<a href="JGRAN.php">JGRAN</a>,
<a href="STGRANR.php">STGRANR</a>
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

