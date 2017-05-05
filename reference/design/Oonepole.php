<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Oonepole</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>Oonepole</h3>
<i>INSTRUMENT design -- simple one-pole filter object</i>
<br>
<br>
The <b>Oonepole</b> object instantiates a simple
one-pole IIR filter, based on designs found in
<i><u>Computer Music: Synthesis, Composition, and Performance</i></u>
by Charles Dodge and Thomas Jerse and the
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit (STK)</a>
authored by Perry Cook and Gary Scavone.  The general recursive filter
equation used for this object is:
<dd>
<pre>
y[n] = a*x[n] + b*y[n-1]
</pre>
</dd>
where <i>y[n]</i> and <i>y[n-1]</i> are the current and previous
outputs of the equation, respectively, and <i>x[n]</i> is the
current input.  <i>a</i> and <i>b</i> are the coefficients to
the equation that determine what kind of filter is constructed.
Simple low-pass and high-pass filters are possible with characteristics
depending upon the values of the <i>a</i> and <i>b</i>
coefficients.
<p>
The
<a href="OonePoleTrack.php">OonepoleTrack</a>
object does the same thing as <b>Oonepole</b> except that it
'tracks' changes to the state of the filter and only performs
computations if the cutoff frequency or lag time of the filter
has changed.  More generally, the older functions
<a href="reson.php">reson</a>
and
<a href="resonz.php">resonz</a>
do similar kinds of filtering operations.  See also the
<a href="Oequalizer.php">Oequalizer</a>
object for filtering capabilities.
<hr>
<h3>Constructors</h3>
<ul>
<b>Oonepole(</b><i>float SR</i><b>)</b>
<br>
<br>
<dd>
<u><i>SR</i></u> is the current sampling rate (an
<a href="Instrument.php">Instrument</a>
class variable).
<p>
The coefficient <i>a</i> in the filter equation will be set to 
the value 0.1, and the coefficient <i>b</i> in the filter equation will
be 0.9 (a smooth low-pass filter).
</dd>
<br>
<br>

<b>Oonepole(</b><i>float SR, float freq</i><b>)</b>
<br>
<br>
<dd>
<u><i>SR</i></u> is the current sampling rate (an
<a href="Instrument.php">Instrument</a>
class variable).
<br>
<u><i>freq</i></u> sets the cutoff point for the filter.  If
<i>freq</i> is positive it will be set up as a low-pass filter,
if <i>freq</i> is negative it will be a high-pass filter.  The
values for the coefficients <i>a</i> and <i>b</i>
in the filter equation will be set accordingly.
</dd>

<br>
<br>
</ul>
<hr>
<h3>Access Methods</h3>
<ul>
<b>void Oonepole::setfreq(</b><i>float freq</i><b>)</b>
<br>
<br>
<dd>
sets the cutoff point of the constructed filter to <i>freq</i>.
</dd>

<br>
<br>
<b>void Oonepole::setlag(</b><i>float lag</i><b>)</b>
<br>
<br>
<dd>
is an alternative to the <b>setfreq</b> method for use in control-rate
signals.  The <i>lag</i> determines how long the filter will
take to travel to the next data point.  <i>lag</i> is in the range
[0, 1] and is inversely proportional to the way the cutoff frequency
operates.  Values closer to 1 will result in lower cutoff frequencies.
The conversion to filter cutoff frequency is:
<dd>
<pre>
 #define LAGFACTOR 12.0
 #define MAXCF     500.0

cutoff = MAXCF * pow(2, -lag * LAGFACTOR);
</pre>
</dd>
John Gibson determined the parameters in order to achieve a linear
"feel" to the <i>lag</i> range.
</dd>

<br>
<br>
<b>void Oonepole::clear()</b>
<br>
<br>
<dd>
will reinitialize the filter by setting the 'past history' of this
recursive filter to 0.0.
</dd>

<br>
<br>
<b>void Oonepole::setpole(</b><i>float coefficient</i><b>)</b>
<br>
<br>
<dd>
sets the "b" term of the filter equation:
<dd>
<pre>
y[n] = a*x[n] + b*y[n-1]
</pre>
</dd>
to <i>coefficient</i>.  The "a" term is set to <i>1.0 - coefficient</i>
if "b" is greater than 0.0, otherwise it is set to <i>1.0 + coefficient</i>.
</dd>

<br>
<br>
<b>float Oonepole::next(</b><i>float input</i><b>)</b>
<br>
<br>
<dd>
returns the next floating-point sample value from the filter
and places an incoming sample into the
filter (<i>input</i>).
</dd>

</ul>
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Ougens.h&gt;

Oonepole *thefilt;

// this instrument has a delay line
int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	thefilt = new Oonepole(SR, -100.0); // high-pass filter, cutoff at 100.0 Hz

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
<a href="Oreson.php">Oreson</a>,
<a href="OonepoleTrack.php">OonepoleTrack</a>,
<a href="Oequalizer.php">Oequalizer</a>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
