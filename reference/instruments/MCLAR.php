<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MCLAR</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MCLAR</b> -- clarinet physical model
<br>
<i>in RTcmix/insts/stk</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MCLAR</b>(outsk, dur, AMP, FREQ, NOISEAMP, maxpressure, REEDSTUFF[, PAN, BREATHENV])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>


<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = frequency (Hz)
   p4 = noise gain (0.0-1.0)
   p5 = max pressure (0.0-1.0)
   p6 = reed stiffness (0.0-1.0)
   p7 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]
   p8 = breath pressure table [optional; default is 1.0]

   p2 (amplitude), p3 (frequency), p4 (noise amp), p6 (reed stiffness) and
   p7 (pan) can receive dynamic updates from a table or real-time control source.
   p8 (breath pressure table), if used, should be a reference to a pfield table-handle.

   Author:  Brad Garton, based on code from the <a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit</a>
</pre>
<br>
<hr>
<br>


<b>MCLAR</b> is the "Clarinet" physical model in Perry Cook and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">STK</a>,
the Synthesis ToolKit.

<h3>Usage Notes</h3>

<b>MCLAR</b>
implements a clarinet physical model.  It seems highly similar to the
earlier
<a href="CLAR.php">CLAR</a> physical model,
but this has better control parameters.  Also check out
<a href="MBLOWHOLE.php">MBLOWHOLE</a>
for a clarinet-like model with a tonehole and register vent included.
<p>
It was originally adapted from Perry Cook
and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">STK</a>,
for doing amazing physical model stuff.
<p>
This is from the orginal STK source code for "Clarinet":
<ul>
    This class implements a simple clarinet
    physical model, as discussed by Smith (1986),
    McIntyre, Schumacher, Woodhouse (1983), and
    others.
</ul>
Be aware that some combinations of parameters will yield no sound.  The
'physics' have to work correctly!
<p>
The optional 'breath pressure table' (p8, "BREATHENV") functions
independently of an amplitude-control envelope used in p2 ("AMP").
This allows you to design sharp attacks, etc.
<p>
<b>MCLAR</b> can produce other mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("MCLAR")

   breathenv = maketable("line", 1000, 0,1, 2,0)
   MCLAR(0, 3.5, 30000.0, 314.0, 0.2, 0.7, 0.5, 0.5, breathenv)
   MCLAR(4, 3.5, 30000.0, 149.0, 0.2, 0.7, 0.5, 0.5, breathenv)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("MCLAR")

   amp = maketable("line", 1000, 0,0, 1,1, 2,1, 3,0)
   freq = maketable("line", "nonorm", 1000, 0, 349, 1, 207)
   MCLAR(0, 3.5, amp*20000.0, freq, 0.2, 0.7, 0.5)

   bamp = maketable("line", 1000, 0,1, 2,1, 3,0)
   noise = makeLFO("sine", 7.0, 0.0, 1.0)
   reedstiff = maketable("line", 1000, 0,0, 1,1, 2,0)
   pan = maketable("line", 1000, 0,1, 1,0, 1.5,1, 2,0)
   MCLAR(4, 3.5, 15000.0, 149.0, noise, 0.7, reedstiff, pan, bamp)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="CLAR.php">CLAR</a>,
<a href="MBLOWBOTL.php">MLOWBOTL</a>,
<a href="MBLOWHOLE.php">MBLOWHOLE</a>,
<a href="MBOWED.php">MBOWED</a>,
<a href="MBRASS.php">MBRASS</a>,
<a href="METAFLUTE.php">METAFLUTE</a>,
<a href="MSAXOFONY.php">MSAXOFONY</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

