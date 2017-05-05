<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - FMINST</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>FMINST</b> -- basic FM synthesis
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>FMINST</b>(outsk, dur, AMP, CARFREQ (Hz/oct.pc), MODFREQ (Hz/oct.pc), LOWINDEX, HIGHINDEX[, PAN, WAVETABLE, INDEXENV])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = frequency of carrier (Hz or oct.pc *)
   p4 = frequency of modulator (Hz or oct.pct)
   p5 = FM index low point
   p6 = FM index high point
   p7 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]
   p8 = reference to carrier and modulator wavetable
   p9 = index envelope

   p2 (amplitude), p3 (carrier freq), p4 (modulator freq), p5 (index low),
   p6 (index high), p7 (pan) and p9 (index guide) can receive dynamic updates
   from a table or real-time control source.

   p8 (carrier/modulator wavetable), if used, should be a reference to a pfield table-handle.

   * oct.pc format generally will not work as you expect for p3 and p4
   (osc freq) if the pfield changes dynamically.  Use Hz instead in that case.

   Author Brad Garton, rev for v4, JGG, 7/12/04
</pre>
<br>
<hr>
<br>

<b>FMINST</b> creates sound output usig
<i>frequency modulation:</i> a type of distortion synthesis where the
'pitch' of one
waveform (the carrier) of frequency <tt>f<sub>c</sub></tt> is modulated
by another waveform (the modulator) with frequency
<tt>f<sub>m</sub></tt> and modulation index <tt>I</tt>
(defined by the maximum amplitude deviation of the modulator oscillator
divided by its frequency).  
The resultant sound consists of the carrier frequency as well as a number
of sidebands of frequencies
<tt>f<sub>c</sub> &plusmn <i>k</i>f<sub>m</sub></tt>,
where <i>k</i> is an integer series increasing from 0
(the carrier frequency).
The amplitude of the sidebands over time is determined by a
Bessel function of the first kind <tt>J<sub>k</sub>(I)</tt>.
The modulation index <tt>I</tt> is a rough guide to how many
sidebands will be present in the resultant signal.
Negative frequencies are possible, resulting in a
180&deg out-of-phase sideband at the absolute value of that frequency.
Negative amplitudes are also possible, resulting in a reversal of phase
at that sideband (paraphrased from Dodge and Jerse, 1985).
Note that when negative-amplitude sidebands are added to the corresponding
positive-amplitude sidebands that the resultant amplitude of the
sideband will be modified (probably reduced).

<h3>Usage Notes</h3>

FM has traditionally been considered a computationally efficient method
to create complex, time-varying spectra using just two oscillators.
A very low modulation index and/or frequency will result in vibrato on
the carrier signal.
As the modulation increases, the spectrum will become increasingly richer.
<b>FMINST</b> provides for a time-varying index of modulation based
on the index control envelope (p9) in conjunction with
p4 and p5 of the instrument (which define the low point and high points
of the index envelope).

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("FMINST")
   
   dur = 7
   amp = 30000
   carfreq = cpspch(8.00)
   modfreq = 179
   minindex = 0
   maxindex = 10
   
   env = maketable("line", 1000, 0, 0, 3.5,1, 7,0)
   wavetable = maketable("wave", 1000, "sine")
   guide = maketable("line", "nonorm", 1000, 0,1, 7,0)
   
   FMINST(0, dur, amp * env, carfreq, modfreq, minindex, maxindex, pan=0.5,
      wavetable, guide)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("FMINST")
   
   print_off()
   
   notedur = 0.5
   
   maxamp = 5000
   amp = maketable("linebrk", "nonorm", 1000, 0, 500, maxamp, 500, 0)
   
   wavetable = maketable("wave", 1000, "sine")
   guide = maketable("line", 1000, 0,1, 2,0)
   
   freq = 8.00
   for (start = 0; start < 60; start = start + 0.1) {
      pan = random()
      FMINST(start, notedur, amp, freq, 179, 0, 10, pan, wavetable, guide)
      freq = freq + 0.002
   }
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="AMINST.php">AMINST</a>,
<a href="MULTIFM.php">MULTIFM</a>,
<a href="MULTIWAVE.php">MULTIWAVE</a>,
<a href="WAVETABLE.php">WAVETABLE</a>,
<a href="WAVESHAPE.php">WAVESHAPE</a>,
<a href="WAVY.php">WAVY</a>,
<a href="WIGGLE.php">WIGGLE</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
