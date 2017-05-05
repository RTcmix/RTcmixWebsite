<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Ooscil/Ooscili</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>Ooscil/Ooscili</h3>
<i>INSTRUMENT design -- wavetable and function-table oscillator objects</i>
<br>
<br>
The <b>Ooscili</b> object is an interpolating wavetable and function
table unit generator used in RTcmix instrument design.  What the heck
does this mean?  It's an oscillator.  It oscillates.  The thing that
it oscillates is the wavetable or function table array.  The slightly
less-functional <b>Ooscil</b> object does pretty much the same thing except
that it does not interpolate (except for the <b>nexti</b> method
intended for use in special cases).
<p>
They can replace
the older
<a href="oscili.php">oscili</a> and
<a href="oscil.php">oscil</a>
functions used in previous
incarnations of RTcmix/cmix.  They can also partially replace
the
<a href="tablei.php">tablei</a> and
<a href="table.php">table</a> and
array/table functions used
for generating longer-span control envelopes.  This cute trick is
accomplished by creating an <b>Ooscili</b> or <b>Ooscil</b>
object with the frequency
set to <i>1.0/dur</i> where <i>dur</i> is the time-span of the
control function.
<p>
The values returned by the <b>Ooscili::next()</b> method
will be interpolated between points in the original wavetable/function
table array.  The wavetable/function table array will be accessed cyclically
at a rate determined by the frequency set for the <b>Ooscili</b> object.
Again, <b>Ooscil</b> does the same thing but no interpolation.
<hr><h3>Constructors</h3>
<ul>
<b>Ooscili(</b><i>float SR, float freq, int arrnumber</i><b>)</b>
<br>
<br>
<dd>
<u><i>SR</i></u> is the current sampling rate (an
<a href="Instrument.php">Instrument</a>
class variable).
<br>
<u><i>freq</i></u> is the frequency of the oscillator in Hz.
<br>
<u><i>arrnumber</i></u> is the number of the function/wavetable array
specified and constructed by the makegen directive in the score.
</dd>
<br>
<br>
<b>Ooscili(</b><i>float SR, float freq, double array[]</i><b>)</b>
<br>
<br>
<dd>
<u><i>SR</i></u> is the current sampling rate (an
<a href="Instrument.php">Instrument</a>
class variable).
<br>
<u><i>freq</i></u> is the frequency of the oscillator in Hz.
<br>
<u><i>array</i></u> is the name (pointer) to an array that will be used
by the <b>Ooscil</b> object for wavetable or function table lookups.
</dd>
<br>
<br>
<b>Ooscili(</b><i>float SR, float freq, double array[], int length</i><b>)</b>
<br>
<b>Ooscil(</b><i>float SR, float freq, double array[], int length</i><b>)</b>
<br>
<br>
<dd>
<u><i>SR</i></u> is the current sampling rate (an
<a href="Instrument.php">Instrument</a>
class variable).
<br>
<u><i>freq</i></u> is the frequency of the oscillator in Hz.
<br>
<u><i>array</i></u> is the name (pointer) to an array that will be used
by the <b>Ooscil</b> object for wavetable or function table lookups.
<br>
<u><i>length</i></u> is the length of the <i>array</i> to use.  Generally
this will be identical to the actual length of the <i>array</i>,
but occasionally only a portion of <i>array</i> may be desired.
</dd>
<br>
<br>
</ul>
<hr>
<h3>Access Methods</h3>
<ul>
<b>float Ooscili::next()</b>
<br>
<b>float Ooscil::next()</b>
<br>
<b>float Ooscil::nexti()</b>
<br>
<br>
<dd>
returns the next floating-point sample value from the wavetable or
function table array being oscillated.
<p>
The <b>nexti</b> method for the <b>Ooscil</b> object will interpolate
sample values like <b>Ooscili</b> always does.  For most interpolation
situations, <b>Ooscili</b> is a better choice.
</dd>
<br>
<br>
<b>float Ooscili::next(</b><i>sample_number</i><b>)</b>
<br>
<br>
<dd>
returns a floating-point sample value, but this method
is intended for when the Ooscili object is used as an
envelope or control signal generator.  This is done by
setting the frequency of oscillation to 1.0/duration, where
the duration is the length of time for the envelope or
control signal.  The "oscillator" in this case will only
scan through the wavetable or function table array once
for the total duration.  <i>sample_number</i> allows
the lookup of values along the control signal or envelope
without having to call the <b>Ooscili::next()</b> method
for every sample synthesized.
</dd>
<br>
<br>
<b>void Ooscili::setfreq(</b><i>float freq</i><b>)</b>
<br>
<b>void Ooscil::setfreq(</b><i>float freq</i><b>)</b>
<br>
<br>
<dd>
sets the frequency of the oscillator to <i>freq</i> Hz.
</dd>
<br>
<br>
<b>void Ooscili::setphase(</b><i>double phase</i><b>)</b>
<br>
<b>void Ooscil::setphase(</b><i>double phase</i><b>)</b>
<br>
<br>
<dd>
sets the phase of the oscillator to <i>phase</i>.  <i>phase</i> is
the index number into the wavetable or function table array.
</dd>
<br>
<br>
<b>int Ooscili::getlength()</b>
<br>
<b>int Ooscil::getlength()</b>
<br>
<br>
<dd>
returns the length (in samples)
of the wavetable or function table array being
used by the <b>Ooscili</b> object.
</dd>

</ul
<br>
<hr><h3>Examples</h3>
used as an oscillator:
<ul>
<pre>
#include &lt;Ougens.h&gt;

Ooscili *theOscil;

int MYINSTRUMENT::init(float p[], int n_args)
{

	...

	theOscil = new Ooscili(freq, 2); // assumes makegen 2 for waveform

	...

}

int MYINSTRUMENT::run()
{
	float out[2];

	...

	for (i = 0; i < framesToRun(); i++)
	{
		out[0] = theOscil->next();
	}

	...

}
</pre>
</ul>
<br>
used as an envelope or control signal generator:
<ul>
<pre>
#include &lt;Ougens.h&gt;

Ooscili *theEnv;

int resetsamps, resetcount;

int MYINSTRUMENT::init(float p[], int n_args)
{
	float dur;

	dur = p[2];

	...

	theEnv = new Ooscili(1.0/dur, 1); // assumes makegen 1 for envelope
	resetsamps = 100; // update the envelope only once every 100 samps
	resetcount = 0;

	...

}

int MYINSTRUMENT::run()
{
	float out[2];
	float amp;

	...

	for (i = 0; i < framesToRun(); i++)
	{
		if (resetcount >= resetsamps)  // update the envelope
		{
			amp = theEnv->next(currentFrame());
			resetcount = 0;
		}

		increment();
	}

	...

}
</pre>
</ul>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
