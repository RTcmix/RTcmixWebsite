<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - octpch</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>octpch</b> - convert octave.pitch-class (oct.pc) to linear octaves

</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
linoct = <b>octpch</b>(<i>octpcval</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
Given a pitch in "octave.pitch-class" notation (<i>oct.pc</i>),
<b>octpch</b> returns that value as a linear octave value.
<i>oct.pc</i> is a way
to use standard "western" keyboard notes without having to look
up the pitch-frequency conversion.  It works by arbitrarily assigning
the octave of middle C to 8.00.  Any semitone above middle C is
added as a "hundredth" to the left of the decimal point, i.e.
8.01 is the C# just above middle C, 8.02 is the D, 8.03 is the D# (Eb),
etc. up to 8.12, which is equivalent to 9.00.   9.01 is then the C#
one octave and a semitone abouve midddle C.
<p>
Linear octaves are similar to
octave.pitch-class (oct.pc) notation in that 8.00 is middle C,
9.00 is the C an octave above, etc.  The difference is that the fractional
part of the specification represents a direct mapping onto the notes
of the scale between octaves.  For example, in oct.pc notation the
value 8.06 represents F-sharp (the tritone, 1/2 the chromatic scale
between 8.00 and 9.00).  This would be represented as 8.5 in linear
octaves.
<p>
The fun thing about these notations is that you are not limited to
keyboard-notes.  An octave.pitch-class specification of 7.07542389 will select
a frequency that is somewhere about half-way between the G (7.07)
and Ab (7.08) just below middle-C.  The linear octave representation
will reflect this absolute frequency value.  Different RTcmix instruments
will require the pitch or frequency to be specified in different
ways.
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
<DT><i>octpcval</i>
<DD>
Any number, floating point or integer, representing an
linear octave pitch value
<P></P></DL>


<HR>
<h3>Examples</h3>
<pre>
   linval = octpch(8.07)
   linval = octpch(7.09425)
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
<a href="octmidi.php">octmidi</a>,
<a href="pchcps.php">pchcps</a>,
<a href="pchlet.php">pchlet</a>,
<a href="pchmidi.php">pchmidi</a>,
<a href="pchoct.php">pchoct</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

