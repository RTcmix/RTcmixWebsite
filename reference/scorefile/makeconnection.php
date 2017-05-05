<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - makeconnection</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>makeconnection</b> - establish a control connection to an external device or process
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
pfield = <b>makeconnection</b>(<i>"connection_type"</i>[, <i>arg1, arg2, ...</i>])
<p>
Parameters inside the [brackets] are optional.
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>makeconnection</b> is a utility command used to associate
data coming from "outside" RTcmix with a <i>pfield-handle</i> variable.  This
variable can then be used to deliver values to an Instrument during
scorefile execution.  This is very similar to the mechanism used by the
<a href="maketable.php">maketable</a>
scorefile command to deliver table data to Instruments through
table-handle variables.  Indeed, <i>table-handles</i> and
<i>pfield-handles</i> are nearly identical in terms of scorefile use
and behavior.  The main difference is that <i>table-handle</i>
variables are accessing values from a previously-created table,
while <i>pfield-handle</i> variables are funneling (in real-time)
data from some external process of device into RTcmix.
<p>
This is almost the inverse of how the
<a href="../interface/RTcmix-embed.php">'embedded' RTcmix object</a>
works.  The RTcmix object can be used inside another application,
with all interface tasks mediated through the "wrapping" application.
RTcmix is a subsidiary object in this case.  <b>makeconnection</b>
allows an interface application to be developed within RTcmix,
with the interface code existing as a
<a href="../interface/PField.php">PField class</a>
object.  Interfaces can then be "connected" to control different
Instrument/note parameters through a <i>pfield-handle</i>.
<p>
Because device and interface characteristics can vary widely, the
syntax of a <b>makeconnection</b> command will also be relatively
unique for particular interfaces.  At present, three different
<i>connection_type</i> interfaces are included in RTcmix.
<p>
Many of the arguments for <b>makeconnection</b> may themselves
also be pfield-handles.
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><a name="item_connection_type" class="internallink"><i>"connection_type"</i></A><BR>
<DD>
This string value (i.e. enclosed in "double quotes" in the scorefile)
determines the device or interface that will be associated with the
<i>pfield-handle</i> returned by <b>makeconnection</b>.  Currently three
different
<i><a href="#CONNECTION_TYPES">connection_types</a></i>
are included in the RTcmix distribution,
<i><a href="#mouse">"mouse"</a></i>,
<i><a href="#midi">"midi"</a></i>,
<i><a href="#datafile">"datafile"</a></i>, and
<i><a href="#inlet">"inlet"</a></i> (in the Max/MSP
<a href="/rtcmix~/">rtcmix~</a>
object distribution).  Each <i>connection_type</i> used loads a
library containing the interface code.  These libraries should
be in the <u>RTcmix/shlib/</u> directory or some other directory
on the RTcmix dynamic-loading search path.  The default RTcmix installation
procedure should set this up properly.

<P></P>
<DT><a name="item_arg1_arg2_etc" class="internallink"><i>arg1, arg2, ...</i></A><BR>
<DD>
Any number of arguments that are needed to set up the interface/device
connection.  These depend on the connection type.
See documentation for each type below.
<P></P></DL>
<P>


<hr>
<h2><a name="CONNECTION_TYPES" class="internallink">Connection Types</a></h2>
<DL>

<DT><a name="mouse" class="internallink"><i>mouse</i></A><BR>
<DD>
This establishes a PField variable that will draw data from the
mouse screen position.  The syntax is:
<ul>
<pre>
pfield = makeconnection("mouse", "axis", min, max, default, lag[, "prefix"[, "units"], precision])
</pre>
</ul>
This will cause a window to be displayed, and movement of the mouse
relative to that window will be tracked.
An executing note using the <i>pfield</i> variable as
an Instrument parameter will draw data from the position of the mouse
to provide the values for that parameter.  More than one parameter
or Instrument may be controlled simultaneously, depending on how
the connections are specified in the scorefile.  The other arguments
determine how the mouse data will be set and interpreted:
<ul>
	<li><i>"axis"</i> -- this string argument can be either <i>"x"</i>
	or <i>"y"</i> and sets which axis will be read for data from the mouse.
	<br>
	<br>
	<li><i>min</i> -- the value when the mouse x or y position is at 0
	on the display.
	<br>
	<br>
	<li><i>max</i> -- the maximum value reached as the mouse is moved to
	the maximum set position on the display.
	<p>
	Note that if <i>min</i> and <i>max</i> are inverted, the mouse
	will deliver values 'backwards'.
	<br>
	<br>
	<li><i>default</i> -- the initial value used for the <i>pfield-handle</i>.
	<br>
	<br>
	<li><i>lag</i> -- amount of smoothing for value stream [percent: 0-100].
	This applies a simple filter to the incoming data to prevent values
	from jumping abruptly, potentially causing discontinuity glitches
	in executing notes.
	<br>
	<br>
	<li><i>"prefix"</i> -- an optional string value that will be used
	to label reporting in the window used by the mouse.
	<br>
	<br>
	<li><i>"units"</i> -- an optional string value that will be displayed
	in the mouse window to report mouse location data.
	<br>
	<br>
	<li><i>precision</i> -- this optional number determines how many
	digits after the decimal point will be displayed in the mouse
	window to report mouse location data.
