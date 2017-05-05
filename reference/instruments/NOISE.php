<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - NOISE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>NOISE</b> -- generate white noise
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>NOISE</b>(outsk, dur, AMP[, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   p2 (amplitude) and p3 (pan) can receive dynamic updates from a table or
   real-time control source.
   
   Author: JGG <johgibso at indiana dot edu>, 24 Dec 2002, rev. 7/9/04
</pre>
<br>
<hr>
<br>

<b>NOISE</b> makes white (or pseudo-white...) noise.  It is very noisy.
It is good for annoying your family, unless your family is a
bunch of <i>weirdoes</i>.
<p>

<h3>Usage Notes</h3>

The series of random numbers that makes the noise is affected by any
calls to the
<a href="/reference/scorefile/srand.php">srand</a>
scorefile command in the script.  If there are no such calls, the
random seed is 1.
<p>
Output may be mono or stereo.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 1)
   load("NOISE")

   ampenv = maketable("window", 1000, "hanning")
   NOISE(0.0, 2.5, 20000*ampenv)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="IIR.php">IIR</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

