<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - DMOVE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>DMOVE</b> -- PField-enabled moving source room-simulation
<br>
<i>in RTcmix/insts/std/MMOVE</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>DMOVE</b>(outsk, insk, dur, AMP, DIST-XPOS, ANGLE-YPOS, (-)dist_mikes[, inchan]);
   <br><br>
   <b>RVB</b>(outsk, insk, dur, AMP)
   <br><br>
   <b>space</b>(front, right, -back, -left, ceiling, absorb, rvbtime)
   <br><br>
   <b>threshold</b>(update_rate)
   <br><br>
   <b>mikes</b>(mike_angle, pattern)
   <br><br>
   <b>mikes_off</b>()
   <br><br>
   <b>set_attenuation_params</b>(min_dist, max_dist, dist_exponent)
   <br><br>
   <b>matrix</b>(amp, matrixval1, matrixval2, ... matrixval144)
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<b>DMOVE</b> employs several subcommands to set the room-simulation
characteristics and one sub-instrument (<b>RVB</b>) to operate.
<p>
NOTE:  Although the older path-trajectory subcommands
may be used in this instrument
(<b>path</b>, <b>cpath</b>, <b>param</b>, <b>cparam</b>,
see the
<a href="MMOVE.php">MMOVE</a>
documentation for a description of these), it is intended for this information
to be specified in the "DIST-XPOS" and "ANGLE-YPOS" pfield parameters.
<br>
<br>
<br>

<a name="DMOVE"></a>
<b>DMOVE</b>
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
   p7 = input channel [optional, default is 0]

   p3 (amplitude) can receive dynamic updates from a table or real-time control source.
</pre>
<br>

<a name="RVB"></a>
<b>RVB</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (or endtime if negative) (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)

   p3 (amplitude) can receive dynamic updates from a table or real-time control source.

   NOTE: this associated instrument is required for MPLACE to function
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

   NOTE: this subcommand is required for MPLACE to function
</pre>
<br>

<a name="threshold"></a><b>threshold</b><br>
<pre>
   p0 = time interval (seconds) for trajectory updates

   NOTE: this subcommand is optional for MMOVE to function (the default is
      the size of the buffers set in <a href="/reference/scorefile/rtsetparams.php">rtsetparams</a>)
</pre>
<br>

<a name="mikes"></a>
<b>mikes</b><br>
<pre>
   p0 = microphone angle (degrees, 0 degrees is straight in front)
   p1 = microphone pattern (0-1; 0 == omnidirectional, 1 == highly directional)

   NOTE: this subcommand is optional for MPLACE to function (the default is "mikes_off")
</pre>
<br>

<a name="mikes_off"></a>
<b>mikes_off</b><br>
<pre>
   no pfields, this defeats the microphone angle and pattern settings for binaural simulation

   NOTE: this subcommand is optional for MPLACE to function
</pre>
<br>

<a name="set_attenuation_params"></a>
<b>set_attenuation_params</b><br>
<pre>
   p0 = minimum distance (feet)
   p1 = maximum distance (feet)
   p2 = distance attentuation exponent

   NOTE: this subcommand is optional for MPLACE to function
</pre>
<br>

<a name="matrix"></a>
<b>matrix</b><br>
<pre>
   p0 = total matrix gain (relative multiplier of input signal)
   p1-p145 = 12 x 12 matrix amp/feedback coefficients [optional; defaults to internal matrix]

   NOTE: this subcommand is optional for MPLACE to function
</pre>
<br>
<hr>
<br>


<b>DMOVE</b> is a
<a href="pfield-enabled.php">pfield-enabled</a>
version of the
<a href="MMOVE.php">MMOVE</a>
room-simulation program, allowing the sound source trajectory to be
controlled using
<a href="/reference/scorefile/maketable.php">maketable</a>
tables or dynamically via the
<a href="/reference/scorefile/makeconnection.php">makeconnection</a>
scorefile command. It uses the same methodology as the
<a href="MPLACE.php">MPLACE</a>
instrument to model the acoustics of a room.

<h3>Usage Notes</h3>

Most of the subcommands for <b>DMOVE</b> are identical to the
equivalent subcommands in
<a href="MPLACE.php">MPLACE</a>.
See the
<a href="MPLACE.php#usage_notes">MPLACE Usage Notes</a>
for more information.
<p>
The only semi-tricky thing to know about <b>DMOVE</b> is that the
interpretation of the pfield data coming through p4 and p5
("DIST-XPOS", "ANGLE-YPOS") depends on whether or not p6 ("dist_mikes")
is positive or negative.  The distance to the mikes (p6) will
be interpreted as a positive number in any case, but if it is negative
it will cause p4 and p5 to be interpreted as cartesian coordinates
on a coordinate plane where the center of the listener is located
at [0, 0].  The default interpretation is to use polar coordinates
for the sound source information (distance to sound, angle to sound).
<p>
When using
<a href="/reference/scorefile/maketable.php">maketable</a>
and other pfield-control parameters be aware that the "nonorm"
optional parameter should probably be set, otherwise the data coming through
the pfield will be normalized between 0.0 and 1.0 (or -1.0 and 1.0).
<p>
The <b>RVB</b> subinstrument needs to be configured with
the appropriate
<a href="/reference/scorefile/bus_config.php">bus_config</a>
setup.  <b>MPLACE/RVB</b> requires stereo output.

<h3>Sample Scores</h3>

basic use:
<pre>
   rtsetparams(44100, 2, 256)
   load("DMOVE")
   
   bus_config("DMOVE", "in 0", "aux 0-1 out")
   bus_config("RVB", "aux 0-1 in", "out 0-1")

   rtinput("mysoundfile.aif")
   
   mikes(45, 0.5)
   
   dist_front = 100
   dist_right = 100
   dist_rear = -100
   dist_left = -100
   height = 100
   rvbtime = 3
   abs_fac = 1
   space(dist_front, dist_right, dist_rear, dist_left, height, abs_fac, rvbtime)
   
   
   insk = 0
   outsk = 0
   amp = 1
   
   dur = 60
   dist_mikes = 2
   inchan = 0
   
   xpos = makeconnection("mouse", "x", min=dist_left, max=dist_right, dflt=10, lag=90,
      "x pos", "feet", 2)
   
   ypos = makeconnection("mouse", "y", min=dist_rear, max=dist_front, dflt=10, lag=90, 
      "y pos", "feet", 2)
   
   mindist = 10
   maxdist = 100
   
   set_attenuation_params(mindist, maxdist, 1.0)
   threshold(0.0005)
   
   DMOVE(outsk, insk, dur, amp, xpos, ypos, -dist_mikes, inchan)
   
   RVB(0, 0, dur+rvbtime+0.5, 0.1)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="FREEVERB.php">FREEVERB</a>,
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
