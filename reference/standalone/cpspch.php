<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - cpspch</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>cpspch</b> - convert octave.pitch-class to frequency (Hz)

<HR>
<h3>Synopsis</h3>
<P><STRONG>cpspch</STRONG> <EM>frequency</EM></P>
<P>
<HR>
<h3>Description</h3>

<P>Given a pitch in ``octave.pitch-class'' notation (<i>oct.pc</i>),
<STRONG>cpspch</STRONG> prints that value as frequency
in Hz (cycles per second).
<i>oct.pc</i> is a way
to use standard "western" keyboard notes without having to look
up the pitch-frequency conversion.  It works by arbitrarily assigning
the octave of middle-C to 8.00.  Any semitone above middle-C is
added as a "hundredth" to the left of the decimal point, i.e.
8.01 is the C# just above middle-C, 8.02 is the D, 8.03 is the D# (Eb),
etc. up to 8.12, which is equivalent to 9.00.   9.01 is then the C#
one octave and a semitone abouve midddle-C. 
<p>
The fun thing about this notation is that you are not limited to
keyboard-notes.  A pitch specification of 7.07542389 will select
a frequency that is somewhere about half-way between the G (7.07)
and Ab (7.08) just below middle-C.  Different RTcmix instruments
will require the pitch or frequency to be specified in different
ways, although the scorefile commands
<a href="/reference/scorefile/cpspch.php">cpspch</a>,
<a href="/reference/scorefile/pchcps.php">pchcps</a>
or other related commands can do most necessary conversions.
</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
