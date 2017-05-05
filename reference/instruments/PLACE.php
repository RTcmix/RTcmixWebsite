<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - PLACE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>PLACE</b> -- stationary source room-simulation
<br>
<i>in RTcmix/insts/std/MOVE</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>PLACE</b>(outskip, inskip, dur, AMP, dist-xpos, angle-ypos, (-)dist_between_mikes, reverb_amp[, input_channel)
	<br> <br>
	<b>space</b>(dist_to_front, dist_to_right, -dist_to_back, -dist_to_left, height, abs_fact, rvbtime)
	<br> <br>
	<b>mikes</b>(mike_angle, pattern_factor)
	<br> <br>
	<b>mikes_off</b>()
   <br><br>
   <b>matrix</b>(amp, matrixval1, matrixval2, ... matrixval144)
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<b>PLACE</b> employs several subcommands to set the room-simulation
characteristics.
<p>
NOTE:  This is an older RTcmix instrument, the newer
<a href="MPLACE.php">MPLACE</a>
instrument is probably better to use.
<br>
<br>
<br>

<a name="PLACE"></a>
<b>PLACE</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (or endtime if negative) (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = distance (feet) to sound source, or x-coordinate (feet) of sound source
   p5 = angle to sound source (degrees; 0 degrees is straight in front),
      or y-coordinate (feet) of sound source
   p6 = distance between 'mics' (stereo receivers) in the room (feet)
      NOTE: if p6 is negative, p4/p5 will be interpreted as x- and y- coordinates,
      otherwise p4/p5 will set polar coordinates for the sound source location
   p7 = amplitude of reverberation (relative multiplier of input signal)
   p8 = input channel [optional, default is 0]

   p3 (amplitude) can receive dynamic updates from a table or real-time control source.
</pre>
<br>

<a name="space"></a>
<b>space</b>
<br>
<pre>
   p0 = distance to front wall of room (feet)
   p1 = distance to right-hand wall of room (feet)
   p2 = distance to back wall of room (feet) [< 0.0]
   p3 = distance to left-hand wall of room (feet) [< 0.0]
   p4 = distance to ceiling of room (feet)
   p5 = wall absorption factor (0-10; 0 == more 'dead', 10 == more 'live')
   p6 = reverberation time (seconds)

   NOTE: this subcommand is required for PLACE to function
</pre>
<br>

<a name="mikes"></a>
<b>mikes</b><br>
<pre>
   p0 = microphone angle (degrees, 0 degrees is straight in front)
   p1 = microphone pattern (0-1; 0 == omnidirectional, 1 == highly directional)

   NOTE: this subcommand is optional for PLACE to function (the default is "mikes_off")
</pre>
<br>

<a name="mikes_off"></a>
<b>mikes_off</b><br>
<pre>
   no pfields, this defeats the microphone angle and pattern settings for binaural simulation

   NOTE: this subcommand is optional for PLACE to function
</pre>
<br>

<a name="matrix"></a>
<b>matrix</b><br>
<pre>
   p0 = total matrix gain (relative multiplier of input signal)
   p1-p145 = 12 x 12 matrix amp/feedback coefficients [optional; defaults to internal matrix]

   NOTE: this subcommand is optional for PLACE to function
</pre>
<br>
<hr>
<br>


<b>PLACE</b> is Doug Scott's room simulation RTcmix instrument. It places
a sound in a room of your design and simulates the acoustic resonances of
the room.  Early reflections are computed
using a ray-tracing approach based in the distances between the
source, the listening 'microphones' and the walls.  The generalized
room reverberation is simulated using a 12 x 12 matrix of delay
elements with feedback and filtering designed to imitate the global
reverberation response of the specified room.
<p>
NOTE: This is an older RTcmix instrument, the newer
<a href="MPLACE.php">MPLACE</a>
instrument is probably better to use.


<a name="usage_notes"></a>
<h3>Usage Notes</h3>

The room design for <b>PLACE</b> depends on parameters specified in the <b>setup</b>
subcommand.  The parameters work by assuming that the listener (YOU) is placed
at point [0,0] in a coordinate space.  The locations of the four walls are
specified in this x,y coordinate system ("front", "right", "-back", "-left"):
<pre>
                                  y
                                  |
                             -x---0---x
                                  |
                                 -y
</pre>
Therefore the distance to the back and left walls must be specified as
negative. All, including height, are in feet. "absorb" is a number between 0
(minimum) and 10 (maximum) that determines how reflective the walls are.
"rvbtime" is the approximate length of reverb in seconds (the
actual length depends on the size of the room).
<p>
<b>PLACE</b> sets the location of the source sound by specifying
the distance to the sound ("dist-xpos") and the angle ("angle_ypos")
 of the sound:
<pre>

                                  0.0    source
                                   |    /
                                   |   /
                                   |  /
                                   | /
                                   |/
                                  you
</pre>
using feet and degrees, respectively (see below for an alternative
method of specifying the source location).  Be sure to stay inside bounds
of the room (it may take a bit of trigonometry [or guessing] to do that)
The "AMP" pfield is a multipler of the input audio prior to any processing
by <b>PLACE</b>.  The "dist_mikes" parameter sets how far apart the two
'listening' points are from the [0,0] center of the coordinate room (you
can choose to think of this is how big the listener's head is...).
<p>
When specifying the parameters for <b>PLACE</b>, be aware that
the interpretation of the p4 and p5 pfields
("dist-xpos", "angle-ypos") depends on whether or not p6 ("dist_mikes")
is positive or negative.  The distance to the mikes (p6) will be interpreted
as a positive number in any case, but if it is entered as negative
it will cause p4 and p5 to be interpreted as cartesian coordinates
on a coordinate plane where the center of the listener is located
at [0, 0].  The default interpretation is to use polar coordinates
for the sound source information (distance to sound, angle to sound).
<p>
p7 ("reverb_amp") can be used to adjust the amount of reverberant
sound coming from the matrix reverberator relative to the direct
sound and the early wall reflections.
<p>
The optional subcommands that may be used to
set the parameters for <b>PLACE</b> include <b>mikes</b> and
<b>mikes_off</b>.  <b>mikes</b> is a setup call for times when you wish
to simulate microphone recording (most of the time, actually). The arguments
are "mike_angle", which is the angle <i>each</i> microphone makes with a
line drawn between them (i.e., 45 puts them at a 90 degree angle FROM EACH
OTHER).  "pattern" is a value between 0 and one; 0 produces an omnidirectional
mike, 1 produces a hypercardioid pattern, 0.5 produces the familiar cardioid
pattern.  The default pattern will be omnidirectional.
<p>
<b>mikes_off</b> is used following a previous call to <b>mikes</b> in order
to cancel mike mode in the event that you wish to use binaural mode,
or default to omnidirectional.
<p>
<b>matrix</b> is used to replace the default set of amplitude/feedback
coefficients for the <b>RVB</b> matrix -- all 144 of them.  This is tricky
to use.
<p>
<b>PLACE</b> requires stereo output.

<h3>Sample Scores</h3>

basic use:
<pre>
   rtsetparams(44100,  2)
   load("PLACE")
   
   rtinput("mysound.aif")
   
   space(400, 400, -400, -400, 400, 8., 10.)
   
   PLACE(0, 0, 14.3, 20, 10, 20, -1, 1.)
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
<a href="REV.php">REV</a>,
<a href="REVERBIT.php">REVERBIT</a>,
<a href="ROOM.php">ROOM</a>,
<a href="SROOM.php">SROOM</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
