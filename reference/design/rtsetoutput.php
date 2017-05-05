<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rtsetoutput</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>rtsetoutput</h3>
<i>INSTRUMENT design -- output initialization and setup function</i>
<br>
<br>
The <b>rtsetoutput()</b> function is used in RTcmix
instrument design to set the start time and duration of a note.
Typically it is used in the <i>INSTRUMENT::init()</i> member function
of an instrument.  It handles all scheduling tasks for real-time
output, and it also will set the note up for writing into a soundfile
(if the 
<a href="/reference/scorefile/rtoutput.php">rtoutput</a>
scorefile command was specified
in the score)
at the proper time.
<p>
It replaces
the older <a href="setnote.php">setnote</a> function used in 
disk-only cmix.
<hr><h3>Usage</h3>
<ul>
<b>int rtsetoutput(</b><i>float start_time, float duration, Instrument *inst</i><b>)</b>
<br>
<br>
<dd>
<u><i>start_time</i></u> is the starting time for the note in seconds. Usually
this is a p-field variable.
<br>
<u><i>duration</i></u> is the duration of the note in seconds.  Usually
this is also a p-field variable.
<br>
<u><i>*inst</i></u> is a pointer to the INSTRUMENT object being scheduled.
Usually this is the token <i>this</i>
(i.e. a pointer to the INSTRUMENT calling the <b>rtsetoutput</b> function).
<br>
<br>
<b>rtsetoutput()</b> returns <i>0</i> if successful, <i>-1</i> if
it fails for any
reason.  A test for failure should be used to return the token
<i>DONT_SCHEDULE</i> from an INSTRUMENT init method.
</dd>
</ul
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Instrument.h&gt;

int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	// assumes p[0] = start time (in seconds), p[1] = duration (in seconds)
	returnval = rtsetoutput(p[0], p[1], this);
	if (returnval == -1) return DONT_SCHEDULE;

	...
}
</pre>
</ul>
<br>
<hr><h3>See Also</h3>
<ul>
<li><a href="rtsetinput.php">rtsetinput</a>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
