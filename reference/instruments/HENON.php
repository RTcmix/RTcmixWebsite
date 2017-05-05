<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - HENON</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>HENON</b> -- Henon map noise generator
<br>
<i>in RTcmix/insts/neil</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>HENON</b>(outsk, dur, AMP[, A, B, X, Y, UPDATE, PAN)
	
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time
   p1 = duration
   p2 = amplitude multiplier
   p3 = a [optional, default is 1.4]
   p4 = b [optional, default is 0.3]
   p5 = x [optional, default is 1]
   p6 = y [optional, default is 1]
   p7 = update rate for p3-p6 [optional, default is 1000]
   p8 = pan (in percent-to-left format) [optional, default is .5]

   p2 (amp), p3-p6 (function parameters), p7 (update rate), and p8 (pan)
   can receive updates from a table or real-time control source.

   p3-p6: Try values within a few tenths of the defaults given here.

   Author: Neil Thornock (neilthornock at gmail), 11/12/16.
</pre>
<br>
<hr>
<br>

Function from the Henon map by Michel Henon.

<h3>Usage Notes</h3>

HENON is a chaotic noise generator. Pfields p3-p6 default to classical Henon map values. Varying these parameters will lead to a variety of different results. Try values within a few tenths of the defaults given.
<p>
Pfield p7 (update rate) is how many times per second p3-p6 are updated and affects the frequency. Values greater than 0 and less than sample rate divided by 5 are valid.

<h3>Sample Score</h3>

<pre>
   rtsetparams(44100, 2)
   load("HENON")

   HENON(0, dur=100, amp=4000, a=1.4, b=0.3, x=1, y=1, update=1000, pan=0.5)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="BROWN.php">BROWN</a>,
<a href="CRACKLE.php">CRACKLE</a>,
<a href="DUST.php">DUST</a>,
<a href="IIR.php">IIR</a>,
<a href="LATOOCARFIAN.php">LATOOCARFIAN</a>,
<a href="NOISE.php">NOISE</a>,
<a href="PINK.php">PINK</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
