<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - mod</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>mod</b> - modulus command
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
modval = <b>mod</b>(<i>p0, p1</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>mod</b> returns the result of the operation
<i>p0 mod p1</i> (otherwise known as: <i>p0 % p1</i>).  <b>mod</b>
converts both params to integers.
<p>
The
<a href="wrap.php">wrap</a>
command apparently does the same thing.
</P>
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><i>p0, p1</i>
<DD>
The parameters used to perform the <i>a mod b</i> (in this case,
<i>p0 mod p1</i>) operation.  Essentially <b>mod</b> gives the remainder
of dividing <i>p0</i> into <i>p1</i>.  <i>Modular</i> (or "clock")
arithmetic is very useful in western, 12-note/octave music.
<P></P></DL>


<HR>
<h3>Examples</h3>
<pre>
   modout = mod(3, 12)
</pre>

<HR>
<h3>See Also</h3>
<p>
<a href="abs.php">abs</a>,
<a href="log.php">log</a>,
<a href="pow.php">pow</a>,
<a href="max.php">max</a>,
<a href="min.php">min</a>,
<a href="round.php">round</a>,
<a href="trunc.php">trunc</a>,
<a href="wrap.php">wrap</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


