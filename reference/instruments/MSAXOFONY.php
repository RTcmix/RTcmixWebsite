<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MSAXOFONY</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MSAXOFONY</b> -- saxophone physical model
<br>
<i>in RTcmix/insts/stk</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MSAXOFONY</b>(outsk, dur, AMP, FREQ, NOISEAMP, maxpressure, REEDSTUFF, APERTURE, BLOWPOS[, PAN, BREATHENV])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = (absolute, for 16-bit soundfiles: 0-32768)
   p3 = frequency (Hz)
   p4 = noise gain (0.0-1.0)
   p5 = max pressure (0.0-1.0)
   p6 = reed stiffness (0.0-1.0)
   p7 = reed aperture (0.0-1.0)
   p8 = blow position (0.0-1.0)
   p9 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]
   p10 = breath pressure table [optional; default is 1.0]

   p2 (amplitude), p3 (frequency), p4 (noise amp), p6 (reed stiffness), p7 (reed aperture),
   p8 (blow position) and p9 (pan) can receive dynamic updates from a table or
   real-time control source.

   p10 (breath pressure table), if used, should be a reference to a pfield table-handle.

   Author:  Brad Garton, based on code from the <a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit</a>
</pre>
<br>
<hr>
<br>


<b>MSAXOFONY</b> is the "Saxofony" physical model in Perry Cook
and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">STK</a>,
the Synthesis ToolKit.

<h3>Usage Notes</h3>

<b>MSAXOFONY</b>
<i>-- it's a late, smoky night in the Naked City.  Echoing through the alleyway,
diffracted by several dozen fire escapes, comes the throaty,
creaky/squeaky sound of a lazy blues... from a laptop!</i>
<p>
Well, not really -- but someday.  <b>MSAXOFONY</b> implements a physical
model of a sax.  Yeah, daddy-oh.
<p>
Here's what Gary says about "Saxofony":
<ul>
STK faux conical bore reed instrument class.
<p>
    This class implements a "hybrid" digital
    waveguide instrument that can generate a
    variety of wind-like sounds.  It has also been
    referred to as the "blowed string" model.  The
    waveguide section is essentially that of a
    string, with one rigid and one lossy
    termination.  The non-linear function is a
    reed table.  The string can be "blown" at any
    point between the terminations, though just as
    with strings, it is impossible to excite the
    system at either end.  If the excitation is
    placed at the string mid-point, the sound is
    that of a clarinet.  At points closer to the
    "bridge", the sound is closer to that of a
    saxophone.  See Scavone (2002) for more details.
</ul>
The model is similar in many ways to the
<a href="MCLAR.php">MCLAR</a>
and
<a href="MBLOWHOLE.php">MBLOWHOLE</a>
models.
<p>
Be aware that some combinations of parameters will yield no sound.  The
'physics' have to work correctly!
<p>
The optional 'breath pressure table' (p8, "BREATHENV") functions
independently of an amplitude-control envelope used in p2 ("AMP").
This allows you to design sharp attacks, etc.
<p>
<b>MSAXOFONY</b> can produce other mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("MSAXOFONY")

   breathenv = maketable("line", 1000, 0,1, 2,0)
   MSAXOFONY(0, 3.5, 20000.0, 243.0, 0.2, 0.7, 0.5, 0.3, 0.6, 0.5, breathenv)
   MSAXOFONY(4, 3.5, 20000.0, 149.0, 0.2, 0.7, 0.5, 0.3, 0.6, 0.5, breathenv)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("MSAXOFONY")

   noiseamp = maketable("line", 1000, 0,1, 1,0, 2,1)
   aperture = makeLFO("sine", 2.0, 0.1, 0.7)
   blowpos = maketable("line", 1000, 0,0.5, 1,0.2, 3,0.8)
   MSAXOFONY(0, 3.5, 15000.0, 243.0, noiseamp, 0.7, 0.5, aperture, blowpos)

   amp = maketable("line", 1000, 0,0,1,1, 2,0)
   freq = makeLFO("sine", 4.0, 145, 150)
   reed = makeLFO("sine", 1.5, 0.1, 0.9)
   pan = maketable("line", 1000, 0,0.5, 1,1, 2,0, 2.5,1)
   MSAXOFONY(4, 3.5, amp*10000.0, freq, 0.2, 0.7, reed, 0.3, 0.6, pan)

   bamp = maketable("line", 1000, 0,0, 2,1, 10,1, 11,0)
   MSAXOFONY(8, 3.5, 20000.0, 178.0, 0.2, 0.7, 0.5, 0.3, 0.6, 0.5, bamp)
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
<a href="MCLAR.php">MCLAR</a>,
<a href="METAFLUTE.php">METAFLUTE</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


