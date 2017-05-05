<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - PFSCHED</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>PFSCHED</b> -- dynamically schedule pfield controls
<br>
<i>in RTcmix/insts/bgg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>PFSCHED</b>(outsk, dur, pfield_bus, pfield[, deleteflag])
	<ul>
   This instrument has no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
   default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = pfield bus number to use
   p3 = pfield variable
   p4 = delete note flag (keep note active: 0, delete note: 1) [optional; default is 0]

   Author Brad Garton, 11/2009
</pre>
<br>
<hr>
<br>

<b>PFSCHED</b>
allows you to schedule pfield control information dynamically as a note
is executing.

<h3>Usage Notes</h3>

The <b>PFSCHED</b> instrument takes advantage of the
<a href="pfield-enabled.php">pfield-enabled</a>
control capabilities of RTcmix instruments to arbitrarily schedule
pfield controls during execution of a note.  It uses an internal
set of "pfield busses" (up to 1024) for the routing of pfield information
to instruments/notes.  This is useful in interactive RTcmix
applications such as the
<a href="http://rtcmix.org/rtcmix~/rtcmix~.php/"">rtcmix~</a>
Max/MSP object or the
<a href="http://rtcmix.org/irtcmix/"">iRTcmix</a>
library for iOS.
<p>
The "pfield bus" (or "pfbus") is set up using the
<a href="/reference/scorefile/makeconnection.php#pfbus">makeconnection("pfbus")...</a>
scorefile command.  Once a pfield variable is created using this
makeconnection(), it can be used to send other pfield control data
through the "pfbus" associated with the makeconnection()
pfield variable.
<p>
Here's how it works in practice:  Suppose you want to start a
<a href="WAVETABLE.php">WAVETABLE</a>
note with an arbitrary duration, but at some point in the future you
want to fade that note down (and possibly end it).
<ul>
<li>First of all, create a "pfbus" (and associated pfield variable)
using
<a href="/reference/scorefile/makeconnection.php#pfbus">makeconnection("pfbus")...</a>:
<pre>
   pfield_var = makeconnection("pfbus", 1, 1.0)
</pre>
This will create a pfield named "pfield_var" that will receive information
through "pfbus" #1 with an initial value of 1.0.
<br>
<br>
<br>
<li>Next start the
<a href="WAVETABLE.php">WAVETABLE</a>
note with an arbitrarily long duration, and the pfield variable
"pfield_var" set to control the amplitude of the note:
<pre>
   WAVETABLE(0, 7.0, 20000 * pfield_var, 8.00)
</pre>
Note that because "pfield_var" has an initial value of 1.0 that the
<a href="WAVETABLE.php">WAVETABLE</a>
will be producing sound at full volume.
<br>
<br>
<br>
<li>Then create an envelope that will fade down and assign it to
a different pfield variable:
<pre>
   delayed_envelope = maketable("line", 1000, 0,1.0,  1,0.0)
</pre>
This uses the
<a href="/reference/scorefile/maketable.php#line">maketable("line",...)</a>
scorefile command to fill a table with values going from 1.0
to 0.0.  Note that this envelope can be created before starting the
<a href="WAVETABLE.php">WAVETABLE</a>
note, or at any point while the note is executing.
<br>
<br>
<br>
<li>This control envelope -- using the pfield variable it assigned --
can now be scheduled through the "pfbus" using <b>PFSCHED</b>:
<pre>
   PFSCHED(2.5, 2.1, 1, delayed_envelope)
