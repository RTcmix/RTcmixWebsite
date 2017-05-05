<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MSHAKERS</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MSHAKERS</b> -- 'shaker' PhISEM and PhOLIES physical model
<br>
<i>in RTcmix/insts/stk</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MSHAKERS</b>(outsk, dur, AMP, ENERGY, DECAY, NOBJS, RESONANCE, instrument[, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = energy (0.0-1.0)
   p4 = decay (0.0-1.0)
   p5 = # of objects (0.0-1.0)
   p6 = resonance freq (0.0-1.0)
   p7 = instrument selection (0-22 -- see the <a href="#usage_notes">Usage Notes</a> below)
   p8 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]

   p2 (amplitude), p3 (energy), p4 (decay), p5 (# of objects), p6 (resonance frequency)
   and p8 (pan)  can receive dynamic updates from a table or real-time control source.

   Author:  Brad Garton, based on code from the <a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit</a>
</pre>
<br>
<hr>
<br>


<b>MSHAKERS</b> is the "Shakers" PhISEM and PhOLIES physical model
in Perry Cook and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">STK</a>,
the Synthesis ToolKit.


<a name="usage_notes"></a>
<h3>Usage Notes</h3>

<b>MSHAKERS</b>
realizes the sound of many 'shaken' instruments (maracas, sleigh bells,
change rattling in coffee mugs, etc.) using a "stochastic modelling"
approach that Perry Cook developed.  There are a large number of
diverse sounds available through this one instrument -- try 'em all!
<p>
Here's what Perry says about "Shakers":
<ul>
    PhISEM (Physically Informed Stochastic Event
    Modeling) is an algorithmic approach for
    simulating collisions of multiple independent
    sound producing objects.  This class is a
    meta-model that can simulate a Maraca, Sekere,
    Cabasa, Bamboo Wind Chimes, Water Drops,
    Tambourine, Sleighbells, and a Guiro.
<p>
    PhOLIES (Physically-Oriented Library of
    Imitated Environmental Sounds) is a similar
    approach for the synthesis of environmental
    sounds.  This class implements simulations of
    breaking sticks, crunchy snow (or not), a
    wrench, sandpaper, and more.
</ul>
The instrument number values for p7 ("instrument") are:
<ul>
<pre>
- Maraca = 0
- Cabasa = 1
- Sekere = 2
- Guiro = 3
- Water Drops = 4
- Bamboo Chimes = 5
- Tambourine = 6
- Sleigh Bells = 7
- Sticks = 8
- Crunch = 9
- Wrench = 10
- Sand Paper = 11
- Coke Can = 12
- Next Mug = 13
- Penny + Mug = 14
- Nickle + Mug = 15
- Dime + Mug = 16
- Quarter + Mug = 17
- Franc + Mug = 18
- Peso + Mug = 19
- Big Rocks = 20
- Little Rocks = 21
- Tuned Bamboo Chimes = 22
</pre>
</ul>
Increasing parameter p3 ("ENERGY") will tend to keep the instrument
going.  Parameter p4 ("DECAY" interacts with the natural decay of the shaker.
If p4 &gt; 1.0 the instrument will go for a loooong time (be careful!).
<p>
<b>MSHAKERS</b> can produce other mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("MSHAKERS")

   st = 0
   inst = 0
   for (j = 0; j < 23; j = j+1)
   {
      for (i = 0; i < 7; i = i+1)
      {
         MSHAKERS(st, 0.5, 20000, 0.9, 0.8, 0.5, 0.7, inst)
         st = st + 0.2
      }
      inst = inst + 1
   }
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("MSHAKERS")

   st = 0
   numobjs = 0
   for (i = 0; i < 20; i = i+1)
   {
      MSHAKERS(st, 0.5, 30000, 0.8, 0.8, numobjs, 0.1, 0)
      numobjs = numobjs + 0.05
      st = st + 0.2
   }

   st = st + 0.5
   energy = 0
   for (i = 0; i < 20; i = i+1)
   {
      MSHAKERS(st, 0.5, 30000, energy, 0.8, 0.5, 0.1, 0)
      energy = energy + 0.05
      st = st + 0.2
   }

   st = st + 0.5
   decay = 0
   for (i = 0; i < 20; i = i+1)
   {
      MSHAKERS(st, 0.5, 30000, 0.8, decay, 0.5, 0.1, 0)
      decay = decay + 0.05
      st = st + 0.2
   }

   st = st + 0.5
   resofreq = 0
   for (i = 0; i < 20; i = i+1)
   {
      MSHAKERS(st, 0.5, 30000, 0.8, 0.8, 0.5, resofreq, 0)
      resofreq = resofreq + 0.05
      st = st + 0.2
   }
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2)
   load("MSHAKERS")

   MSHAKERS(0, 3.5, 4*20000, 0.9, 1.05, 0.5, 0.7, 1)

   amp = maketable("line", 1000, 0,0, 1,1, 2,1, 2.1,0)
   MSHAKERS(4, 3.5, amp*5*20000, 0.9, 1.05, 0.5, 0.7, 3)

   energy = maketable("line", "nonorm", 1000, 0,0, 1,0.2, 2,0)
   resonance = makeLFO("tri", 3.5, 0.3, 0.4)
   MSHAKERS(8, 3.5, 5000, energy, 0.1, 0.5, resonance, 14)

   decay = maketable("line", "nonorm", 1000, 0,1, 1,1.1, 2,0)
   pan = maketable("line", 1000, 0,1, 1,0.3, 2,0.7, 3,0, 4,1, 5,0)
   MSHAKERS(12, 3.5, 3*20000, 0.9, decay, 0.5, 0.7, 19, pan)

   nobjs = maketable("line", 1000, 0,1, 1,0, 3,1)
   energy = maketable("line", "nonorm", 1000, 0,0.1, 1,0.2, 2,0)
   MSHAKERS(15, 5.5, 5000, energy, 0.1, nobjs, 0.7, 5)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="AMINST.php">AMINST</a>,
<a href="FMINST.php">FMINST</a>,
<a href="MBANDEDWG.php">MBANDEDWG</a>,
<a href="MMESH2D.php">MMESH2D</a>,
<a href="MMODALBAR.php">MMODALBAR</a>,
<a href="STRUM.php">STRUM</a>,
<a href="STRUM2.php">STRUM2</a>,
<a href="STRUMFB.php">STRUMFB</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>




