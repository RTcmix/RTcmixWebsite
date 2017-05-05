<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - makeconverter</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>makeconverter</b> - read data from one <i>pfield-handle</i> or
<i>table-handle</i> and transform it to a different representation,
passing the altered data out through another <i>pfield-handle</i>.
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
pfield = <b>makeconverter</b>(<i>input_handle</i>, <i>"converter_type"</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>makeconverter</b>
returns a <i>pfield-handle</i> that will deliver data by applying an
RTcmix data-representation conversion routine
as specified by the <i>"convertor_type"</i> string argument.
This will be applied to data coming through
the <i>input-handle</i> variable.  The <i>input_handle</i> variable
can be any of the PField-derived variables in RTcmix, such as a
<i>table-handle</i> (see
<a href="maketable.php">maketable</a>)
or another <i>pfield-handle</i> (see
<a href="makeconnection.php">makeconnection</a>,
<a href="makeLFO.php">makeLFO</a> or
<a href="makerandom.php">makerandom</a>).
<p>
Many of the arguments for <b>makeconverter</b> may themselves
also be pfield-handles.
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="input_handle""><i>input_handle</i></A><BR>
<DD>
This is a <i>pfield-handle</i> variable referring to a data stream, possibly
from an external device or interface or an internal PField data-generating
process.
<P></P>

<DD>
<DT><A NAME="item_converter_type"><i>converter_type</i></A><BR>
<DD>
This string value (i.e. enclosed in "double quotes" in the scorefile)
determines which RTcmix data-format conversion routines
(listed below) will be used to transform the values
coming through the <i>input_handle</i>.  The <i>pfield-handle</i> returned
from the <b>makeconverter</b> command will refer to this transformed
data stream.
<P></P></DL>
<P>

<hr>
<h2><a name="converter_types">Converter Types</a></h2>
<DL>
The string argument for the converter to operate on the <i>input_handle</i>
data stream can be any of the following:
<ul>
	<li><i>"ampdb"</i> - convert amp in decibels to a real amplitude
	<br>
	<li><i>"cpsoct"</i> - convert linear octaves to cycles per second
	<br>
	<li><i>"octcps"</i> - convert cycles per second to linear octaves
	<br>
	<li><i>"octpch"</i> - convert octave.pitch-class to linear octaves
	<br>
	<li><i>"cpspch"</i> - convert octave.pitch-class to cycles per second
	<br>
	<li><i>"pchoct"</i> - convert linear octaves to octave.pitch-class
	<br>
	<li><i>"pchcps"</i> - convert cycles per second to octave.pitch-class
	<br>
	<li><i>"pchmidi"</i> - convert MIDI note # to octave.pitch-class
	<br>
	<li><i>"octmidi"</i> - convert MIDI note # to linear octaves
	<br>
	<li><i>"midipch"</i> - convert octave.pitch-class to MIDI note #
	<br>
	<li><i>"boost"</i> - converts a pan value (0-1) to a linear amplitude that,
       when multiplied by the amplitude of a note, achieves constant-power
       panning (compensating for the "hole in the middle")
</ul>
For more information on these conversion types, see the documentation
for the various RTcmix
data format converters (such as
<a href="ampdb.php">ambdb</a>,
<a href="cpsoct.php">cpsoct</a>,
<a href="pchmidi.php">pchmidi</a>,
etc. (see the <a href="#see also">SEE ALSO</a> section below.)
<P>


<HR>
<h3>Examples</h3>
<PRE>
   mpfield = makeconnection("midi", 1, 127, 60, 0, 1, "noteonpitch")
   octpfield = makeconverter(mpfield, "pchmidi")
</pre>
<i>mpfield</i> receives MIDI note # data from MIDI NoteOn events, and the
<b>makeconverter</b> command will change them into the octave.pitch-class
(see
<a href="pchcps.php">pchcps</a>
for a description of octave.pitch-class)
notation format used by many RTcmix Instruments.  The <i>octpfield</i>
variable could then be used to control Instrument pitch dynamically.
<p>


<HR>
<h3>See Also</h3>
<p>
<a href="maketable.php">maketable</a>,
<a href="makeconnection.php">makefilter</a>,
<a href="makeLFO.php">makeLFO</a>,
<a href="makerandom.php">makerandom</a>,
<a href="makefilter.php">makefilter</a>,
<a href="makemonitor.php">makemonitor</a>,
<a href="ampdb.php">ampdb</a>,
<a href="boost.php">boost</a>,
<a href="dbamp.php">dbamp</a>,
<a href="cpsmidi.php">cpsmidi</a>,
<a href="cpslet.php">cpslet</a>,
<a href="cpsoct.php">cpsoct</a>,
<a href="cpspch.php">cpspch</a>,
<a href="midipch.php">midipch</a>,
<a href="octcps.php">octcps</a>,
<a href="octlet.php">octlet</a>,
<a href="octmidi.php">octmidi</a>,
<a href="octpch.php">octpch</a>,
<a href="pchcps.php">pchcps</a>,
<a href="pchlet.php">pchlet</a>,
<a href="pchmidi.php">pchmidi</a>,
<a href="pchoct.php">pchoct</a>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
