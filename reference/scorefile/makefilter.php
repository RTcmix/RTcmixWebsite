<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - makefilter</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>makefilter</b> - create a 'filter' to alter PField control
data, reading from one <i>pfield-handle</i> or <i>table-handle</i>
and passing the
altered data through another <i>pfield-handle</i>.
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>pfield = <b>makefilter</b>(<i>input_handle</i>, <i>"filter_type"</i>, <i>arg1, arg2, ...</i>)
<p>
Parameters inside the [brackets] are optional.
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>makefilter</b>
returns a <i>pfield-handle</i> that will deliver data by applying an
operation defined by <i>"filter_type"</i> to the data coming through
the <i>input-handle</i> variable.  The <i>input_handle</i> variable
can be any of the PField-derived variables in RTcmix, such as a
<i>table-handle</i> (see
<a href="maketable.php">maketable</a>)
or another <i>pfield-handle</i> (see
<a href="makeconnection.php">makeconnection</a>,
<a href="makeLFO.php">makeLFO</a> or
<a href="makerandom.php">makerandom</a>).
The arguments vary depending on each 
<i><a href="#filter_types">filter_type</a></i>.
<p>
Many of the arguments for <b>makefilter</b> may themselves
also be pfield-handles.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><a name="input_handle"" class="internallink"><i>input_handle</i></A><BR>
<DD>
This is <i>pfield-handle</i> variable referring to a data stream, possibly
from an external device or interface or an internal PField data-generating
process.
<P></P>

<DD>
<DT><a name="item_filter_type" class="internallink"><i>filter_type</i></A><BR>
<DD>
This string value (i.e. enclosed in "double quotes" in the scorefile)
determines what kind of 'filter' will be used to transform the values
coming through the <i>input_handle</i>.  The <i>pfield-handle</i> returned
from the <b>makefilter</b> command will refer to this transformed
data stream.
<P></P>

<DT><a name="item_arg1_arg2_etc" class="internallink"><i>arg1, arg2, ...</i></A><BR>
<DD>
The arguments that are relevant for each filter type.  These will determine
how the particular filter operates to transform the data.
See documentation for each type below.
<P></P></DL>
<P>


<hr>
<h2><a name="filter_types" class="internallink">Filter Types</a></h2>
<DL>

<DT><a name="clip" class="internallink"><i>clip</i></A><BR>
<DD>
The <i>clip</i> filter will 
This limits the incoming pfield values to the range defined by min
and max, which both can be dynamic.
The syntax is:
<ul>
<pre>
pfield = makefilter(input_pfield, "clip", min[, max])
</pre>
</ul>
Data coming through the <i>input_pfield</i> variable less then
the value <i>min</i> will be reset to the value <i>min</i>.  Similarly,
data greater than the value <i>max</i> (if present) will be
set to <i>max</i>.
<P></P>

<DT><a name="constrain" class="internallink"><i>constrain</i></A><BR>
<DD>
The <i>constrain</i> filter works with two data streams, one being
an incoming set of pfield values (as with all the <i>makefilter</i>
filter types), and the other being a <i>table_handle</i> p-field
referring to an existing table of values.
The syntax is:
<ul>
<pre>
pfield = makefilter(input_pfield, "constrain", table_handle, strength)
</pre>
</ul>
For each value coming through the <i>input_pfield</i> variable,
this filter will return the nearest numerical value in the
<i>table_handle</i> table.  The <i>strength</i> parameter
(from 0 to 1) is a measure of how closely the filter constrains
the pfield to the table value.  A <i>strength</i> value
of 0 means no constraint (i.e., you get back the original
pfield value); a <i>strength</i> of 1 means you get
the table value; a <i>strength</i> of 0.5 means you get a value
midway between the pfield and table values.
<i>strength</i> can be time-varying.
<P></P>

<DT><a name="delay" class="internallink"><i>delay</i></A><BR>
<DD>
The <i>delay</i> filter introduces a time delay into the data
stream coming through the <i>input_pfield</i> variable.
The syntax is:
<ul>
<pre>
pfield = makefilter(input_pfield, "delay", time)
</pre>
</ul>
<i>time</i> is the length of the delay (in seconds).  The delay
is relative to when the data appears through the <i>input_pfield</i>.
<P></P>

<DT><a name="fitrange" class="internallink"><i>fitrange</i></A><BR>
<DD>
The <i>fitrange</i> filter will take data in the range [0.0, 1.0] or
[-1.0, 1.0] and expand it to a specified range.
The syntax is:
<ul>
<pre>
pfield = makefilter(input_pfield, "fitrange", min, max[, "bipolar"])
</pre>
</ul>
Data coming through the <i>input_pfield</i> variable in the range
[0.0, 1.0] will be expanded and transformed to fit the range
[<i>min, max</i>].  When the input data is 0.0, the output will be
<i>min</i>.  Input data at 1.0 will output <i>max</i>.  If the
optional <i>"bipolar"</i> string argument is given, then the
<i>fitrange</i> filter assumes that the input data will be
in the [-1.0, 1.0] range -- when the input is -1.0, then
<i>min</i> will be the output; input of 1.0 will yield <i>max</i>.
<P></P>

