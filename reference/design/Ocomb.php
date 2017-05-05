<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Ocomb/Ocombi</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>Ocomb/Ocombi</h3>
<i>INSTRUMENT design -- comb-filter (delay) objects</i>
<br>
<br>
The <b>Ocomb</b> and <b>Ocombi</b> objects are used to build
feedback delay lines known as "comb" filters.  In fact, the
<b>Ocomb</b> and <b>Ocombi</b> objects are essentially just
wrappers for the
<a href="Odelay.php">Odelay</a>
and
<a href="Odelayi.php">Odelayi</a>
objects.  However, the parameters used to set and control
the <b>Ocomb</b> and <b>Ocombi</b> objects are more convenient
for many computer-music applications.  Comb filter delays are
used extensively in room-simulation and reverberation
algorihms, and the effect has also figured prominently in
many 'classic computer music pieces.
<p>
<b>Ocomb</b> is non-interpolating,
so that requests for delay times that translate into a fractional point
between two samples will be 'rounded' to the nearest sample value.
This fractional delaying can happen quite often with
dynamically-changing delay lines, which makes <b>Ocombi</b>
probably a better choice in those cases. Shifting the delay
time of <b>Ocomb</b> may result in audio "glitches" because of
this round-off error, but these may be a desirable effect.
<b>Ocombi</b> is slightly less
efficient because of the interpolation math to calculate a fractional
sample-point.
<p>
<b>Ocomb</b> and <b>Ocombi</b> replace the older CMIX
<a href="comb.php">comb</a>
and
<a href="combset.php">combset</a>
functions.
<hr><h3>Constructors</h3>
<ul>
<b>Ocomb(</b><i>float SR, float loopTime, float reverbTime</i><b>)</b>
<br>
<br>
<dd>
<u><i>SR</i></u> is the current sampling rate (an
<a href="Instrument.php">Instrument</a>
class variable).
<br>
<u><i>loopTime</i></u> is the delay time of the comb filter (in seconds).
<br>
<u><i>reverbTime</i></u> is the length of time for the amplitude of
samples to decay 60 dB (in seconds).  This time should be > 0.0.
</dd>
<br>
<br>

<b>Ocomb(</b><i>float SR, float loopTime, float defaultLoopTime, float reverbTime, Odelay *del</i><b>)</b>
<br>
<br>
<dd>
<u><i>SR</i></u> is the current sampling rate (an
<a href="Instrument.php">Instrument</a>
class variable).
<br>
<u><i>loopTime</i></u> is the initial delay time of the comb
filter (in seconds).
<br>
<u><i>defaultLoopTime</i></u> is the expected maximum delay of the filter
filter (in seconds).
<br>
<u><i>reverbTime</i></u> is the length of time for the amplitude of
samples to decay 60 dB (in seconds).  This time should be > 0.0.
<br>
<u><i>del</i></u> is a pointer to an
<a href="Odelay.php">Odelay</a>
object.  This is useful if you want to create and manage your own
delay line for the filter.  If this value is NULL then the constructor
will allocate an internal <b>Odelay</b> object.
</dd>
<br>
<br>

<b>Ocombi(</b><i>float SR, float loopTime, float defaultLoopTime, float reverbTime</i><b>)</b>
<br>
<br>
<dd>
<u><i>SR</i></u> is the current sampling rate (an
<a href="Instrument.php">Instrument</a>
class variable).
<br>
<u><i>loopTime</i></u> is the initial delay time of the comb
filter (in seconds).
<br>
<u><i>defaultLoopTime</i></u> is the expected maximum delay of the filter
filter (in seconds).
<br>
<u><i>reverbTime</i></u> is the length of time for the amplitude of
samples to decay -60 dB (in seconds).  This time should be > 0.0.

</dd>
<br>
<br>
</ul>
<hr>
<h3>Access Methods</h3>
<ul>
<b>void Ocomb::clear()</b>
<br>
<b>void Ocombi::clear()</b>
<br>
<br>
<dd>
will clear (fill with 0.0) the delay line.
</dd>

<br>
<br>
<b>void Ocomb::setReverbTime(</b><i>float reverbTime</i><b>)</b>
<br>
<b>void Ocombi::setReverbTime(</b><i>float reverbTime</i><b>)</b>
<br>
<br>
<dd>
sets the time it takes for samples entering the comb filter delay line
to decay -60 dB in amplitude.  <i>reverbTime</i> is expressed in seconds.
Internally it is used to set a regeneration multiplier to feed samples
back into the delay line.  The multiplier is calculated to give
the desired decay time.
</dd>

<br>
<br>
<b>float Ocomb::next(</b><i>float input</i><b>)</b>
<br>
<b>float Ocombi::next(</b><i>float input</i><b>)</b>
<br>
<br>
<dd>
returns a floating-point sample value from the recirculating
comb filter delay line and places an incoming sample into the
filter (<i>input</i>).
</dd>

<br>
<br>
<b>float Ocomb::next(</b><i>float input, float delaySamps</i><b>)</b>
<br>
<b>float Ocombi::next(</b><i>float input, float delaySamps</i><b>)</b>
<br>
<br>
<dd>
returns a floating-point sample value from the recirculating
comb filter delay line and places an incoming sample into the
filter (<i>input</i>).
The <i>delaySamps</i> variable
will also resize the comb filter delay line.  This is the
mechanism used to dynamically change the 'sounding pitch'
of the comb filter.  Note that <i>delaySamps</i> is a floating-point
number of samples.  For <b>Ocomb</b> this is ignored (truncated),
for <b>Ocombi</b> it is factored in to an interpolating delay.
(see the <b>setdelay</b> methods for the
<a href="Odelay.php">Odelay</a>
and
<a href="Odelay.php">Odelayi</a>
objects).
</dd>

<br>
<br>
<b>float Ocomb::frequency()</b>
<br>
<b>float Ocombi::frequency()</b>
<br>
<br>
<dd>
returns the current frequency of the comb filter, based upon
the most recently set length of the delay line.  The returned value
is in Hz.
</dd>

</ul>
<br>
<hr><h3>Examples</h3>
<ul>
<pre>
#include &lt;Ougens.h&gt;

Ocombi *comb;

// this instrument has a delay line
int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	comb = new Ocombi(SR, loopt, loopt, rvbtime);
	if (comb->frequency() == 0.0)
		return die("COMBIT", "Failed to allocate comb memory!");

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
		out[0] = comb->next(sample);
	}

	...

}
</pre>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
