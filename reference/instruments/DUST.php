<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - DUST</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>DUST</b> -- random impulses
<br>
<i>in RTcmix/insts/neil</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>DUST</b>(outsk, dur, AMP[, DENSITY, min range, PAN])
	
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time
   p1 = duration
   p2 = amplitude multiplier
   p3 = density (average impulses per second) [default: 5]
   p4 = impulse range minimum (-1 or 0) [default: -1]
   p5 = pan (in percent-to-left format) [default: 0.5]

   p2 (amplitude), p3 (pan), and p4 (density) can receive updates from a table
   or real-time control source.
   
   Author: Neil Thornock (neilthornock at gmail), 11/12/16
</pre>
<br>
<hr>
<br>

<b>DUST</b> generates randomly spaced impulses with a range of either 0 to 1 or -1 to 1. At very high densities, it generates white noise.
<p>
Inspired by the Dust and Dust2 ugens from SuperCollider.
<p>

<h3>Usage Notes</h3>

Output may be mono or stereo.

<h3>Sample Score</h3>

<pre>
   rtsetparams(44100, 2)
   load("DUST")

   density = maketable("line", "nonorm", 1000, 0,0, 1,10)
   DUST(0, dur=100, amp=4000, density, minrange=-1, pan=0.5)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="BROWN.php">BROWN</a>,
<a href="CRACKLE.php">CRACKLE</a>,
<a href="HENON.php">HENON</a>,
<a href="IIR.php">IIR</a>,
<a href="LATOOCARFIAN.php">LATOOCARFIAN</a>,
<a href="NOISE.php">NOISE</a>,
<a href="PINK.php">PINK</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
