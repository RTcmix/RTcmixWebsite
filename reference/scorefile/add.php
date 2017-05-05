<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - add</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>add</b> - add a constant value to a table associated with a table-handle
or do a point-by-point addition with another table-handle table.
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
<b>add</b>(<i>table_handle1, table_handle2/constant</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>add</b> operates on each element of the function table
referred to by <i>table_handle1</i> by either adding 
the value <i>constant</i> to each one or by summing each one
with the corresponding element of the table
associated with <i>table_handle2</i>.  If the two tables are of different
sizes, the values will be interpolated relative to the length of
each table prior to the addition.
The interpolation scheme used depends upon the original
setting of the optional specifier for interpolation used in the
original
<a href="maketable.php#item_optional_specifiers">maketable</a>
scorefile command that was used to create the table.
<p>
NOTE:  The functionality of <b>add</b> has largely been duplicated
by the
<a href="/reference/instruments/pfield-enabled.php">pfield-enabled</a>
capabilities of RTcmix instruments.  However, the <b>add</b> function is
still useful for Perl and shell-script front-ends to RTcmix.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><a name="item_table_handle1" class="internallink"><i>table_handle1</i></A><BR>
<DD>
The table-handle identifier for the first table to be summed
<P></P></DL>
<DL>
<DT><a name="item_table_handle2" class="internallink"><i>table_handle2</i></A><BR>
<DD>
The table-handle identifier for the second table to be summed with
the first, or
<P></P></DL>
<DL>
<DT><a name="item_constant" class="internallink"><i>constant</i></A><BR>
<DD>
the constant value that will be added to all the values of the
first table
<P></P></DL>
<P>


<HR>
<h3>RETURN VALUE</h3>
<P>Returns a table-handle referring to the modified table
</P>
<P>


<HR>
<h3>Examples</h3>
<PRE>
   table1 = maketable("literal", "nonorm", 5, 1.0, 2.0, 3.0, 4.0, 5.0)
   table2 = maketable("literal", "nonorm", 5, 2.0, 4.0, 5.0, 8.0, 10.0)
   newtable1 = add(table1, 2.0)
   newtable2 = add(table1, table2)
</pre>
<p>
The table-handle
<i>newtable1</i> will be associated with a new table that will
contain the following sequence of elements:
<ul>
<pre>
3.0, 4.0, 5.0, 6.0, 7.0
</pre>
</ul>
and the elements of <i>newtable2</i> will be:
<ul>
<pre>
3.0, 6.0, 8.0, 12.0, 15.0
</pre>
</ul>
<P>


<HR>
<h3>See Also</h3>
<p>
<A HREF="maketable.php">maketable</A>,
<A HREF="modtable.php">modtable</A>,
<A HREF="makefilter.php">makefilter</A>,
<A HREF="makeconverter.php">makeconverter</A>,
<A HREF="tablelen.php">tablelen</A>,
<A HREF="copytable.php">copytable</A>,
<A HREF="sub.php">sub</A>,
<A HREF="div.php">div</A>,
<A HREF="mul.php">mul</A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

