<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MOOGVCF</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MOOGVCF</b> -- 24dB/octave resonant lowpass filter
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MOOGVCF</b>(outsk, insk, dur, AMP, inputchan, PAN, BYPASS, FILTFREQTABLE, FILTRESONTABLE)
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = input channel
   p5 = pan (0-1 stereo; 0.5 is middle)
   p6 = bypass filter (0: bypass off, 1: bypass on) (usually use 0)
   p7 = filter cutoff frequency (Hz)
   p8 = filter resonance (0-1, 1 is more resonant.  > 1.0 will self-oscillate)

   p3 (amplitude), p5 (pan), p6 (bypass), p7 (cutoff) and p8 (resonance) can
   receive dynamic updates from a table or real-time control source.

   Author:  John Gibson, 22 May 2002; rev for v4, 7/24/04
   This is based on the design by Stilson and Smith (CCRMA), as modified
   by Paul Kellett  (described in the source code archives at <a href="http://musicdsp.org">musicdsp.org</a>).
</pre>
<br>
<hr>
<br>

<b>MOOGVCF</b> duplicates the famous "Moog" lowpass filter.

<h3>Usage Notes</h3>

One of the characteristics of this filter is a sharp resonant peak
at the lowpass cutoff frequency.  The sharpness is determined by the
"FILTRESONTABLE" pfield (p8).  Values &gt; 1.0 will cause self-oscillation
of the filter, producing a tone at the lowpass cutoff frequency.
<p>
The setting of the amplitude multiplier (p3, "AMP") can be a little tricky.
If the filter saturates (clips), it will 'explode' (i.e. produce an
infinite output -- the result is no sound).
<p>
<b>MOOGVCF</b> can produce either stereo or mono output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("WAVETABLE")
   load("MOOGVCF")

   // feed wavetable into filter
   bus_config("WAVETABLE", "aux 0 out")
   bus_config("MOOGVCF", "aux 0 in", "out 0-1")

   dur = 10.0
   amp = 10000
   pitch = 6.00
   wavet = maketable("wave", 15000, "saw30")
   WAVETABLE(0, dur, amp, pitch, 0, wavet)
   WAVETABLE(0, dur, amp, pitch+.0005, 0, wavet)

   amp = 20.0
   env = maketable("line", 1000, 0,1, 7,1, 10,0)

   lowcf = 500
   highcf = 1500
   lowres = 0.1
   highres = 0.9

   cf = maketable("line", "nonorm", 2000, 0,lowcf, dur*.2,lowcf, dur*.5,highcf, dur,lowcf)
   res = maketable("line", "nonorm", 2000, 0,lowres, 1,highres, 2,lowres)

   MOOGVCF(0, 0, dur, amp * env, inchan=0, pan=0.5, bypass=0, cf, res)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="BUTTER.php">BUTTER</a>,
<a href="ELL.php">ELL</a>,
<a href="EQ.php">EQ</a>,
<a href="FIR.php">FIR</a>,
<a href="FILTERBANK.php">FILTERBANK</a>,
<a href="FILTSWEEP.php">FILTSWEEP</a>,
<a href="FOLLOWBUTTER.php">FOLLOWBUTTER</a>,
<a href="IIR.php">IIR</a>,
<a href="JFIR.php">JFIR</a>,
<a href="FILTSWEEP.php">FILTSWEEP</a>,
<a href="MULTEQ.php">MULTEQ</a>
<a href="SPECTEQ.php">SPECTEQ</a>,
<a href="SPECTEQ2.php">SPECTEQ2</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

