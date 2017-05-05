<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - AMINST</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>AMINST</b> -- amplitude modulation synthesis
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>AMINST</b>(outsk, dur, AMP, CARFREQ, MODFREQ[, PAN, MODAMPENV, CARWAVETABLE, MODWAVETABLE])
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = carrier frequency (Hz)
   p4 = modulation frequency (Hz)
   p5 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]
   p6 = modulator amplitude [optional; default is 1.0 (full amplitude)]
   p7 = reference to carrier wavetable [optional; defaults to sine wave]
   p8 = reference to modulator wavetable [optional; defaults to sine wave]

   p2 (amplitude), p3 (carrier freq), p4 (modulator freq) p5 (pan) and p6 (modulator amp)
   can receive dynamic updates from a table or real-time control source.

   p7 (carrier wavetable) and p8 (modulator wavetable), if used, should be
   references to pfield table-handles.

   Author Brad Garton; rev for v4, JGG, 7/22/04
</pre>
<br>
<hr>
<br>

<b>AMINST</b>
synthesizes a sound using amplitude modulation,
a type of modulation where a carrier signal (of frequency <i>C</i>
is varied by a modulator signal (of frequency <i>M</i>)
such that two sidebands are produced of frequency <i>C + M</i>
and frequency <i>C - M</i>.  This results from multiplying the
amplitude of the carrier signal by the amplitude of the modulator
signal.  The operation is simple, each instantaneous sample value of
the carrier is multiplied by the corresponding sample value of the modulator.
<p>
At low modulator frequency rates (&lt; 20 Hz) this is perceived as
an amplitude 'tremolo' of the carrier signal.  At higher rates the sidebands
manifest as audio components in a more complex spectrum.
<p>
If non-sinusoidal waveforms are used, each sine-wave component acts
as a separate carrier or modulator.  Each sine-wave partial in
the signal(s) will have distinct <i>C + M</i> and <i>C + M</i>
components in the resulting spectrum.

<h3>Usage Notes</h3>

Depending on the amplitude of modulator, the original carrier frequency
component will be present in the resulting sound.  Negative frequencies
resulting from the AM operation 'wrap' around 0 Hz and appear as
positive components 180 degrees out of phase.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 1)
   load("AMINST")

   // use defaults to produce a signal with components at
   // 178.0 + 315.0 Hz, 178.0 - 315.0 Hz, and 178.0 Hz)
   AMINST(0, 3.5, 10000, 178, 315)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 1)
   load("AMINST")

   ampenv = maketable("line", 1000, 0,0, 1,1, 9,1, 10,0)
   modenv = maketable("line", 1000, 0,0, 1,1, 2,0)
   AMINST(3.9, 3.4, 10000*ampenv, cpspch(8.00), cpspch(8.02), 0, modenv)
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2)
   load("AMINST")

   ampenv = maketable("line", 1000, 0,1, 10,0)
   carfreq = makeLFO("sawup", 0.9, 100, 500)
   modfreq = makeLFO("sawdown", 0.7, 250, 1400)
   carwave = maketable("wave", 1000, "saw3")
   modwave = maketable("wave", 1000, "square")
   panner = makeLFO("sine", 0.5, 0, 1)
   AMINST(0, 7, 20000*ampenv, carfreq, modfreq, panner, 1.0,  carwave, modwave)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeLFO.php">makeLFO</a>,
<a href="AM.php">AM</a>,
<a href="FMINST.php">FMINST</a>,
<a href="HALFWAVE.php">HALFWAVE</a>,
<a href="MULTIWAVE.php">MULTIWAVE</a>,
<a href="SYNC.php">SYNC</a>,
<a href="VWAVE.php">VWAVE</a>,
<a href="WAVESHAPE.php">WAVESHAPE</a>,
<a href="WAVY.php">WAVY</a>,
<a href="WIGGLE.php">WIGGLE</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
