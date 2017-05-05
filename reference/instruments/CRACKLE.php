<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - CRACKLE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>CRACKLE</b> -- chaotic noise generator
<br>
<i>in RTcmix/insts/neil</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>CRACKLE</b>(outsk, dur, AMP[, CHAOS, PAN])
	
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time
   p1 = duration
   p2 = amplitude multiplier
   p3 = chaos parameter (0-1) [optional, default is 1]
   p4 = pan (in percent-to-left format) [optional, default is .5]

   p2 (amplitude), p3 (chaos), and p4 (pan) can receive updates from a table or
   real-time control source.

   Author: Neil Thornock (neilthornock at gmail), 11/12/16
</pre>
<br>
<hr>
<br>

Chaos (p3) values near 0 are less crackly (closer to white noise). As chaos approaches 1, it crackles more.
<p>

<h3>Usage Notes</h3>

Output may be mono or stereo.

<h3>Sample Score</h3>

<pre>
   rtsetparams(44100, 2)
   load("CRACKLE")

   CRACKLE(0, dur=100, amp=4000, chaos=0.9, pan=0.5)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="BROWN.php">BROWN</a>,
<a href="DUST.php">DUST</a>,
<a href="HENON.php">HENON</a>,
<a href="IIR.php">IIR</a>,
<a href="LATOOCARFIAN.php">LATOOCARFIAN</a>,
<a href="NOISE.php">NOISE</a>,
<a href="PINK.php">PINK</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
