<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - type</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>type</b> - return the Minc data-type of the argument
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
strval = <b>type</b>(<i>somevar</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>type</b> will return (as a string) the data-type of its argument.
At present the following are valid
<a href="Minc.php">Minc</a>
data-types:
<ul>
<li>void
<li>float
<li>string
<li>handle
<li>list
</ul>
</P>
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><i>somevar</i>
<DD>
Any valid
<a href="Minc.php">Minc</a>
variable.
<P></P></DL>

<HR>
<h3>Examples</h3>
<pre>
   datatype= type(arbitrary_var)
   print(datatype)
</pre>

<HR>
<h3>See Also</h3>
<P>
<a href="len.php">len</a>,
<a href="print.php">print</a>,
<a href="printf.php">printf</a>,
<a href="stringify.php">stringify</a>
</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

