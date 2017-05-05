<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - QPAN</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>QPAN</b> -- 4-channel panning of input signal
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>QPAN</b>(outsk, insk, dur, AMP, XLOC, YLOC[, inputchan])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = X coordinate of virtual source (-1.0 - 1.0) [-1: left, 1: right, 0.0: center]
   p5 = Y coordinate of virtual source (-1.0 - 1.0) [-1: back, 1: front, 0.0: center]
   p6 = input channel [optional, default is 0]

   p3 (amplitude), p4 (xloc) and p5 (yloc) can receive dynamic
   updates from a table or real-time control source.

   Author:  John Gibson, 11/18/04
</pre>
<br>
<hr>
<br>


<b>QPAN</b> is a simple instrument to do quadraphonic panning.

<h3>Usage Notes</h3>

The listener is in the center of the coordinate space, at [0,0].
Left-to-right panning (p4, "XLOC") is from -1.0 to 1.0;
back-to-front panning (p5 "YLOC") is from -1.0 to 1.0.
<p>
The
<a href="/reference/scorefile/rtsetparams.php">rtsetparams</a>
scorefile command should be set for 4 channels, and a sound
card capable of sending out 4 independent audio streams is
obviously required.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 4)
   load("WAVETABLE")
   load("QPAN")

   bus_config("WAVETABLE", "aux 0 out")
   bus_config("QPAN", "aux 0 in", "out 0-3")

   dur = 60
   amp = 10000
   freq = 440

   wave = maketable("wave", 2000, 1)
   line = maketable("line", 1000, 0,0, 1,1, 19,1, 20,0)

   WAVETABLE(0, dur, amp * line, freq, 0, wave)

   lag = 70
   srcX = makeconnection("mouse", "X", -1, 1, 0, lag, "X")
   srcY = makeconnection("mouse", "Y", -1, 1, 1, lag, "Y")

   QPAN(0, 0, dur, 1, srcX, srcY)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeconnection.php">makeconnection</a>,
<a href="DMOVE.php">DMOVE</a>,
<a href="MIX.php">MIX</a>,
<a href="MMOVE.php">MMOVE</a>,
<a href="MOVE.php">MOVE</a>,
<a href="MPLACE.php">MPLACE</a>,
<a href="MROOM.php">MROOM</a>,
<a href="NPAN.php">NPAN</a>,
<a href="PLACE.php">PLACE</a>,
<a href="QPAN.php">QPAN</a>,
<a href="ROOM.php">ROOM</a>,
<a href="SROOM.php">SROOM</a>
<a href="STEREO.php">STEREO</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


