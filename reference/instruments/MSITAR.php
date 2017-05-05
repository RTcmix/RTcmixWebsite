<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MSITAR</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MSITAR</b> -- sitar physical model
<br>
<i>in RTcmix/insts/stk</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MSITAR</b>(outsk, dur, AMP, FREQ, plamp[, PAN, AMPENV])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = frequency (Hz)
   p4 = pluck amp (0.0-1.0)
   p5 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]
   p6 = amplitude envelope table [optional; default is 1.0]

   p2 (amplitude), p3 (frequency) and p5 (pan) can receive dynamic updates from
   a table or real-time control source.

   p6 (amplitude envelope table), if used, should be a reference to a pfield table-handle.

   Author:  Brad Garton, based on code from the <a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit</a>
</pre>
<br>
<hr>
<br>


<b>MSITAR</b>
the "Sitar" physical model in Perry Cook and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">STK</a>,
the Synthesis ToolKit.

<h3>Usage Notes</h3>

<b>MSITAR</b>
models an Indian sitar.  It uses a modified Karplus-Strong
("plucked string" -- see the
<a href="STRUM2.php">STRUM2</a>
instrument) algorithm.
Here's what Perry says about "Sitar":
<ul>
    This class implements a sitar plucked string
    physical model based on the Karplus-Strong
    algorithm.
</ul>
The amplitude envelope table (p6, "AMPENV") is an optional
parameter.  It is also redundant -- the same functionality can be
achieved by using a pfield-table reference in p2 ("AMP").
<p>
<b>MSITAR</b> can produce other mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 1)
   load("MSITAR")

   amp = 17000
   MSITAR(0, 3.5, amp, cpspch(8.00), 0.9)
   MSITAR(4, 3.5, amp, cpspch(8.07), 0.9)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("MSITAR")

   MSITAR(0, 3.5, 30000, cpspch(8.00), 0.9)

   amp = maketable("line", 1000, 0,0, 1,1, 2,0)
   freq = makerandom("linear", 9.0, cpspch(8.065), cpspch(8.075))
   MSITAR(4, 3.5, amp*20000, freq, 0.9, 0.0)
   freq = makerandom("linear", 7.0, cpspch(8.065), cpspch(8.075))
   MSITAR(4, 3.5, amp*20000, freq, 0.9, 1.0)

   stramp = maketable("line", 1000, 0,1, 2,0)
   pan = makeLFO("sine", 14, 0, 1)
   MSITAR(8, 3.5, 20000, cpspch(7.07), 0.9, pan, stramp)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="CLAR.php">CLAR</a>,
<a href="MBLOWBOTL.php">MBLOWBOTL</a>,
<a href="MBLOWHOLE.php">MBLOWHOLE</a>,
<a href="MBOWED.php">MBOWED</a>,
<a href="MBRASS.php">MBRASS</a>,
<a href="MCLAR.php">MCLAR</a>,
<a href="METAFLUTE.php">METAFLUTE</a>,
<a href="MSAXOFONY.php">MSAXOFONY</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

