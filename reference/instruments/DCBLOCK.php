<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - DCBLOCK</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>DCBLOCK</b> -- remove (most of) DC bias from input signal
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>DCBLOCK</b>(outsk, insk, dur, AMP)
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)

   p3 (amplitude) can receive dynamic updates from a table or real-time control source.

   Author:  John Gibson <johgibso at indiana dot edu>, 5/21/06
</pre>
<br>
<hr>
<br>

<b>DCBLOCK</b> uses a simple one-pole/one-zero filter set to remove a DC
(0 Hz) offset component in the output signal. The recursive filter
equation used for this object is:
<ul>
<pre>
y[n] = x[n] - x[n-1] + 0.99*y[n-1]
</pre>
</ul>
where <i>y[n]</i> and <i>y[n-1]</i> are the current and previous outputs of
the equation, respectively, and <i>x[n]</i> and <i>x[n-1]</i> are the
current and previous sample inputs to the filter equation.

<h3>Usage Notes</h3>



<b>DCBLOCK</b> processes N input channels to N output channels, e.g. mono
to mono, stereo to stereo, quad to quad, etc.
<p>
The sound itself should be relatively unchanged by <b>DCBLOCK</b>.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("DCBLOCK")

   rtinput("mysound.aif")

   DCBLOCK(0, 0, DUR(), 1.0)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="ELL.php">ELL</a>,
<a href="EQ.php">EQ</a>,
<a href="FIR.php">FIR</a>,
<a href="IIR.php">IIR</a>,
<a href="JFIR.php">JFIR</a>,
<a href="MULTEQ.php">MULTEQ</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

