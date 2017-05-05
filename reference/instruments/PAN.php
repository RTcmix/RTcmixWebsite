<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - PAN</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>PAN</b> -- stereo panning of input signal
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>PAN</b>(outsk, insk, dur, AMP, inputchan, PANMODE, PANENV)
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = input channel
   p5 = 0: use constant-power panning, 1: use linear panning
   p6 = pan (0-1 stereo; 0.5 is middle)

   p3 (amplitude), p5 (pan mode) and p6 (pan) can receive dynamic updates from
   a table or real-time control source.

   Author:  John Gibson, 1/26/00; rev for v4, JGG, 7/24/04
</pre>
<br>
<hr>
<br>

<b>PAN</b> is a simple mixing instrument that follows a pan curve

<h3>Usage Notes</h3>


<b>PAN</b> lets you pan the input sound continuously, according to the
control values coming through p6 ("PANENV").  These control values
are interpreted on a 0-1 scale, with 0.5 being set in the middle of
the stereo output.
<p>
<b>PAN</b> uses "constant-power'' panning to prevent a sense of lost power when
the sound source moves toward the center, unless you set p5 ("PANMODE") to zero.
Sometimes this causes jerkey panning motion near hard left/right, so you can
defeat it bys setting p5 to 1.
<p>
For rapidly-varying pan control envelopes, you may want to set the
reset rate higher than the default 1000 times/second.  Use the
<a href="/reference/scorefile/reset.php">reset</a>
scorefile command to do this.
<p>
The output of <b>PAN</b> is stereo only.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("PAN")

   rtinput("mysound.aif")

   dur = DUR()

   amp = 1.0
   ampenv = maketable("line", 1000, 0,0, 1,1, dur-1,1, dur,0)

   panenv = maketable("line", 1000, 0,1, 1,0, 3,.5)

   PAN(outskip=0, inskip=0, dur, amp*ampenv, inchan=0, panmode=0, panenv)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("WAVETABLE")
   load("PAN")

   /* feed wavetable into panner */
   bus_config("WAVETABLE", "aux 0 out")
   bus_config("PAN", "aux 0 in", "out 0-1")

   reset(10000)  /* lower control rates can produce zipper noise */

   dur = 10.0
   amp = 25000
   ampenv = maketable("line", 1000, 0,0, 1,1, 7,1, 10,0)
   pitch = 8.00
   wavetable = maketable("wave", 1000, 1, .4, .3, .2, .1)

   WAVETABLE(0, dur, amp*ampenv, pitch, 0, wavetable)

   panenv = makeLFO("tri", 0.5, 0, 1)   // pan once every 2 seconds

   PAN(0, 0, dur, amp=1, 0, 1, panenv)   /* disable constant-power panning */
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeLFO.php">makeLFO</a>,
<a href="DMOVE.php">DMOVE</a>,
<a href="MIX.php">MIX</a>,
<a href="MMOVE.php">MMOVE</a>,
<a href="MOVE.php">MOVE</a>,
<a href="MPLACE.php">MPLACE</a>,
<a href="MROOM.php">MROOM</a>,
<a href="NPAN.php">NPAN</a>,
<a href="PLACE.php">PLACE</a>,
<a href="QPAN.php">QPAN</a>,
<a href="ROOM.php">ROOM</a>,
<a href="SROOM.php">SROOM</a>
<a href="STEREO.php">STEREO</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

