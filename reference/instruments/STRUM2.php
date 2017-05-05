<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - STRUM2</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>STRUM2</b> -- tuned Karplus-Strong ("plucked string") physical model
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>STRUM2</b>(outsk, dur, AMP, PITCH, squish, decay_time[, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p3 = pitch (Hz or oct.pc *) (see note below)
   p4 = squish (0-10)
   p5 = decay time (seconds)
   p6 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   p2 (amp), p3 (pitch) and p6 (pan) can receive updates from a table or
   real-time control source.

   * If the value of p3 field is < 15.0, it assumes oct.pc.  Use the <a href="/reference/scorefile/pchcps.php">pchcps</a>
   scorefile convertor for direct frequency specification below 15.0 Hz.
</pre>
<br>
<hr>
<br>

<b>STRUM2</b> is an updated version (updated from the older
<a href="STRUM.php">STRUM</a> family of instruments) of the
Karplus-Strong "plucked string" algorithm.  The
Karplus-Strong plucked string algorithm is a subtractive synthesis
system featuring a burst of white noise, a recirculating delay line, a
lowpass filter, an allpass filter, and a snazzy recursion (see Roads, 1997).
<p>
The basic idea is that a burst of noise is pushed through a delay line,
which splits its output, sending one half as output and the rest of it
back into itself after going through a lowpass and allpass filter setup. The
result is a burst of rich sound that gradually loses its higher harmonics
as it decays (as does, interestingly enough, a plucked string).


<h3>Usage Notes</h3>


As noted above, the "pitch" parameter (p3) can be in Hz or oct.pc form.
The decision is based upon the value being &lt; 15.0 (&lt; 15.0 will be
interpreted as oct.pc).
<p>
The "squish" parameter (p4) tells how "squishy" is the item
being used to pluck the string.  Values are integers ranging from 0 to 10
The lower the value, the harder the plucking object (0 is like
plucking with a steel pick).  The higher, the more "fleshy" (fat fingers!)
<p>
The "decay_time" parameter (p5) sets the time for the decay of the
fundamental frequency in the synthesis algorithm.  Usually this is the same
as the duration of the note (p1), but shorter times can give a 'damped'
effect, where longer times can yield a more sustained string sound.
If p5 is &gt; p1, it's generally a good idea to apply an amplitude
envelope of some kind to prevent clicks at the end of the note.
<p>
You may note that the older
<a href="STRUM.php">STRUM</a>
instruments also had a "nyquist decay" parameter.  It didn't work
well, and timbral variation is much more effective using the "squish"
parameter.
<p>
<b>STRUM2</b> can produce either mono or stereo output.

<h3>Sample Scores</h3>

basic use:
<pre>
   rtsetparams(44100, 2)
   load("STRUM2")

   STRUM2(0, 3.4, 20000, 8.00, 1, 1.0, 0.5)
</pre>
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("STRUM2")

   srand(4)

   makegen(1, 24, 1000, 0,1, 1,1) // amplitude envelope
   pitches = { 7.00, 7.02, 7.05, 7.07, 7.10, 8.00, 8.07 }
   lpitches = len(pitches)

   for (st = 0; st < 15; st = st + 0.1) {
      pindex = trand(0, lpitches)
      pitch = pitches[pindex]
      STRUM2(st, 1.0, 10000, pitch, 1, 1.0, random())
   }
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2)
   load("STRUM2")

   pitchtab = { 7.00, 7.02, 7.05, 7.07, 7.10, 8.00, 8.07 }
   pitchtablen = len(pitchtab)

   maxpitch = 0.02
   gliss = maketable("line", "nonorm", 1000, 0,0, 0.2,octpch(maxpitch), 2,0)

   srand(7)
   
   for (st = 0; st < 15; st = st + 0.2) {
      pindex = trand(0, pitchtablen)
      pitch = pitchtab[pindex]
      pitch = octpch(pitch)
      freq = makeconverter(pitch + gliss, "cpsoct")
      stereo = random()
      STRUM2(st, 1.0, 10000, freq, 1, 1, stereo)
   }
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeconverter.php">makeconverter</a>,
<a href="MSITAR.php">MSITAR</a>,
<a href="STRUM.php">STRUM</a>,
<a href="STRUMFB.php">STRUMFB</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

