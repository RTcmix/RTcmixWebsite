<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - ELL</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>ELL</b> -- elliptical filter
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<i>lowpass:</i>
	<br>
	<b>ellset</b>(passband, stopband, 0, ripple, attenuation)
	<br> <br>
	<i>highpass:</i>
	<br>
	<b>ellset</b>(passband, stopband, 0, ripple, attenuation)
	<br> <br>
	<i>bandpass:</i>
	<br>
	<b>ellset</b>(passbandlow, passbandhigh, stopband, ripple, attenuation)
	<br> <br>
	<b>ELL</b>(outsk, insk, dur, AMP, ringdowndur[, inputchan, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<b>ELL</b> has one subcommand (<b>ellset</b>) used to configure the
filter.
<br>
<br>
<br>

<a name="ellset"></a>
<b>ellset</b>
<pre>
   <i>for lowpass filter:</i>
   p0 = passband cutoff (Hz) (< stopband)
   p1 = stopband cutoff (Hz)
   p2 = 0
   p3 = ripple (db)  [try 0.2]
   p4 = attenuation at stopband (db)  [try 90 for a steep filter]

   <i>for hipass filter:</i>
   p0 = passband cutoff (Hz) (> stopband)
   p1 = stopband cutoff (Hz)
   p2 = 0
   p3 = ripple (db)  [try 0.2]
   p4 = attenuation at stopband (db)  [try 90 for a steep filter]

   <i>for bandpass filter:</i>
   p0  lower passband cutoff (Hz)
   p1  higher passband cutoff (Hz)
   p2  stopband cutoff, either higher or lower (Hz) (higher seems more reliable)
   p3 = ripple (db)  [try 0.2]
   p4 = attenuation at stopband (db)  [try 90 for a steep filter]
</pre>
<br>

<a name="ELL"></a>
<b>ELL</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = ring-down duration (seconds)
   p5 = input channel [optional; default is 0]
   p6 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   p3 (amplitude) and p6 (pan) can receive dynamic updates from a table
   or real-time control source.

   Author: Adapted by John Gibson from the original Cmix instrument.
   Thanks to Alistair Riddell and Ross Bencina for eliminating the f2c dependency
</pre>
</pre>
<br>
<hr>
<br>

<b>ELL</b> implements cascaded IIR filters and a built-in elliptical filter
design program.  It can create filters with very steep slopes.

<h3>Usage Notes</h3>

The <b>ellset</b> subcommand is used to design the kind of filter implemented
by <b>ELL</b>.  Depending on how the first three parameters are
configured, <b>ELL</b> will do lowpass, hipass or bandpass filtering.
The filters designed by <b>ellset</b> can have very steep cutoff slopes.
<p>
The "ripple" parameter (p3 of the <b>ellset</b> subcommand)
controls the amount of ringing in the filter. A small ripple
designs the filter to minimize ringing, whereas a large ripple (c. 20db)
causes the filter to ring very noticeably. A large ripple can sound
good with a tight bandpass, producing a fairly clear pitch.
<p>
The "ringdowndur" parameter (p4 of <b>ELL</b>) will add an amount
in seconds to the duration of the note to allow this ringing to
fade.
<p>
The "attenuation" (p4 of the <b>ellset</b> subcommand) determines how
much suppression of the signal outside the passband will occur.
<p>
The filter design program (invoked by ellset) sometimes can't fulfill
the design criteria -- a particular combination of cutoff freqs, ripple
and attenuation. If this happens, the program will die with a "Filter
design failed!" message, instead of running the job. If you ask for a
very steep cutoff and very little ripple, you may see this.
<p>
<b>ELL</b> can produce both mono and stereo output

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("ELL")
   
   rtinput("mysound.aif")
   
   outskip = 0
   inskip = 0
   endin = DUR()
   dur = endin - inskip
   amp = 0.9
   ringdur = 0.1
   
   p0 = 1600
   p1 = 9000
   p2 = 0
   ripple = 0.1
   attenuation = 90.0
   
   ellset(p0, p1, p2, ripple, attenuation)
   ELL(outskip, inskip, dur, amp, ringdur)
</pre>
<br>
<br>

another one:
<pre>
   rtsetparams(44100, 2)
   load("STEREO")
   load("ELL")
   
   rtinput("mysound.aif")
   inchan = 0
   inskip = 0
   dur = DUR()
   
   //----------------------------------------------
   // unprocessed signal
   
   amp = 2
   STEREO(start=0, inskip, dur, amp, pan=.5)
   
   //----------------------------------------------
   // low-pass filter
   
   pbcut = 400
   sbcut = 800
   ripple = .1
   atten = 90
   
   ellset(pbcut, sbcut, 0, ripple, atten)
   
   amp = 8
   ringdur = .1
   
   ELL(start=dur+1, inskip, dur, amp, ringdur, inchan, pan=.5)
   
   //----------------------------------------------
   // high-pass filter
   
   pbcut = 800
   sbcut = 400
   ripple = .1
   atten = 90
   
   ellset(pbcut, sbcut, 0, ripple, atten)
   
   amp = 1.6
   ringdur = .1
   
   ELL(start=start+dur+1, inskip, dur, amp, ringdur, inchan, pan=.5)
</pre>
<br>
<br>


slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("ELL")
   
   rtinput("mysound.aif")
   
   outskip = 0
   inskip = 0
   dur = DUR()
   ringdur = 3
   
   p0 = 500
   p1 = 2000
   p2 = 5000
   ripple = 45.0
   attenuation = 90.0
   
   srand(29467)
   amp = 0.05
   
   numbeats = 10
   bpm = 100
   notesperbeat = 4
   
   tempo(0, bpm * notesperbeat)
   numnotes = numbeats * notesperbeat
   
   for (i = 0; i < numnotes; i = i + 1) {
      p0 = p0 + (rand() * 20)
      p1 = p1 + (rand() * 20)
      p2 = p2 + (rand() * 20)
      ripple = ripple + (rand() * 5)
      ellset(p0, p1, p2, ripple, attenuation)
      spread = random()
      outskip = tb(i)
      ELL(outskip, inskip, dur, amp * random(), ringdur, inchan=0, spread)
   }
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2)
   load("ELL")
   
   rtinput("mysound.aif")
   inchan = 0
   inskip = 0
   dur = DUR()
   
   ripple = 20
   atten = 90
   ringdur = .2
   
   env = maketable("line", 1000, 0,0, .01,1, dur/2,1, dur,0)
   
   srand(9)
   
   for (start = 0; start < 15; start = start + .12) {
      pbcut = 400 + (rand() * 200)
      sbcut = 900 + (rand() * 200)
      ellset(pbcut, sbcut, 0, ripple, atten)
      amp = .2
      pan = random()
      st = start + (random() * .01)
      ELL(st, inskip, dur, amp * env, ringdur, inchan, pan)
   
      pbcut = 900 + (rand() * 200)
      sbcut = 400 + (rand() * 200)
      ellset(pbcut, sbcut, 0, ripple, atten)
      amp = .1
      pan = random()
      st = start + (random() * .01)
      ELL(st, inskip, dur, amp * env, ringdur, inchan, pan)
   }
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="BUTTER.php">BUTTER</a>,
<a href="EQ.php">EQ</a>,
<a href="FIR.php">FIR</a>,
<a href="FILTSWEEP.php">FILTSWEEP</a>,
<a href="FILTERBANK.php">FILTERBANK</a>,
<a href="FOLLOWBUTTER.php">FOLLOWBUTTER</a>,
<a href="IIR.php">IIR</a>,
<a href="JFIR.php">JFIR</a>,
<a href="MOOGVCF.php">MOOGVCF</a>,
<a href="MULTEQ.php">MULTEQ</a>,
<a href="SPECTEQ.php">SPECTEQ</a>,
<a href="SPECTEQ2.php">SPECTEQ2</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

