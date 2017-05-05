<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rtaddout</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>rtaddout</h3>
<i>INSTRUMENT design -- sample output-writing function</i>
<br>
<br>
The <b>rtaddout()</b> function is used in RTcmix
instrument design to write one frame of generated samples
to the output buffer for hearing or soundfile-writing.
It will write the appropriate number of channels depending
on the value of the INSTRUMENT variable <i>outputchans</i>
(see the <a href="Instrument.php">Instrument</a> listing
for more information about INSTRUMENT variables).
<p>
Typically <b>rtaddout</b> is used in the sample-computing
loop inside the <i>INSTRUMENT::run()</i> member function.
<b>rtaddout</b> assumes that <a href="rtsetoutput.php">rtsetoutput()</a>
was called in the <i>INSTRUMENT::init()</i> member function.
<p>
It replaces
the older <a href="ADDOUT.php">ADDOUT</a> macro used in 
disk-only cmix.
<hr><h3>Usage</h3>
<ul>
<b>int rtaddout(</b><i>float frame_array[]</i><b>)</b>
<br>
<br>
<dd>
<u><i>frame_array</i></u> is the name of a float array used to store
a frame  of samples.  A "frame" contains samples for each output
channel, thus <i>frame_array</i> will have only one element for
mono output, two for stereo, four for quad, etc.
<p>
For example, if the output were stereo, <i>frame_array</i> would be
declared like this:
<ul>
<pre>float frame_array[2];</pre>
</ul>
where <i>frame_array[0]</i> would contain the sample for the
left output channel, and <i>frame_array[1]</i> would contain
the right output channel sample.
<br>
<br>
The <b>rtaddout()</b>
function returns the number of channels of the output.
</dd>
</ul
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Instrument.h&gt;

int MYINSTRUMENT::run()
{
	float out[2];

	for (i = 0; i < framesToRun(); i++)
	{
		...

		out[0] = leftchannelsample;
		out[1] = rightchannelsample;

		rtaddout(out);
	}
}
</pre>
</ul>
<br>
<hr><h3>See Also</h3>
<ul>
<li><a href="rtsetoutput.php">rtsetoutput</a>
<li><a href="rtgetin.php">rtgetin</a>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
