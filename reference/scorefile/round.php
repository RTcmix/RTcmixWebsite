<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - round</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>round</b> - round the argument to the nearest integer
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
val = <b>round</b>(someval)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>round</b> returns (as a double) the nearest integer ("rounded off")
value of the argument <i>someval</i>.  I.e. 3.789 becomes 4.0; 987.123
become 987.0.  This differs from the
<a href="trunc.php">trunc</a>
scorefile command in that it will return the closest int, where
<a href="trunc.php">trunc</a>
simply ignores the values after the decimal point.
</P>
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><i>someval</i>
<DD>
Any number, floating point or integer (although an int would be silly...)
<P></P></DL>


<HR>
<h3>Examples</h3>
<pre>
   roundedval = round(arbitrary_val)
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="abs.php">abs</a>,
<a href="log.php">log</a>,
<a href="pow.php">pow</a>,
<a href="max.php">max</a>,
<a href="min.php">min</a>,
<a href="mod.php">mod</a>,
<a href="trunc.php">trunc</a>,
<a href="wrap.php">wrap</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

