<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - modtable</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>modtable</b> - modify the data coming through 
one <i>table-handle</i> and send the transformed
data through another <i>table-handle</i>.
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
table = <b>modtable</b>(<i>input_table_handle</i>, <i>"modification_type"</i>, <i>arg1, arg2, ...</i>)
</P>
<P>



<HR>
<h3>Description</h3>
<P><b>modtable</b>
returns a <i>table-handle</i> that will deliver data produced by modifying
the values coming from another table.  The specific data-transformation
applied is determined by the <i>"modification_type"</i> text field in
conjunction with any of the optional <i>argN</i> parameters.  The
<i>input_table_handle</i> variable should refer to another table
via a <i>table-handle</i>, probably created using the
<a href="maketable.php">maketable</a>)
command or possibly coming from a previous <b>modtable</b>.
<p>
Many of the arguments for <b>modtable</b> may themselves
also be pfield-handles.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><a name="input_table_handle" class="internallink"><i>input_table_handle</i></A><BR>
<DD>
This is <i>table-handle</i> variable referring to a data stream coming
from a previously created or modified table.
<P></P>

<DT><a name="item_modification_type" class="internallink"><i>modification_type</i></A><BR>
<DD>
This string value (i.e. enclosed in "double quotes" in the scorefile)
determines the operation that will be used to transform the values
coming through the <i>input_table_handle</i>.
The <i>table-handle</i> returned
from the <b>modtable</b> command will refer to this transformed
table data.
<P></P>

<DT><a name="item_arg1_arg2_etc" class="internallink"><i>arg1, arg2, ...</i></A><BR>
<DD>
The arguments that are possibly relevant for each modification
type.  These will determine
how particular operations work to transform the data.
See documentation for each type below.

<P></P></DL>
<P>
<hr>
<h2><a name="modification_types" class="internallink">Modification Types</a></h2>
<DL>


<DT><a name="normalize" class="internallink"><i>normalize</i></A><BR>
<DD>
The <i>normalize</i> modification type processes the data from
a table associated with
<i>table_handle</i> and normalizes (scales) the values using the
the optional <i>peak</i> argument as the desired peak value for the
elements in the new table.  The syntax is:
<ul>
<pre>
table = modtable(table_handle, "normalize"[, peak])
</pre>
</ul>
If the optional <i>peak</i> argument
is missing, then 1.0 will be used as the desired peak value.
<p>
Tables can have both positive and negative values.  This is what
happens, depending on the sign of the values in the table:
<ul>
<pre>
sign of values          resulting range of values
-------------------------------------------------
all positive            between 0.0 and <i>peak</i>
all negative            between 0.0 and <i>-peak</i>
positive and negative   between <i>-peak</i> and <i>peak</i>
</pre>
</ul>
A new table-handle will be returned for subsequent use in the scorefile
referring to the normalized table values.
<P></P>

<DT><a name="reverse" class="internallink"><i>reverse</i></A><BR>
<DD>

The
<i>reverse</i> operation
reverses the ordering of all the values in
a table associated with <i>table_handle</i>, essentially the same as
reading through the original table backwards.
The syntax is:
<ul>
<pre>
table = modtable(table_handle, "reverse")
</pre>
</ul>
The values will
be interpolated depending upon the original
setting of the optional specifier for interpolation used in the
<a href="maketable.php#item_optional_specifiers">maketable</a>
scorefile command that created the table.
<p>
The values of the table are not altered in any other way.  The size
of the table is also unchanged.  This returns
a table-handle for the reversed table data.
<P></P>

<DT><a name="shift" class="internallink"><i>shift</i></A><BR>
<DD>

The <i>shift</i> modification type operates on the table
associated with
<i>table_handle</i> and moves all the elements in the table forwards
or backwards (depending on whether <i>shift_amount</i> is positive or
negative) in the table.
The syntax is:
<ul>
<pre>
table = modtable(table_handle, "shift", shift_amount)
</pre>
</ul>
The elements in the table array will be
moved <i>shift_amount</i> array locations.  Positive values of
<i>shift_amount</i> shift to the right;
negative values to the left.  If a value is shifted off the end of the
array in either direction, it reenters the other end of the array.
<p>
The values of the table are not altered in any other way.  A table-handle
referring to the shifted table values is returned.
<P></P>

