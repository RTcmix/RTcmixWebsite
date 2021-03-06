<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - JGRAN</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>JGRAN</b> -- FM or wavetable granular synthesis
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>JGRAN</b>(outsk, dur, AMP, seed, osctype, phaserandom, GRAINENV, GRAINWAVE, MODFREQMULT, MODINDEX, MINFREQ, MAXFREQ, MINSPEED, MAXSPEED, MININTENSITY, MAXINTENSITY, DENSITY[, PAN, PANRANDOM])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0  = output start time (seconds)
   p1  = duration (seconds)
   p2  = amplitude multiplier (relative multiplier of grain intensity (p14, p15)
   p3  = random seed (any integer; if 0, seed from system clock) [default: 0]
   p4  = oscillator configuration (0: wavetable, 1: FM) [default: 0]
   p5  = randomize oscillator starting phase (0: no, 1: yes) [default: yes]
   p6  = reference to grain envelope table
   p7  = reference to grain waveform table
   p8  = modulation frequency multiplier (sets frequency of modulator for FM synthesis)
   p9  = index of modulation (FM synthesis)
   p10 = minimum grain frequency (Hz)
   p11 = maximum grain frequency (hz)
   p12 = minimum grain speed (I think this is the number of grains/second)
   p13 = maximum grain speed (ditto)
   p14 = minimum grain intensity (in dB for some reason, decibels above 0))
   p15 = maximum grain intensity (I'm not sure how this translates to actual amplitude)
   p16 = grain density (I have no idea what units are used.  Try "1")
   p17 = grain pan (0-1 stereo; 0.5 is middle) [optional; required if stereo output]
   p18 = grain pan randomization (1: full stereo randomization; 0: no randomization from p17 value)
      [optional; required if stereo output]

   p2 (amplitude), p8 (mod. freq.), p9 (mod. index), p10 (min. grain freq.),
   p11 (max. grain freq.), p12 (min. grain speed), p13 (max. grain speed),
   p14 (min. grain intensity), p15 (max. grain intensity), p16 (grain density),
   p17 (grain pan) and p18 (grain pan randomization) can receive dynamic
   updates from a table or real-time control source.

   p6 (grain envelope), p7 (grain waveform) should be references to pfield table-handles.


   Author:  John Gibson, 4/15/00; rev for v4, JGG, 7/25/04
   <b>JGRAN</b> was derived from a Cecilia module (StochasticGrains) by Mathieu
   Bezkorowajny and Jean Piche.
</pre>
<br>
<hr>
<br>


<b>JGRAN</b>
was derived from a
<a href="http://sourceforge.net/projects/cecilia/">Cecilia</a>
module (StochasticGrains) by
Mathieu Bezkorowajny and Jean Piche. See also Mara Helmuth's
<a href="SGRANR.php">SGRANR</a> or
<a href="STGRANR.php">STGRANR</a>
for more control over randomness.

<h3>Usage Notes</h3>

<b>JGRAN</b> produces only one stream of
non-overlapping grains. To get more
streams, call <b>JGRAN</b> more than once (maybe with different seeds).
<p>
This instrument uses non-interpolating oscillators for efficiency, so make large
tables for the grain waveform and grain envelope.
<p>
Note that amplitude is given in dB as the grain intensity
between two values (p14, "MININTENSITY"
and p15, "MAXINTENSITY").  The amp parameter (p2, "AMP") is thus an
overall scaling multiplier.  The dB values start at a base of 0 (i.e.
positive, not negative down from a reference value).
<p>
The pitch of each grain is determined by the constraints of p10 ("MINFREQ")
and p11 ("MAXFREQ").  In the case of FM synthesis, this will be set
as the carrier frequency of each synthesized grain.  The modulator
frequency is determined by multiplying this base frequency by the value
of p8 ("MODFREQMULT").
<p>
<b>JGRAN</b> can produce either stereo or mono output.  If used with
stereo output, p17 ("PAN") and p18 ("PANRANDOM") need to be
specified.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("JGRAN")

   dur = 16
   amp = 3

   // overall amplitude envelope
   env = maketable("line", 1000, 0,0, 1,1, 2,1, 4,0)

   // grain envelope
   genv = maketable("window", 1000, "hanning")

   // grain waveform
   gwave = maketable("wave", 10000, "sine")

   // modulation frequency multiplier
   mfreqmult = maketable("line", "nonorm", 1000, 0,2, 1,2.1) // slight increase

   // index of modulation envelope (per grain)
   modindex = maketable("line", "nonorm", 1000, 0,0, 1,5) // increasing index

   // grain frequency
   minfreq = 500
   maxfreq = maketable("line", "nonorm", 1000, 0,500, 1,550) // increasing maximum

   // grain speed
   minspeed = maketable("line", "nonorm", 1000, 0,100, 1,10) // decreasing minimum
   maxspeed = 100

   // grain intensity (decibels above 0)
   mindb = 80
   maxdb = 80

   // grain density
   density = maketable("line", "nonorm", 1000, 0,1, 1,1, 2,.8)  // slight decrease

   // grain stereo location -- image centered in middle
   pan = 0.5

   // grain stereo location randomization
   panrand = maketable("line", "nonorm", 1000, 0,0, 1,1) // increasingly randomized

   JGRAN(start=0, dur, amp * env, seed=1, type=1, ranphase=1,
      genv, gwave, mfreqmult, modindex, minfreq, maxfreq, minspeed, maxspeed,
      mindb, maxdb, density, pan, panrand)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("JGRAN")

   dur = 10
   amp = .5

   // overall amplitude envelope
   env = maketable("line", 1000, 0,0, 6,1, 9,1, 10,0)

   // grain envelope
   genv = maketable("window", 10000, "hanning")

   // grain waveform
   gwave = maketable("wave", 10000, 1, .1, .05)

   // modulation frequency multiplier
   mfreqmult = maketable("random", "nonorm", 1000, "high", min=0, max=1, seed=1)

   // index of modulation envelope (per grain)
   modindex = maketable("line", "nonorm", 1000, 0,0, 1,6)

   // grain frequency
   minfreq = maxfreq = 500

   // grain speed
   minspeed = 20
   maxspeed = 90

   // grain intensity (decibels above 0)
   mindb = 80
   maxdb = 80

   density = 1

   // grain stereo location
   pan = 0.5

   // grain stereo location randomization
   panrand = maketable("line", "nonorm", 1000, 0,0, 1,1)

   JGRAN(start=0, dur, amp * env, seed=1, type=1, ranphase=1,
      genv, gwave, mfreqmult, modindex, minfreq, maxfreq, minspeed, maxspeed,
      mindb, maxdb, density, pan, panrand)


   // a second grain stream, with some different params
   env = maketable("line", 1000, 0,0, 1,1, 4,1, 10,0)
   minfreq = 1000
   maxfreq = 1100
   panrand = maketable("line", "nonorm", 1000, 0,1, 1,0)
   amp = 2

   JGRAN(start=0, dur, amp * env, seed=2, type=0, ranphase=1,
      genv, gwave, mfreqmult, modindex, minfreq, maxfreq, minspeed, maxspeed,
      mindb, maxdb, density, pan, panrand)
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2, 256)
   load("JGRAN")

   dur = 60
   amp = 4

   // overall amplitude envelope
   env = maketable("line", 1000, 0,0, 1,1, 2,1, 4,0)

   // grain envelope
   genv = maketable("window", 1000, "hanning")

   // grain waveform
   gwave = maketable("wave", 10000, "sine")

   // modulation frequency multiplier
   mfreqmult = 0

   // index of modulation envelope (per grain)
   modindex = 0

   // grain frequency
   minfreq = maxfreq = 500
   //maxfreq = maketable("line", "nonorm", 1000, 0,500, 1,550)

   // grain speed
   //minspeed = maketable("line", "nonorm", 1000, 0,100, 1,10)
   minspeed = maxspeed = makeconnection("mouse", "x", 1, 200, 1, 20, "speed")

   // grain intensity (decibels above 0)
   mindb = 80
   maxdb = 80

   // grain density
   //density = maketable("line", "nonorm", 1000, 0,1, 1,1, 2,.8)
   density = makeconnection("mouse", "y", 1, 100, 1, 20, "density")

   // grain stereo location
   pan = 0.5

   // grain stereo location randomization
   panrand = 0

   JGRAN(start=0, dur, amp * env, seed=0, type=0, ranphase=1,
      genv, gwave, mfreqmult, modindex, minfreq, maxfreq, minspeed, maxspeed,
      mindb, maxdb, density, pan, panrand)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="GRANSYNTH.php">GRANSYNTH</a>,
<a href="GRANULATE.php">GRANULATE</a>,
<a href="JCHOR.php">JCHOR</a>,
<a href="SGRANR.php">SGRANR</a>,
<a href="STGRANR.php">STGRANR</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

