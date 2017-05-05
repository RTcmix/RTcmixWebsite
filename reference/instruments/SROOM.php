<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - SROOM</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>SROOM</b> -- simple stationary-source room simulation
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>SROOM</b>(outsk, insk, dur, amp, rightdist, frontdist, xloc, yloc, rvbtime, reflect, inroomwidth[, inputchan])
	<ul>
   This instrument has no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
   default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

<p>
NOTE:  This is an older RTcmix instrument, the newer
<a href="MPLACE.php">MPLACE</a>
instrument is probably better to use for room-simulation.
<br>
<br>
<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = distance from middle of room to right wall (feet)
   p5 = distance from middle of room to front wall (feet)
   p6 = x position of sound source (feet)
   p7 = y position of source (feet)
   p8 = reverb time (seconds)
   p9 = reflectivity (0 - 100; the higher, the more reflective)
   p10 = "inner room" width (feet; try 8)
   p11 = input channel number [optional; default is 0]
</pre>
<br>
<hr>
<br>


<b>SROOM</b>
uses the F. R. Moore approach to modelling room acoustics
(described in
F.R. Moore: "A General Model for Spatial Processing of Sounds."
The Computer Music Journal, Vol 7/3, pp. 6-15, 1983).
you to specify a trajectory of a source sound through the room.
NOTE:  This is an older RTcmix instrument, the newer
<a href="MPLACE.php">MPLACE</a> or
<a href="PLACE.php">PLACE</a>
instruments do a better job of room-simulation, although
they are more computationally expensive.


<a name="usage_notes"></a>
<h3>Usage Notes</h3>

<b>SROOM</b> will add reverberation and "roominess" to sounds it processes.
Delay lines are calculated from the source to the listener. 
The room model is rectangular, delay paths are based on "ideal"
reflections from the walls, the `listener' (or "inner room" in Moore's
conception) has an expandable head, and reverberation is added to the
delay lines to simulate diffusion from reflections of reflections.
(NOTE:  This is where
<a href="MPLACE.php">MPLACE</a> or
<a href="PLACE.php">PLACE</a>
may be better then <b>SROOM</b>.  The reverberation algorithm employed by
<a href="MPLACE.php">MPLACE</a>/<a href="PLACE.php">PLACE</a>
is much better than the simple Schroeder model used in <b>SROOM</b>
<p>
<b>SROOM</b> is identical to
<a href="MROOM.php">MROOM</a>
except that
<a href="MROOM.php">MROOM</a>
has the ability to process a moving sound source.
<p>
The room is set up on a
Cartesian coordinate system (x-y plane) with the center of
the listener's head ("inner room" front wall) positioned at the origin (0,0).
<p>
Parameter p4 ("rightdist") is the position along the x-axis where
the right-hand wall should appear. <b>SROOM</b> will then create
the left-hand wall at -p4, so this value represents 1/2
the room's width (in feet).  Similarly, p5 ("frontdist") is the position along
the y-axis where the front wall will be drawn.  The rear
wall will be positioned at -p5.  p5 represents 1/2
the room's height (also in feet).
<p>
The parameters p6 and p7 ("xloc" and "yloc") are the x and y coordinates
of the sound source.  "rvbtime" (p8) is the amount of time (in
seconds) it takes for the reverb comb filters to decay to
.001 of their original value.  Values greater than 1.0 - 1.5
tend to sound "metallic"; the frequency response of the
reverb combs becomes clearly audible.  p9 ("reflect")
is the percentage of sound reflected by the walls.  A p9 value
of 100 will mean that the walls will not absorb any of the
incident sound.  The only attenuation in the delay paths
will be due to the distance travelled from the source to the
listener (-6 db for each doubling of distance).  p10 ("inroomwidth")
is the width of the inner (or listening) room (or the size
of the listener's head).  The value
represents 1/2 the true width of the inner room (in feet).
p11 ("inputchan") is an optional argument to specify which channel of
the input sound to process through the room.
The default is channel 0.  Note that only one channel at a
time may be processed through <b>SROOM</b>
<p>
The older
<a href="/reference/scorefile/makegen.php">makegen</a>
control envelope sysystem can be used to place an amplitude envelope
in function slot 1
(the
<a href="/reference/scorefile/setline.php">setline</a>
scorefile command may also be used to do this).
<p>
<b>SROOM</b> produces stereo output only.

<h3>Sample Scores</h3>

basic use:
<pre>
   rtsetparams(44100, 2)
   load("SROOM")

   rtinput("mysound.snd")

   outskip = 0
   inskip = 0
   dur = DUR()
   amp = 0.8
   xdim = 20
   ydim = 20
   xsrc = 10
   ysrc = 10
   rvbtime = 1.0
   reflect = 90.0
   innerwidth = 4.0
   inchan = 0

   SROOM(outskip, inskip, dur, amp, xdim, ydim, xsrc, ysrc, rvbtime, reflect, innerwidth, inchan)

   outskip = dur+1
   amp = 0.7
   ydim = 50
   xsrc = -30
   reflect = 80.0

   SROOM(outskip, inskip, dur, amp, xdim, ydim, xsrc, ysrc, rvbtime, reflect, innerwidth, inchan)
</pre>
<br>


<hr>
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
<a href="REVERBIT.php">REVERBIT</a>,
<a href="ROOM.php">ROOM</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


