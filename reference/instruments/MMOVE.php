<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MMOVE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MMOVE</b> -- moving source room-simulation
<br>
<i>in RTcmix/insts/std/MMOVE</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MMOVE</b>(outskip, inskip, dur, AMP, dist_between_mikes[, inputchan])
   <br><br>
   <b>RVB</b>(outsk, insk, dur, AMP)
   <br><br>
   <b>space</b>(front, right, -back, -left, ceiling, absorb, rvbtime)
   <br><br>
   <b>path</b>(time0, sound_dist0, sound_angle0, ... timeN, sound_distN, sound_angleN)
   <br><br>
   <b>cpath</b>(time0, sound_x-coord0, sound_y-coord0, ... timeN, sound_x-coordN, sound_y-coordN)
   <br><br>
   <b>param</b>(function1, function2)
   <br><br>
   <b>cparam</b>(function1, function2)
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

<b>MMOVE</b> employs several subcommands to set the room-simulation
characteristics, the sound-source trajectory and one sub-instrument
(<b>RVB</b>) to operate.
<p>
NOTE:  This is an older RTcmix instrument, the newer
<a href="DMOVE.php">DMOVE</a>
instrument allows the sound trajectory to be controlled using
<a href="pfield-enabled.php">pfield-enabled</a>
parameters.
<br>
<br>
<br>

