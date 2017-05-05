<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - pow</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>pow</b> - exponentiate one argument by the other
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
val = <b>pow</b>(<i>base, exponent</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>pow</b> returns the value of <i>base</i> raised to the <i>exponent</i>
power, i.e.:
<ul>
base<sup>exponent</sup>
</ul>
</P>
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_base"><i>base</i></A><BR>
<DD>
The base of the exponential expression to be evaluated
<P></P></DL>
<DL>
<DT><A NAME="item_exponent"><i>exponent</i></A><BR>
<DD>
The exponent of the exponential expression to be evaluated
<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<pre>
   val = pow(3.5, 3)
   val = pow(4, 0.7)
   val = pow(7.8, 2.597)
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="abs.php">abs</a>,
<a href="log.php">log</a>,
<a href="max.php">max</a>,
<a href="min.php">min</a>,
<a href="mod.php">mod</a>,
<a href="round.php">round</a>,
<a href="trunc.php">trunc</a>,
<a href="wrap.php">wrap</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

