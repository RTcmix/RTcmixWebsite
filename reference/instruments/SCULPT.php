<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - SCULPT</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>SCULPT</b> -- breakpoint oscillator resynthesis
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>SCULPT</b>(outsk, segmentdur, amp. nsegments[, pan])
	<ul>
   This instrument has no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
   default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration of each segment (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = number of points
   p4 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sysystem should be used:

   function table 1 is overall amp envelope
   function table 2 is the synthesis waveform
   function table 3 is a listing of the frequency points
   function table 4 is a listing of the amplitude points

   Author:  Stanko Juzbasic
</pre>
<br>
<hr>
<br>

<b>SCULPT</b> is an instrument which does a time-based resynthesis of
frequency / amplitude pairs that have been parsed into
<a href="/reference/scorefile/makegen.php">makegen</a>
function tables.

<h3>Usage Notes</h3>

As much fun as this instrument is, its functionality has largely been
superceded by
<a href="WAVETABLE.php">WAVETABLE</a> and
<a href="MULTIWAVE.php">MULTIWAVE</a>
using the pfield control mechanism.  Stanko originally designed it so that
output from analysis programs like IRCAM's
<a href="http://forumnet.ircam.fr/691.php?L=1">AudioSculpt</a>
or Michael Klingbeil's
<a href="http://www.klingbeil.com/spear/">SPEAR</a>
(which didn't even exist when <b>SCULPT</b> was written).
<p>
If you do use <b>SCULPT</b>, be sure not to normalize the values
in the
<a href="/reference/scorefile/makegen.php">makegen</a>
tables.  Also, be aware that <b>SCULPT</b> does not interpolate between
frequency and amplitude values in the table.  Each value holds constant for
the length of each segment.
<p>
<b>SCULPT</b> can produce stereo or mono output.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 2)
   load("SCULPT")

   makegen(1, 24, 1000, 0, 1, 1, 1)
   makegen(2, 10, 1000, 1)
   makegen(3, 2, 10, 0)
      149.0 159.0 169.0 179.0 189.0 199.0 214.0 215.0 234.0 314.0
   makegen(4, 2, 10, 0)
      0.0 -7.0 -10.0 -3.0 0.0 -10.0 -20.0 -15.0 -2.1 -1.1

   SCULPT(0, 0.5, 10, 10)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="MULTIWAVE.php">MULTIWAVE</a>,
<a href="WAVETABLE.php">WAVETABLE</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