<a name="MMOVE"></a>
<b>MMOVE</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (or endtime if negative) (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = distance between 'mics' (stereo receivers) in the room (feet)
   p5 = input channel [optional, default is 0]

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

   NOTE: this associated instrument is required for MMOVE to function
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

   NOTE: this subcommand is required for MMOVE to function
</pre>
<br>

<a name="path"></a>
<b>path</b>
<br>
<pre>
   The pfields for <b>path</b> are triples, the first being the relative time
   during processing to reach this point, and the other two of each triple being
   polar coordinates of the sound source location (distance to sound [feet]
   and angle to sound [degrees]).  Up to 100 triples may be specified.

   NOTE: one of the subcommands (<b>path</b>, <b>cpath</b>, <b>param</b>, <b>cparam</b>) is required for MMOVE to function
</pre>
<br>

<a name="cpath"></a>
<b>cpath</b>
<br>
<pre>
   The pfields for <b>cpath</b> are triples, the first being the relative time
   during processing to reach this point, and the other two of each triple being
   the x- and y- cartesian coordinates of the sound source location (feet,
   with [0,0] being the center position of the listener).  Up to 100 triples
   may be specified.

   NOTE: one of the subcommands (<b>path</b>, <b>cpath</b>, <b>param</b>, <b>cparam</b>) is required for MMOVE to function
</pre>
<br>

<a name="param"></a>
<b>param</b>
<br>
<pre>
   p0 = function table reference for polar coordinate distance to sound source (feet) values
   p1 = function table reference for polar coordinate angle to sound source (degrees) values

   The two function tables are loaded with values representing the polar
   coordinates of the sound source location (p0 table == distance to sound [feet]
   and p1 table == angle to sound [degrees]).  These values will be spread
   over the duration of the note

   Because this instrument has not been updated for pfield control, the older
   <a href="/reference/scorefile/makegen.php">makegen</a> function table system should be used to create the tables.

   NOTE: one of the subcommands (<b>path</b>, <b>cpath</b>, <b>param</b>, <b>cparam</b>) is required for MMOVE to function
</pre>
<br>

<a name="cparam"></a>
<b>cparam</b>
<br>
<pre>
   p0 = function table reference for x-coordinate location of sound source (feet)
   p1 = function table reference for y-coordinate location of sound source (feet)

   The two function tables are loaded with values representing the x-coordinate
   location of the sound source (feet) and the y-coordinate location of the
   sound source (feet).  The listener is assumed to be centered at coordinate [0,0].
   These values will be spread over the duration of the note

   Because this instrument has not been updated for pfield control, the older
   <a href="/reference/scorefile/makegen.php">makegen</a> function table system should be used to create the tables.

   NOTE: one of the subcommands (<b>path</b>, <b>cpath</b>, <b>param</b>, <b>cparam</b>) is required for MMOVE to function
</pre>
<br>

<a name="threshold"></a>
<b>threshold</b><br>
<pre>
   p0 = time interval (seconds) for trajectory updates (typically < 0.01)

   NOTE: this subcommand is optional for MMOVE to function (the default is
      the size of the buffers set in <a href="/reference/scorefile/rtsetparams.php">rtsetparams</a>)
</pre>
<br>

<a name="mikes"></a>
<b>mikes</b><br>
<pre>
   p0 = microphone angle (degrees, 0 degrees is straight in front)
   p1 = microphone pattern (0-1; 0 == omnidirectional, 1 == highly directional)

   NOTE: this subcommand is optional for MMOVE to function (the default is "mikes_off")
</pre>
<br>

<a name="mikes_off"></a>
<b>mikes_off</b><br>
<pre>
   no pfields, this defeats the microphone angle and pattern settings for binaural simulation

   NOTE: this subcommand is optional for MMOVE to function
</pre>
<br>

<a name="set_attenuation_params"></a>
<b>set_attenuation_params</b><br>
<pre>
   p0 = minimum distance (feet)
   p1 = maximum distance (feet)
   p2 = distance attentuation exponent

   NOTE: this subcommand is optional for MMOVE to function
</pre>
<br>

<a name="matrix"></a>
<b>matrix</b><br>
<pre>
   p0 = total matrix gain (relative multiplier of input signal)
   p1-p145 = 12 x 12 matrix amp/feedback coefficients [optional; defaults to internal matrix]

   NOTE: this subcommand is optional for MMOVE to function
</pre>
<br>
<hr>
<br>


<b>MMOVE</b> is an updated version of the original
<a href="MOVE.php">MOVE</a> room-simulation program.  It
uses the same methodology as the
<a href="MPLACE.php">MPLACE</a>
instrument to model the acoustics of a room.  The difference is that
<b>MMOVE</b> allows you to specify a trajectory for the sound source
instead of a single, fixed location for the duration of processing.
<p>
NOTE:  This is an older RTcmix instrument, the newer
<a href="DMOVE.php">DMOVE</a>
instrument allows the sound trajectory to be controlled using
<a href="pfield-enabled.php">pfield-enabled</a>
parameters.


<a name="usage_notes"></a>
<h3>Usage Notes</h3>

Most of the subcommands for <b>MMOVE</b> are identical to the
equivalent subcommands in
<a href="MPLACE.php">MPLACE</a>.
See the
<a href="MPLACE.php#usage_notes">MPLACE Usage Notes</a>
for more information.
<p>
The new subcommands in <b>MMOVE</b>
(<b>path</b>, <b>cpath</b>, <b>param</b>, <b>cparam</b>)
relate to specifying the sound source
trajectory over the duration of processing.  The parameters should be
self-explanatory; you set the coordinate locations for the sound source
(in polar or cartesian coordinates) at relative times and the instrument
will calculate the movement trajectory to intersect these points.
For higher rates of speed the delay-line interpolation used in <b>MMOVE</b>
will effectively simulate a Doppler shift in all the calculated sound
paths.  Be careful, it is easy to inadvertently create high rates of
speed for the sound source!
<p>
The <b>threshold</b> rate will determine how often the various delay lengths and
attentuation factors are calculated, based on where the sound source
location has moved along the trajectory.  This rate is independent of
the
<a href="/reference/scorefile/reset.php">reset</a> rate used for
pfield updates.
<p>
The <b>RVB</b> subinstrument needs to be configured with
the appropriate
<a href="/reference/scorefile/bus_config.php">bus_config</a>
setup.  <b>MPLACE/RVB</b> requires stereo output.

<h3>Sample Scores</h3>

basic use:
<pre>
   rtsetparams(44100, 2, 1024)
   load("MMOVE")

   bus_config("MMOVE", "in 0", "aux 0-1 out")
   bus_config("RVB", "aux 0-1 in", "out 0-1")
   
   rtinput("mysoundfile.wav")

   mikes(45, 0.5)
   
   dist_front = 100
   dist_right = 130
   dist_rear = -145
   dist_left = -178
   height = 100
   rvbtime = 2
   abs_fac = 4
   space(dist_front, dist_right, dist_rear, dist_left, height, abs_fac, rvbtime)
   
   /* 5 feet is min distance,  100 feet max,  scale by 1/distance**1.5 */
   set_attenuation_params(5.0, 100.0, 1.5);
   
   insk = 0
   outsk = 0
   dur = 15;
   pre_amp = 25
   dist_mikes = 2.2		/* for normal */
   //dist_mikes = 0.67	/* for binaural */
   inchan = 0
   
   threshold(0.0005)
   
   // slow,  then zoom in and out again
   path(0,50,-90, 10,50,0, 11,10,20, 12,80,30, 15,30,90)
   
   // MMOVE does not have rvb level arg that MOVE had.  Handled in RVB call now
   MMOVE(outsk, insk, dur, pre_amp, dist_mikes, inchan)
   
   // Reverb gain increases over time
   handle rvblevel
   rvblevel = maketable("line", 1024, 0, 0.01, 1, 1.0);
   RVB(0, 0, dur+rvbtime+0.5, rvblevel)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="DMOVE.php">DMOVE</a>,
<a href="FREEVERB.php">FREEVERB</a>,
<a href="GVERB.php">GVERB</a>,
<a href="MOVE.php">MOVE</a>,
<a href="MPLACE.php">MPLACE</a>,
<a href="MROOM.php">MROOM</a>,
<a href="PLACE.php">PLACE</a>,
<a href="REV.php">REV</a>,
<a href="REVERBIT.php">REVERBIT</a>,
<a href="ROOM.php">ROOM</a>,
<a href="SROOM.php">SROOM</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
