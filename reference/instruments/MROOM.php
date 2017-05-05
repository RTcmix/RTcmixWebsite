<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MROOM</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MROOM</b> -- simple moving-source room simulation
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>timeset</b>(time, xloc, yloc)
	<br> <br>
	<b>MROOM</b>(outsk, insk, dur, amp, rightdist, frontdist, rvbtime, reflect, inroomwidth[, inputchan, updaterate])
	<ul>
   This instrument has no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
	default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

<b>MROOM</b> uses a subcommand (<b>timeset</b>) to specify the sound source
trajectory.
<br>
<br>
<br>

<a name="timeset"></a>
<b>timeset</b><br>
<br>
<pre>
   p0 = timepoint (seconds)
   p1 = x location (feet, Cartesian coordinates)
   p2 = y location (feet, Cartesian coordinates)
</pre>
<br>

<a name="MROOM"></a>
<b>MROOM</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = distance from middle of room to right wall (feet; i.e., 1/2 of width)
   p5 = distance from middle of room to front wall (feet; i.e., 1/2 of depth)
   p6 = reverb time (seconds)
   p7 = reflectivity (0 - 100; the higher, the more reflective)
   p8 = "inner room" width (feet; try 8)
   p9 = input channel number [optional; default is 0]
   p10 = control rate for trajectory [optional; default is 100]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sysystem should be used:

   assumes function table 1 is the amplitude envelope
</pre>
<br>
<hr>
<br>


<b>MROOM</b>
uses the F. R. Moore approach to modelling room acoustics
(described in
F.R. Moore: "A General Model for Spatial Processing of Sounds."
The Computer Music Journal, Vol 7/3, pp. 6-15, 1983), and allows
you to specify a trajectory of a source sound through the room.
<p>
NOTE:  This is an older RTcmix instrument, the newer
<a href="MMOVE.php">MMOVE</a> or
<a href="DMOVE.php">DMOVE</a> (pfield-enabled data specification)
instruments are probably better to use, although they are more
computationally expensive.


<a name="usage_notes"></a>
<h3>Usage Notes</h3>

The trajectory of the sound source in <b>MROOM</b>
is mapped using the subcommand <b>timeset</b> repeatedly::
<ul>
<pre>
	timeset</strong>(timepoint, x-location, y-location)
