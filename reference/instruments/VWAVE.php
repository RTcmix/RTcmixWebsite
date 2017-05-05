<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - VWAVE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>VWAVE</b> -- "vector" wavetable synthesis with arbitrary # of wavetables
<br>
<i>in RTcmix/insts/bgg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>VWAVE</b>(outsk, dur, PITCH, AMP, VECTOR, PAN, WAVE1, WAVE2, ... WAVEN)
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = pitch (Hz or oct.pc)
   p3 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p4 = wavetable vector guide [0.0-1.0]
   p5 = pan (0-1 stereo; 0.5 is middle)
   p6... pn = wavetable references

   p2 (pitch), p3 (amplitude), p4 (wavetable vector guide) and p5 (pan)
   can receive dynamic updates from a table or real-time control source.

   p6... pn should be references to pfield table-handles.

   Author Brad Garton, 7/2007 (based on the very first digital instrument I (Brad)
      wrote for FORTRAN MIX in 1983 :-)).
</pre>
<br>
<hr>
<br>

<b>VWAVE</b>
can fade between different wavetables aligned upon a 'vector' and controlled
by a dynamic pfield.

<h3>Usage Notes</h3>


<b>VWAVE</b> is essentially a simple wavetable oscillator, but the
wavetable being used can mix between an arbitrary number of user-created
waveforms (see the
<a href="/reference/scorefile/maketable.php">maketable</a>
scorefile command).  Beginning with parameter p6 ("WAVE1", ...), <b>VWAVE</b>
arranges these along a 'vector' (nomenclature taken from commercial
synthesis techniques) that spans the range 0.0 to 1.0.  As you select
indices along this vector using parameter p4 ("VECTOR"), the waveforms
used by <b>VWAVE</b> will fade from one to another depending upon how
many wavetables you have designated.
<p>
For example, if only two wavetables have been set (p6 and p7), then when
p4 is 0.0 <b>VWAVE</b> will use only the waveform designated in p6.  If
p4 is 1.0, <b>VWAVE</b> will use only the waveform in p7.  If p4 is
0.5, however, <b>VWAVE</b> will use a 0.5-amplitude mixture of both
the p6 wavetable and p7 wavetable.  Moving p4 along the 0.0 -- 1.0
vector will change this mix.
<p>
Suppose five different waveforms have been designated for <b>VWAVE</b>
(p6, p7, p8, p9 and p10).  A p4 value of 0.0 will use only the
p6 wavetable, a p4 value of 0.2 will use only p7, 0.4 only p8, etc.
A p4 value of 0.1 will mix half of p6 and half of p7.  Moving p4
from 0.0 -- 1.0 will 'slide through' all five waveforms.
<p>
Because p4 is
<a href="pfield-enabled.php">pfield-enabled</a>,
this 'vector' can be dynamically controlled throughout the <b>VWAVE</b>
note.
<p>
The output of <b>VWAVE</b> will be played at pitch p2 ("PITCH").
p2 can be either oct.pc or Hz (&lt; 15.0 is the switch-over from
Hz to oct.pc).
<p>
<b>VWAVE</b> can produce both mono and stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 1)
   load("VWAVE")

   w1 = maketable("wave", 1000, "sine")
   w2 = maketable("wave", 1000, "square3")
   w3 = maketable("wave", 1000, "saw")

   vec = maketable("line", 1000, 0,0, 1,1, 2,0)

   VWAVE(0, 3.5, 9.00, 20000, vec, 0, w1, w2, w3)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("VWAVE")

   srand(14)

   // initialize array
   theWs = { 1, 2, 3, 4, 5, 6, 7, 8 }

   amp = 10000

   for (i = 0; i < 8; i += 1) {
      theWs[i] = maketable("wave", 1000, random(), random(), random(), random())
   }
   vec = makeLFO("sine", 2, 0, 1)
   pcurve = maketable("line", "nonorm", 1000, 0, 0, irand(1, 5), 0.005, irand(5, 10), 0.02)
   VWAVE(0, 8.7, 7.00+pcurve, amp, vec, 0, theWs[0], theWs[1], theWs[2], theWs[3], theWs[4],
      theWs[5], theWs[6], theWs[7])


   for (i = 0; i < 8; i += 1) {
      theWs[i] = maketable("wave", 1000, random(), random(), random(), random(), random(),
         random(), random())
   }
   vec = makeLFO("sine", 0.3, 0, 1)
   pcurve = maketable("line", "nonorm", 1000, 0, 0, irand(1, 5), 0.005, irand(5, 10), 0.02)
   VWAVE(0.1, 8.7, 7.00+pcurve, amp, vec, 1, theWs[0], theWs[1], theWs[2], theWs[3],
      theWs[4], theWs[5], theWs[6], theWs[7])


   ampenv = maketable("window", 1000, "hanning")
   for (i = 0; i < 8; i += 1) {
      theWs[i] = maketable("wave", 1000, random(), random(), random(), random())
   }
   vec = makeLFO("sine", 0.2, 0, 1)
   pcurve = maketable("line", "nonorm", 1000, 0, 0, irand(1, 5), 0.005, irand(5, 10), 0.02)
   VWAVE(3, 8.7, 6.07+pcurve, amp*ampenv, vec, 1, theWs[0], theWs[1], theWs[2], theWs[3],
      theWs[4], theWs[5], theWs[6], theWs[7])


   for (i = 0; i < 8; i += 1) {
      theWs[i] = maketable("wave", 1000, random(), random(), random(), random(), random(),
         random(), random())
   }
   vec = makeLFO("sine", 4, 0, 1)
   pcurve = maketable("line", "nonorm", 1000, 0, 0, irand(1, 5), 0.005, irand(5, 10), 0.02)
   VWAVE(3.14, 8.7, 6.07+pcurve, amp*ampenv, vec, 0, theWs[0], theWs[1], theWs[2], theWs[3],
      theWs[4], theWs[5], theWs[6], theWs[7])
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeLFO.php">makeLFO</a>,
<a href="AMINST.php">AMINST</a>,
<a href="FMINST.php">FMINST</a>,
<a href="HALFWAVE.php">HALFWAVE</a>,
<a href="MULTIWAVE.php">MULTIWAVE</a>,
<a href="SYNC.php">SYNC</a>,
<a href="WAVESHAPE.php">WAVESHAPE</a>,
<a href="WAVY.php">WAVY</a>,
<a href="WIGGLE.php">WIGGLE</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

