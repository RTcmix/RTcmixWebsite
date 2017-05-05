<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - dumptable</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>dumptable</b> - print the contents of a table from
an associated table-handle variable
to a terminal or a file
<P>


<HR>
<h3>Synopsis</h3>
<p>
table = <b>dumptable</b>(<i>table_handle</i>[, <i>"filename"</i>])
<p>
Parameters inside the [brackets] are optional.
<P>


<HR>
<h3>Description</h3>
<P>
<b>dumptable</b> is a useful utility that will print the
contents of a table associated with a particular table-handle to the
screen, or to a text file if the optional <i>filename</i> is given.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_table_handle"><i>table_handle</i></A><BR>
<DD>
The table-handle identifier for the table.
<P></P></DL>
<DL>
<DT><A NAME="item_filename"><i>filename</i></A><BR>
<DD>
This optional string argument refers to a file that will contain the
printed output from the <b>dumptable</b> command.  This text file can
be identified using an absolute or a relative path -- i.e. if the
<i>filename</i> is given with no path information the file will be created
in the directory where the scorefile is invoked.
<P></P></DL>
<P>


<HR>
<h3>RETURN VALUE</h3>
<P>
Returns 0.0 if the printing is successful, -1.0 if there was
an error
<P>


<HR>
<h3>Examples</h3>
<PRE>
   table = maketable("wave", 10, 1)
   dumptable(table)
</pre>
<p>
The above score will produce the following output to the screen:
<pre>
   0 0.000000
   1 0.618034
   2 1.000000
   3 1.000000
   4 0.618034
   5 0.000000
   6 -0.618034
   7 -1.000000
   8 -1.000000
   9 -0.618034
</pre>
<P>


<HR>
<h3>See Also</h3>
<p>
<A HREF="maketable.php">maketable</A>,
<A HREF="modtable.php">modtable</A>,
<A HREF="makefilter.php">makefilter</A>,
<A HREF="makeconverter.php">makeconverter</A>,
<A HREF="plottable.php">plottable</A>,
<A HREF="tablelen.php">tablelen</A>,
<A HREF="mul.php">mul</A>,
<A HREF="div.php">div</A>,
<A HREF="sub.php">sub</A>,
<A HREF="add.php">add</A>
</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


