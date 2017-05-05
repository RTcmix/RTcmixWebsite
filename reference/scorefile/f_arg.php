<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - f_arg/i_arg/s_arg/n_arg</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>f_arg/i_arg/s_arg/n_arg</b> - return command-line arguments</i>
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
val = <b>f_arg</b>(<i>arg_index</i>)
<br>
val = <b>i_arg</b>(<i>arg_index</i>)
<br>
val = <b>s_arg</b>(<i>arg_index</i>)
<br>
val = <b>n_arg</b>()
</P>
<P>


<HR>
<h3>Description</h3>
<P>
These functions allow command-line arguments to the <i>CMIX</i>
command to be entered into the RTcmix scorefile environment.
For example, the command:
<ul>
<pre>
CMIX 1 2 3 4 5 < scorefile.sco
</pre>
</ul>
contains 5 ingeter command-line arguments.  The command:
<ul>
<pre>
CMIX 1.0 2.0 "hey" < scorefile.sco
</pre>
</ul>
contains 2 floating-point arguments and 1 string argument.
<p>
<b>f_arg</b>(<i>n</i>) returns the <i>n</i>th argument as a floating-point
value.
<br>
<b>i_arg</b>(<i>n</i>) returns the <i>n</i>th argument as an integer value.
<br>
<b>s_arg</b>(<i>n</i>) returns the <i>n</i>th argument as a string value.
<br>
<b>n_arg</b>() returns the number of arguments in the <i>CMIX</i>
command.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><i>arg_index</i>
<DD>
The index of the argument to retrieve.
Numbering of arguments starts at "0" for the first argument after the
<i>CMIX</i> command.
<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<pre>
   floatval = f_arg(3)
   stringval = s_arg(1)
   nargs = n_arg()
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="print.php">print</a>,
<a href="printf.php">printf</a>,
<a href="rtsetparams.php">rtsetparams</a>,
<a href="set_option.php">set_option</a>,
<a href="stringify.php">stringify</a>,
<a href="type.php">type</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

