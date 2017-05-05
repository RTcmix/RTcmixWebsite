<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - WAVESHAPE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>WAVESHAPE</b> -- waveshape distortion synthesis
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>WAVESHAPE</b>(outsk, dur, PITCH, INDEXMIN, INDEXMAX, AMP, PAN, WAVETABLE, TRANSFERFUNCTION, INDEXENV[, ampnormalize])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = start time (seconds)
   p1 = duration (seconds)
   p2 = pitch (Hz or oct.pc *) (see note below)
   p3 = minimum distortion index (0.0-1.0)
   p4 = maximum distortion index (0.0-1.0)
   p5 = amp (absolute, for 16-bit soundfiles: 0-32768)
   p6 = pan (0-1 stereo; 0.5 is middle)
   p7 = reference to oscillator waveform table
   p8 = reference to waveshaping transfer function table
   p9 = index control envelope
   p10 = amp normalization [optional; default is on (1)]

   p2 (freq), p3 (min index), p4 (max index), p5 (amp), p6 (pan) and
   p9 (index) can receive dynamic updates from a table or real-time
   control source.

   p7 (waveform) and p8 (transfer function) should be references to pfield table-handles.

   Author: Brad Garton; rev for v4, JGG, 7/22/04
</pre>
<br>
<hr>
<br>

<b>WAVESHAPE</b> produces sound using <i>waveshaping</i>,
a type of distortion synthesis where an input waveform is modified by a
<i>transfer function</i> to produce an output signal.


<a name="usage_notes"</a>
<h3>Usage Notes</h3>

The technical description of waveshaping is that
an input signal, <i>x</i>, puts out an output signal, <i>y</i>, by
passing through a function defined as <tt>y = f(x)</tt>.
So, for example,
<tt>f(x) = x<sup>2</sup></tt> will exponentially expand the amplitude of the incoming waveform (Dodge and Jerse, 1985).
<p>
What does this mean?  Imagine a transfer function as a line drawn
on a cartesian coordinate system:
<center>
<br>
<img src="images/waveshape1.jpg">
</center>
<br>
The x-axis is where the input values from the signal are located.
These are then mapped onto te y-axis -- the output values -- by mapping
from the x-axis to the transfer function curve and then over to the
y-axis:
<center>
<br>
<img src="images/waveshape2.jpg">
</center>
<br>
Note that if the input value goes above or below a certain point on the
above graph, the output value will remain constant even if the input
value increases beyond that point (positive or negative).  This simple
waveshaping distortion will result in "clipping" the input signal:
<center>
<br>
<img src="images/waveshape3.jpg">
</center>
<br>
<p>
The "INDEXMIN" (p3) and "INDEXMAX" (p4) set the parameters for
how the lookup/transfer function works.  In the above example, the
"INDEXMIN" was assumed to be 0.0 and the "INDEXMAX" was 1.0.  This
will use the full range of the x-axis input values, i.e. the whole
transfer function.  You may choose to use just a small portion of the
transfer function for doing the x-axis -> y-axis mapping by setting
these two values between 0.0 and 1.0.
<p>
The particular range of lookup values will also be determined by
the "INDEXENV" pfield control envelope (p9).  It determines how much of the
range between p3 and p4 is used.  Changing this dynamically can
alter the spectrum of the note through time.  For example, a control
envelope that traveled from 0.0 to 1.0 back to 0.0 for the duration
of a note with a transfer function like the one pictured above will
gradually introduce distortion into the output wave and then
gradually reduce it.  All timbres produced by <b>WAVESHAPE</b>
are harmonic spectra, however.  No non-harmonic partials can
be generated by waveshaping.
<p>
p8 (the "TRANSFERFUNCTION") is a pfield reference to a table containing
the transfer function to be used.  These are generally constructed
using the
<a href="/reference/scorefile/maketable.php">maketable</a>
scorefile command.  Of special interest is the
<a href="/reference/scorefile/maketable.php#cheby">maketable("cheby", ...)</a>
option.  Chebyshev polynomials can help design transfer functions with
particular harmonic characteristics.
<p>
The transfer-function process (called a "table lookup" by the way) also
imparts an amplitude to the signal as the "INDEXENV" travels between
0.0 and 1.0.  Because this is primarily used for determining the
spectral character of the note, you may wish to use an independent
amplitude envelope (done using the pfield-control capabilities
of the "AMP" parameter, p5).  To guarantee that a full output
results from the waveshaping, the optional "ampnormalize"
parameter (p10) can be set to 1 (this is the default, by the way).
To turn off this normalization, set it to 0.  Why would you
want to turn this off?  The amp normalization in this instrument can
cause clicks at the beginning and ending of notes if you don't
set your amplitude envelope.
<p>
Any waveform may be used as an input function.  The waveform
table is specified in p7 ("WAVETABLE").
<p>
Be aware that
oct.pc format generally will not work as you expect for p3 (pitch)
if the pfield changes dynamically because of the 'mod 12' aspect of
the pitch-class (.pc) specification.  Use direct frequency (hz) or
linear octaves instead.
<p>
<b>WAVESHAPE</b> can produce mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("WAVESHAPE")

   ampenv = maketable("line", 1000, 0,0, 3.5,1, 7,0)
   waveform = maketable("wave", 1000, "sine")
   transferfunc = maketable("linebrk", 1000, -0.5, 300, -0.5, 200, 0, 200, 0.5, 300, 0.5)
   indexfunc = maketable("line", 1000, 0,0, 3.5,1, 7,0)

   WAVESHAPE(0, 7, 7.02, 0, 1, 20000*ampenv, 0.3, waveform, transferfunc, indexfunc)
   WAVESHAPE(0, 7, 7.021, 0, 1, 20000*ampenv, 0.7, waveform, transferfunc, indexfunc)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("WAVESHAPE")

   ampenv = maketable("line", 1000, 0,0, 3.5,1, 7,0)
   waveform = maketable("wave", 1000, "sine")
   transferfunc = maketable("cheby", 1000, 0.9, 0.3, -0.2, 0.6, -0.7)
   indexfunc = maketable("line", 1000, 0,0, 3.5,1, 7,0)

   WAVESHAPE(0, 7, 7.02, 0, 1, 20000*ampenv, 0.99, waveform, transferfunc, indexfunc)

   ampenv = maketable("line", 1000, 0,0, 1.5,1, 7,0)
   indexfunc = maketable("line", 1000, 0,1, 7,0)

   WAVESHAPE(4, 7, 6.091, 0, 1, 20000*ampenv, 0.01, waveform, transferfunc, indexfunc)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/pchcps.php">pchcps</a>,
<a href="MULTWAVE.php">MULTIWAVE</a>,
<a href="VWAVE.php">VWAVE</a>,
<a href="HALFWAVE.php">HALFWAVE</a>,
<a href="SYNC.php">SYNC</a>,
<a href="WAVETABLE.php">WAVETABLE</a>,
<a href="FMINST.php">FMINST</a>,
<a href="AMINST.php">AMINST</a>,
<a href="WAVY.php">WAVY</a>,
<a href="WIGGLE.php">WIGGLE</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
