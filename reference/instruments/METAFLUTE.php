<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - METAFLUTE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>METAFLUTE</b> -- physical model flute
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>SFLUTE</b>(outskip, dur, noiseamp, length1 (samples), length2 (samples), amp[, pan])<br>
	<br> <br>
	<b>VSFLUTE</b>(outskip, dur, noiseamp, length1low (samples), length1high (samples), length2low (samples), length2high (samples), amp, vibfreq1low (Hz), vibfreq1high (Hz), vibfreq2low (Hz), vibfreq2high (Hz)[, pan])<br>
	<br> <br>
	<b>BSFLUTE</b>(outskip, dur, noiseamp, length1low (samples), length1high (samples), length2low (samples), length2high (samples), amp[, pan])<br>
	<br> <br>
	<b>LSFLUTE</b>(outskip, dur, noiseamp, length1 (samples), length2 (samples), amp[, pan])<br>
	<ul>
   These instruments have no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
   default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

<b>METAFLUTE</b> is a family of instruments implmenting a physical model
of a flute.  The different versions allow for pitch-bending (<b>BSFLUTE</b>,
vibrato (<b>VSFLUTE</b>), and an 'unarticulated' (legato)
attack (<b>LSFLUTE</b> -- <b>SFLUTE</b> is the basic model).
<br>
<br>
<br>


<a name="SFLUTE"></a>
<b>SFLUTE</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = noise amplitude (relative to overall amplitude; usually 0-1)
   p3 = length1 (samples, usually 5-200)
   p4 = length2 (samples, usually 5-200)
   p5 = amplitude multiplier (relative multiplier of input signal)
   p6 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sysystem should be used:

   assumes function table 1 is the noise amplitude envelope
   function table 2 is the overall amplitude envelope
 
   Parameters after the [bracket] are optional and default to 0 unless
   otherwise noted.

   Author: Brad Garton
</pre>
<br>

<a name="VSFLUTE"></a>
<b>VSFLUTE</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = noise amplitude (relative to overall amplitude; usually 0-1)
   p3 = length1 low value (samples, usually 5-200)
   p4 = length1 high value (samples, usually 5-200)
   p5 = length2 low value (samples, usually 5-200)
   p6 = length2 high value (samples, usually 5-200)
   p7 = amplitude multiplier (relative multiplier of input signal)
   p8 = vibrato frequency 1 low value (Hz, usually < 20)
   p9 = vibrato frequency 1 high value (Hz, usually < 20)
   p10 = vibrato frequency 2 low value (Hz, usually < 20)
   p11 = vibrato frequency 2 high value (Hz, usually < 20)
   p12 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sysystem should be used:

   assumes function table 1 is the noise amplitude envelope
   function table 2 is the overall amplitude envelope,
   function table 3 is the vibrato waveform for length1 (between p3 and p4),
   function table 4 is the vibrato waveform for length2 (between p5 and p6)

   Parameters after the [bracket] are optional and default to 0 unless
   otherwise noted.

   Author: Brad Garton
</pre>
<br>

<a name="BSFLUTE"></a>
<b>BSFLUTE</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = noise amplitude (relative to overall amplitude; usually 0-1)
   p3 = length1 low value (samples, usually 5-200)
   p4 = length1 high value (samples, usually 5-200)
   p5 = length2 low value (samples, usually 5-200)
   p6 = length2 high value (samples, usually 5-200)
   p7 = amplitude multiplier (relative multiplier of input signal)
   p8 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sysystem should be used:

   assumes function table 1 is the noise amplitude envelope
   function table 2 is the overall amplitude envelope,
   function table 3 is the control envelope for length1 (between p3 and p4),
   function table 4 is the control envelope for length2 (between p5 and p6)

   Parameters after the [bracket] are optional and default to 0 unless
   otherwise noted.

   Author: Brad Garton
</pre>
<br>

<a name="LSFLUTE"></a>
<b>LSFLUTE</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = noise amplitude (relative to overall amplitude; usually 0-1)
   p3 = length1 (samples, usually 5-200)
   p4 = length2 (samples, usually 5-200)
   p5 = amplitude multiplier (relative multiplier of input signal)
   p6 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sysystem should be used:

   assumes function table 1 is the noise amplitude envelope
   function table 2 is the overall amplitude envelope
 
   Parameters after the [bracket] are optional and default to 0 unless
   otherwise noted.

   Author: Brad Garton
</pre>
<br>


<b>METAFLUTE</b> is a physical modeling instrument based on Perry Cook's
original "Slide Flute" waveguide model.
<b>METAFLUTE</b> has several variants: a simple flute model
(<b>SFLUTE</b>), a model with pitch-bending (<b>BSFLUTE</b>), and a
model with wavetable-defined vibrato (<b>VSFLUTE</b>).
These could be consolidated into a single instrument with pfield control.
Hasn't happened yet, but probably should, because there really isn't an
equivalent in the STK instruments
(<a href="MBLOWBOTL">MBLOWBOTL</a>, etc.).
<p>
<b>LSFLUTE</b> does the same thing as <b>SFLUTE</b>, but 
without reinitializing the internal buffers, allowing you to get legato and
slurred-note effects -- just like a REAL flute!

<h3>Usage Notes</h3>

The <b>METAFLUTE</b> instruments are older, reflected in the use of
the old
<a href="/reference/scorefile/makegen.php">makegen</a>
control envelope and waveform table system as well as the use of different
instruments to accomplish tasks (pitch bending, vibrato) that could
easily be handled via pfield controls.  The modeled flutes are also
tricky to use; the tuning is dependent on the length of the slides
and the 'context' of the note when it is played.
<p>
Specifying pitch via two slide lengths isn't optimum, but that's the
way the model was constructed.  (remember this was one of the first
ones Perry did) Here is a rough tuning-table for length1 and length2
to produce a given note:
<pre>
  c8 == middle "C", 8.00 in oct.pc

  note   length1   length2
   g7      112       25
   ab7     106       24
   a7      100       19
   bb7     95        21
   b7      89        19
   c8      84        18
   db8     79        23
   d8      75        19
   eb8     70        15
   e8      67        16
   f8      63        19
   gb8     59        17
   g8      56        17
   ab8     53        25
   a8      50        16
   bb8     47        12
   b8      44        11
   c9      42        10
   db9     39        10
   d9      37        8
   eb9     35        9
   e9      33        18
   f9      31        18
   gb9     29        39
   g9      28        14
   ab9     26        15
   a9      24        17
   bb9     23        14
   b9      22        34
   c10     21        9
</pre>
These are approximate (in fact, they were done "by ear"), so your mileage
may vary.
<p>
<b>LSFLUTE</b> will not work if more than one <b>SFLUTE</b> is active.  An
<b>SFLUTE</b> note has to precede it, although it can have 0 duration.
To be honest, <b>LSFLUTE</b> isn't all that effectve (and I'm not sure
it functions properly).

