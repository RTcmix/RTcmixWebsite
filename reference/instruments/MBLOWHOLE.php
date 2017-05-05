<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MBLOWHOLE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MBLOWHOLE</b> -- waveguide clarinet phyiscal model
<br>
<i>in RTcmix/insts/stk</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MBLOWHOLE</b>(outsk, dur, AMP, FREQ, NOISEAMP, maxpressure, REEDSTIFF, TONEHOLE, VENT[, PAN, PRESSUREENV])
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
   p7 = Tonehole state (1 == "open"; 0 == "closed")
   p8 = Register vent state (1 == "open"; 0 == "closed")
   p9 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]
   p10 = breath pressure table [optional; default is 1.0]

   p2 (amplitude), p3 (frequency), p4 (noise amp), p6 (reed stiffness), p7 (tonehole state),
   p8 (register vent state) and p9 (pan) can receive dynamic updates from a
   table or real-time control source.

   p10 (breath pressure table), if used, should be a reference to a pfield table-handle.

   Author:  Brad Garton, based on code from the <a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit</a>
</pre>
<br>
<hr>
<br>


<b>MBLOWHOLE</b> is
the "BlowHole" physical model in Perry Cook and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">STK</a>
,
the Synthesis ToolKit.

<h3>Usage Notes</h3>

<b>MBLOWHOLE</b>
is a simple clarinet/reed physical model instrument very similar in
sound and action to the earlier
<a href="CLAR.php">CLAR</a>
instrument.  The addition of a 'tonehole' and 'register vent'
to the model give it a bit more flexibility.
See also the
<a href="MCLAR.php">MCLAR</a>
instrument.
<p>
Here's what Perry and Gary say about "BlowHole":
<ul>
    This class is based on the clarinet model,
    with the addition of a two-port register hole
    and a three-port dynamic tonehole
    implementation, as discussed by Scavone and
    Cook (1998).
<p>
    In this implementation, the distances between
    the reed/register hole and tonehole/bell are
    fixed.  As a result, both the tonehole and
    register hole will have variable influence on
    the playing frequency, which is dependent on
    the length of the air column.  In addition,
    the highest playing freqeuency is limited by
    these fixed lengths.
</ul>
The optional 'breath pressure table' (p10, "PRESSUREENV") functions
independently of an amplitude-control envelope used in p2 ("AMP").
This allows you to design sharp attacks, etc.
<p>
<b>MBLOWHOLE</b> can produce other mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("MBLOWHOLE")

   amp = 20000
   ampenv = maketable("line", 1000, 0,1, 2,0)

   MBLOWHOLE(0, 3.5, amp*ampenv, 414.0, 0.2, 0.7, 0.5, 1, 1)
   MBLOWHOLE(4, 3.5, amp*ampenv, 414.0, 0.2, 0.7, 0.5, 0, 1)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("MBLOWHOLE")

   amp = 20000.0
   ampenv = maketable("line", 1000, 0,0,  0.1,1,  1,1, 1.1,0)
   ventstate = makeLFO("sine", 1, 0.0, 1.0)
   MBLOWHOLE(0, 3.5, amp*ampenv, 414.0, 0.2, 0.7, 0.5, 0, ventstate)

   breathamp = maketable("line", 1000, 0,0, 1,1, 2,1, 5,0)
   freq = maketable("line", "nonorm", 1000, 0,300, 1, 500)
   noiseamp = makeLFO("saw", 8.0, 1.0, 0.0)
   pan = makeLFO("sine", 1.4, 0.0, 1.0)
   MBLOWHOLE(4, 5.2, amp*ampenv, freq, noiseamp, 0.7, 0.2, 0, 1, pan, breathamp)

   reedstiff = maketable("line", "nonorm", 1000, 0,0.6, 1,0.81, 2,0)
   tonehole = makeLFO("sine", 1, 0.0, 1.0)
   ventstate = makeLFO("sine", 3.5, 0.0, 1.0)
   MBLOWHOLE(10, 3.5, amp*ampenv, 214.0, 0.2, 0.7, reedstiff, tonehole, ventstate)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="CLAR.php">CLAR</a>,
<a href="MBLOWBOTL.php">MBLOWBOTL</a>,
<a href="MBOWED.php">MBOWED</a>,
<a href="MBRASS.php">MBRASS</a>,
<a href="MCLAR.php">MCLAR</a>,
<a href="METAFLUTE.php">METAFLUTE</a>,
<a href="MSAXOFONY.php">MSAXOFONY</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

