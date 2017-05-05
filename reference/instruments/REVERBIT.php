<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - REVERBIT</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>REVERBIT</b> -- modified basic Schroeder reverb
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>REVERBIT</b>(outsk, insk, dur, AMP, RVBTIME, RVBAMT, chan0delay, FILTFREQ[, dcblock, ringdowndur])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = reverb time (seconds, > 0)
   p5 = reverb amount (0: dry --> 1: wet)
   p6 = right channel delay time (seconds, > 0)
   p7 = cutoff freq for low-pass filter (Hz, 0 will disable filter)
   p8 = apply DC blocking filter (0: No, 1: Yes) [optional; default is 1]
   p9 = ring-down duration [optional; default is p4)

   p3 (amplitude), p4 (reverb time), p5 (reverb percent) and p7 (cutoff)
   can receive dynamic updates from a table or real-time control source.

   Author:  John Gibson, 6/24/99 rev for v4, 7/11/04
   based on original code by Paul Lansky
</pre>
<br>
<hr>
<br>

<b>REVERBIT</b> reverberates the input signal using a variation
on a typical Schroeder network of comb and allpass filters.

<h3>Usage Notes</h3>


<b>REVERBIT</b> is a very old reverbator (dates back to the late 1970's).
For a more general reverberation algorithm  the
<a href="FREEVERB.php">FREEVERB</a>
or
<a href="GVERB.php">GVERB</a>
instruments are probably better.  There are also a number of excellent
room-simulator instruments (listed under the
<a href="#see_also">See Also</a>
section below).
<p>
Here's how <b>REVERBIT</b> works:
<ul>
<li>(1)  Runs the input signal into a simple Schroeder reverberator,
scaling the output of that by the reverb percent and flipping its phase.
(The reverberator has four comb filters in parallel, followed by two
allpass filters in series.)
<br>
<br>
<li>(2)  Puts output of (1) into a delay line, length determined by
"chan0delay" (p6).
<br>
<br>
<li>(3)  Adds output of (1) to dry signal, and places in left channel.
<br>
<br>
<li>(4)  Adds output of delay to dry signal, and places in
right channel.
<br> 
<br>
<li>(4)  Feeds output to optional lowpass and DC-blocking filters.
</ul>
<b>REVERBIT</b> works best with short reverb times and a moderate amount
of reverberated sound mixed into the output. If you crank "RVBTIME" (p4)
and "RVBAMT" (p5), you'll hear a grungy, grainy reverb tail. You can smooth
this some using the lowpass filter. Lansky's original intent was
just to "put a gloss on a signal,'' not to swamp it with gushy reverb.
<p>
The chan0delay parameter (p6) governs the delay time between output
channels. A small amount (e.g., .02 seconds) livens up the sound;
a larger amount makes an audible slap echo.
<p>
The amplitude multiplier (p3, "AMP") is applied to the input sound before
it enters the reverberator.
<p>
The point of the optional ring-down duration parameter (p9, "ringdowndur")
is to let you control
how long the reverb will ring after the input has stopped.  If the
reverb time is constant, <b>REVERBIT</b> will figure out the correct ring-down
duration for you.  If the reverb time is dynamic, you must specify a
ring-down duration if you want to ensure that your sound will not be
cut off prematurely.
<p>
<b>REVERBIT</b> requires stereo output. The input file can be either mono or
stereo. If the input is from a real-time source, such as live audio in or
an aux bus, p1 ("inskip") has to be 0.

<h3>Sample Scores</h3>

<pre>
   rtsetparams(44100, 2)
   load("NOISE")
   load("REVERBIT")

   bus_config("NOISE", "aux 0 out")
   bus_config("REVERBIT", "aux 0 in", "out 0-1")

   totdur = 7
   for (st = 0; st < totdur; st = st + .3)
      NOISE(st, notedur=.1, amp=20000)

   REVERBIT(outskip=0, inskip=0, totdur + notedur, amp=1, revtime=.6, revpct=.4, rtchandel=.02, cutoff=5000)
</pre>
<br>


<hr>
<br>
<a name="see_also"></a>
<h3>See Also</h3>

<a href="DMOVE.php">DMOVE</a>,
<a href="FREEVERB.php">FREEVERB</a>,
<a href="GVERB.php">GVERB</a>,
<a href="MMOVE.php">MMOVE</a>,
<a href="MOVE.php">MOVE</a>,
<a href="MPLACE.php">MPLACE</a>,
<a href="MROOM.php">MROOM</a>,
<a href="PLACE.php">PLACE</a>,
<a href="REV.php">REV</a>,
<a href="ROOM.php">ROOM</a>,
<a href="SROOM.php">SROOM</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
