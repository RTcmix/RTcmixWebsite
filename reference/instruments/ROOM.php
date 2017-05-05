<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - ROOM</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>ROOM</b> -- simple delay-line room model
<br>
<i>in RTcmix/insts/jg</i>

<br>
<br>
<b><i>NOTE:  This instrument does not seem to be functioning properly, 6/2012</i></b>


	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>roomset</b>(xsize, ysize, xsrc, ysrc, xleftwall, yleftwall, xrightwall, yrightwall, absorpt[, seed])
	<br> <br>
	<b>ROOM</b>(outsk, insk, dur, amp[, inputchan])
	<ul>
   This instrument has no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
	default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

<b>ROOM</b> uses a subcommand (<b>roomset</b>) to specify the modeled
room's characteristics.
<br>
<br>
<br>

<a name="roomset"></a>
<b>roomset</b>
<br>
<pre>
   p0 = x-dimension size (feet)
   p1 = y-dimension size (feet)
   p2 = x-coordinate of virtual source (0.0-1.0) [0.0: left, 1.0: right, 0.5: center]
   p3 = y-coordinate of virtual source (0.0-1.0) [0.0: left, 1.0: right, 0.5: center]
   p4 = x-coordinate where left wall branches to become the back wall (0.0-1.0)
   p5 = y-coordinate where left wall branches to become the back wall (0.0-1.0)
   p6 = x-coordinate where right wall branches to become the back wall (0.0-1.0)
   p7 = y-coordinate where right wall branches to become the back wall (0.0-1.0)
   p8 = absorption factor (0.0: highly reverberant, 2.0: "normal" room, 3.0: "quiet" room)
   p9 = random seed value [optional; default is 0.3]
</pre>
<br>

<a name="ROOM"></a>
<b>ROOM</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = input channel [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sysystem should be used:

   assumes function table 1 is the amplitude envelope
</pre>
<br>
<hr>
<br>


<b>ROOM</b> is based on a very early room-simulation model by Paul Lansky.
Basically, it constructs a set of 13 delay lines based on the distance
to a virtually-constructed room.
<p>
NOTE:  This is an older RTcmix instrument (almost three decades!).
Many of the room-simulation programs listed below in
the
<a href="#see_also">See Also</a>
section are much more sophisticated.

<h3>Usage Notes</h3>

The room is created using the <b>roomset</b> command, and the
input sound is then processed by the <b>ROOM</b> instrument.
<p>
<b>roomset</b> builds a two-dimensional model of a room and with thirteen
delay lines from the source to the listener.  This
virtual model of a room is created  by computing the
delay, the speaker (source) location based on the angle from
the reflection point, and a decay factor based on the
absorption factor and the delay due to distance
(1/distance^absorption) for each reflection.
<p>
To visualize the room created by this command, imagine a two-dimensional
space with [0,0] (the origin) at the lower left-hand corner.
In the <b>roomset</b> arguments, p0 ("xsize") and p1 ("ysize")
are the x and y dimensions of the space in feet.
<p>
The "xsrc" and "ysrc" parameters (p2 and p3)
specify the position of the sound source in
terms of a fraction of the x and y dimensions.  The
arguments .5, .5 for xsrc and ysrc will position a sound source
in the middle of the <b>roomset</b> space
while .9, .1 will position it at the right front.
<p>  
"xleftwall" (p4) and "yleftwall" (p5) specify the point at which the left
wall becomes the back wall in terms of a fraction of the
left side of the room only. p4 is thus a fraction of
the x dimension/2.  The arguments .1, .9 for p4 and p5
will form almost a square corner for the left side
of the room, while .5, .5 will make the left side a straight
line from (0,0) to (x-dimension/2,y-dimension).  This will
create a triangular room if it is repeated for the
"xrightwall" and "yrightwall" (p6 and p7)
parameters.  p6 and p7 are specified as if the
room were "folded over" -- if the arguments are identical to
the left wall arguments the room will be symmetrical.  The
basic shape of the room is probably best thought of as triangular.
The sides of the triangle can then be pulled back
from their midpoints to approach a rectangle.
<p>
The absorption factor (p8, "absorpt") specifies how much the signal
will have decayed by the time it reaches the listener (positioned at
(x-dimension/2,0).  An absorption factor of 2 will
approximate an average room while 3 will be rather dry, .5
will be highly reverberant and 0 will create the effect of
no absorption at all.  A negative absorption factor will
actually cause the sound to get louder as a function of increased distance.
<p>
The thirteen reflection points along the walls are chosen
randomly.  The random number generator may be reseeded with
the optional tenth argument, "seed" (p9).
<p>
<b>ROOM</b> requires stereo output.

<h3>Sample Scores</h3>

basic use:
<pre>
   rtsetparams(44100, 2)
   load("ROOM")

   rtinput("mysound.snd")

   x = 300
   y = 200
   xsrc = .9
   ysrc = .1
   xlwall = .1
   ylwall = .9
   xrwall = .1
   yrwall = .9
   absorb = 2
   seed = .1730

   roomset(x, y, xsrc, ysrc, xlwall, ylwall, xrwall, yrwall, absorb, seed)

   outskip = 0
   inskip = 0
   dur = DUR()
   amp = 3.0
   inchan = 0

   makegen(1, 24, 1000, 0,0, 1,1, 9,1, 10,0)
   ROOM(outskip, inskip, dur, amp, inchan)
</pre>
<br>


<hr>
<br>
<a name="see_also"</a>
<h3>See Also</h3>

<a href="DMOVE.php">DMOVE</a>,
<a href="FREEVERB.php">FREEVERB</a>,
<a href="GVERB.php">GVERB</a>,
<a href="MMOVE.php">MMOVE</a>,
<a href="MOVE.php">MOVE</a>,
<a href="MPLACE.php">MPLACE</a>,
<a href="MROOM.php">MOOM</a>,
<a href="PLACE.php">PLACE</a>,
<a href="REV.php">REV</a>,
<a href="REVERBIT.php">REVERBIT</a>,
<a href="SROOM.php">SROOM</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

