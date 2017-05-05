<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MBRASS</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MBRASS</b> -- brass instrument physical model
<br>
<i>in RTcmix/insts/stk</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MBRASS</b>(outsk, dur, AMP, FREQ, SLIDELEN, LIPFILT, maxpressure[, PAN, BREATHENV])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>


<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = frequency (Hz)
   p4 = slide length (samps)
   p5 = lip filter (Hz)
   p6 = max pressure (0.0-1.0)
   p7 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]
   p8 = breath pressure table [optional; default is 1.0]

   p2 (amplitude), p3 (frequency), p4 (slide length), p5 (lip filter) and p7 (pan)
   can receive dynamic updates from a table or real-time control source.

   p8 (breath pressure table), if used, should be a reference to a pfield table-handle.

   Author:  Brad Garton, based on code from the <a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit</a>
</pre>
<br>
<hr>
<br>


<b>MBRASS</b> is the "Brass" physical model in Perry Cook and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">STK</a>,
the Synthesis ToolKit. 

<h3>Usage Notes</h3>

<b>MBRASS</b>
models a simple brass instrument, using digital waveguide techniques.
Dum-dah-dah-DAAAAAH!
Here's what Perry says about "Brass":
<ul>
    This class implements a simple brass instrument
    waveguide model, a la Cook (TBone, HosePlayer).
</ul>
Although parameter p3 ("FREQ") looks as though it would set the pitch
for <b>MBRASS</b>, it is only one element of several interacting
factors.  This is a physical model, and as such the sounding pitch
is influenced by the length of the modeled tube/slide (p4, "SLIDELEN"),
the 'lip filter' modeling how elastic the lip-impulse sound is
(p5, "LIPFILT") and the simulated air pressure in the model (p6, "maxpressure"
and p8, "BREATHENV").  In other words, specifying a particular pitch
is somewhat inexact.  Here is a rough tuning-table (done by ear!)
for the <b>MBRASS</b> instrument:
<pre>
   note (oct.pc)   slide length (p4)   lip filter (p5)   max pressure (p6)
     7.00               103                140               0.045
     7.01               103                150               0.05
     7.02               103                160               0.07
     7.03               103                170               0.1
     7.04               100                180               0.1
     7.05                95                188               0.15
     7.06                90                195               0.15
     7.07                80                207               0.2
     7.08                75                220               0.2
     7.09                70                235               0.2
     7.10                65                250               0.2
     7.11                55                255               0.2
     8.00                50                265               0.2
     8.01                45                280               0.2
     8.02                43                295               0.2
     8.03                40                320               0.1
     8.04                40                340               0.25
     8.05                35                355               0.25
     8.06                30                370               0.25
     8.07                30                395               0.3
     8.08                25                415               0.3
     8.09                15                430               0.3
     8.10                10                450               0.3
     8.11                10                480               0.2
     8.11 (alt)         270                450               0.23
     9.00                10                520               0.2
     9.00 (alt)         255                480               0.23/0.25
     9.01               240                490               0.3
     9.02               228                530               0.3
     9.03               215                550               0.35
     9.04               202                590               0.4
     9.05               190                640               0.4
     9.06               180                670               0.45
     9.07               170                710               0.5
     9.08               160                740               0.55
     9.09               150                780               0.6
     9.10               142                840               0.6
     9.11               134                860               0.65
    10.00               127                940               0.7
</pre>
These are approximate.  Also note that the same pitch may be produced
by different combinations of parameters.
<p>Also be aware that some combinations of parameters will yield no sound.
The 'physics' have to work correctly!
<p>
<b>MBRASS</b> can produce other mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("MBRASS")

   amp = 40000
   breathenv = maketable("line", 1000, 0,0, 0.05,1, 3.0,3, 3.5,0)

   MBRASS(0, 3.5, amp, 249.0, 200, 279.0, 0.3, 0.5, breathenv)
   MBRASS(4, 3.5, amp, 249.0, 400, 279.0, 0.3, 0.5, breathenv)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("MBRASS")

   freq = maketable("line", "nonorm", 1000, 0,201, 1,314)
   pan = makeLFO("tri", 0.5, 0.0, 1.0)
   MBRASS(0, 3.5, 15000, freq, 200, 279.0, 0.3, pan)

   bamp = maketable("line", 1000, 0,0, 1,1, 2,0)
   slide = maketable("line", "nonorm", 1000, 0, 100, 1, 400, 3, 200)
   lipfilt = makeLFO("sine", 3.5, 250, 400)
   MBRASS(4, 3.5, 20000, 249.0, slide, lipfilt, 0.3, 0.5, bamp)
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2)
   load("MBRASS")

   srand()

   breathamp = maketable("line", 1000, 0,0, 5,1, 10,0)

   /* amps */
   amps = { 30000, 20000, 20000, 20000, 20000, 20000, 20000, 20000, 20000, 20000, 20000, 20000, 20000, 20000, 20000, 20000, 20000, 20000 }
   lamps = len(amps)

   /* pch */
   pches = { 7.05, 7.07, 7.10, 8.00, 8.02, 8.03, 8.05, 8.07, 8.09, 8.10, 9.00, 9.02, 9.03, 9.05, 9.07, 9.09, 9.10, 10.00 }

   /* slide length */
   slidelen = { 95, 80, 65, 50, 43, 40, 35, 30, 15, 10, 255, 228, 215, 190, 170, 150, 142, 127 }

   /* lip filter */
   lipfilt = { 188, 207, 250, 265, 295, 320, 355, 395, 430, 450, 480, 530, 550, 640, 710, 780, 840, 940 }

   /* max pressure */
   maxpress = { 0.15, 0.2, 0.2, 0.2, 0.2, 0.2, 0.25, 0.3, 0.3, 0.3, 0.25, 0.3, 0.35, 0.4, 0.5, 0.6, 0.6, 0.7 }


   start = 0
   for(i = 0; i < 100; i=i+1)
   {
      index = trand(0, lamps)
      amp = amps[index]
      pch = pches[index]
      slide = slidelen[index]
      lip = lipfilt[index]
      pressure = maxpress[index]
      dur = irand(1.7, 2.7)
      MBRASS(start, dur, amp*0.4, cpspch(pch), slide, lip, pressure, random(), breathamp)
      start = start + (random() * 0.2 + 0.1)
   }
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="CLAR.php">CLAR</a>,
<a href="MBLOWBOTL.php">MBLOWBOTL</a>,
<a href="MBLOWHOLE.php">MBLOWHOLE</a>,
<a href="MBOWED.php">MBOWED</a>,
<a href="MCLAR.php">MCLAR</a>,
<a href="METAFLUTE.php">METAFLUTE</a>,
<a href="MSAXOFONY.php">MSAXOFONY</a>,
<a href="MSITAR.php">MSITAR</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


