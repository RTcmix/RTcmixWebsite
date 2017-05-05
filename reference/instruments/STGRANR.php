<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - STGRANR</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>STGRANR</b> -- sampling stochastic granular processor
<br>
<i>in RTcmix/insts/std/MARAGRAN</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>STGRANR</b>(outsk, insk, dur, amp, rate, p5-8: ratevar, p9-12: duration, p13-16: location, p17-20: transposition[, grainlayers (not used), seed])
	<ul>
	This instrument has no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
   default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = grain rate (seconds)
   p5-8 = rate variance (between 0.0 and 1.0; it is the % variation in rate - 100% being the rate)
   p9-12 = duration values (seconds)
   p13-16 = location values (0-1 stereo; 0.5 is middle)
   p17-20 = transposition values
   p21 = grainlayers [optional; default is 0]
   p22 = random number seed [optional; default is 0]

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

<b>STGRANR</b>
does stochastic granular signal-processing, decomposing an input soundfile
or real-time sound source.  It's a fairly powerful instrument,
with lots of snazzy gen-envelope controls to produce evolving granular
textures.  To best understand the concepts behind the design of
this instrument, see Mara Helmth's
<a href="http://ccm.uc.edu/music/cmt/events/computermusic/software">papers</a>
on the use of these techniques.
<p>
It was originally adapted from the older <i>stgran</i> Cmix instrument,
also written by Mara.

<h3>Usage Notes</h3>

At present the setting of the buffer size in 
<a href="/reference/scorefile/rtsetparams.php">rtsetparams</a>
appears to have a significant effect on the output of this instrument.
<p>
<b>STGRANR</b> will take mono or stereo input files, it requires
stereo output.

<h3>Sample Scores</h3>

very basic:
<pre>
   set_option("FULL_DUPLEX_ON")
   rtsetparams(44100, 2)
   load("STGRANR")

   rtinput("AUDIO","MIC",2)

   makegen(1, 7, 1000, 1, 950, 1, 50, 0)
   makegen(2, 25, 1000, 1)

   start = 0.0

   /* p0start, p1inputstt, p2dur, p3amp */
   STGRANR(start, 0, 13, 5000, 
   /* grain rate, ratevar values (must be positive,
      % until next grain possible displacement): */
   .1, 0.0, 0.1, 0.2, 1.0,
   /* duration values: */
   .1,.1,.1,2, 
   /* location values: */
   0.0,0.5,1.0,10.0, 
   /* pitch values: */
   0.0,0.00,0.07,2,
   /* granlyrs, seed */
   1,1)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="GRANSYNTH.php">GRANSYNTH</a>,
<a href="GRANULATE.php">GRANULATE</a>,
<a href="JCHOR.php">JCHOR</a>,
<a href="JGRAN.php">JGRAN</a>,
<a href="SGRANR.php">SGRANR</a>
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


