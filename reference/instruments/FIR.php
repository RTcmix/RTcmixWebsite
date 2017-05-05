<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - FIR</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>FIR</b> -- simple finite impulse response filter
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>FIR</b>(outsk, insk, dur, AMP, ncoefficients, coefficients...)
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = total number of filter-equation coefficients
   p5...  the coefficients (up to 99 fir coefficients)

  p3 (amplitude) can receive updates.
  <i>NOTE: mono input / mono output only</i>
</pre>
<br>
<hr>
<br>

<b>FIR</b> creates a <i>finite impulse response</i> filter
using the filter coefficients passed to the instrument.  The filter is
non-recursive (i.e. only past inputs are used in the equation),
in the form:<br>
<ul>
y<sub>n</sub> = a<sub>n</sub>x<sub>n</sub> &plusmn a<sub>n-1</sub>x<sub>n-1</sub>... &plusmn a<sub>n-x</sub>x<sub>n-x</sub><br>
<br>
<i>(a<sub>n-x</sub> are the filter coefficients, x<sub>n-x</sub>
are the past inputs from the sample stream)</i>
</ul>

<h3>Usage Notes</h3>


<b>FIR</b> can be used to design fairly complex filters, although
the phase-shifting due to a long stream of past inputs is an
inherent design problem with basic FIR filters.  The trick is to
find the right set of coefficients.  There are a number of good
web sites that will generate FIR coefficients given a frequency-graph
type of specification.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 1)
   load("FIR")

   rtinput("mysound.aif")
   FIR(0, 0, 7.0, 0.7, 7, 0.9, 0.1, 0.69, -0.49, 0.314, 0.2, 0.09)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="BUTTER.php">BUTTER</a>
<a href="ELL.php">ELL</a>
<a href="EQ.php">EQ</a>
<a href="FILTERBANK.php">FILTERBANK</a>,
<a href="FILTSWEEP.php">FILTSWEEP</a>,
<a href="IIR.php">IIR</a>,
<a href="JFIR.php">JFIR</a>,
<a href="MOOGVCF.php">MOOGVCF</a>,
<a href="MULTEQ.php">MULTEQ</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

