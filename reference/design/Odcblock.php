<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Odcblock</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>Odcblock</h3>
<i>INSTRUMENT design -- DC-blocking filter object</i>
<br>
<br>
Based in a design from Perry Cook and Gary Scavone's
<a href="http://www.cs.princeton.edu/~prc/NewWork.php#STK">Synthesis ToolKit (STK)</a>,
the <b>Odcblock</b> object is a simple one-pole/one-zero filter
set to remove a DC (0 Hz) offset component in the output signal.
The recursive filter equation used for this object is:
<dd>
<pre>
y[n] = x[n] - x[n-1] + 0.99*y[n-1]
</pre>
</dd>
where <i>y[n]</i> and <i>y[n-1]</i> are the current and previous
outputs of the equation, respectively, and <i>x[n]</i> and
<i>x[n-1]</i> are the current and previous sample inputs to the filter
equation.
<p>
This object is very useful in cases where the output of a signal-processing
or synthesis algorithm may not necessarily be symmetrical around
0.0.  Many physical-modelling algorithms use this filter.
<hr>
<h3>Constructors</h3>
<ul>
<b>Odcblock()</b>
<br>
<br>
<dd>
builds the object.
</dd>

<br>
<br>
</ul>
<hr>
<h3>Access Methods</h3>
<ul>
<b>float Odcblock::next(</b><i>float input</i><b>)</b>
<br>
<br>
<dd>
returns the current output of the filter. <i>input</i> is
the current input to the filter.
</dd>

<br>
<br>
<b>float Odcblock::last()</b>
<br>
<br>
<dd>
returns the previous output from the filter.
</dd>

<br>
<br>
<b>void Odcblock::clear()</b>
<br>
<br>
<dd>
will reinitialize the filter by setting the 'past history' of this
recursive filter (both past inputs and past outputs) to 0.0.
</dd>


</ul>
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Ougens.h&gt;

Odcblock *theBlocker;

int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	theBlocker = new Odcblock();

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
		out[0] = theBlocker->next(sample);
	}

	...

}
</pre>
</ul>

<br>
<hr><h3>See Also</h3>
<ul>
<a href="Oonepole.php">Oonepole</a>,
<a href="Oreson.php">Oreson</a>,
<a href="Oequalizer.php">Oequalizer</a>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
