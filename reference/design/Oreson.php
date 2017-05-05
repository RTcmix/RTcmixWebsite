<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Oreson</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>Oreson</h3>
<i>INSTRUMENT design -- simple first-order IIR filter object</i>
<br>
<br>
<b>Oreson</b> duplicates the functionality of the older CMIX
functions
<a href="reson.php">reson</a> and
<a href="reson.php">rsnset</a>.
It builds a simple IIR filter given a desired center frequency
and bandwidth, very useful in parallel for building complicated
filter response curves (see the
<a href="/reference/instruments/IIR.php">IIR</a>
instrument for an example of <b>Oreson</b> use).
<p>
The general recursive filter equation used by this object
is:
<dd>
<pre>
y[n] = a*x[n] + b0*y[n-1] - b1*y[n-2]
</pre>
</dd>
where <i>y[n]</i>, <i>y[n-1]</i> and <i>y[n-2]</i> are the current
and two previous outputs of the equation, and
<i>x[n]</i> is the
current input.  <i>a</i>, <i>b0</i> and <i>b1</i> are the coefficients to
the equation that determine the characteristics of the filter, depending
upon the parameters set in the constructor.  Presently the <b>Oreson</b>
filter object does not allow for dynamic changes to the filter
equation.
<hr>
<h3>Constructors</h3>
<ul>
<b>Oreson(</b><i>float SR, float centerFreq, float bandwidth[, Scale scaling]</i><b>)</b>
<br>
<br>
<dd>
<u><i>SR</i></u> is the current sampling rate (an
<a href="Instrument.php">Instrument</a>
class variable).
<br>
<u><i>centerFreq</i></u> is the center frequency of the bandpass filter
constructed.
<br>
<u><i>bandwidth</i></u> is the distance in Hz between the half-power points
of the passband centered around the <i>centerFreq</i>.
<br>
<u><i>scaling</i></u> is an optional parameter to set how the
filter normalizes the filter equation.  The flags for this parameter
are defined in RTcmix/genlib/Oreson.h as:
<pre>
   typedef enum {
      kNoScale = 0,  // no scaling of signal
      kPeakResponse, // peak response factor of 1; use for harmonic signals
      kRMSResponse   // RMS response factor of 1; use for white noise signals
   } Scale;
</pre>
The default value used is <i>kPeakResponse</i>.
</dd>

<br>
<br>
</ul>
<hr>
<h3>Access Methods</h3>
<ul>
<b>void Oreson::clear()</b>
<br>
<br>
<dd>
sets all delayed signals in the filter to 0.0.
</dd>

<br>
<br>
<b>float Oreson::next(</b><i>float sig</i><b>)</b>
<br>
<br>
<dd>
enters the incoming sample value <i<sig</i> into the filter equation,
computes the equation and then
returns the next filtered sample value as output.
</dd>

<br>
<br>
<b>float Oreson::last()</b>
<br>
<br>
<dd>
returns the current output of the filter without computing the
equation.
</dd>

</ul>
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Ougens.h&gt;

Oreson *thefilt;

int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	// center freq at 478 Hz, 14-Hz wide bandwdith
	thefilt = new Oreson(SR, 478.0, 14.0);

	...

}

int MYINSTRUMENT::run()
{
	float out[2];
	float sample;

	...

	for (int i = 0; i < framesToRun(); i++)
	{
		sample = someSampleGeneratingProcess();
		out[0] = thefilt->next(sample);
	}

	...

}
</pre>
</ul>

<br>
<hr><h3>See Also</h3>
<ul>
<a href="Oonepole.php">Oonepole</a>,
<a href="Oequalizer.php">Oequalizer</a>
</ul> 

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
