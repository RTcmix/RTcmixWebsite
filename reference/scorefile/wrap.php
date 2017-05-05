<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - wrap</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>wrap</b> - mod-like command
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
val = <b>wrap</b>(<i>value, range</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>wrap</b> returns the modulus of <i>value</i>, using <i>range</i>
as the modulo; i.e. it will keep <i>value</i> within <i>range</i>
by "wrapping" it around.
<p>
See also
<a href="mod.php">mod</a>
which apparently does the same thing.
</P>
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><i>value, range</i>
<DD>
The parameters used to perform the "wrapping" (i.e.
<i>a mod b;</i> in this case,
<i>value mod range</i>) operation.
Essentially <b>wrap</b> gives the remainder
of dividing <i>value</i> into <i>range</i>.  <i>Modular</i> (or "clock")
arithmetic is very useful in western, 12-note/octave music.
<P></P></DL>


<HR>
<h3>Examples</h3>
<pre>
   wrappedval = wrap(7, 12)
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="abs.php">abs</a>,
<a href="log.php">log</a>,
<a href="pow.php">pow</a>,
<a href="max.php">max</a>,
<a href="mod.php">mod</a>,
<a href="min.php">min</a>,
<a href="round.php">round</a>,
<a href="trunc.php">trunc</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>



<br>
<br>
<br>
<br>
<br>
<br>
<br>


</body>
</html>
