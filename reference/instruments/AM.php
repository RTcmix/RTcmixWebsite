<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - AM</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>AM</b> -- apply amplitude or ring modulation to an input source
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>AM</b>(outsk, insk, dur, AMP, MODFREQ[, inputchan, PAN, MODWAVETABLE])
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = modulation oscillator frequency (Hz)
   p5 = input channel [optional; default is 0]
   p6 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]
   p7 = reference to AM modulator wavetable [optional; defaults to sine wave]

   p3 (amplitude), p4 (mod freq) and p6 (pan) can receive dynamic updates
   from a table or real-time control source.

   p7 (modulator wavetable), if used, should be a reference to a pfield table-handle.

   Author:  Brad Garton; rev. for v 4.0: John Gibson
</pre>
<br>
<hr>
<br>

<b>AM</b>
processes an input source using amplitude or ring modulation (see
<a href="AMINST.php">AMINST</a>
for an explanation of amplitude modulation).  An
oscillator modulates the amplitude of the source.  The waveform of
the oscillator and the frequency are set by p-fields; the frequency
can be changed dynamically as the instrument executes.  If no
waveform (wavetable) is specified (p7), an internal sine-wave
is used.

<h3>Usage Notes</h3>



<b>AM</b> can be used to do either amplitude modulation
or ring modulation, depending on whether
the modulator waveform is unipolar (no negative values) or bipolar (positive
and negative values, like a typical waveform).  A unipolar modulator does
amplitude modulation; a bipolar modulator does ring modulation.
<p>
To make a unipolar sine wave, you have to add a DC component to shift
the sine wave out of the negative area.  For example, the following
creates a sine wave that oscillates between 0 and 1:
<pre>

      wave = maketable("wave3", 1000, 0,.5,0, 1,.5,0)

</pre>
The output of <b>AM</b> can be either mono or stereo.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 1)
   load("AM")

   rtinput("mysound.aif")

   // ring modulate the entire soundfile with a 378 Hz modulator
   AM(0, 0, DUR(), 1.0, 378)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("AM")

   rtinput("mysound.aif")

   ampenv = maketable("line", 1000, 0,0, 1,1, 2,0)

   // this will modulate one section of the input file (channel 0 only)
   // and play it back amplitude-modulated at 17 Hz at stereo position 0.2,
   // and play another section back slightly later amplitude-modulated
   // at 923,5 Hz at stereo position 0.8
   // the sound will do a fade up and fade down through the ampenv PField
   AM(0.4, 0, 5.2, 1.9*ampenv, 17.0, 0, 0.2)
   AM(10.1, 0.5, 4.3, 3.5*ampenv, 923.5, 0, 0.8)
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2)
   load("AM")

   rtinput("AUDIO")

   ampenv = maketable("window", 1000, "hanning")
   freqenv = maketable("line", "nonorm", 1000, 0,100, 1,987, 2, 340, 5, 777.9)
   waveform = maketable("wave", 1000, 1, 0.2, 0.5, 0, 0.1)

   AM(0, 0, 14.0, 1*ampenv, freqenv, 0, 0.5, waveform)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeLFO.php">makeLFO</a>,
<a href="AMINST.php">AMINST</a>,
<a href="STEREO.php">STEREO</a>,
<a href="DISTORT.php">DISTORT</a>,
<a href="SHAPE.php">SHAPE</a>,
<a href="DECIMATE.php">DECIMATE</a>,
<a href="COMPLIMIT.php">COMPLIMIT</a>,
<a href="FMINST.php">FMINST</a>,
<a href="WAVY.php">WAVY</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

