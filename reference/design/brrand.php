<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - brrand/sbrrand</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>brrand/sbrrand</h3>
<i>pseudo-random number generator and initialization</i>
<br>
<br>
This runs a block-computing version of the
<a href="rrand.php">rrand</a>
random number generator and
<a href="srrand.php">srrand</a>
seed/initiliaztion program.
<p>
From the source code:
<hr>
<pre>
/* block version of rrand */
/* a modification of unix rand() to return floating point values between
   + and - 1. */

sbrrand(unsigned int x)
brrand(float amp, float *a, int j)
</pre>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
