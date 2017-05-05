<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - BROWN</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>BROWN</b> -- brown noise instrument
<br>
<i>in RTcmix/insts/neil</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>BROWN</b>(outsk, dur, AMP[, PAN])
	
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = pan (0-1 stereo; 0.5 is middle) [optional, default is .5]

   p2 (amplitude) and p3 (pan) can receive updates from a table or
   real-time control source.

   Author: Neil Thornock (neilthornock at gmail), 11/12/16
</pre>
<br>
<hr>
<br>

<b>BROWN</b> is based on an <a href="http://vellocet.com/dsp/noise/VRand.html">algorithm by Andrew Simper</a>, who
credits these people, mainly from the music-dsp mailing list:
Allan Herriman, James McCartney, Phil Burk and Paul Kellet, and the
<a href="http://www.firstpr.com.au/dsp/pink-noise">web page by Robin Whittle</a>.

<h3>Usage Notes</h3>

Output may be mono or stereo.

<h3>Sample Score</h3>

<pre>
   rtsetparams(44100, 2)
   load("BROWN")

   BROWN(0, dur=100, amp=4000, pan=0.5)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="CRACKLE.php">CRACKLE</a>,
<a href="DUST.php">DUST</a>,
<a href="HENON.php">HENON</a>,
<a href="IIR.php">IIR</a>,
<a href="LATOOCARFIAN.php">LATOOCARFIAN</a>,
<a href="NOISE.php">NOISE</a>,
<a href="PINK.php">PINK</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