</ul>
<P></P>

<DT><a name="midi" class="internallink"><i>midi</i></A><BR>
<DD>
This establishes a PField variable that will accept data from
an attached MIDI interface.  The syntax is:
<ul>
<pre>
pfield = makeconnection("midi", min, max, default, lag, chan, "type"[, "subtype"])
</pre>
</ul>
An executing note using the <i>pfield</i> variable as
an Instrument parameter will draw data from a MIDI controller
attached to a MIDI interface
to provide the values for that parameter.  As with the
<a href="#mouse">"mouse"</a>
connection type, more than one parameter
or Instrument may be controlled simultaneously, depending on how
the connections are specified in the scorefile.  The other arguments
establish which MIDI channel and parameter will be monitored and
determine how the MIDI data will be interpreted:
<ul>
	<li><i>min</i> -- the value when the MIDI controller delivers 0.
	<br>
	<br>
	<li><i>max</i> -- the maximum value reached when the MIDI controller
	is at the maximum of the range (usually 127).
	<p>
	Note that if <i>min</i> and <i>max</i> are inverted, the mouse
	will deliver values 'backwards'.
	<br>
	<br>
	<li><i>default</i> -- the initial value used for the <i>pfield-handle</i>.
	<br>
	<br>
	<li><i>lag</i> -- amount of smoothing for value stream [percent: 0-100].
	This applies a simple filter to the incoming data to prevent values
	from jumping abruptly, potentially causing discontinuity glitches
	in executing notes.
	<br>
	<br>
	<li><i>chan</i> -- the MIDI channel to use (1-16).
	<br>
	<br>
	<li><i>type</i> -- the MIDI parameter to monitor.  This string
	value will deliver data as follows:
<pre>
value                     MIDI data
---------------------------------------------------------------
"noteonpitch"             MIDI note # for noteon events
"noteonvel"               MIDI velocity for noteon events
"noteooffpitch"           MIDI note # for noteoff events
"noteoffvel"              MIDI velocity for noteoff events
"cntl"                    use <i>"subtype"</i> to specify
                             which MIDI controller to use
"prog"                    MIDI program change #
"bend"                    MIDI pitch-bend data
"chanpress"               MIDI channel change value
"polypress"               use <i>"subtype"</i> somehow
</pre>
	<br>
	<br>
	<li><i>subtype</i> -- if <i>type</i> is set to <i>"cntl"</i>,
	then <i>subtype</i> is used to specify which MIDI controller
	is monitored.  This can be set using a string symbol or the
	corresponding MIDI controller #:
<pre>
subtype                   MIDI controller
---------------------------------------------------------------
<i>"mod"</i>                     modulator wheel
<i>"foot"</i>                    foot pedal
<i>"breath"</i>                  breath controller
<i>"data"</i>                    data slider
<i>"volume"</i>                  volume slider
<i>"pan"</i>                     pan silder
</pre>
<p>
	If <i>type</i> is set to <i>"polypress"</i>, then somehow
	a MIDI note number is used for something.
</ul>
<P></P>

<DT><a name="datafile" class="internallink"><i>datafile</i></A><BR>
<DD>
This establishes a PField variable that will read control data from
an existing datafile, probably created using the
<a href="makemonitor.php#datafile">makemonitor</a> scorefile command.
The syntax is:
<ul>
<pre>
pfield = makeconnection("datafile", "filename", lag, [skiptime[, timefactor[, filerate, format, swap]]])
</pre>
</ul>
This will open the file <i>filename</i> for reading.
An executing note using the <i>pfield</i> variable as
an Instrument parameter will draw data from the file
to provide the values for that parameter.  More than one parameter
or Instrument may be controlled simultaneously, depending on how
the connections are specified in the scorefile.  The arguments
determine how the file will be opened and read:
<ul>
	<li><i>"filename"</i> -- this string argument is a relative or
	absolute pathname to an existing file.
	<br>
	<br>
	<li><i>lag</i> -- the amount of smoothing for value stream [percent: 0-100].
	This applies a simple filter to the incoming data to prevent values
	from jumping abruptly, potentially causing discontinuity glitches
	in executing notes.
	<br>
	<br>
	<li><i>skiptime</i> -- the time in seconds to skip before reading data
	file, prior to applying <i>timefactor</i>.  This is optional; default is 0.
	<br>
	<br>
	<li><i>timefactor</i> -- this scales (expands or contracts) the
	time it takes to read the file: 1 means use the same
	amount of time it took to create the file; 2 means take
	twice as long to play the file data; 0.5 means take half
	as long; etc.  This argument is optional; if used,
	<i>skiptime</i> must be given.  Default for <i>timefactor</i> is 1.0.
	<br>
	<br>
	<li><i>lag</i> -- amount of smoothing for value stream [percent: 0-100].
	This applies a simple filter to the incoming data to prevent values
	from jumping abruptly, potentially causing discontinuity glitches
	in executing notes.
	<br>
	<br>
	<li><i>filerate</i> -- an optional parameter for datafiles with no
	file 'header' containing information relevant to how the data in the
	file is interpreted.  If this parameter is specified, then the
	subsequent <i>format</i> and <i>swap</i> parameters should also
	be present.  <i>filerate</i> determines the control rate at which
	the data points from the file will be read.  It is recommended that
	this be significantly less than the control rate (maybe 1/5 as fast)
	in order to 'thin' the file data a bit.  This rate is the number of
	updates/second, and the overall control rate is set by the
	<a href="reset.php">reset</a> scorefile command.  The default
	overall control rate is 1000 updates/second.
	<br>
	<br>
	<li><i>format</i> -- an optional string value used for datafiles
	with no file 'header'.  This determines the format of the data
	in the file.  Acceptable values are <i>"double", "float", "int64",
	"int32", "int16"</i> or <i>"byte".</i>  This parameter is used in
	conjunction with the <i>filerate</i> and <i>swap</i> parameters.
	<br>
	<br>
	<li><i>swap</i> -- this optional number sets whether or not
	byte-swapping should be employed when reading files with no
	file 'header'.  A value of 0 sets no swapping; 1 will engage
	swapping.  This parameter is used in
	conjunction with the <i>filerate</i> and <i>format</i> parameters.
