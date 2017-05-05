<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - tablelen</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>tablelen</b> - return the size of a table from an associated table-handle variable
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>val = <b>tablelen</b>(<i>table_handle</i>)
<P>


<HR>
<h3>Description</h3>
<P>
<b>tablelen</b> returns the size (length) of the table from the
<i>table_handle</i> variable.  <i>table_handle</i> is instantiated
using the
<a href="maketable.php">maketable</a>
scorefile command.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_table_handle"><i>table_handle</i></A><BR>
<DD>
The table-handle identifier for the table.
<P></P></DL>
<P>


<HR>
<h3>RETURN VALUE</h3>
<P>
Returns to the script an integer value, the size of the table.
<P>


<HR>
<h3>Examples</h3>
<pre>
   table = maketable("literal", "nonorm", 0, 8.00, 8.02, 8.03, 8.05, 8.07)
   size = tablelen(table)
</pre>
<p>
<i>size</i> will have the value 5, corresponding to the 5 elements
of the table.  This is very useful when a <i>size</i> argument of
0 is used for a
<a href="maketable.php#literal">maketable("literal", ...)</a>
table type.
<P>


<HR>
<h3>See Also</h3>
<p>
<A HREF="maketable.php">maketable</A>,
<A HREF="modtable.php">modtable</A>,
<A HREF="makefilter.php">makefilter</A>,
<A HREF="makeconverter.php">makeconverter</A>,
<A HREF="plottable.php">plottable</A>,
<A HREF="dumptable.php">dumptable</A>,
<A HREF="tablelen.php">tablelen</A>,
<A HREF="mul.php">mul</A>,
<A HREF="div.php">div</A>,
<A HREF="sub.php">sub</A>,
<A HREF="add.php">add</A>,
<A HREF="len.php">len</A>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

