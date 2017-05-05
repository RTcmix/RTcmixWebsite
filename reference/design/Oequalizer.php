<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Oequalizer</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>Oequalizer</h3>
<i>INSTRUMENT design -- multi-purpose equalizer (filter) object</i>
<br>
<br>
The <b>Oequalizer</b> object uses a
<a href="http://peabody.sapp.org/class/350.838/lab/mybiquad/">biquad filter</a>
algorithm to instantiate a number of different filter types (low-pass,
high-pass, band-pass, etc.).  The code was based on work done by
<a href="http://tomstdenis.home.dhs.org">Tom St. Denis</a>,
using formulas for the filter coeeficients from
Robert Bristow-Johnson's on-line document
<a href="http://www.musicdsp.org/files/Audio-EQ-Cookbook.txt">The Audio-EQ-Cookbook</a>.
<p>
The older functions
<a href="reson.php">reson</a>
and
<a href="resonz.php">resonz</a>
do similar signal-processing actions, but using different and
somewhat less flexible algorithms.  For very simple filtering,
the
<a href="Oonepole.php">Oonepole</a>
object may be more appropriate.
<hr>
<h3>Constructors</h3>
<ul>
<b>Oequalizer(</b><i>float SR, OeqType filter_type</i><b>)</b>
<br>
<br>
<dd>
<u><i>SR</i></u> is the current sampling rate (an
<a href="Instrument.php">Instrument</a>
class variable).
<br>
<u><i>filter_type</i></u> is the kind of filter that will be implemented
by the biquad equation.  These types are defined in the <i>OeqType</i>
structure found in the <i>RTcmix/genlib/Oequalizer.h</i> file:
<ul>
<li><i>OeqLowPass</i> -- low-pass filter
<br>
<li><i>OeqHighPass</i> -- high-pass filter
<br>
<li><i>OeqBandPassCSG</i> -- band-pass filter with "constant skirt gain",
	the peak gain will be related to the "Q" of the filter
<br>
<li><i>OeqBandPassCPG/OeqBandPass</i> -- band-pass filter with "constant peak
	gain", the peak gain will be 0 dB
<br>
<li><i>OeqNotch</i> -- notch filter
<br>
<li><i>OeqAllPass</i> -- allpass filter
<br>
<li><i>OeqPeaking</i> -- peaking filter (good for creating "quacking"
	sounds; used in... oh, you figure it out :-))
<br>
<li><i>OeqLowShelf</i> -- low shelf filter
<br>
<li><i>OeqHighShelf</i> -- high shelf filter
</ul>
</dd>
<br>
<br>
</ul>

<hr>
<h3>Access Methods</h3>
<ul>

<b>void Oequalizer::settype(</b><i>OeqType filter_type</i><b>)</b>
<br>
<br>
<dd>
sets the configuration of the biquad filter equation for a particular
kind of filter.  See the list of <i>filter_types</i> above in the
constructor.  Note that if the type is changed after the <b>Oequalizer</b>
object is constructed and after the <i>setparams</i> method is called,
the filter will 'inherit' coefficients from a different type, which
may or may not produce desirable effects.
</dd>

<br>
<br>
<b>void Oequalizer::setparams(</b><i>float freq, float Q[, float gain]</i><b>)</b>
<br>
<br>
<dd>
<i>freq</i> sets the cutoff frequency (in Hz) for low-pass, high-pass,
low-shelf and high-shelf filters.  It sets the midpoint of the passband
for band-pass and notch filters.
<br>
<i>Q</i> sets the steepness of the rolloff or the narrowness of the
passband of the filter.  This number usually ranges from 0.0 to 10.0 (or
more).
<br>
<i>gain</i> [optional] sets the amount of boost or cut (positive or
negative dB) for the peaking and shelf-type filters.
</dd>


<br>
<br>
<b>void Oequalizer::clear()</b>
<br>
<br>
<dd>
will set all filter coefficients to 0.0.
</dd>

<br>
<br>
<b>float Oequalizer::next(</b><i>float input</i><b>)</b>
<br>
<br>
<dd>
returns a floating-point sample value from the
biquad filter and places an incoming sample into the
filter equation (<i>input</i>).
</dd>

<br>
<br>
<b>float Oequalizer::last()</b>
<br>
<br>
<dd>
returns the last (previous) output of the <b>Oequalizer</b> filter.
</dd>

</ul>
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Ougens.h&gt;

Oequalizer *theFilt;

int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	theFilt = new Oequalizer(SR, OeqBandPass);
	theFilt->setparams(700.0, 2.0); // 700 Hz midpoint, "Q" of 2.0

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
		out[0] = theFilt->next(sample);
	}

	...

}
</pre>
</ul>

<br>
<hr><h3>See Also</h3>
<ul>
<a href="Oonepole.php">Oonepole</a>,
<a href="Oreson.php">Oreson</a>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
