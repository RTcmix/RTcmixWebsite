<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - printf</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>printf</b> - C-like formatted printing
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
<b>printf</b>(<i>"format string"</i>, <i>var1</i>[, <i>var2 ...</i>])
<p>
Parameters inside the [brackets] are optional.
<P>


<HR>
<h3>Description</h3>
<P>
<b>printf</b> will print a formatted version of the values its arguments
to the screen using a syntax similar to the C "printf" command.
The <b>printf</b> formatting can truncate floating point
numbers to integers in the output.  <b>printf</b> returns 0 to
the Minc environment.
<p>
<b>printf</b> will ignore the value set for printing using the
<a href="set_option.php#print">set_option</a>,
<a href="print_on.php">print_on</a> or
<a href="print_off.php">print_off</a>
commands and always print its arguments.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_format_string"><i>"format string"</i></A><BR>
<DD>
The C-syntax format string (i.e. "%d, %f, %3.2f, %s, \n" .. etc.)
used to format the output that will appear on the screen.
<P></P></DL>

<DL>
<DT><A NAME="item_vars"><i>var1, var2...</i></A><BR>
<DD>
The variables to be printed, corresponding to the format string.
<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<p>
The following scorefile:
<dd>
<pre>
a = 7.8
printf("the value of a is: %f, %s\n", a, "so THERE!")
</pre>
</dd>
will produce the following output:
<dd>
<pre>
the value of a is: 7.8, so THERE!
</pre>
</dd>
<P>


<HR>
<h3>See Also</h3>
<P>
<a href="print.php">print</a>,
<a href="type.php">type</a>,
<A HREF="dumptable.php">dumptable</A>,
<a href="set_option.php#print">set_option</a>,
<a href="print_on.php">print_on</a>,
<a href="print_off.php">print_off</a>
</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

