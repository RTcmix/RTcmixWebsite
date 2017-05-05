<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Ortgetin</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>Ortgetin</h3>
<i>INSTRUMENT design -- read samples from the input device or file</i>
<br>
<br>
The <b>Ortgetin</b> object fills an input array with samples
from a soundfile or an input device, depending upon the
parameters set in the
<a href="/reference/scorefile/rtinput.php">rtinput</a>
scorefile command.  It essentially wraps the
<a href="rtgetin.php">rtgetin</a> function and simplifies
the necessary array allocation and sample-retrieval chores.
<p>
It is still the responsibility of the RTcmix instrument
designer to properly handle differing numbers of input
channels (i.e. mono vs. stereo) in the <i>Instrument::run()</i>
method.  <b>Ortgetin</b>
will configure it's input buffers and returned sample array
based upon the values of the
<a href="Instrument.php#inputChannels>inputChannels()</a>
funtion and the
<a href="Instrument.php">RTBUFSAMPS<a>
parameter.  <b>Ortgetin</b> will automatically read a new input
buffer whenever the current buffer of input samples is exhausted.
Note that <b>Ortgetin</b> assumes that the input has been properly
set using the
<a href="rtsetinput.php">rtsetinput</a>
function.
<p>
See the
<a href="/tutorials/instrumentdesign.php">instrument design</a>
tutorial for more information on how <b>Ortgetin</b> is used.
<hr><h3>Constructors</h3>
<ul>
<b>Ortgetin(</b><i>Instrument *inst</i><b>)</b>
<br>
<br>
<dd>
<u><i>inst</i></u> is a pointer to the Instrument/note using <b>Ortgetin</b>.
</dd>
<br>
<br>
</ul>
<hr>
<h3>Access Methods</h3>
<ul>
<b>int Ortgetin::next(</b><i>float *inarray</i><b>)</b>
<br>
<br>
<dd>
<i>inarray[]</i> is the input array used for the input-channel
samples of the current sample frame; i.e. <i>inarray[0]</i> would
contain the sample for channel 0 (left) and <i>inarray[1]</i>
would contain the sample for channel 1 (right) of a stereo file
after a call to this method.  This method returns the number of
samples read whenever <b>Ortgetin</b> grabs a new buffer of samples
(once at the beginning of each sample frame), otherwise it returns
0.
</dd>
</ul
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Ougens.h&gt;

Ortgetin *theIn;

// this instrument will generate noise
int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	rtsetinput(inputskip, this);

	theIn = new Ortgetin(this);

	...

}

int MYINSTRUMENT::run()
{
	float out[2];
	float in[2];

	...

	for (i = 0; i < framesToRun(); i++)
	{
		theIn->next(in);

		out[0] = in[0];
		out[1] = in[1];

		rtaddout(out);
	}

	...

}
</pre>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