<DT><a name="invert" class="internallink"><i>invert</i></A><BR>
<DD>
The <i>invert</i> filter will take data from an input p-field and
'invert' the values, i.e. all values are 'mirrored' around a center value.
The syntax is:
<ul>
<pre>
pfield = makefilter(input_pfield, "invert"[, center])
</pre>
</ul>
By default, the center value (y-axis center of symmetry)
is a point halfway between the
min and max table values.  If the optional second <i>center</i>
argument is present, this will be used as the vertical center of symmetry.
<P></P>

<DT><a name="map" class="internallink"><i>map</i></A><BR>
<DD>
The <i>map</i> filter sets up a 'transfer function' for data coming
through an input p-field.
The syntax is:
<ul>
<pre>
pfield = makefilter(input_pfield, "map", transfer_table[, inputMin, inputMax])
</pre>
</ul>
The operation of the <i>map</i> filter is a simple table-lookup
transfer function.  The transfer function itself is set using the
<i>transfer_table</i> table-handle (see
<a href="maketable.php">maketable</a>
for how to create these tables).  Values then coming in through the
<i>input_pfield</i> parameter are treated as X-locations in the
<i>transfer_table</i>, and the corresponding Y-value for a given
X-location will be returned through the <i>pfield</i> variable.
The input data stream can be scaled to match the X-range of the
<i>transfer_table</i> table using the optional <i>inputMin</i>
and <i>inputMax</i> parameters.
<P></P>

<DT><a name="quantize" class="internallink"><i>quantize</i></A><BR>
<DD>
The <i>quantize</i> filter will transform data coming through
the <i>input_pfield</i> variable by shifting each input value
to an integer multiple of the <i>quantize_value</i>.
The syntax is:
<ul>
<pre>
pfield = makefilter(input_pfield, "quantize", quantize_value)
</pre>
</ul>
All data values coming through the <i>input_pfield</i>
will be rounded to the nearest integer multiple (both
positive and negative) of the <i>quantize_value</i> and then
output through the data stream associated with the <i>pfield</i>
variable.  A value
exactly 0.5 between two successive multiples of <i>quantize_value</i>
will be rounded to the upper multiple.  This is the inverse of
the interpolation procedure used in the <i>"smooth"</i> filter.
<P></P>

<DT><a name="smooth" class="internallink"><i>smooth</i></A><BR>
<DD>
The <i>smooth</i> filter type will linearly interpolate values
coming through the <i>input_pfield</i> variable depending
on the rate set by <i>lag</i>.  This means that large jumps
in input will be 'smoothed' into a series of smaller
value jumps in the output.
The syntax is:
<ul>
<pre>
pfield = makefilter(input_pfield, "smooth", lag[, initial_value])
</pre>
</ul>
The filter operates by applying a 1-pole linear filter to the input
values.  <i>lag</i> is a percentage that determines how quickly
(i.e. the number of interpolation steps) the filter will jump
from one value to the next for a given input sequence. By default, it will start 
from 0 when initialized. Set the optional
<i>initial value</i> value to prevent a swoop to the <i>input pfield</i> value at the start.

<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<PRE>
   rpfield = makerandom("even", 7.0, 0.0, 100.0)
   smpfield = makefilter("smooth", 20)
   qpfield = makefilter("quantize", 20)
   rpfield = makefilter("fitrange", 0.0, 1.0)
</pre>
The
<a href="makerandom.php">makerandom</a>
scorefile command will output random numbers between 0.0 and 100.0 at
a rate of 7 times/second (7.0 Hz).  Three different <b>makefilter</b>
commands modify that data.  Associated with the <i>smpfield</i>
variable will be data that is 'smoothed' by 20% -- large jumps in the random
values will be "filled in" by interpolated values.  The <i>qpfield</i>
stream will deliver data that consists of the closest integer multiple
of 20 (the output will be [0.0, 20.0, 40.0, 60.0, 80.0, 100.0] depending
on the value of the input).  <i>rpfield</i> will take the [0.0, 100.0]
range and scale it to fit between 0.0 and 1.0.
<pre>
   table = maketable("literal", "nonorm", 0, 8.00, 8.02, 8.04, 8.05, 8.07)
   rpfield = makerandom("even", 10.0, 8.00, 8.07)
   pitches = makefilter(rpfield, "constrain", table, 1.0)
</pre>
This will take the random numbers (generated 10 times each second)
coming through <i>rpfield</i> and cause them to generate one of the specific
values in the <i>table</i> set of values.  The result will be
assigned through the p-field variable <i>pitches</i>
<PRE>
   table = maketable("expbrk", 1000, 0.0001, 1000, 1.0)
   newpfield = makefilter("invert", table)
</pre>
<p>
The p-field
<i>newpfield</i> will be associated with data 
containing a convex version of the concave exponential curve (or maybe
vice-versa) created using the original <i>"expbrk"</i> table-type.
<p>

<HR>
<h3>See Also</h3>
<p>
<a href="maketable.php">maketable</a>,
<a href="modtable.php">modtable</a>,
<a href="makeconnection.php">makeconnection</a>,
<a href="makeLFO.php">makeLFO</a>,
<a href="makerandom.php">makerandom</a>,
<a href="makeconverter.php">makeconverter</a>,
<a href="makemonitor.php">makemonitor</a>
<p>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
