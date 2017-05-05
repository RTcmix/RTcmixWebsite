<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - div</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>div</b> - divide a table associated with a table-handle by a constant
or do a point-by-point division by another table-handle table.
</P>


<HR>
<h3>Synopsis</h3>
<p>
<b>div</b>(<i>table_handle1</i>, <i>table_handle2/constant</i>)
<P>
<HR>
<h3>Description</h3>
<P>
<b>div</b> operates on each element of the function table
referred to by <i>table_handle1</i> by either dividing by
the value <i>constant</i> to each one or by dividing each one
by the corresponding element of the table
associated with <i>table_handle2</i>.  If the two tables are of different
sizes, the values will be interpolated relative to the length of
each table prior to the division.
The interpolation scheme used depends upon the original
setting of the optional specifier for interpolation used in the
original
<a href="maketable.php#item_optional_specifiers">maketable</a>
scorefile command that was used to create the table.
<p>
NOTE:  The functionality of <b>div</b> has largely been duplicated
by the
<a href="/reference/instruments/pfield-enabled.php">pfield-enabled</a>
capabilities of RTcmix instruments.  However, the <b>div</b> function is
still useful for Perl and shell-script front-ends to RTcmix.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_table_handle1"><i>table_handle1</i></A><BR>
<DD>
The table-handle identifier for the first table (the
<a href="http://www.math.com/school/glossary/defs/dividend.html">dividends</a>
to be used).
<P></P></DL>
<DL>
<DT><A NAME="item_table_handle2"><i>table_handle2</i></A><BR>
<DD>
The table-handle identifier for the second table to be divided into
the first (the
<a href="http://www.math.com/school/glossary/defs/divisor.html">divisors</a>),
or
<P></P></DL>
<DL>
<DT><A NAME="item_constant"><i>constant</i></A><BR>
<DD>
the constant value that will be divided into to all the values of the
first table
<P></P></DL>
<P>


<HR>
<h3>RETURN VALUE</h3>
<P>Returns a table-handle referring to the modified table.  If the
second value is ever 0, then the value 999999999999999999.9
is returned.  Hey, it's <i>almost</i> infinity... right?
</P>
<P>


<HR>
<h3>Examples</h3>
<PRE>
   table1 = maketable("literal", "nonorm", 5, 1.0, 2.0, 3.0, 4.0, 5.0)
   table2 = maketable("literal", "nonorm", 5, 2.0, 4.0, 5.0, 8.0, 10.0)
   newtable1 = div(table1, 2.0)
   newtable2 = div(table1, table2)
</pre>
<p>
The table-handle
<i>newtable1</i> will be associated with a new table that will
contain the following sequence of elements:
<ul>
<pre>
0.5, 1.0, 1.5, 2.0, 2.5
</pre>
</ul>
and the elements of <i>newtable2</i> will be:
<ul>
<pre>
0.5, 0.5, 0.6, 0.5, 0.5
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
<A HREF="add.php">add</A>,
<A HREF="sub.php">sub</A>,
<A HREF="mul.php">mul</A>
</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

