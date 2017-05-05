<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MBLOWBOTL</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MBLOWBOTL</b> -- simple Helmholtz resonator physical model
<br>
<i>in RTcmix/insts/stk</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MBLOWBOTL</b>(outsk, dur, AMP, FREQ, NOISEAMP, maxpressure[, PAN, PRESSUREENV])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>


<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = frequency (Hz)
   p4 = noise gain (0.0-1.0)
   p5 = max pressure (0.0 - 1.0)
   p6 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]
   p7 = breath pressure table [optional; default is 1.0]

   p2 (amplitude), p3 (frequency), p4 (noise amp) and p6 (pan) can receive
   dynamic updates from a table or real-time control source.

   p7 (breath pressure table), if used, should be a reference to a pfield table-handle.

   Author:  Brad Garton, based on code from the <a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit</a>
</pre>
<br>
<hr>
<br>


<b>MBLOWBOTL</b> is
the "BlowBotl" physical model in Perry Cook and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">STK</a>
,
the Synthesis ToolKit.

<h3>Usage Notes</h3>

<b>MBLOWBOTL</b>
is a physical model instrument that recreates the haunting sound of
a simple Helmholtz resonator.  Once you hear this, you will
probably never want to use any other instrument ever again.
Well, maybe not...
<p>
Here's what Perry says about "BlowBotl":
<ul>
    This class implements a helmholtz resonator
    (biquad filter) with a polynomial jet
    excitation (a la Cook).
</ul>
The optional 'breath pressure table' (p7, "PRESSUREENV") functions
independently of an amplitude-control envelope used in p2 ("AMP").
This allows you to design sharp attacks, etc.
<p>
<b>MBLOWBOTL</b> can produce other mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("MBLOWBOTL")

   amp = 30000
   ampenv = maketable("line", 1000, 0,1, 1,0)
   MBLOWBOTL(0, 3.5, amp*ampenv, 349.0, 0.3, 0.5)
   MBLOWBOTL(4, 3.5, amp*ampenv, 278.0, 0.7, 0.8)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("MBLOWBOTL")

   ampenv = maketable("line",1000, 0,0, 1,1, 2,0)
   amp = 20000.0 * 5
   noiseamp = 0.1
   st = 0
   MBLOWBOTL(st, 2.0, amp*ampenv, cpspch(7.03), noiseamp, 0.9)
   st = st + 2.0
   MBLOWBOTL(st, 2.0, amp*ampenv, cpspch(7.05), noiseamp, 0.9)
   st = st + 2.0
   MBLOWBOTL(st, 2.0, amp*ampenv, cpspch(7.07), noiseamp, 0.9)
   st = st + 2.0
   MBLOWBOTL(st, 2.0, amp*ampenv, cpspch(7.08), noiseamp, 0.9)
   st = st + 2.0
   MBLOWBOTL(st, 2.0, amp*ampenv, cpspch(7.10), noiseamp, 0.9)
   st = st + 2.0
   MBLOWBOTL(st, 2.0, amp*ampenv, cpspch(8.00), noiseamp, 0.9)
   st = st + 2.0
   MBLOWBOTL(st, 2.0, amp*ampenv, cpspch(8.02), noiseamp, 0.9)
   st = st + 2.0
   MBLOWBOTL(st, 2.0, amp*ampenv, cpspch(8.03), noiseamp, 0.9)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="CLAR.php">CLAR</a>,
<a href="MBLOWHOLE.php">MBLOWHOLE</a>,
<a href="MBOWED.php">MBOWED</a>,
<a href="MBRASS.php">MBRASS</a>,
<a href="MCLAR.php">MCLAR</a>,
<a href="METAFLUTE.php">METAFLUTE</a>,
<a href="MSAXOFONY.php">MSAXOFONY</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

