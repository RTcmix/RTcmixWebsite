<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - samptable</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>samptable</b> - return a specified value from a table given
an associated table-handle variable
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
val = <b>samptable</b>(<i>table_handle</i>, [ <i>interp_type,</i> ] <i>index</i>)
<p>
Parameters inside the [brackets] are optional.
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>samptable</b> returns the value at table element <i>index</i>
of the table from the
<i>table_handle</i> variable.  <i>table_handle</i> is instantiated
using the
<a href="maketable.php">maketable</a>
scorefile command.  The optional <i>interp_type</i> specifier determines
if a fractional <i>index</i> will be interpolated between two of the table
values, or will be 'rounded down' (truncated) to the nearest integer table
location.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_table_handle"><i>table_handle</i></A><BR>
<DD>
The table-handle identifier for the table.
<P></P></DL>
<DL>
<DT><A NAME="item_interp_type"><i>interp_type</i></A><BR>
<DD>
This optional string argument can be either <i>"interp"</i> or
<i>"nointerp"</i>, with the <i>"interp"</i> specifying a simple
linear interpolation between adjacent table values if the
requested table-location <i>index</i> is fractional.  <i>"nointerp"</i>
will simply round downwards (truncate the fractional part) to return
a value.
<p>
<i>"interp"</i> is the default setting.
<P></P></DL>
<DL>
<DT><A NAME="item_index"><i>index</i></A><BR>
<DD>
If <i>index</i> is an integer or of the optional <i>"nointerp"</i>
specifier has been set, then <b>sampfunc</b> will return the value
of the table at location <i>index</i> in the table array.  An
<i>index</i> with a fractional part will return a linear-interpolated
value between two adjacent (integer)<i>index</i> locations in the
table array.  Note that these table arrays begin numbering at 0.
<P></P></DL>
<P>


<HR>
<h3>RETURN VALUE</h3>
<P>
Returns to the script the value at the <i>index</i> (or interpolated
between <i>index</i> and <i>index+1</i>) in the table array.
<P>


<HR>
<h3>Examples</h3>
<PRE>
   table = maketable("literal", "nonorm", 0, 8.00, 8.02, 8.03, 8.05, 8.07)
   tablelength = tablelen(table)

   for (i = 0; i < 10; i = i+1) {
      val = samptable(table, "nointerp", irand(0, tablelength))
   }
</pre>
<p>
<i>val</i> will be set to a different, random value of the <i>table</i>
for each iteration of the loop.  Setting the optional specifier
<i>"nointerp"</i> will guarantee that <i>val</i> will assume values
taken directly from the <i>table</i>.
<P>


<HR>
<h3>See Also</h3>
<p>
<A HREF="maketable.php">maketable</A>,
<A HREF="modtable.php">modtable</A>,
<A HREF="makefilter.php">makefilter</A>,
<A HREF="copytable.php">copytable</A>,
<A HREF="dumptable.php">dumptable</A>,
<A HREF="tablelen.php">tablelen</A>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

