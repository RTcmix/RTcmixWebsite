<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rtsetinput</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>rtsetinput</h3>
<i>INSTRUMENT design -- input initialization and setup function</i>
<br>
<br>
The <b>rtsetinput()</b> function is used in RTcmix
instrument design to set the start time to begin reading a soundfile
(if the
<a href="/reference/scorefile/rtinput.php">rtinput</a>
scorefile command set a soundfile
in the score) or the start time for becoming active (if
real-time input was specified by the
<a href="/reference/scorefile/rtinput.php">rtinput</a> command in the score).
<p>
Typically it is used in the <i>INSTRUMENT::init()</i> member function
of an instrument.  It handles all scheduling tasks for real-time
input, and it can also be used to set the INSTRUMENT for reading a soundfile
at the proper time.
<p>
It replaces
the older <a href="setnote.php">setnote</a> function used in 
disk-only cmix.
<hr><h3>Usage</h3>
<ul>
<b>int rtsetinput(</b><i>float start_time, Instrument *inst</i><b>)</b>
<br>
<br>
<dd>
<u><i>start_time</i></u> is the starting time for reading in seconds. Usually
this is a p-field variable.
<br>
<u><i>*inst</i></u> is a pointer to the INSTRUMENT object being scheduled.
Usually this is the token <i>this</i>
(i.e. a pointer to the INSTRUMENT calling the <b>rtsetinput()</b> function).
<br>
<br>
<b>rtsetinput()</b> does not use a duration.  This is set in the
<a href="rtsetoutput.php">rtsetoutput</a> function.  The <b>rtsetinput()</b>
function returns <i>0</i> if it is successful, <i>-1</i> if there
is an error.
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

	// assumes p[0] = start time for output (in seconds)
	//	   p[1] = duration (in seconds)
	//	   p[2] = start time for input (in seconds)
	returnval = rtsetoutput(p[0], p[1], this);
	if (returnval == -1) return DONT_SCHEDULE;
	returnval = rtsetinput(p[2], this);
	if (returnval == -1) {
		cout << "problem setting up the input!" << endl;
		return DONT_SCHEDULE;
	}

	...
}
</pre>
</ul>
<br>
<hr><h3>See Also</h3>
<ul>
<li><a href="rtsetoutput.php">rtsetoutput</a>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
