<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MBANDEDWG</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MBANDEDWG</b> -- banded-waveguide physical model
<br>
<i>in RTcmix/insts/stk</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MBANDEDWG</b>(outsk, dur, AMP, FREQ, strikepos, pluckflag, maxvel, preset, BOWPRESSURE, RESONANCE, INTEGRATION[, PAN, VELOCITYENV])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>


<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = frequency (Hz)
   p4 = strike position (0.0-1.0)
   p5 = pluck flag (0: no pluck, 1: pluck)
   p6 = max velocity (0.0-1.0)
   p7 = preset #
         - Uniform Bar = 0
         - Tuned Bar = 1
         - Glass Harmonica = 2
         - Tibetan Bowl = 3
   p8 = bow pressure (0.0-1.0) 0.0 == strike only
   p9 = mode resonance (0.0-1.0) 0.99 == normal strike
   p10 = integration constant (0.0-1.0) 0.0 == normal?
   p11 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]
   p12 = velocity envelope table reference [optional; default is 1.0]]

   p2 (amplitude), p3 (frequency), p8 (bow pressure), p9 (mode resonance),
   p10 (integration constant) and p11 (pan) can receive dynamic updates from
   a table or real-time control source.

   p11 (velocity table), if used, should be a reference to a pfield table-handle.

   Author:  Brad Garton, based on code from the <a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit</a>
</pre>
<br>
<hr>
<br>


<b>MBANDEDWG</b> is
the "BandedWG" physical model in Perry Cook and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">STK</a>,
the Synthesis ToolKit.

<h3>Usage Notes</h3>

<b>MBANDEDWG</b>
is a physical model instrument that recreates the sounds of
struck and bowed modal/metal objects (xylophones, glass harmonicas,
Tibetan bowls, etc.).
<p>
The description that Perry Cook (and Georg Essl on this one) give about
the "BandedWG" physical model:
<ul>
    This class uses banded waveguide techniques to
    model a variety of sounds, including bowed
    bars, glasses, and bowls.  For more
    information, see Essl, G. and Cook, P. "Banded
    Waveguides: Towards Physical Modelling of Bar
    Percussion Instruments", <u>Proceedings of the
    1999 International Computer Music Conference</u>.
</ul>
Parameter p5 ("pluckflag") is used to determine if the model will
be activated by an impulse.  p4 ("strikepos") is used to set
how the impulse will activate the model).  Setting p5 to 0 allows the
'bow pressure' (p8, "BOWPRESSURE"), the 'maximum velocity' (p6, "maxvel")
and the 'velocity envelope' (p12, "VELOCITYENV")
to operate.  By modulating p12, the sound of a bowed metal bar can be
produced.
<p>
The preset selected using p7 ("preset") configures the model for different
sounds.  p9 ("RESONANCE") and p10 ("INTEGRATION") also alter characteristics
of the model.
<p>
<b>MBANDEDWG</b> can produce other mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("MBANDEDWG")

   amp = 20000
   ampenv = maketable("line", 1000, 0,1, 2,0)

   MBANDEDWG(0, 5.0, amp*ampenv, cpspch(8.04), 0.3, 1, 0.5, 3, 0.0, 1.0, 0.0)

   velocityenv = maketable("line", 1000, 0,1, 2,0)
   MBANDEDWG(6, 5.0, amp*ampenv, cpspch(8.04), 0.3, 0, 0.5, 3, 0.3, 0.2, 0.8, 0.5, velocityenv)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("MBANDEDWG")

   amp = 10000
   ampenv = maketable("line", 1000, 0,1, 1,0)

   pitches  = { 8.00, 8.02, 8.04, 8.05, 8.07, 8.08, 8.10, 9.00 }
	lpitches = len(pitches)

   st = 0.0
   for (i = 0; i < 50; i = i+1)
   {
      index = trand(0, lpitches)
      pch = pitches[index]
      MBANDEDWG(st, 1.0, amp*ampenv, cpspch(pch), 0.3, 1, 0.5, 0, 0.0, 1.0, 0.0, random())
      st = st + 0.1
   }

   for (i = 0; i < 50; i = i+1)
   {
      index = trand(0, lpitches)
      pch = pitches[index]
      MBANDEDWG(st, 1.0, amp*ampenv, cpspch(pch), 0.3, 1, 0.5, 1, 0.0, 1.0, 0.0, random())
      st = st + 0.15
   }

   for (i = 0; i < 50; i = i+1)
   {
      index = trand(0, lpitches)
      pch = pitches[index]
      MBANDEDWG(st, 1.0, amp*ampenv, cpspch(pch), 0.3, 1, 0.5, 2, 0.0, 1.0, 0.0, random())
      st = st + 0.2
   }

   for (i = 0; i < 50; i = i+1)
   {
      index = trand(0, lpitches)
      pch = pitches[index]
      MBANDEDWG(st, 1.0, amp*ampenv, cpspch(pch), 0.3, 1, 0.5, 3, 0.0, 1.0, 0.0, random())
      st = st + 0.25
   }
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="AMINST.php">AMINST</a>,
<a href="FMINST.php">FMINST</a>,
<a href="MBOWED.php">MBOWED</a>,
<a href="MMESH2D.php">MMESH2D</a>,
<a href="MMODALBAR.php">MMODALBAR</a>,
<a href="MSHAKERS.php">MSHAKERS</a>,
<a href="STRUM.php">STRUM</a>,
<a href="STRUM2.php">STRUM2</a>,
<a href="STRUMFB.php">STRUMFB</a>,
<a href="WIGGLE.php">WIGGLE</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

