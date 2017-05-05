<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - octmidi</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>octmidi</b> - convert midi note # to linear octaves

</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
linoct = <b>octmidi</b>(<i>midinote</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>octmidi</b> returns a corresponding linear octave value for a
given midi note number.  Linear octaves are similar to
octave.pitch-class (oct.pc) notation in that 8.00 is middle C,
9.00 is the C an octave above, etc.  The difference is that the fractional
part of the specification represents a direct mapping onto the notes
of the scale between octaves.  For example, in oct.pc notation the
value 8.06 represents F-sharp (the tritone, 1/2 the chromatic scale
between 8.00 and 9.00).  This would be represented as 8.5 in linear
octaves.
<p>
<b>octmidi</b> will not do fractional
midi note values.  Any fractional midi note number will be truncated
prior to conversion (i.e. 62.78 -> 62).
<p>
NOTE:  With the exception of
<a href="boost.php">boost</a>,
The RTcmix conversion functions follow a pattern.  The command isdivided into two halves, the one closest to the argument represent the
format of the argument, and the one closest to the assignment represents
the format to be returned.  For example, "cpspch" is divided into "cps"
and "pch".  The argument is in oct.pc form ("pch") and the return
value will be in cps ("cps").
<p>
The various format specifiers are:
<pre>
   amp = absolute amplitude (16-bit, 0-32768)
   cps = cycles per second (Hz)
   db = decibels
   midi = midi note # (60 is middle C)
   oct = linear octaves (8.5 is halfway between octave 8.00 [middle C] and 9.00)
   pch = octave.pitch-class (oct.pc; 8.00 is middle C, 8.02 is D, 8.12 = 9.00 = C above middle C)
   let = note-letter specification ("C4" is middle C, "C#4" is C-sharp above middle C,
      "Gb5" is G-flat the octave above middle C octave. [see <a href= "http://www.musiccog.ohio-state.edu/Humdrum/representations/pitch.rep.html">pitch-reps</a> for more info])
</pre>
</P>
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><i>midinote</i>
<DD>
Any postive number, floating point or integer, representing a midi note number
<P></P></DL>


<HR>
<h3>Examples</h3>
<pre>
   loct = octmidi(72)
   loct = octmidi(60.0)
</pre>

<HR>
<h3>See Also</h3>
<p>
<a href="ampdb.php">ampdb</a>,
<a href="boost.php">boost</a>,
<a href="dbamp.php">dbamp</a>,
<a href="cpslet.php">cpslet</a>,
<a href="cpsmidi.php">cpsmidi</a>,
<a href="cpsoct.php">cpsoct</a>,
<a href="cpspch.php">cpspch</a>,
<a href="midipch.php">midipch</a>,
<a href="octcps.php">octcps</a>,
<a href="octlet.php">octlet</a>,
<a href="octpch.php">octpch</a>,
<a href="pchcps.php">pchcps</a>,
<a href="pchlet.php">pchlet</a>,
<a href="pchmidi.php">pchmidi</a>,
<a href="pchoct.php">pchoct</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

