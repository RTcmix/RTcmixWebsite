<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - OonepoleTrack</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>OonepoleTrack</h3>
<i>INSTRUMENT design -- simple 'tracking' one-pole filter object</i>
<br>
<br>
The <b>OonepoleTrack</b> object is a subclass of the
<a href="Oonepole.php">Oonepole</a>
object that 'tracks' changes to the cutoff frequency or
the lag time and performs computations to update them only when they
change.  This only works if the caller sticks to updating either
the cutoff frequency (using the <b>setfreq</b> method) or the lag
time (using the <b>setlag</b> method), not mixing calls to both.
<p>
See the
<a href="Oonepole.php">Oonepole</a>
documentation for a more complete description of this filter.
<hr>
<h3>Constructors</h3>
<ul>
<b>OonepoleTrack(</b><i>float SR</i><b>)</b>
<br>
<br>
<dd>
<u><i>SR</i></u> is the current sampling rate (an
<a href="Instrument.php">Instrument</a>
class variable).
</dd>

<br>
<br>
</ul>
<hr>
<h3>Access Methods</h3>
<ul>
<b>void OonepoleTrack::setfreq(</b><i>float freq</i><b>)</b>
<br>
<br>
<dd>
updates the cutoff point <i>freq</i> if it has changed since the
last call to the filter.
</dd>

<br>
<br>
<b>void OonepoleTrack::setlag(</b><i>float lag</i><b>)</b>
<br>
<br>
<dd>
updates the lag time <i>lag</i> if it has changed since the
last call to the filter.
</dd>

</ul>
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Ougens.h&gt;

OonepoleTrack *thefilt;

// this instrument has a delay line
int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	thefilt = new OonepoleTrack(SR);
	thefilt->setfreq(100.0);

	...

}

int MYINSTRUMENT::run()
{
	float out[2];
	float sample;

	...

	thefilt->setfreq(someFrequencyChanger);
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
<a href="Oreson.php">Oreson</a>,
<a href="Oequalizer.php">Oequalizer</a>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
