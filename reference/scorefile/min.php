<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - min</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>min</b> - return minimum value of params
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
minval = <b>min</b>(<i>p0, p1, p2, ...</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>min</b> returns the minimum of all the parameters <i>p0, p1, ... etc.</i>
passed to it.
</P>
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><i>p0, p1, ..., pN</i>
<DD>
The parameters passed into <b>min</b>
may be any number, floating point or integer.  <b>min</b> will not
work on arrays or tables.
<P></P></DL>


<HR>
<h3>Examples</h3>
<pre>
   mval = min(7, 0, 8.9, -14, 78.7878)
</pre>

<HR>
<h3>See Also</h3>
<p>
<a href="abs.php">abs</a>,
<a href="log.php">log</a>,
<a href="pow.php">pow</a>,
<a href="max.php">max</a>,
<a href="mod.php">mod</a>,
<a href="round.php">round</a>,
<a href="trunc.php">trunc</a>,
<a href="wrap.php">wrap</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

