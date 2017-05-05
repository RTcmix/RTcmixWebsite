<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - print_off</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>print_off</b> - turn off RTcmix printing
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
<b>print_off</b>()
<P>


<HR>
<h3>Description</h3>
<P>
<b>print_off()</b> turns off reporting of RTcmix scheduling,
file information, etc.  A subsequent call to
<a href="print_on.php">print_on</a>
will restore RTcmix printing.  This can often speed up
RTcmix execution, especially when large numbers of notes
are being scheduled.
<P>


<HR>
<h3>Examples</h3>
<pre>
   print_off()
</pre>
<P>


<HR>
<h3>See Also</h3>
<P>
<a href="print.php">print</a>,
<a href="printf.php">printf</a>,
<a href="type.php">type</a>,
<A HREF="dumptable.php">dumptable</A>,
<a href="set_option.php#print">set_option</a>,
<a href="print_on.php">print_on</a>
</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


