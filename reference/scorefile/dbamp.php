<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - dbamp</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>dbamp</b> - convert from absolute amplitude to decibels (dB)
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
decibels = <b>dbamp</b>(<i>ampval</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>dbamp</b> returns a corresponding decibel value for an absolute
amplitude value.
The 16-bit (0-32768) absolute amplitude range is approximately matched by
a 1-90 decibel range (0 dB returns "-inf").
<p>
NOTE:  With the exception of
<a href="boost.php">boost</a>,
The RTcmix conversion functions follow a pattern.  The command is
divided into two halves, the one closest to the argument represent the
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
<DT><i>ampval</i>
<DD>
Any positive number, floating point or integer, representing a 16-bit
amplitude value
<P></P></DL>



<HR>
<h3>Examples</h3>
<pre>
   dbval = dbamp(20000)
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="ampdb.php">dbamp</a>,
<a href="boost.php">boost</a>,
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


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