</ul>
<P></P>

<DT><a name="inlet" class="internallink"><i>inlet</i></A> (Max/MSP
<a href="/rtcmix~/">rtcmix~</a>
only)<BR>
<DD>
This establishes a PField variable that will read data coming from
an 'inlet' on the Max/MSP
<a href="/rtcmix~/">rtcmix~</a>
object.
The syntax is:
<ul>
<pre>
pfield = makeconnection("inlet", inlet_number, default)
</pre>
</ul>
An executing note using the <i>pfield</i> variable as
an Instrument parameter will draw data from a max-patch
through one of the <i>rtcmix~</i> object inlets.
As with the
<a href="#mouse">"mouse"</a> and
<a href="#mouse">"midi"</a>
connection types, more than one parameter
or Instrument may be controlled simultaneously, depending on how
the connections are specified in the scorefile.
<ul>
	<li><i>inlet_number</i> -- which inlet will be read for this
	<i>pfield-handle</i> variable.
	<br>
	<br>
	<li><i>default</i> -- the initial value used for the <i>pfield-handle</i>.
</ul>
Please refer to the <i>rtcmix~</i> object help-patch for more information
on how this connection type is used.
<P></P></DL>
<P>

<HR>
<h3>Examples</h3>
<PRE>
   pan = makeconnection("mouse", "x", 1, 0, .5, lag=50, "pan")
   deltime = makeconnection("mouse", "x", 0.0002, .5, .5, lag=90, "delay time", "", 5)
   feedback = makeconnection("mouse", "y", 0, 1, 0, lag=20, "feedback")
   DELAY(0, 0, 10, 1.0, deltime, feedback, 1.0, 0, pan)
</pre>
This scorefile uses three different <i>pfield-handle</i> variables: <i>pan</i>,
<i>deltime</i> and <i>feedback</i>.  <i>pan</i> and <i>deltime</i>
are controlled by the 'x' position of the mouse, scaled by the
<i>min</i> and <i>max</i> values for each ([1, 0], [0.0002, 0.5]).
The <i>deltime</i> parameter is set with a high <i>lag</i> percentage
to prevent glitching as the delay-time of the
<a href="/reference/instruments/DELAY.php">DELAY</a>
instrument is changed.  The <i>feedback</i> parameter tracks the 'y'
position of the mouse, scaling values between 0 and 1.  Notice
that these <i>pfield-handle</i> variables function in the same way that
<a href="maketable.php">maketable</a>
table-handle variables do.
<p>
See the <u>RTcmix/docs/sample_scores/dynamic_insts/</u> subdirectory
in the RTcmix distrubition for more examples of different connection
types.
<P>

<HR>
<h3>NOTES</h3>
<p>
The <b>makeconnection</b> command will dynamically-load the library
containing the interface code used for each connection type.  For
example:
<pre>
   makeconnection("mouse", ...)
</pre>
will look for the dynamic library <u>libmouse.so</u>.  As discussed
above, this library needs to be locatable along the RTcmix library
search path.  The default RTcmix installation will compile and
install this library into the <u>RTcmix/shlib/</u> directory.
<P>


<HR>
<h3>See Also</h3>
<p>
<a href="maketable.php">maketable</a>,
<a href="makeLFO.php">makeLFO</a>,
<a href="makerandom.php">makerandom</a>,
<a href="makefilter.php">makefilter</a>,
<a href="makeconverter.php">makeconverter</a>,
<a href="makemonitor.php">makemonitor</a>
<p>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
