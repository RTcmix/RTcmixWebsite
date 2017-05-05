<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Odelay/Odelayi</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>Odelay/Odelayi</h3>
<i>INSTRUMENT design -- general delay-line objects</i>
<br>
<br>
The <b>Odelay</b> and <b>Odelayi</b> objects are used to create
and use delay-lines for samples.  <b>Odelay</b> is non-interpolating,
so that requests for delays that translate into a fractional point
between two samples will be 'rounded' to the nearest sample value.
This fractional delaying can happen quite often with
dynamically-changing delay lines, which makes <b>Odelayi</b>
a better choice in those cases.  <b>Odelayi</b> is slightly less
efficient because of the interpolation math to calculate a fractional
sample-point.
<p>
There are two different ways of using the <b>Odelay/Odelayi</b>
objects.  The first is based on the older RTcmix delay techniques using the
<a href="delget.php">delset/delput/delget/dliget</a> approach, where
delayed samples are retrieved from the delay line based upon
a time- or sample-amount of delay specified in the corresponding
<b>delget</b> or <b>dliget</b> function call.  Samples are put 'into'
the delay line using <b>delput</b>.  Because the delay amount is determined
when samples are retreived from the delay line, multiple taps (i.e. multiple
calls to the sample-retrieving function) are allowed for each
sample-generating cycle.
<p>
The second way of using the <b>Odelay/Odelayi</b> objects is based
on approach used in the
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit (STK)</a>
delay line implementation (DLineL).  Samples are placed into and retrieved
from the delay line simultaneously, with the length of the delay determined
by a separate function call.  It is prabably best not to mix the two
different approaches, because the delay line pointer-updating is handled
slightly differently in each case.

<hr><h3>Constructors</h3>
<ul>
<b>Odelay(</b><i>long defaultLength</i><b>)</b>
<br>
<b>Odelayi(</b><i>long defaultLength</i><b>)</b>
<br>
<br>
<dd>
creates a new delay line.
<u><i>defaultLength</i></u> is the initial length of the delay line
(in samples, so time should be converted to samples using <i>SR*seconds</i>).
If a delay length is requested during note execution that is longer
than this initial length, then the delay line will be resized to accommodate
the additional delay length.
</dd>
<br>
<br>
</ul>
<hr>
<h3>Access Methods</h3>
<ul>
<b>void Odelay::clear()</b>
<br>
<b>void Odelayi::clear()</b>
<br>
<br>
<dd>
will clear (zero) the current delay line of all samples.
</dd>
<br>
<br>

<b>void Odelay::fill(</b><i>double val</i><b>)</b>
<br>
<b>void Odelayi::fill(</b><i>double val</i><b>)</b>
<br>
<br>
<dd>
will fill the entire delay line with the number <i>val</i>.
</dd>
<br>
<br>

<b>void Odelay::putsamp(</b><i>float samp</i><b>)</b>
<br>
<b>void Odelayi::putsamp(</b><i>float samp</i><b>)</b>
<br>
<br>
<dd>
will place the sample <i>samp</i> into the delay line.  This method should
be used with the <b>getsamp()</b> method below.
</dd>
<br>
<br>


<b>float Odelay::getsamp(</b><i>double delaysamps</i><b>)</b>
<br>
<b>float Odelayi::getsamp(</b><i>double delaysamps</i><b>)</b>
<br>
<br>
<dd>
returns a floating-point sample value corresponding to a sample
that was placed into the delay line <i>delaysamps</i> samples ago.
<b>Odelayi::getsamp()</b> will interpolate between sample values
if <i>delaysamps</i> has a fractional part; <b>Odelay::getsamp()</b>
will 'round' to the nearest sample location in the delay line.
<b>getsamp()</b> is used with <b>putsamp()</b> above.
</dd>
<br>
<br>
<b>void Odelay::setdelay(</b><i>double delaysamps</i><b>)</b>
<br>
<b>void Odelayi::setdelay(</b><i>double delaysamps</i><b>)</b>
<br>
<br>
<dd>
sets the delay line to return samples that are <i>delaysamps</i> samples
(<i>SR*seconds</i> seconds) old.  This is to be used to set
the delay for the <b>next()</b> method described below.
<b>Odelayi::setdelay()</b> will cause <b>next()</b> to
interpolate fractional sample values if <i>delaysamps</i> has a
fractional part; <b>Odelay::setdelay()</b>
will catse <b>next()</b> to
'round' to the nearest sample location in the delay line.
</dd>
<br>
<br>
<b>float Odelay::next(</b><i>float samp</i><b>)</b>
<br>
<b>float Odelayi::next(</b><i>float samp</i><b>)</b>
<br>
<br>
<dd>
returns a floating-point sample value delayed by the number of samples
set in a preceding <b>setdelay()</b> call, as well as putting the sample
<i>samp</i> into the delay line for subsequent retrieval by <b>next)</b>.
</dd>
<br>
<br>
<b>float Odelay::last()</b>
<br>
<b>float Odelayi::last()</b>
<br>
<br>
<dd>
returns the last sample value retrieved from the delay line by either a
<b>getsamp()</b> call or a <b>next()</b> call.
</dd>
<br>
<br>
<b>long Odelay::length()</b>
<br>
<b>long Odelayi::length()</b>
<br>
<br>
<dd>
returns the current length (in samples) of the delay line.
</dd>
<br>
<br>
<b>float Odelay::delay()</b>
<br>
<b>float Odelayi::delay()</b>
<br>
<br>
<dd>
returns the current delay (in samples) of the delay line.  Note that a
delay line may be longer than the current delay.  This reports the delay
length as established by <b>setdelay()</b>.
</dd>
</ul
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Ougens.h&gt;

Odelay *theDelay;

// this instrument has a delay line
int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	theDelay = new Odelay(22050.0); // 0.5 second initial delay line

	...

}

int MYINSTRUMENT::run()
{
	float out[2];
	float sample;

	...

	for (i = 0; i < framesToRun(); i++)
	{
		sample = someSampleGeneratingProcess();
		theDelay->putsamp(sample);
		out[0] = theDelay->getsamp(22050.0); // 0.5 second delay
	}

	...

}
</pre>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
