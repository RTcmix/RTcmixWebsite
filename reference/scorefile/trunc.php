<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - trunc</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>trunc</b> - truncate value of argument
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
val = <b>trunc</b>(<i>someval</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>trunc</b> returns the truncated (integer part) value of <i>someval</i>.
Like all Minc functions, however, it returns it as a double (floating-point)
value.  For example
<pre>
<ul>
val = trunc(14.154978)
</pre>
</ul>
will set <i>val</i> to 14.0.
This differs from the
<a href="round.php">round</a>
scorefile command in that
<a href="round.php">round</a>
will return the closest int, where
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
   truncval = trunc(arbitrary_val)
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
<a href="round.php">round</a>,
<a href="wrap.php">wrap</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


