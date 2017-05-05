<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - copytable</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>copytable</b> - copy a table associated with a table-handle and optionally
resize it with or without interpolation
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
table = <b>copytable</b>(<i>table_handle</i>[, <i>newsize</i>[, <i>interp_type</i>]])
<p>
Parameters inside the [brackets] are optional.
<P>


<HR>
<h3>Description</h3>
<P>
<b>copytable</b> makes a copy of a table associated with
<i>table_handle</i>.  Using the optional <i>newsize</i> argument,
the copied table may be larger or smaller than the original table.
The second optional argument, <i>interp_type</i> determines
if the resized table uses interpolation or simply
truncates the values to determine the values in the new table.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_table_handle"><i>table_handle</i></A><BR>
<DD>
The table-handle identifier for the table to be copied and possibly resized
<P></P></DL>
<DL>
<DT><A NAME="item_newsize"><i>newsize</i></A><BR>
<DD>
An optional value setting the size of the copied table.  If <i>newsize</i>
is used, then the <i>interp_type</i> should also be specified.
<P></P></DL>
<DL>
<DT><A NAME="item_interp_type"><i>interp_type</i></A><BR>
<DD>
If <i>newsize</i> is specified, then the <i>interp_type</i> can
also be set.  This is a string, identical to two of the interp
options for
<a href="maketable.php">maketable</a>:
<ul>
	<li><i>"interp"/"nointerp"</i> -- <i>"interp"</i> enables simple first-order
		linear interpolation, i.e. if a requested  table value lies between
		two elements in the table, setting  <i>"interp"</i> will generate an
		intermediate value based upon  a linear interpolation of nearest
		sample values. For example,  if the value at table location 314.15
		were requested, the value  returned would be 0.15 between the
		value at location 314 and the  value at location 315.  <i>"nointerp"</i>
		turns off interpolation; the values  returned from the table will
		be 'rounded-down' (truncated) to the nearest-lowest point in the
		table. For example, if the table value  at location 149.78 were
		requested, the <i>"nointerp"</i> option  would return the value stored
		at location 149. 
</ul>
The default is <i>interp</i>.
<P></P></DL>
<P>


<HR>
<h3>RETURN VALUE</h3>
<P>
Returns a table-handle for the new, copied and (possibly) resized
table
<P>


<HR>
<h3>Examples</h3>
<PRE>
   table = maketable("wave", 4000, 1.0, 0.2, 0.1)
   newtable = copytable(table, 1000, "interp")
</pre>
<p>
<i>newtable</i> will be associated with a new table that will
contain the same waveform defined in the first <b>maketable</b>,
except that it will only fill 1000 elements instead of 4000.
The new values will be determined by linear interpolation if
they don't align with the values taken from the original 4000-point
table.
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
<A HREF="add.php">add</A>
</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
