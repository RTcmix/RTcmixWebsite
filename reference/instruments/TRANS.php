<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - TRANS</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>TRANS</b> -- pitch-transposiion using cubic spline interpolation
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>TRANS</b>(outsk, insk, dur, AMP, TRANSP[, inputchan, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = output duration (or endtime if negative) (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = interval of transposition (oct.pc)
   p5 = input channel [optional; default is 0]
   p6 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   p3 (amplitude), p4 (transposition) and p6 (pan) can receive dynamic updates
   from a table or real-time control source.

   Author: Doug Scott; rev. by John Gibson, 2/29/00;  rev. for v4 by JG, 3/27/05
</pre>
<br>
<hr>
<br>

<b>TRANS</b> transposes the input for the specified output duration (p2),
starting at the input start time (p1).  <b>TRANS</b> uses second-order
polynomial interpolation to accomplish this.


<a name="usage_notes"></a>
<h3>Usage Notes</h3>

<b>TRANS</b> does not maintain the input duration, so it's sort of like
changing tape speed. To transpose down, it interpolates samples between
existing ones; to transpose up, it discards some existing samples.
When transposing up, then, it must consume more than outdur seconds
of samples, and this means that it's possible to reach the end of
the input file.  <b>TRANS</b> will stop processing if that occurs.
<p>
This also means that you can use this instrument only with input from a
sound file, not with a real-time input (microphone or aux bus) -- at
least not without hearing clicks. (That's because you can't read samples
that haven't happened yet.)
<p>
The transposition is given in oct.pc notation, so that a "TRANSP" (p4)
value of 0.01 will transpose the input up by one semitone, a value
of -0.07 will transpose down by a fifth, and a value of 1.0225 will
shift the signal up by an octave + a whole tone + a quarter tone.
<p>
Be careful when dynamically updating the transposition as the mod-12
arithmetic used in oct.pc notation may yield undesired results
(i.e. going linearly down from 8.00, the next step might be 7.99
which is 99 semitones above octave 7 in oct.pc notation).
It is best to work with linear octaves or direct frequency (Hz)
specification for control-envelope changes.
<p>
Because you specify the output duration for the note, you will
need to calculate how long a given input will shift depending
on the transposition if you want to process an entire input
event.  You can do this using the
<a href="/reference/scorefile/translen.php">translen</a>
scorefile command.
<p>
<b>TRANS</b> can produce both mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("TRANS")

   rtinput("mysound.aif")

   trans = -0.02
   // do both channels of a stereo input file
   TRANS(outskip=1, inskip=2, dur=4, amp=1, trans, inchan=0, pan=0)
   TRANS(outskip=1, inskip=2, dur=4, amp=1, trans, inchan=1, pan=1)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("TRANS")
   
   rtinput("mysound.aif")

   start = 0
   inskip = 0
   dur = 7.8
   amp = 1.0
   ampenv = maketable("line", 1000, 0,0, 1,1, 7,1, 7.8,0)

   low = octpch(-0.05)
   high = octpch(0.03)
   transp = maketable("line", "nonorm", 1000, 0,0, 1,low, 3,high)
   transp = makeconverter(transp, "pchoct")

   /*
   This transposition starts at 0, moves down by a perfect fourth (-0.05),
   then up to a minor third (0.03) above the starting transposition.  The
   table is expressed in linear octaves, then converted to octave.pc by the
   call to makeconverter.
   */
   TRANS(start, inskip, dur, amp*ampenv, transp)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeconverter.php">makeconverter</a>,
<a href="MOCKBEND.php">MOCKBEND</a>,
<a href="SCRUB.php">SCRUB</a>,
<a href="TRANS3.php">TRANS3</a>,
<a href="TRANSBEND.php">TRANSBEND</a>,
<a href="PVOC.php">PVOC</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

