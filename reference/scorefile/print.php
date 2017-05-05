<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - print</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>print</b> - print the values of the arguments
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
<b>print</b>(<i>somevar</i>[, <i>othervars...</i>])
<p>
Parameters inside the [brackets] are optional.
<P>


<HR>
<h3>Description</h3>
<P>
<b>print</b> will print the interpreted values of its arguments to the screen.
The command will interpret various
<a href="Minc.php">Minc</a>
data-types and attempt to produce an accurate representation of their
values.  It will print multiple values on a single output line if
multiple values are given as input. <b>print</b> returns 0 to
the Minc environment.
<p>
<b>print</b> will ignore the value set for printing using the
<a href="set_option.php#print">set_option</a>,
<a href="print_on.php">print_on</a> or
<a href="print_off.php">print_off</a>
commands and always print its arguments.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_vars"><i>somevar, othervars</i></A><BR>
<DD>
The variable (or number, etc.) whose value will be printed
<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<p>
The following scorefile:
<dd>
<pre>
a = 7.8
b = 8.9
c = {1, 2, 3}
print(a, b, c)
</pre>
</dd>
will produce the following output:
<dd>
<pre>
7.8, 8.9, [1, 2, 3]
</pre>
</dd>
<P>


<HR>
<h3>See Also</h3>
<P>
<a href="printf.php">printf</a>,
<a href="type.php">type</a>,
<A HREF="dumptable.php">dumptable</A>,
<a href="set_option.php#print">set_option</a>,
<a href="print_on.php">print_on</a>,
<a href="print_off.php">print_off</a>
</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


