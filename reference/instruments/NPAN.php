<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - NPAN</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>NPAN</b> -- multichannel pair-wise intensity panner
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>NPANspeakers</b>(mode, speak1_a, speak1_b ... speakN_a, speakN_b)
	<br> <br>
	<b>NPAN</b>(outsk, insk, dur, AMP, mode, ANGLE/XLOC, DISTANCE/YLOC[, inputchan])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>


<b>NPAN</b> consists of two sub-instruments, one to set up the
'speaker' placements (<b>NPANspeakers</b>) and one to process the sound
source through the modeled placements (<b>NPAN</b>).
<br>
<br>
<br>

<a name="NPANspeakers"></a>
<b>NPANspeakers</b>
<br>
<pre>
   p0 = mode ("polar" or "xy" (or "cartesian"))
   p1, p2, ... pN-1, pN
      starting with p1, the next N pfields are pairs specifying the locations
      of the virtual speakers, using angle/distance coordinates (for "polar"
      mode) or x-location/y-location (for "xy" or "cartesian" mode).  Distances
      are assumed to be in feet.  Up to 16 speakers may be set.
</pre>
<br>

<a name="NPAN"></a>
<b>NPAN</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = global amplitude multiplier (relative multiplier of input signal)
   p4 = mode: "polar" or "xy" (or "cartesian")
   If mode is "polar",
      p5 = angle (in degrees), relative to listener
      p6 = distance from listener (feet)
   If mode is "cartesian",
      p5 = x coordinate (feet)
      p6 = x coordinate (feet)
   p7 = input channel [optional, default is 0]

   p3 (amplitude), p5 (x-coordinate/angle) and p6 (y-coordinate/radius) can
   receive dynamic updates from a table or real-time control source.

   Author:  John Gibson, 11/13/04
   based on the description in F. R. Moore, "Elements of Computer Music," pp. 353-9
</pre>
<br>
<hr>
<br>

<b>NPAN</b> is very useful for multi-speaker 'spatialization' applications.

<h3>Usage Notes</h3>


To use <b>NPAN</b>, first call <b>NPANspeakers</b>
to configure the number of speakers and their locations.
<p>
In <b>NPANspeakers</b>,
If you choose "polar" mode for p0 ("mode"), the listener is situated
in the center of the coordinate space, at [0,0].  Angles
are measured in degrees, with 0 degrees directly in front of the listener,
90 degrees to their left and -90 degrees to their right.
<p>
"cartesian" or "xy" mode for p0 will set up a Cartesian coordinate
plane with the listener again at [0,0].  Speaker locations are given
in terms of their x-coordinates and y-coordinates.  Distance in both
"polar" mode and "xy" mode are in feet.
<p>
The order of speakers in the argument list for
<b>NPANspeakers</b> is significant: the order
corresponds to the order of output channels.  So if you want the front
left speaker in the first output channel, list it first.
<p>
Then using <b>NPAN</b>, parameters p5 ("ANGLE/XLOC,")
 and p6 ("DISTANCE/YLOC")
give the position of the virtual sound source, relative
to the listener, using the coordinate space described above.
As with the speaker setup, the interpretation of p5 and p6 depends on the
"mode" parameter (p4).
<p>
This is pair-wise panning, so no more than two adjacent speakers have
signal at any time.  It is not possible to place a virtual source between
two speakers that are not adjacent.
<p>
Distance from the listener affects gain (the closer, the higher the gain).
Very short distances can cause clipping.  If in doubt, use the polar mode,
set both speaker distances and virtual source distance to 1.
<p>
A multichannel interface card is needed for this command, note the
<a href="/reference/scorefile/rtsetparams.php">rtsetparams</a>
commands in the sample scores all specify multiple channel outputs.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 4)
   load("WAVETABLE")
   load("NPAN")

   bus_config("WAVETABLE", "aux 0 out")
   bus_config("NPAN", "aux 0 in", "out 0-3")

   dur = 10
   amp = 10000
   freq = 440

   env = maketable("line", 1000, 0,0, 1,1, 19,1, 20,0)
   WAVETABLE(0, dur, amp*env, freq, 0)

   NPANspeakers("polar",
       45, 1,     // left front
      -45, 1,     // right front
       135, 1,    // left rear
      -135, 1)    // right rear

   dist = 1

   // 3 counter-clockwise trips around circle
   trips = 3
   angle = maketable("linebrk", "nonorm", 1000, 45, 1000, 405 * trips)

   NPAN(0, 0, dur, 1, "polar", angle, dist)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 8)
   load("NPAN")

   rtinput("mysound.snd")

   // 8 speakers arranged in circle, with speakers directly in front of (0 deg)
   // and behind (180 deg) listener.

   NPANspeakers("polar",
       45, 1,   // front left
      -45, 1,   // front right
       90, 1,   // side left
      -90, 1,   // side right
      135, 1,   // rear left
     -135, 1,   // rear right rear
        0, 1,   // front center
      180, 1)   // rear center

   inskip = 0
   amp = 1.0
   dur = DUR()
   start = 0

   // move counter-clockwise around circle
   angle = maketable("line", "nonorm", 1000, 0,0, 1,360)

   dist = maketable("line", "nonorm", 1000, 0,.5, 1,4, 6,.4)

   NPAN(start, inskip, dur, amp, "polar", angle, dist)
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 8, 512)
   load("WAVETABLE")
   load("NPAN")

   bus_config("WAVETABLE", "aux 0 out")
   bus_config("NPAN", "aux 0 in", "out 0-7")

   // 8 speakers arranged in a rectangle, as follows...
   //
   //    1  7  2
   //    3  x  4        x = listener
   //    5  8  6

   sin45 = 0.70710678

   NPANspeakers("xy",
      -1,     1,     // front left (1)
       1,     1,     // front right (2)
      -sin45, 0,     // side left (3)
       sin45, 0,     // side right (4)
      -1,    -1,     // rear left (5)
       1,    -1,     // rear right rear (6)
       0, sin45,     // front center (7)
       0, -sin45)    // rear center (8)

   dur = 60
   amp = 10000
   freq = 440

   env = maketable("line", 1000, 0,0, 1,1, 49,1, 50,0)
   WAVETABLE(0, dur, amp*env, freq, 0)

   // pan using the mouse
   lag = 70
   x = makeconnection("mouse", "X", -1, 1, 0, lag, "X")
   y = makeconnection("mouse", "Y", -1, 1, 1, lag, "Y")

   NPAN(0, 0, dur, 1, "xy", x, y)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeconnection.php">makeconnection</a>,
<a href="DMOVE.php">DMOVE</a>,
<a href="MIX.php">MIX</a>,
<a href="MMOVE.php">MMOVE</a>,
<a href="MOVE.php">MOVE</a>,
<a href="MPLACE.php">MPLACE</a>,
<a href="MROOM.php">MROOM</a>,
<a href="PAN.php">PAN</a>,
<a href="PLACE.php">PLACE</a>,
<a href="QPAN.php">QPAN</a>,
<a href="ROOM.php">ROOM</a>,
<a href="SROOM.php">SROOM</a>
<a href="STEREO.php">STEREO</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