</pre>
</ul>
where <i>timepoint</i> determines at what time in the total note duration
(given in seconds) that the source should be at point
(<i>x-location, y-location</i>).
These locations are in feet using Cartesian coordinates with the
'front wall' of the 'inner room' constructed along the x-axis) to be reached
by the source sound at that time.  Up to 100 of these points may be specified.
<p>
<b>timeset</b> is called repeatedly to create the trajectory for the
sound source through the room.  Be sure that the timepoints are
in ascending order!
<p>
<b>MROOM</b> then adds reverberation and
"roominess" to a sound source, calculating the
delay lines from the source located in an 'outer room' to an 'inner room'.
The room model is rectangular, delay paths are based on "ideal"
reflections from the walls, the 'listener' ('inner room') has an exandable
head, and reverberation is added to the delay lines to simulate diffusion
from reflections of reflections (NOTE:  This is where
<a href="MMOVE.php">MMOVE</a> or
<a href="DMOVE.php">DMOVE</a>
may be better then <b>MROOM</b>.  The reverberation algorithm employed by
<a href="MMOVE.php">MMOVE</a>/<a href="DMOVE.php">DMOVE</a>
is much better than the simple Schroeder model used in <b>MROOM</b>
<p>
<b>MROOM</b> is identical to
<a href="SROOM.php">SROOM</a>
except for the ability to process a moving sound source.
<p>
The delay paths are calculated from the walls of a
rectangular room to two points representing the corners of
an 'inner' or listening room.  The room is set up on a
Cartesian coordinate system (x-y plane) with the center of
the  inner room's front wall positioned at the origin (0,0).
<p>
The variable "rightdist" (p4) is the position along the x-axis where
the right-hand wall should appear. <b>MROOM</b> will then create
the left-hand wall at "-rightdist", so this value represents 1/2
the room's width (in feet).  "frontdist" (p5) is the position along
the y-axis where the front wall will be drawn.  The rear
wall will be positioned at "-frontdist".  "frontdist" represents 1/2
the rooms length (also in feet).
<p>
"rvbtime" (p6) is the amount of time (in
seconds) it takes for the reverb comb filters to decay to
.001 of their original value.  Values greater than 1.0 - 1.5
tend to sound "metallic"; the frequency response of the
reverb combs becomes clearly audible.  
<p>
The parameter p7 ("reflect")
is the percentage of sound reflected by the walls.  A p7 value
of 100 will mean that the walls will not absorb any of the
incident sound.  The only attenuation in the delay paths
will be due to the distance travelled from the source to the
listener (-6 db for each doubling of distance).
<p>
The "inroomwidth" (p8) parameter sets
width of the inner (or listening) room.  The value
represents 1/2 the true width of the inner room (in feet).
<p>
<b>MROOM</b> will calculate the doppler shift for the
source as it moves relative to the listening room and the
walls -- just like the real world!  The amount of frequency
shift from the doppler effect for sources moving directly
towards or away from a listener (or a wall) can be calculated by:
<ul>
<pre>
          F(new) = (c/(c + SV)) * F(old)
</pre>
</ul>
where c = speed of sound (1086 ft/sec); F(old) is the original
source frequency; SV = source velocity (ft/sec); and
F(new) is the resultant doppler-shifted frequency.
<p>
Very fast source velocities may generate some quantization
noise if the position of the sound source is not updated
frequently enough.  
<b>MROOM</b> has an optional argument "updaterate" (p10)
that specifies the number of times/second to update the
source position.  The default value is 100.  Values greater
than this will cause <b>MROOM</b> to execute proportionally slower.
This value is independent of the pfield-parameter control rate
set by the
<a href="/reference/scorefile/reset.php">reset</a>
scorefile command.
<p>
As an example of how this works, consider the following scorefile:
<pre>
   timeset(0, 17, 19)
   timeset(17, -10, 15)
   timeset(29, -11, -7)
   timeset(49, -20, -14)
   timeset(57, -19, -37)
   timeset(77, 14,- 5)

   MROOM(14, 0.7, 77, 1, 21, 49, .9, 50, .5)
</pre>
The call to <b>timeset</b> specify a trajectory for the sound source
through the room that looks approximately like this (each 'X' represents a
timepoint in the <b>timeset</b> specification:
<pre>

                                 |+49
                                 |
                                 |
                                 |
                                 |
                                 |
                                 |
                     _X-----<----|-<------<------<----X  <--Start Here
                    /            |
     ______________|_____________|_____________________________
     -21         __X             |                  X       +21
            ____/                |           ______/
         __/                     |      ____/
        X                        |_____/
        |                  ______/
        |          _______/      |
        |   ______/              |
        |__/                     |
        X                        |
                                 |-49
</pre>
<p>
<b>MROOM</b> requires stereo output.

<h3>Sample Scores</h3>

basic use:
<pre>
   rtsetparams(44100, 2)
   load("MROOM")

   rtinput("mysound.snd")

   outskip = 0
   inskip = 0
   dur = DUR()
   amp = 0.6
   xdim = 30
   ydim = 80
   rvbtime = 1.0
   reflect = 90.0
   innerwidth = 8.0
   inchan = 0
   quant = 2000

   timeset(0, 0-xdim, 0-ydim)
   timeset(dur/2, xdim/8, ydim/8)
   timeset(dur, xdim, ydim)
   
   makegen(1, 24, 1000, 0,0, dur/8,1, dur-.5,1, dur,0)
   
   MROOM(outskip, inskip, dur, amp, xdim, ydim, rvbtime, reflect, innerwidth, inchan, quant)
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
<a href="PLACE.php">PLACE</a>,
<a href="REV.php">REV</a>,
<a href="REVERBIT.php">REVERBIT</a>,
<a href="ROOM.php">ROOM</a>,
<a href="SROOM.php">SROOM</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

