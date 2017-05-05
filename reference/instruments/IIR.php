<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - IIR</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>IIR</b> -- infinite impulse response filter
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>setup</b>(centfreq1, bandwidth1, amp1, centfreq2, bandwidth2, amp2, ...)
	<br><br>
	<b>INPUTSIG</b>(outsk, insk, dur, AMP[, inputchan, PAN])
	<br><br>
	<b>IINOISE</b>(outsk, dur, AMP[, PAN])
	<br><br>
	<b>BUZZ</b>(outsk, dur, AMP, PITCH (Hz/oct.pc)[, PAN])
	<br><br>
	<b>PULSE</b>(outsk, dur, AMP, PITCH (Hz/oct.pc)[, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<b>IIR</b> consists of a set of sub-instruments that draw upon
a subcommand (<b>setup</b>) for filter design parameters.
<br>
<br>
<br>

<a name="setup"></a>
<b>setup</b>
<br>
<pre>
   The pfields for <b>setup</b> are triples, the first being the center frequency
   of an IIR filter "hump" (in Hz), the second being the bandwidth of the
   "hump" (Hz, or if negative a multiplier of the center frequency), and
   the third being the relative amplitude of that "hump" in the final
   constructed filter.  Up to 64 cf-bw-amp triples can be specified.
</pre>
<br>

<a name="INPUTSIG"></a>
<b>INPUTSIG</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = input channel [optional, default is 0]
   p5 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   p3 (amplitude) and p5 (pan) can receive dynamic updates from a table
   or real-time control source.
</pre>
<br>


<a name="IINOISE"></a>
<b>IINOISE</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amp (absolute, for 16-bit soundfiles: 0-32768)
   p3 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   p2 (amplitude) and p3 (pan) can receive dynamic updates from a table
   or real-time control source.
</pre>
<br>

<a name="BUZZ"></a>
<b>BUZZ</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amp (absolute, for 16-bit soundfiles: 0-32768)
   p3 = pitch (Hz or oct.pc *) (see note below)
   p4 = pan (in percent-to-left form: 0-1) [optional, default is 0] 

   p2 (amplitude), p3 (pitch) and p4 (pan) can receive dynamic updates
   from a table or real-time control source.

   * If the value of p3 field is < 15.0, it assumes oct.pc.  Use the <a href="/reference/scorefile/pchcps.php">pchcps</a>
   scorefile convertor for direct frequency specification below 15.0 Hz.
</pre>
<br>

<a name="PULSE"></a>
<b>PULSE</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amp (absolute, for 16-bit soundfiles: 0-32768)
   p3 = pitch (Hz or oct.pc *) (see note below)
   p4 = pan (in percent-to-left form: 0-1) [optional, default is 0]

   p2 (amplitude), p3 (pitch) and p4 (pan) can receive dynamic updates
   from a table or real-time control source.

   * If the value of p3 field is < 15.0, it assumes oct.pc.  Use the <a href="/reference/scorefile/pchcps.php">pchcps</a>
   scorefile convertor for direct frequency specification below 15.0 Hz.

   rev. for v4.0 of all the above by JGG, 7/10/04
</pre>
<br>
<hr>
<br>

<b>IIR</b> sets up an infinite impulse response (or recursive) filter with
center frequency, bandwidth, and amplitude boost defined in triplets by the
<b>setup</b> subcommand.  <b>IIR</b> can take as its input a soundfile
(<b>INPUTSIG</b>), white noise (<b>IINOISE</b>), a pulse train
(<b>PULSE</b>), or a buzzing signal (<b>BUZZ</b>).  <b>IIR</b> filters
are excited based on previous output samples as well as previous input
samples, so that they can ring down infinitely using the equation:
<ul>
&nbsp&nbsp&nbsp<tt>y(n)=a<sub>0</sub>x(n)-b<sub>1</sub>y(n-1)-b<sub>2</sub>y(n-2)...b<sub>N</sub>y(n-N)</tt><br>
</ul>
where <i>y</i> is an output sample at time <i>n</i>, <i>x</i> is an input
sample, and <i>a<sub>0</sub></i> and <i>b<sub>N</sub></i> are filter
coefficients that are determined by the shape of the filter desired
(blatantly stolen from Dodge and Jerse, 1985).  The number of coefficients
used based on past output samples is called the number of <i>poles</i> in
the filter.  <b>IIR</b> uses a standard 4-pole filter equation.
At least, that's what we'd like you to think.

<h3>Usage Notes</h3>

<b>IIR</b> is an older instrument, reflected in the 'subcommand' structure
of the setup and instrument calls in the score.  It has largely
been superceded by the
<a href="FILTERBANK.php">FILTERBANK</a>
instrument which allows more control (pfield-enabled) flexibility.
However, <b>FILTERBANK</b> does not have the <b>BUZZ</b> and <b>PULSE</b>
capabilities.  Both are useful for simulating speech-like sounds for formant
processing in <b>IIR</b>.
<p>
<b>BUZZ</b> generates a waveform consisting of all harmonic partials at
relative amplitude 1.0 between the specified pitch and the Nyquist
frequency.  <b>PULSE</b> generates a unit impulse at the specified
frequency and pitch.  Although they are similar, there are differences
in the sound related to the band-limited nature of <b>BUZZ</b> as
opposed to <b>PULSE</b>.
<p>
For the pitch specification,
oct.pc format generally will not work as you expect for p3 (osc freq)
if the pfield changes dynamically because of the 'mod 12' aspect of
the pitch-class (.pc) specification.  Use direct frequency (hz) or
linear octaves instead.
<p>
The <b>IIR</b> instruments can produce either stereo or mono output.
<p>
NOTE:  Older versions of the <b>IIR</b> family of commands used
<b>NOISE</b> instead of <b>IINOISE</b>.  Unfortunately this conflicted
with the generic RTcmix instrument
<a href="NOISE.php">NOISE</a>,
so the name was changed.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 1)
   load("IIR")

   rtinput("mysoundfile.aif")

   ampenv = maketable("line", 1000, 0,0, 1,1, 5,1, 7,0)
   setup(149.0, 25.0, 1.0, 1415.0, 100.0, 0.8)
   INPUTSIG(0, 0, 7, 0.25*ampenv, 0)

   setup(90.0, -0.5, 1.0, 1000.0, -0.1, 0.8)
   INPUTSIG(8, 0, 7, 0.15, 0)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("IIR")

   ampenv = maketable("line", 1000, 0,0, 0.2,1, 0.3,0)

   start = 0
   for(pc = 0; pc < 0.25; pc = pc + 0.01) {
      setup(8.00 + pc, 1.0, 1.0)
      IINOISE(start, 0.3, 15000*ampenv, random())
      start = start + 0.1
   }
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2)
   load("IIR")

   env = maketable("window", 1000, "hanning")

   pitch = 134.0
   for(start = 0; start < 7.8; start = start + 0.1) {
      setup((random()*2000.0) + 300.0, -0.5, 1)

      BUZZ(start, 0.1, 40000*env, pitch, random())
      BUZZ(start, 0.1, 40000*env, pitch + 2.5, random())
      pitch = pitch + 0.5
   }

   for(start = 7.8; start < 15; start = start + 0.1) {
      setup((random()*2000.0) + 200.0, -0.5, 1)

      PULSE(start, 0.1, 40000*env, pitch, random())
      PULSE(start, 0.1, 40000*env, pitch + 2.5, random())
      pitch = pitch - 0.5
   }
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="BUTTER.php">BUTTER</a>,
<a href="ELL.php">ELL</a>,
<a href="EQ.php">EQ</a>,
<a href="FILTERBANK.php">FILTERBANK</a>,
<a href="FILTSWEEP.php">FILTSWEEP</a>,
<a href="FIR.php">FIR</a>,
<a href="JFIR.php">JFIR</a>,
<a href="MOOGVCF.php">MOOGVCF</a>,
<a href="MULTEQ.php">MULTEQ</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

