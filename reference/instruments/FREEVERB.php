<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - FREEVERB</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>FREEVERB</b> -- decent stereo reverberator
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>FREEVERB</b>(outsk, insk, dur, AMP, ROOMSIZE, PREDELAY, ringdowndur, DAMP, DRYSIG, WETSIG, STEREOWIDTH)
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0  = output start time (seconds)
   p1  = input start time (seconds)
   p2  = input duration (seconds)
   p3  = amplitude multiplier (relative multiplier of input signal)
   p4  = room size (0-1.07143 ... don't ask)
   p5  = pre-delay time (seconds, time between dry signal and onset of reverb)
   p6  = ring-down duration (seconds)
   p7  = damp (room damping, 0-100%)
   p8  = dry signal level (0-100%)
   p9  = wet signal level (0-100%)
   p10 = stereo width of reverb (0-100%)

   p3 (amplitude), p4 (room size), p5 (pre-delay), p7 (damp), p8 (dry),
   p9 (wet) and p10 (stereo width) can receive dynamic updates from a table
   or real-time control source.

   Author: John Gibson, 2 Feb 2001; rev for v4, 7/11/04
   This reverb instrument is based on Freeverb, by Jezar
   (http://www.dreampoint.co.uk/~jzracc/freeverb.htm).
</pre>
<br>
<hr>
<br>

<b>FREEVERB</b>
uses a simple but well-done
implementation of the standard Schroeder/Moorer reverb model.
It is based on the
<a href="http://www.dreampoint.co.uk/~jzracc/freeverb.htm">Freeverb</a>
code, put nicely in the public domain by "Jezar".  The reverb sounds
pretty good, probably because Jezar "spent a long while doing listening tests
in order to create the values [used]."  We're glad he did!
<p>
From the Jezar's implementation notes:
The algorithm uses 8 comb filters on both the left and right channels.
It then feeds the result of the reverb through 4 allpass filters on both the
left and right channels. These "smooth" the sound.
The filters on the right channel are slightly detuned compared to the left
channel in order to create a stereo effect.
<p>
The amplitude multiplier ("AMP", p3) is applied to the input sound before
it enters the reverberator.
<p>
Be careful with the dry and wet levels -- it's easy to get extreme clipping!
<p>
If you enter a room size greater than the maximum, you'll get the
maximum amount -- which is probably an infinite reverb time.
<p>
Input can be mono or stereo; output can be mono or stereo.


<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("FREEVERB")
   
   rtinput("mysound.aif")
   
   outskip = 0
   inskip = 0
   dur = DUR()
   amp = .5
   roomsize = 0.9
   predelay = .03
   ringdur = 3
   damp = 70
   dry = 40
   wet = 30
   width = 100
   
   ampenv = maketable("line", 10000, 0,1, 9,1, 10,0)
   
   FREEVERB(outskip, inskip, dur, amp*ampenv, roomsize, predelay, ringdur, damp, dry, wet, width)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("FREEVERB")
   
   bus_config("MIX", "in 0", "aux 0 out")
   bus_config("FREEVERB", "aux 0 in", "out 0-1")
   
   //-----------------------------------------------------------------
   rtinput("mysound.wav")
   inskip = 0
   dur = 1.5
   
   for (start = 0; start < 12; start += dur)
      MIX(start, inskip, dur, amp=1, 0)
   
   //-----------------------------------------------------------------
   outskip = 0
   inskip = 0     // must be zero, since it's reading from aux bus
   dur += start
   amp = 0.25
   env = maketable("line", 1000, 0,.1, 4,1, 10,1)
   
   roomsize = maketable("curve", "nonorm", 100, 0,0,-2, 6,1.1,0, 8,0)
   predelay = .0
   ringdur = 9
   damp = maketable("line", "nonorm", 100, 0,100, 1,100, 4,20, 5,0)
   dry = 40
   wet = 32
   width = maketable("line", "nonorm", 100, 0,0, 3,100, 6,100)
   
   FREEVERB(outskip, inskip, dur, amp * env, roomsize, predelay, ringdur, damp, dry, wet, width)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/bus_config.php">bus_config</a>,
<a href="DMOVE.php">DMOVE</a>,
<a href="GVERB.php">GVERB</a>,
<a href="MMOVE.php">MMOVE</a>,
<a href="MOVE.php">MOVE</a>,
<a href="MPLACE.php">MPLACE</a>,
<a href="MROOM.php">MROOM</a>,
<a href="PLACE.php">PLACE</a>,
<a href="REV.php">REV</a>,
<a href="REVERBIT.php">REVERBIT</a>,
<a href="ROOM.php">ROOM</a>,
<a href="SROOM.php">SROOM</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

