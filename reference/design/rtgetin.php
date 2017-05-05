<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rtgetin</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>rtgetin</h3>
<i>INSTRUMENT design -- sample input-reading function</i>
<br>
<br>
<br>
<dd>
<i>[NOTE:  Much of the underlying functionality of the
</i><b>rtgetin()</b><i> function has been superceded by the
</i><b><a href="Ortgetin.php">Ortgetin</a></b><i>
object.]</i>
</dd>
<br>
<br>

The <b>rtgetin()</b> function is used in RTcmix
instrument design to read a buffer of samples from the
input stream.  This will probably be a soundfile or
a real-time input source, depending on how
the <a href="/reference/scorefile/rtinput.php">rtinput</a>
score directive is set.  
The point where <b>rtgetin()</b> actually
starts reading also depends on the <a href="rtsetinput.php">rtsetinput</a>
function probably used in the <i>INSTRUMENT::init()</i> member function.
<p>
<b>rtgetin()</b> differs from <a href="rtaddout.php">rtaddout</a>
in that it reads a block of samples instead of a single "frame"
(1-sample-step * number-of-output-channels) of samples.  The buffer
used by <b>rtgetin()</b> has to be dimensioned large enough
to hold the number of samples that will be buffered by
RTcmix.  Since this depends on how the buffers were set in
the <a href="/reference/scorefile/rtsetparams.php">rtsetparams</a> score
directive, this usually needs to be allocated dynamically.
<p>
Here's an example of how to do this:
<ul>
<pre>
float in[];

int MYINSTRUMENT::run()
{
	int rsamps;

	...

	if (in == NULL) // first time, we need to allocate the buffer memory
		in = new float[RTBUFSAMPS*inputChannels()]

	rsamps = framesToRun() * inputChannels();
	rtgetin(in, this, rsamps);

	...
}
</pre>
</ul>
Where does the variable <i>RTBUFSAMPS</i> come from?
It is a class variables that is part of the general
<a href="Instrument.php">Instrument</a> object, used as the
base class to create user-written instruments.  The <i>framesToRun()</i>
and <i>inputChannels</i> are inline access functions, also part of the
<i>Instrument</i> object, that return the <i>Instrument</i>
class variables <i>inputchans</i> and <i>chunksamps</i>.
<p>
Because <b>rtgetin()</b> reads an entire buffer, this
buffer needs to be 'stepped through' inside
the <i>INSTRUMENT::run()</i> method.  The step size depends on how
many channels (<i>inputChannels()</i>, or <i>inputchans</i>) are in the input
stream, as samples are interleaved in the buffer.  This means,
for example, that a stereo input stream will set up the buffer-array
with <i>left0, right0, left1, right1, left2, right2 ... leftN, rightN</i>.
<p>
Generally <b>rtgetin</b> is used in
the <i>INSTRUMENT::run()</i> member function, just before the
sample-computing loop.  It can also be used to read in
a buffer of samples from an input file at any point inside
an INSTRUMENT.
<b>rtgetin</b> assumes that <a href="rtsetinput.php">rtsetinput</a>
was called previously.
<p>
This function replaces
the older <a href="GETIN.php">GETIN</a> macro used in 
disk-only cmix.
<hr><h3>Usage</h3>
<ul>
<b>int rtgetin(</b><i>float buffer[], Instrument *inst, int real_samps</i><b>)</b>
<br>
<br>
<dd>
<u><i>buffer</i></u> is the name of a float array used to store
the input samples.  It needs to be at least as large as
<i>RTBUFSAMPS*inputChannels()</i> -- these being the two factors that
dictate how many actual sample values are read during each buffer-increment
of the RTcmix scheduler.
<br>
<u><i>*inst</i></u> is a pointer to the INSTRUMENT object being run.
Usually this is the token <i>this</i>
(i.e. a pointer to the INSTRUMENT calling the <b>rtgetin()</b> function).
<br>
<u><i>real_samps</i></u> is the actual number of samples to be
read into the <i>buffer</i>.  Usually this is the length of
the RTcmix "chunk" (<i>RTBUFSAMPS</i>) multipled by the number
of samples for each from (the number of input channels).
<p>
The <b>rtgetin()</b>
function returns the number of actual samples read into the
buffer.
</dd>
</ul
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Instrument.h&gt;

float in[];

int MYINSTRUMENT::run()
{
	float out[2]; // stereo output array
	int rsamps; // rsamps is the "real" number of samples read

	...

	if (in == NULL) // first time, so allocate it
		in = new float [RTBUFSAMPS*inputChannels()];

	rsamps = framesToRun() * inputChannels();
	rtgetin(in, this, rsamps);

	// skip through the buffer a frame at a time, rather than a sample at a time
	for (i = 0; i < rsamps; i += inputChannels())
	{
		...

		out[0] = in[i];
		out[1] = in[i+1];

		rtaddout(out);

		...
	}
}
</pre>
</ul>
<br>
<hr><h3>See Also</h3>
<ul>
<li><a href="rtsetinput.php">rtsetinput</a>
<li><a href="rtgetin.php">rtgetin</a>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
