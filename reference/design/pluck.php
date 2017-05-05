<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - pluck</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>pluck</h3>
<i>Karplus-Strong ("plucked string") algorithm generator</i>
<br>
<br>
This implements a simple Karplus-Strong filter/generator.  See the
documentation for
<a href="hpluck.php">hpluck</a>
for more information (and a better implementation).
This is initialized by the
<a href="pluckset.php">pluckset</a>
function.
<p>
From the source code:
<hr>
float pluck(float sig, float *q)
<hr>

<h3>See Also</h3>
<a href="pluckset.php">pluckset</a>
<p>
The source code for the
<a href="/reference/instruments/STRUM.php">STRUM</a>
instrument contains much better plucked-string algorithms.  This
ugen is pretty ancient.


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