</pre>
This will cause the "delayed_envelope" fade-out table to be
sent to the executing
<a href="WAVETABLE.php">WAVETABLE</a>
note at 2.5 seconds (p0, "outsk")
from the time the <b>PFSCHED</b> instrument
command was received by RTcmix.  The "delayed_envelope" will
last for a duration of 2.1 (p1, "dur") seconds.  It is sent to the
<a href="WAVETABLE.php">WAVETABLE</a>
note through "pfbus" # 1 (p2, "pfield_bus").  This "pfbus"
is connected to the
<a href="WAVETABLE.php">WAVETABLE</a>
through the pfield variable "pfield_var", setup earlier with
the
<a href="/reference/scorefile/makeconnection.php#pfbus">makeconnection("pfbus")...</a>
scorefile command.
<br>
<br>
<br>
<li>If the optional paramater p4 ("deleteflag") had been set to 1,
then the
<a href="WAVETABLE.php">WAVETABLE</a>
note would stop executing and be deleted when the "delayed_envelope"
was finished (the 2.1 second duration).  If p4 had not been set to
1, then the
<a href="WAVETABLE.php">WAVETABLE</a>
would continue executing (although with 0.0 amplitude in our
example here) and could receive additional <b>PFSCHED</b>
control information in the future.
<p>
NOTE:  To check if a particular instrument/note is still active,
the
<a href="/reference/scorefile/note_exists.php">note_exists</a>
scorefile command.
</ul>
<br>
Any pfield may be scheduled using <b>PFSCHED</b>, including
pfield variables associated with active pfield generators
such as
<a href="/reference/scorefile/makeLFO.php">makeLFO</a>
and
<a href="/reference/scorefile/makerandom.php">makerandom</a>
<p>
One feature of the
<a href="/reference/scorefile/maketable.php#line">maketable("line",...)</a>
scorefile command that is very useful in conjunction with
<b>PFSCHED</b> is the use of the "curval" token with the
"dynamic" optional specifier:
<pre>
   fadenv = maketable("line", "dynamic", 1000, 0,"curval", 1,0.0)
</pre>
This will build the "line" maketable using the current value
of a pfield associated with a "pfbus".  The table doesn't actually get
created until the <b>PFSCHED</b> instrument schedules the
table for use.  This allows it to check the current value of
the pfield associated with a "pfbus" and use it to build the table.
In other words, you
can begin a fade (like the above example) using whatever value
is set for an instrument/note when the pfield control is
scheduled using <b>PFSCHED</b>

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 1)
   load("PFSCHED")
   load("WAVETABLE")

   value = makeconnection("pfbus", 1, 0.0)

   WAVETABLE(0, 77.0, 20000*value, 8.00)

   delayed_envelope = maketable("line", 100, 0,0.0,  1,1.0)
   PFSCHED(2.5, 2.1, 1, delayed_envelope)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 1)
   load("PFSCHED")
   load("WAVETABLE")

   reset(10000)

   fadeup_envelope = maketable("line", 1000, 0,0.0,  1,1.0)
   controlpfield = makeconnection("pfbus", 1, 0.0)

   PFSCHED(4.5, 0.01, 1, fadeup_envelope)

   WAVETABLE(0, 777.0, 20000*controlpfield, 8.00)

   fadedown_envelope = maketable("line", "dynamic", 1000, 0,"curval",  1,0.0)
   //note that deleteflag is set; the note will be deleted when fadedown_envelope finishes
   PFSCHED(6.2, 1.5, 1, fadedown_envelope, 1)
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2)
   load("PFSCHED")
   load("WAVETABLE")

   delayed_envelope = maketable("line", 1000, 0,0.0,  1,1.0)
   ampvalue1 = makeconnection("pfbus", 1, 0.0)
   ampvalue2 = makeconnection("pfbus", 2, 1.0)
   PFSCHED(0.5, 3.5, 1, delayed_envelope)

   delayed_LFO = makeLFO("sine", 5.0, 0, 0.03)
   pitchvalue = makeconnection("pfbus", 3, 0.0)
   PFSCHED(4.0, 3.5, 3, delayed_LFO)

   wave = maketable("wave", 1000, "saw9")

   WAVETABLE(0, 777.0, 20000*ampvalue1*ampvalue2, 8.00+pitchvalue, 0.5, wave)

   fade_env =  maketable("line", 1000, 0,1.0,  1,0.0)
   PFSCHED(5.2, 1.4, 2, fade_env, 1)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/makeconnection.php">makeconnection</a>,
<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeLFO.php">makeLFO</a>,
<a href="WAVETABLE.php">WAVETABLE</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

