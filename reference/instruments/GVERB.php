<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - GVERB</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>GVERB</b> -- very long and smooth reverb algorithm
<br>
<i>in RTcmix/insts/bgg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>GVERB</b>(outsk, insk, dur, AMP, ROOMSIZE, RVBTIME, DAMPING, BANDWIDTH, DRYLEVEL, EARLYREFLECT, RVBTAIL, RINGDOWN[, INCHAN])
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = roomsize (1.0 - 300.0)
   p5 = reverb time (0.1 - 360.0)
   p6 = damping (0.0 - 1.0)
   p7 = input filter bandwidth (0.0 - 1.0)
   p8 = dry level (inverse dB, -90.0 - 0.0)
   p9 = early reflection level (inverse dB, -90.0 - 0.0)
   p10 = tail level (inverse dB, -90.0 - 0.0)
   p11 = ring-down time (seconds, added to duration)
   p12 = input channel [optional; default = 0]


   p3 (amplitude), p4 (roomsize), p5 (reverb time), p6 (damping), p7 (input filter bandwidth
   p8 (dry level), p9 (early reflection level) and p10 (tail level) can receive dynamic updates
   from a table or real-time control source.

   Author:  Brad Garton, 5/2010
</pre>
<br>
<hr>
<br>

<b>GVERB</b>
is a very smooth reverberator with the ability to produce very long
reverb times.

<h3>Usage Notes</h3>



<b>GVERB</b> is based on the original "gverb/gigaverb" by Juhana Sadeharju
(<i>kouhia at nic.funet.fi</i>).  The code for this version was taken from
the Max/MSP version by Olaf Mtthes (<i>olaf.matthes at gmx.de</i>).
<p>
The parameters should be relatively self-explanatory for this instrument.
Note the use of 'inverse' dB to specify the dry signal amount in the
output (p8, "DRYLEVEL"), the early (wall) reflection leveil (p9, "EARLYREFLECT")
and the level of the reverberated signal 'tail' (diffuse reflections,
p10, "RVBTAIL").
<p>
The filter bandwith parameter (p7, "BANDWIDTH") applies a simple low-pass
filter to the input signal prior to processing through the reverberator.
<p>
The ring-down time (p11, "RINGDOWN") is used to allow the revebr to die
away after the input signal has finished.
<p>
If you modulate some of the parameters too quickly using pfield-controls,
some glitching may occur.  Use a shorter
<a href="/reference/scorefile/reset.php">reset</a>
value to compensate (may not always work, though).
<p>
<b>GVERB</b> requires a stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("GVERB")

   rtinput("mysound.aif")

   GVERB(0, 0, 9.8, 0.9, 78.0, 7.0, 0.71, 0.34, -10.0, -11.0, -9.0, 7.0)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("GVERB")

   rtinput("mysound.aif")

   roomsize = maketable("line", "nonorm", 1000, 0, 78.0, 3,200.0, 7,10.0, 10,25.0)
   revtime = maketable("line", "nonorm", 1000, 0,1, 10,50)
   damping = makeLFO("tri", 0.4, 0.1, 0.9)
   amp = 0.7

   GVERB(0, 0, 9.8, amp, roomsize, revtime, damping, 0.34, -10.0, -11.0, -9.0, 7.0)


   inputbandwidth = makeLFO("tri", 0.5, 0.1, 0.9)
   drylevel = maketable("line", "nonorm", 1000, 0,-1.0,  5,-50.0,  7,-1.0, 15,-1.0)
   amp = 0.3

   GVERB(14, 0, 9.8, amp, 35.0, 15.0, 0.5, inputbandwidth, drylevel, -11.0, -9.0, 5.0)


   earlylevel = maketable("line", "nonorm", 1000, 0,-1.0, 5,-68, 9,-10.0, 15,-10.0)
   taillevel = maketable("line", "nonorm", 1000, 0,-70, 5,-3.5, 10,-50, 15,-50)
   amp = 0.9
   GVERB(25, 0, 9.8, amp, 143.0, 9.0, 0.7, 0.7, -27.0, earlylevel, taillevel, 3.0)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="DMOVE.php">DMOVE</a>,
<a href="FREEVERB.php">FREEVERB</a>,
<a href="MMOVE.php">MMOVE</a>,
<a href="MOVE.php">MOVE</a>,
<a href="MPLACE.php">MPLACE</a>,
<a href="MROOM.php">MROOM</a>,
<a href="PLACE.php">PLACE</a>,
<a href="REV.php">REV</a>,
<a href="REVERBIT.php">REVERBIT</a>,
<a href="ROOM.php">ROOM</a>,
<a href="SROOM.php">SROOM</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
