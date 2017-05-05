<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - pluckset</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>pluckset</h3>
<i>Karplus-Strong ("plucked string") algorithm setup</i>
<br>
<br>
This initializes a simple Karplus-Strong filter/generator
(<a href="pluck.php">pluck</a>).
See the
documentation for
<a href="hplset.php">hplset</a>
for more information (and a better implementation).
<p>
From the source code:
<hr>
void
pluckset(float xlp, float amp, float seed, float c, float *q, float sr)
<hr>

<h3>See Also</h3>
<a href="pluck.php">pluck</a>
<p>
The source code for the
<a href="/reference/instruments/STRUM.php">STRUM</a>
instrument contains much better plucked-string algorithms.  This
ugen is as old as the hills.


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
