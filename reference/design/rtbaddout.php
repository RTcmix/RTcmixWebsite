<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rtbaddout</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>rtbaddout</h3>
<i>INSTRUMENT design -- sample output-writing function</i>
<br>
<br>
The <b>rtbaddout()</b> function is used in RTcmix
instrument design to write an array of generated samples
to the output buffer for audition or soundfile-writing.
It will write a block of samples corresponding to the
<i>length</i> argument of the function.
<p>
Typically <b>rtbaddout</b> is used
inside the <i>INSTRUMENT::run()</i> member function, but after
in the sample-computing loop (i.e. an array of samples needs to
be computed).
<b>rtbaddout</b> assumes that <a href="rtsetoutput.php">rtsetoutput()</a>
was called in the <i>INSTRUMENT::init()</i> member function.
<p>
It replaces
the older <a href="baddout.php">baddout</a> function used in 
disk-only cmix.
<hr><h3>Usage</h3>
<ul>
<b>int rtbaddout(</b><i>float sample_array[], int length</i><b>)</b>
<br>
<br>
<dd>
<u><i>sample_array</i></u> is the name of a float array used to store
an array of samples.  This array needs to be set up properly for
mono or stereo (interleaved) output; i.e. if it is a 2-channel
array, the left and right channels should be interleaved
(ch0, ch1, ch0, ch1, ...) through the entire array.
<p>
For example, if the output were stereo, <i>sample_array</i> for
1024 sample would be declared like this:
<ul>
<pre>float sample_array[2*1024];</pre>
</ul>
where <i>sample_array[0]</i> would contain the first sample for the
left output channel, and <i>sample_array[1]</i> would contain
the first right output channel sample, <i>sample_array[2]</i> would contain
the second left output sample, <i>sample_array[3]</i> would hold
the second right output sample, etc.
<br>
<br>
<u><i>length</i></u> is the total number of samples in the array.
<br>
<br>
The <b>rtbaddout()</b>
function returns the number of samples written.  See also the
<a href="rtaddout.php">rtaddout</a> function.
</dd>
</ul
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Instrument.h&gt;

int MYINSTRUMENT::run()
{
	float out[2*RTBUFSAMPS];

	for (i = 0; i < framesToRun(); i++)
	{
		...

		out[i*2] = leftchannelsample;
		out[i*2+1] = rightchannelsample;
	}
	rtbaddout(out, 2*RTBUFSAMPS);
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
