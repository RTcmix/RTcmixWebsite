<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rtinrepos</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>rtinrepos</h3>
<i>INSTRUMENT design -- reposition input pointer for arbitrary file-reading</i>
<br>
<br>
The <b>rtinrepos()</b> function is used in RTcmix
instrument design to set the input point for reading.
This is done in preparation for a subsequent call to
<a href="rtgetin.php">rtgetin</a>.
Designed for use by instruments that want to reposition the input
file arbitrarily (like
<a href="/reference/instruments/REVMIX.php">REVMIX</a>,
which reads a file backwards).
<p>
Typically it is used in the <i>INSTRUMENT::run()</i> member function
of an instrument.  It only works on file input, as arbitrary movement
forwards and backwards in real-time isn't quite possible (yet).
<p>
It replaces
the older <a href="inrepos.php">inrepos</a> function used in 
disk-only cmix.
<hr><h3>Usage</h3>
<ul>
<b>int rtinrepos(</b><i>Instrument *inst, int nframes, int whence</i><b>)</b>
<br>
<br>
<dd>
<u><i>*inst</i></u> is a pointer to the INSTRUMENT object being scheduled.
Usually this is the token <i>this</i>
(i.e. a pointer to the INSTRUMENT calling the <b>rtinrepos()</b> function).
<br>
<u><i>nframes</i></u> is the number of samples to move the input
pointer forwards or backwards from a point set by <i>whence</i>.
<i>nframes</i> can take a negative value.
<br>
<u><i>whence</i></u> works the same way that the unix <i>lseek()</i>
function does:
<ul>
	<br>
	<li>If <i>whence</i> is <b>SEEK_SET</b>, then the input read
	pointer will be set <i>nframes</i> from the beginning of the
	soundfile.
	<li>If <i>whence</i> is <b>SEEK_CUR</b>, the the input
	read pointer will be set <i>nframes</i> from the current
	read position (positive or negative values).
	<br>
	<br>
	<i>[note:  The values of <b>SEEK_SET</b> and <b>SEEK_CUR</b>
	are defined in the system header file "unistd.h".
	<b>SEEK_END</b> is not defined for use by </i>rtinrepos()<i>.]</i>
	<br>
</ul>
<br>
<br>
The <b>rtinrepos()</b>
function returns <i>0</i> if it is successful, it will exit if there
is an error.
</dd>
</ul
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Instrument.h&gt;
#include &lt;unistd.h&gt;

float in[];

int MYINSTRUMENT::run()
{
	int rsamps;
	int somenumber;

	...

	

	if (in == NULL) // first time, we need to allocate the buffer memory
		in = new float[RTBUFSAMPS*inputChannels()]
	rsamps = framesToRun() * inputChannels();

	rtinrepos(this, somenumber, SEEK_CUR);
	rtgetin(in, this, rsamps);

	...
}
</pre>
</ul>
<br>
<hr><h3>See Also</h3>
<ul>
<li><a href="rtgetin.php">rtgetin</a>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
