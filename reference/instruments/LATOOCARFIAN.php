<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - LATOOCARFIAN</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>LATOOCARFIAN</b> -- chaotic noise generator
<br>
<i>in RTcmix/insts/neil</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>LATOOCARFIAN</b>(outsk, dur, AMP[, A, B, C, D, X, Y, PAN])
	
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time
   p1 = duration
   p2 = amplitude multiplier
   p3 = parameter a [optional, default is 2.871]
   p4 = parameter b [optional, default is 2.75]
   p5 = parameter c [optional, default is 1]
   p6 = parameter d [optional, default is 0.75]
   p7 = seed x [optional, default is 0.5]
   p8 = seed y [optional, default is 0.5]
   p9 = pan (in percent-to-left format) [optional, default is .5]

   p2 (amp), p3-p8 (function parameters), and p9 (pan) can receive
   updates from a table or real-time control source.

   Any values for p3-p8 are legal. Pickover recommends values for a and b
   between -3 and 3,  and p4 and p5 between 0.5 and 1.5. Depending on the
   values provided, results may be chaotic noise, pitch, or silence.

   Author: Neil Thornock (neilthornock at gmail), 11/12/16
</pre>
<br>
<hr>
<br>

<b>LATOOCARFIAN</b> is based on a function given in Clifford Pickover's book Chaos
in Wonderland.

<h3>Usage Notes</h3>

The Latoocarfian chaotic function was described by Clifford Pickover in his book Chaos in Wonderland. Any values for p3-p8 are legal, but not all values will produce sonic results. Try values of -3 to 3 for p3 and p4, and values of 0.5 to 1.5 for p4 and p5.

<h3>Sample Score</h3>

<pre>
   rtsetparams(44100, 2)
   load("LATOOCARFIAN")

   c = maketable("line", 1000, 0,0.5, 1,1)
   LATOOCARFIAN(0, dur=100, amp=4000, a=2.871, b=2.75, c, d=0.75, x=0.5, y=0.5,
      pan=0.5)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="BROWN.php">BROWN</a>,
<a href="CRACKLE.php">CRACKLE</a>,
<a href="DUST.php">DUST</a>,
<a href="HENON.php">HENON</a>,
<a href="IIR.php">IIR</a>,
<a href="NOISE.php">NOISE</a>,
<a href="PINK.php">PINK</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
