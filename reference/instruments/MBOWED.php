<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MBOWED</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MBOWED</b> -- bowed-string physical model
<br>
<i>in RTcmix/insts/stk</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MBOWED</b>(outsk, dur, AMP, FREQ, vibfreqlo, vibfreqhi, VIBDEPTH, PAN, BOWVELENV, BOWPRESSENV, BOWPOSENV, VIBTABLE)
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>


<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = frequency (Hz)
   p4 = vibrato freq low (Hz)
   p5 = vibrato freq high (Hz)
   p6 = vibrato depth (% of base frequency [decimal notation 0.1 == 10%])
   p7 = pan (0-1 stereo; 0.5 is middle)
   p8 = bow velocity (amplitude) table
   p9 = bow pressure table
   p10 = bow position table
   p11 = vibrato wavetable

   p2 (amplitude), p3 (frequency), p6 (vibrato depth) and p7 (pan) can receive
   dynamic updates from a table or real-time control source.

   p8 (bow velocity table), p9 (bow pressure table), p10 (bow position table) and
   p11 (vibrato wavetable) should be a references to pfield table-handles.

   Author:  Brad Garton, based on code from the <a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit</a>
</pre>
<br>
<hr>
<br>


<b>MBOWED</b>
the "Bowed" physical model in Perry Cook and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">STK</a>,
the Synthesis ToolKit.

<h3>Usage Notes</h3>

<b>MBOWED</b> models a bowed-string, using waveguide filter techniques.
Info from the original STK instrument source code:
<ul>
    This class implements a bowed string model, a
    la Smith (1986), after McIntyre, Schumacher,
    Woodhouse (1983).
</ul>
This instrument was coded before the new 
<a href="pfield-enabled.php">pfield-enabled</a>
capabilities were introduced to RTcmix, so the vibrato is built-in to
the instrument.  The vibrato will vary randomly in
frequency  between p4 ("vibfreqlo") and p5 ("vibfreqhi"), with
the amount controlled by p6 ("VIBDEPTH").  The waveform used for
the vobrato is passed in through p11 ("VIBTABLE").  Nowadays the
vibrato could be handled through a dynamic pfield control using
p3 ("FREQ"), but <b>MBOWED</b> will exit if the vibrato information
in p4, p5, p6 and p11 is not present.
<p>
The three other pfield table-handles (p8, "BOWVELENV"; p9, "BOWPRESSENV";
p10, "BOWPOSENV") can vary from 0.0-1.0 and control aspects of the
modeled bow during the duration of the note.
<p>
<b>MBOWED</b> can produce other mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("MBOWED")

   amp = 20000
   bowvelenv = maketable("line", 1000, 0,0, 1,1, 2,0)
   bowpressenv = maketable("line", 1000, 0,1, 1,1)
   bowposenv = maketable("line", 1000, 0,1, 2,0, 3,1)
   vibwave = maketable("wave", 1000, "sine")
   MBOWED(0, 7, 20000, 287.0, 5, 7, 0.02, 0.5, bowvelenv, bowpressenv, bowposenv, vibwave)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("MBOWED")

   amp = 20000
   ampenv = maketable("line", 1000, 0,0, 1,1, 9,1,10,0)
   bowvel = makeLFO("sine", 0.5, 0.2, 0.8)
   freq = maketable("line", "nonorm", 1000, 0,287, 1,350, 5,197.5)
   vdepth = maketable("line", "nonorm", 1000, 0,0, 1,0.1)
   pan = makeLFO("saw", 1.0, 0.0, 1.0)
   bowpress = maketable("line", 1000, 0,1, 1,0.8, 2,1, 3,0.7, 4,1)
   bowpos = maketable("line", 1000, 0,0, 2,1, 3,0)
   vibtable = maketable("wave", 1000, 1, 1)

   MBOWED(0, 7, amp*ampenv, freq, 3, 7, vdepth, pan, bowvel, bowpress, bowpos, vibtable)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="CLAR.php">CLAR</a>,
<a href="MBLOWBOTL.php">MBLOWBOTL</a>,
<a href="MBLOWHOLE.php">MBLOWHOLE</a>,
<a href="MBRASS.php">MBRASS</a>,
<a href="MCLAR.php">MCLAR</a>,
<a href="METAFLUTE.php">METAFLUTE</a>,
<a href="MSAXOFONY.php">MSAXOFONY</a>,
<a href="MSITAR.php">MSITAR</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

