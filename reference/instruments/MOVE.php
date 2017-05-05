<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MOVE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MOVE</b> -- moving-source room simulation
<br>
<i>in RTcmix/insts/std/MOVE</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MOVE</b>(outskip, inskip, dur, AMP, dist_between_mikes, rvb_amp[, inputchan])
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
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

   <hr>
   <br>

<b>MOVE</b> employs several subcommands to set the room-simulation
characteristics and the sound-source trajectory
<p>
NOTE:  This is an older RTcmix instrument, the newer
<a href="MMOVE.php">MMOVE</a> or
<a href="DMOVE.php">DMOVE</a> (pfield-enabled data specification)
instruments are probably better to use.
<br>
<br>
<br>


<a name="MOVE"></a>
<b>MOVE</b>
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

   NOTE: this subcommand is required for MOVE to function
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

   NOTE: one of the subcommands (<b>path</b>, <b>cpath</b>, <b>param</b>, <b>cparam</b>) is required for MOVE to function
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

   NOTE: one of the subcommands (<b>path</b>, <b>cpath</b>, <b>param</b>, <b>cparam</b>) is required for MOVE to function
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

   NOTE: one of the subcommands (<b>path</b>, <b>cpath</b>, <b>param</b>, <b>cparam</b>) is required for MOVE to function
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

   NOTE: one of the subcommands (<b>path</b>, <b>cpath</b>, <b>param</b>, <b>cparam</b>) is required for MOVE to function
</pre>
<br>

<a name="threshold"></a>
<b>threshold</b><br>
<pre>
   p0 = time interval (seconds) for trajectory updates (typically < 0.01)

   NOTE: this subcommand is optional for MOVE to function (the default is
      the size of the buffers set in <a href="/reference/scorefile/rtsetparams.php">rtsetparams</a>)
</pre>
<br>

<a name="mikes"></a>
<b>mikes</b><br>
<pre>
   p0 = microphone angle (degrees, 0 degrees is straight in front)
   p1 = microphone pattern (0-1; 0 == omnidirectional, 1 == highly directional)

   NOTE: this subcommand is optional for MOVE to function (the default is "mikes_off")
</pre>
<br>

<a name="mikes_off"></a>
<b>mikes_off</b><br>
<pre>
   no pfields, this defeats the microphone angle and pattern settings for binaural simulation

   NOTE: this subcommand is optional for MOVE to function
</pre>
<br>

<a name="matrix"></a>
<b>matrix</b><br>
<pre>
   p0 = total matrix gain (relative multiplier of input signal)
   p1-p145 = 12 x 12 matrix amp/feedback coefficients [optional; defaults to internal matrix]

   NOTE: this subcommand is optional for MOVE to function
</pre>
<br>
<hr>
<br>


<b>MOVE</b>
is Doug Scott's moving sound simulation instrument, which simulates the
acoustic space of a room and lets the user define the trajectory of a
sound moving through space within the room, relative to the listener's position.
This is similar to Doug's other room-simulation program,
<a href="PLACE.php">PLACE</a>,
the difference being the ability to specify a moving sound source.
<b>MOVE</b> is a bit more computationally expensive than PLACE.
The instrument has optional parameters for microphone placement and the
computation of inter-aural delays.
<p>
NOTE:  This is an older RTcmix instrument, the newer
<a href="MMOVE.php">MMOVE</a> or
<a href="DMOVE.php">DMOVE</a> (pfield-enabled data specification)
instruments are probably better to use.


<a name="usage_notes"></a>
<h3>Usage Notes</h3>

The use of <b>MOVE</b> is almost identical to the newer
<a href="MMOVE.php">MMOVE</a>
instrument.  See the
<a href="MMOVE.php#usage_notes">MMOVE Usage Notes</a>
for that instrument (minus the updated subcommands, of course).
In fact, it's probably better to use either
<a href="MMOVE.php">MMOVE</a> or
<a href="DMOVE.php">DMOVE</a>
for doing this processing.

<h3>Sample Scores</h3>

basic use:
<pre>
   rtsetparams(44100, 2)
   load("MOVE")

   rtinput("mysound.snd")
   
   space(50, 50, -750, -80, 25, 1, 3)
   mikes_off()
   path(0, 25, 0, 3, 15, 90)
   
   MOVE(0, 0, 5, 20, 0, 1)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="DMOVE.php">DMOVE</a>,
<a href="FREEVERB.php">FREEVERB</a>,
<a href="GVERB.php">GVERB</a>,
<a href="MMOVE.php">MMOVE</a>,
<a href="MPLACE.php">MPLACE</a>,
<a href="MROOM.php">MROOM</a>,
<a href="PLACE.php">PLACE</a>,
<a href="REV.php">REV</a>,
<a href="REVERBIT.php">REVERBIT</a>,
<a href="ROOM.php">ROOM</a>,
<a href="SROOM.php">SROOM</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
