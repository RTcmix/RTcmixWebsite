<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - max</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>max</b> - return maximum value of params
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
maxval = <b>max</b>(<i>p0, p1, p2, ...</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>max</b> returns the maximum of all the parameters <i>p0, p1, ... etc.</i>
passed to it.
</P>
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><i>p0, p1, ..., pN</i>
<DD>
The parameters passed into <b>max</b>
may be any number, floating point or integer.  <b>max</b> will not
work on arrays or tables.
<P></P></DL>


<HR>
<h3>Examples</h3>
<pre>
   mval = max(7, 0, 8.9, -14, 78.7878)
</pre>

<HR>
<h3>See Also</h3>
<p>
<a href="abs.php">abs</a>,
<a href="log.php">log</a>,
<a href="pow.php">pow</a>,
<a href="min.php">min</a>,
<a href="mod.php">mod</a>,
<a href="round.php">round</a>,
<a href="trunc.php">trunc</a>,
<a href="wrap.php">wrap</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

