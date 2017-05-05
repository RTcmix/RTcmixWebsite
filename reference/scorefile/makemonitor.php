<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - makemonitor</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>makemonitor</b> - create and use a window to display PField data from
<i>pfield-handle</i> or <i>table-handle</i> (or similar derived PField)
variable, or capture PField data into a file.
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
pfield = <b>makemonitor</b>(<i>input_handle</i>, <i>"monitor_type"</i>, <i>arg1, arg2, ...</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>makemonitor</b>
is a utility command used to
set up a mechanism for viewing or recording data from a PField
variable, the <i>input_handle</i>.  The <i>"monitor_type"</i> string
determines which 'monitoring' operation will be performed.
The arguments vary depending on each 
<i><a href="#monitor_types">monitor_type</a></i>.
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
<DT><a name="item_monitor_type" class="internallink"><i>monitor_type</i></A><BR>
<DD>
This string value (i.e. enclosed in "double quotes" in the scorefile)
determines what kind of monitor will be used record or view the values
coming through the <i>input_handle</i>.  The <i>pfield-handle</i> returned
from the <b>makemonitor</b> command will pass the data from the
<i>input_handle</i> data stream unchanged.
<P></P>

<DT><a name="item_arg1_arg2_etc" class="internallink"><i>arg1, arg2, ...</i></A><BR>
<DD>
The arguments that are relevant for each monitor type.
See documentation for each type below.
<P></P></DL>
<P>


<hr>
<h2><a name="monitor_types" class="internallink">Monitor Types</a></h2>
<DL>

<DT><a name="datafile" class="internallink"><i>datafile</i></A><BR>
<DD>
This will record the values coming through the <i>input_handle</i>
variable into a file.
The syntax is:
<ul>
<pre>
pfield = makemonitor(input_pfield, "datafile", filename, [filerate[, format]])
</pre>
</ul>
This will open the file <i>filename</i> for writing, attaching an appropriate
header containing information relevant to the interpretation of the file
data.  This header can be read by the RTcmix
<a href="makeconnection.php#datafile">makeconnection</a>
scorefile command, or an external program can access the header fields.
As the RTcmix score executes, data coming through the
<i>input_pfield</i> variable will be stored into the file.
The rate for writing data is the control reset rate
(default 1000 times/second, this is set in the score by the RTcmix
<a href="reset.php">reset</a>
scorefile command), or it can be set independently using the
optional <i>filerate</i> parameter.  The default data format for the
file is to store information in floating-point form (<i>"float"</i>).
This can be set using the optional <i>format</i> parameter.
Valid formats are <i>"double", "float", "int64", "int32", "int16"</i>
or "byte"</i>.
<p>
RTcmix also has a built-in safeguard to prevent overwriting existing
files.  This feature is enabled/disabled using the
<a href="set_option.php#clobber">set_option</a>
command.  The default is to not allow overwriting of a file.
<p>
Note that using a <i>filerate</i> greater than the scorefile
control reset rate will result in redundant data.  Large values
for <i>filerate</i> or the control reset rate are inefficient and
will impact RTcmix performance.
<P></P>

<DT><a name="display" class="internallink"><i>display</i></A><BR>
<DD>
This monitor type is used to create and use a window to display
streaming PField data from a
<i>pfield-handle</i> or <i>table-handle</i> (or similar derived PField)
variable.  The syntax is:
<ul>
<pre>
pfield = makemonitor(input_pfield, "display"[, "prefix"[, "units",]] [precision])"
</pre>
</ul>
The <i>input_pfield</i> is
the PField stream that will be displayed in the window.  This can
be any PField-derived variable, such as a <i>pfield-handle</i> or
<i>table-handle</i>.  The optional arguments <i>prefix</i>,
<i>units</i> and <i>precision</i> determine how the data will
be printed in the widow.  <i>prefix</i> is a string argument
that will specify the label to display in
the window for the <i>input_pfield</i> variable.  If <i>prefix</i>
is missing or is an empty string ("") then no label will be
printed in the window.  <i>units</i> is an optional string
argument to set the 'units' (i.e. "Hz" or "MIDI note")
to appear with the <i>input_pfield</i> data displayed.  This option is
only available if the <i>prefix</i> argument has been set.
The <i>precision</i> is the number of digits after the decimal point
to display in the window.
<P></P></DL>
<P>

<HR>
<h3>Examples</h3>
<PRE>
   xval = makeconnection("mouse", "x", 0, 100, 50, lag=50)
   makemonitor(xval, "display", "x-value", "pts")
</pre>
This set of scorefile commands should create two different windows,
one from the first
<a href="makeconnection.php">makeconnection</a>
command for capturing mouse position, and the other (smaller) window
used to display the x-axis location of the mouse.
<P>

<HR>
<h3>See Also</h3>
<p>
<a href="maketable.php">maketable</a>,
<a href="modtable.php">modtable</a>,
<a href="makeconnection.php">makeconnection</a>,
<a href="makeLFO.php">makeLFO</a>,
<a href="makerandom.php">makerandom</a>,
<a href="makeconverter.php">makeconverter</a>,
<a href="makefilter.php">makemonitor</a>
<p>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
