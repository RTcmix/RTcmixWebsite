<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - FLANGE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>FLANGE</b> -- moving comb or notch filter
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>FLANGE</b>(outsk, insk, dur, AMP, RESONANCE, maxdelay, MODDEPTH, MODRATE, SIGNALMIX[, FLANGETYPE, inputchan, PAN, ringdowndur, MODWAVETABLE])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0  = output start time (seconds)
   p1  = input start time (seconds)
   p2  = duration (seconds)
   p3  = amplitude multiplier (relative multiplier of input signal)
   p4  = resonance (can be negative)
   p5  = maximum delay time (seconds) (determines lowest pitch; try: 1.0 / cpspch(8.00))
   p6  = modulation depth (0 - 100%)
   p7  = modulation rate (Hz)
   p8  = wet/dry mix (0: dry --> 1: wet)  [optional; default is 0.5]
   p9  = flanger type ("IIR" is IIR comb, "FIR" is FIR notch; or
      numeric codes for the flanger type (0: "IIR", 1: "FIR") [optional; default is "IIR"]
   p10 = input channel  [optional; default is 0]
   p11 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]
   p12 = ring-down duration [optional; default is resonance value]
   p13 = reference to modulator wavetable [optional; defaults to sine wave]

   p3 (amplitude), p4 (resonance), p6 (modulation depth), p7 (modulation rate),
   p8 (wet/dry mix), p9 (flanger type) and p11 (pan) can receive dynamic updates
   from a table or real-time control source.  p9 (flanger type) can be updated
   only when using numeric codes.

   p13 (modulator wavetable), if used, should be a reference to a pfield table-handle.

   Author: John Gibson, 7/21/99; rev for v4, JGG, 7/24/04
</pre>
<br>
<hr>
<br>


<b>FLANGE</b> implements a relatively standard flanging
(short moving delay), using either notch or comb filter.

<h3>Usage Notes</h3>


<b>FLANGE</b>
is a moving short delay-line, generating that ever-popular 'flanging'
effect.  The flanger can be set to use a notch or a comb filter,
and the modulation waveform, depth, and speed are all user-controlled.
<p>
the "RESONANCE" parameter (p4) may be positive or negative.  If negative,
the signal will be inverted each time it is sent through the regenerative
delay line.  The effect is slightly different.
<p>
p7 ("MODRATE") is usually a low-frequency oscillator (&lt; 20 Hz), but it
doesn't have to be.
<p>
The type of flanger (p9, "FLANGETYPE") may only be changed dynamically if
it is specified using numeric codes.
<p>
The point of the ring-down duration parameter (p12) is to let you control
how long the flanger will ring after the input has stopped.  If you set p12
to zero, then <b>FLANGE</b> will try to figure
out the correct ring-down duration
for you.  This will almost always be fine.  However, if resonance is dynamic,
there are cases where <b>FLANGE</b>'s estimate of the ring duration will be too
short, and your sound will cut off prematurely.  Use p12 to extend the duration.
<p>
The output of <b>FLANGE</b> can be either mono or stereo.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("FLANGE")
   
   rtinput("mysound.wav")

   inchan = 0
   inskip = 0
   dur = DUR()
   amp = 1.0
   
   resonance = 0.06
   lowpitch = 7.00
   moddepth = 70
   modspeed = maketable("line", "nonorm", 100, 0,4, 1,.1)
   wetdrymix = 0.5
   flangetype = "IIR"
   pan = 0.5
   
   maxdelay = 1.0 / cpspch(lowpitch)
   
   FLANGE(outskip=0, inskip, dur, amp, resonance, maxdelay, moddepth, modspeed,
      wetdrymix, flangetype)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("FLANGE")
   
   rtinput("mysound.aif")

   inchan = 0
   
   start = 0
   inskip = 0
   dur = DUR()
   amp = 0.7
   
   resonance = 0.10
   lowpitch = 8.00
   moddepth = 80
   modspeed = 0.5
   wetdrymix = 0.5
   flangetype = "IIR"
   rightchandelay = 0.08
   ringdur = 0		// let inst figure it out
   
   waveform = maketable("wave", 1000, "sine")
   
   maxdelay = 1.0 / cpspch(lowpitch)
   FLANGE(start, inskip, dur, amp, resonance, maxdelay, moddepth, modspeed,
      wetdrymix, flangetype, inchan, pan=1, ringdur, waveform)
   
   // 45 deg out of phase with left chan sine
   waveform = maketable("wave3", 1000, 1, 1, 45)
   
   start += rightchandelay
   maxdelay *= 1.0001
   FLANGE(start, inskip, dur, amp, resonance, maxdelay, moddepth, modspeed,
      wetdrymix, flangetype, inchan, pan=0, ringdur, waveform)
</pre>
<br>
<br>

fun stuff!
<pre>
   /* This script imposes a trill of a major 2nd onto the input file. */
   rtsetparams(44100, 2)
   load("FLANGE")
   
   rtinput("mysound.aif")

   inchan = 0
   inskip = 0
   dur = DUR()
   amp = 0.4
   
   resonance = 1.0 /* how "ringy" are trill pitches? */
   lowpitch = 8.00 /* lower pitch of major 2nd */
   moddepth = 11.5 /* somehow makes a major 2nd above low pitch  ;-) */
   modspeed = 6.0  /* speed of trill */
   wetdrymix = 0.4 /* how prominent is trill? */
   
   // make an "ideal" square wave
   waveform = maketable("wave", 1000, "square")
   
   maxdelay = 1.0 / cpspch(lowpitch)
   
   FLANGE(0, inskip, dur, amp, resonance, maxdelay, moddepth, modspeed,
      wetdrymix, "IIR", inchan, pan=1, ringdur=0, waveform)
   
   FLANGE(.1, inskip, dur, amp, resonance, maxdelay, moddepth, modspeed,
      wetdrymix, "IIR", inchan, pan=0, ringdur=0, waveform)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="AM.php">AM</a>,
<a href="COMBIT.php">COMBIT</a>,
<a href="DELAY.php">DELAY</a>,
<a href="JDELAY.php">JDELAY</a>,
<a href="MOCKBEND.php">MOCKBEND</a>,
<a href="MULTICOMB.php">MULTICOMB</a>,
<a href="PANECHO.php">PANECHO</a>,
<a href="SHAPE.php">SHAPE/a>,
<a href="TRANS.php">TRANS/a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


