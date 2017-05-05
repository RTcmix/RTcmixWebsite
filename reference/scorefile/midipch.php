<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - midipch</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>midipch</b> - convert octave.pitch-class (oct.pc) to midi note #

</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
midinotenum = <b>midipch</b>(<i>octpcval</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>midipch</b> returns a corresponding midi note number for a
given octave.pitch-class value.  <i>oct.pc</i> is a way
to use standard "western" keyboard notes without having to look
up the pitch-frequency conversion.  It works by arbitrarily assigning
the octave of middle C to 8.00.  Any semitone above middle C is
added as a "hundredth" to the left of the decimal point, i.e.
8.01 is the C# just above middle C, 8.02 is the D, 8.03 is the D# (Eb),
etc. up to 8.12, which is equivalent to 9.00.   9.01 is then the C#
one octave and a semitone abouve midddle C.
<p>
Although <i>oct.pc</i> allows for the specification of notes
'between' ythe standard 12-note western scale (i.e. 8.07534),
<b>midipch</b> will round to the nearest non-fractional midi note
number.
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
Any postive number, floating point or integer, representing an
octave.pitch-class value.
<P></P></DL>


<HR>
<h3>Examples</h3>
<pre>
   mnote = midipch(8.10)
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
<a href="octcps.php">octcps</a>,
<a href="octlet.php">octlet</a>,
<a href="octmidi.php">octmidi</a>,
<a href="octpch.php">octpch</a>,
<a href="pchcps.php">pchcps</a>,
<a href="pchlet.php">pchlet</a>,
<a href="pchmidi.php">pchmidi</a>,
<a href="pchoct.php">pchoct</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

