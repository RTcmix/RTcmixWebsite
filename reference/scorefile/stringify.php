<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - stringify</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>stringify</b> - return pointer to a string argument
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
val = <b>stringify</b>(<i>"somestring"</i>)
<P>


<HR>
<h3>Description</h3>
<P>
<b>stringify</b> returns a pointer to the string argument
(<i>"somestring"</i>) suitable for storing in RTcmix variables.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_somestring"><i>"somestring"</i></A><BR>
<DD>
The string to be converted to an RTcmix pointer.
<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<pre>
rtptr = stringify("hey there!")
</pre>
<p>

<HR>
<h3>See Also</h3>
<P>
<a href="print.php">print</a>,
<a href="printf.php">printf</a>,
<a href="type.php">type</a>,
<a href="len.php">len</a>
</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