<DT><a name="draw" class="internallink"><i>draw</i></A><BR>
<DD>

The <i>draw</i> modtable variant enables you to rewrite a portion of
the <i>table-handle</i> table "on the fly" during scorefile execution,
possibly while an Instrument might be accessing the table.
The syntax is:
<ul>
<pre>
table = modtable(table_handle, "draw", ["literal",] index, value[, width])
</pre>
</ul>
The elements of the table referenced by <i>table_handle</i> will be
replaced by this command whenever an Instrument asks for a value from
the <i>table</i> returned, usually at the control rate. The replacement
operation will be governed by
the <i>index</i>, which is normally 0-1 and acts as a fractional portion
into the table to modify (i.e. 0.5 will replace the values 1/2-way
through the table) unless the optional <i>"literal"</i> argument
is present.  Then <i>index</i> represents an absolute index into
the table, starting at 0 and ending at table_length-1.  <i>value</i>
is the value to place at the <i>index</i>, and the optional <i>width</i>
parameter determines how the neighboring slots might be affected
(linear interpolation) by the newly-inserted <i>value</i>.  <i>width</i>
is also a fractional portion from 0-1, with the default set at 0.  The
interpolation algorithm used by <i>draw</i> will affect elements in
the table that are (<i>width</i>*size)/2 slots away on either side of the
<i>index</i>.  Both the <i>index</i> and the <i>value</i> can also
be dynamic pfield-handles.
<p>
The table referenced by <i>table-handle</i> will itself be modified, so
subsequent uses of the <i>table-handle</i> table will reflect whatever
changes might have been 'drawn' into the table during previous scorefile
processing.  Modification of the table will only occur when the pfield
variable (<i>table</i>) is accessed in a score, however.

<ul><i>[NOTE:  This is an experimental feature; not all instruments
can make use of this modification type.]</i>
</ul>
<br>

<P></P></DL>
<P>

<HR>
<h3>Examples</h3>
Using these scorefile commands:
<PRE>
   table = maketable("line", "nonorm", 1000, 0,0, 1,10, 2, -5)
   newtable = modtable(table, "normalize", 1.0)
</pre>
<p>
<i>newtable</i> will be associated with a new table that will
start at 0.0, go up to 1.0, and then down to -0.5 over the
1000 elements in the table.
<P>
In this set of commands:
<PRE>
   table = maketable("literal", "nonorm", 5, 1.0, 2.0, 3.0, 4.0, 5.0)
   newtable = modtable(table, "reverse")
</pre>
<p>
the table-handle
<i>newtable</i> will be associated with a new table that will
contain the following sequence of elements:
<ul>
<pre>
5.0, 4.0, 3.0, 2.0, 1.0
</pre>
</ul>
<P>
And this scorefile fragment:
<PRE>
   table = maketable("literal", "nonorm", 5, 1.0, 2.0, 3.0, 4.0, 5.0)
   newtable1 = modtable(table, "shift", 3)
   newtable2 = modtable(table, "shift", -1)
</pre>
<p>
will result in the table-handle
<i>newtable1</i> being associated with a new table that will
contain the following sequence of elements:
<ul>
<pre>
3.0, 4.0, 5.0, 1.0, 2.0
</pre>
</ul>
and the elements of <i>newtable2</i> being in the following order:
<ul>
<pre>
2.0, 3.0, 4.0, 5.0, 1.0
</pre>
</ul>
<P>


<HR>
<h3>See Also</h3>
<p>
<a href="maketable.php">maketable</a>,
<a href="makeconnection.php">makeconnection</a>,
<a href="makeLFO.php">makeLFO</a>,
<a href="makerandom.php">makerandom</a>,
<a href="makeconverter.php">makeconverter</a>,
<a href="makemonitor.php">makemonitor</a>,
<a href="makefilter.php">makefilter</a>,
<a href="plottable.php">plottable</a>
<p>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

