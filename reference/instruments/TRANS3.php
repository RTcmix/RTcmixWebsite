<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - TRANS3</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>TRANS3</b> -- pitch-transposiion using 3rd-order interpolation
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>TRANS3</b>(outsk, insk, dur, AMP, TRANSP[, inputchan, PAN])
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

   Author: Doug Scott; rev. for v4 by JG, 2/11/06
</pre>
<br>
<hr>
<br>

<b>TRANS3</b> transposes the input for the specified output duration (p2),
starting at the input start time (p1).  It has the same syntax as
<a href="TRANS.php">TRANS</a>
and is used in the same fashion.
The difference is that <b>TRANS3</b> uses 3rd-order interpolation to
achieve the pitch-shift. This is s a bit more expensive computationally,
but it does produce smoother results.

<h3>Usage Notes</h3>

The use of <b>TRANS3</b> is identical to the
<a href="TRANS.php">TRANS</a>
instrument.  See the
<a href="TRANS.php#usage_notes">TRANS Usage Notes</a>
for more information.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("TRANS") // note that TRANS3 is loaded in the TRANS library

   rtinput("mysound.aif")

   trans = -0.02
   // do both channels of a stereo input file
   TRANS3(outskip=1, inskip=2, dur=4, amp=1, trans, inchan=0, pan=0)
   TRANS3(outskip=1, inskip=2, dur=4, amp=1, trans, inchan=1, pan=1)
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
   TRANS3(start, inskip, dur, amp*ampenv, transp)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeconverter.php">makeconverter</a>,
<a href="MOCKBEND.php">MOCKBEND</a>,
<a href="SCRUB.php">SCRUB</a>,
<a href="TRANS.php">TRANS</a>,
<a href="TRANSBEND.php">TRANSBEND</a>,
<a href="PVOC.php">PVOC</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