<h3>Sample Scores</h3>

<b>SFLUTE</b>:
<pre>
   rtsetparams(44100, 2)
   load("METAFLUTE")

   makegen(1, 24, 1000, 0,1, 1.5,1)
   makegen(2, 24, 1000, 0,0, 0.05,1, 1.49,1, 1.5,0)
   SFLUTE(0, 1.5, 0.1, 40, 28, 7000)
   SFLUTE(1.5, 1.5, 0.1, 40, 22, 7000)
</pre>
<br>
<br>

<b>VSFLUTE</b>:
<pre>
   rtsetparams(44100, 2)
   load("METAFLUTE")
   
   makegen(1, 7, 1000, 1, 1000, 1)
   makegen(2, 7, 1000, 1, 1000, 1)
   makegen(3, 10, 1000, 1)
   makegen(4, 10, 1000, 1)
   VSFLUTE(0, 3.5, 0.1, 60,62, 30,40, 5000, 1.0,4.0, 1.0,5.0)
   VSFLUTE(4, 3.5, 0.1, 48,50, 30,45, 5000, 4.0,7.0, 3.0,5.0)
</pre>
<br>
<br>

<b>BSFLUTE</b>:
<pre>
   rtsetparams(44100, 2)
   load("METAFLUTE")

   makegen(1, 7, 1000, 1, 1000, 1)
   makegen(2, 7, 1000, 1, 1000, 1)
   makegen(3, 7, 1000, 0, 500, 1, 500, 0)
   makegen(4, 7, 1000, 0, 1000, 1)
   BSFLUTE(0, 1.5, 0.1, 40,50, 28,40, 5000)
</pre>
<br>
<br>

<b>LSFLUTE</b>:
<pre>
   rtsetparams(44100, 2) 
   load("METAFLUTE")
   
   makegen(1, 24, 1000, 0, 1, 1.5, 1)
   makegen(2, 24, 1000, 0, 1, 1.5, 1)
   SFLUTE(0.000000, 0.100000, 0.050000, 100.000000, 100.000000, 5000.000000)
   LSFLUTE(0.000000, 0.280000, 0.040000, 50.000000, 16.000000, 5000.000000)
   LSFLUTE(0.280000, 0.280000, 0.040000, 50.000000, 26.000000, 5000.000000)
   LSFLUTE(0.560000, 0.280000, 0.040000, 20.000000, 46.000000, 5000.000000)
   LSFLUTE(0.840000, 0.280000, 0.040000, 50.000000, 16.000000, 5000.000000)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/makegen.php">makegen</a>,
<a href="CLAR.php">CLAR</a>,
<a href="MBLOWBOTL.php">MBLOWBOTL</a>,
<a href="MBLOWHOLE.php">MBLOWHOLE</a>,
<a href="MBRASS.php">MBRASS</a>,
<a href="MCLAR.php">MCLAR</a>,
<a href="MSAXOFONY.php">MSAXOFONY</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

