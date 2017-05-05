<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - TRANSBEND</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>TRANSBEND</b> -- time-varying pitch transposition
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>TRANSBEND</b>(outsk, insk, dur, amp, pitchenvgenno[, inputchan, pan])
	<ul>
   This instrument has no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
   default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = output duration (or endtime if negative) (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = function table number for pitch transposition control envelope
   p5 = input channel [optional; default is 0]
   p6 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sysystem should be used:

   assumes function table 1 is the amplitude envelope

   Author: Doug Scott 9/3/2000
</pre>
<br>
<hr>
<br>

<b>TRANSBEND</b> performs a time-varying transposition on an input signal 
using cubic spline interpolation.  This is essentially the same thing as
<a href="TRANS.php">TRANS</a>, except that you can change the transposition
factor dynamically using
the older
<a href="/reference/scorefile/makegen.php">makegen</a>
control envelope sysystem.

<h3>Usage Notes</h3>

Because of the new
<a href="pfield-enabled.php">pfield-enabled</a>
control envelope system, <b>TRANSBEND</b> has now been largely superceded
by the
<a href="TRANS.php">TRANS</a>
and
<a href="TRANS3.php">TRANS3</a>
instruments.  The paramters of <b>TRANSBEND</b> are the same as
with these instruments.
See the
<a href="TRANS.php#usage_notes">TRANS Usage Notes</a>
for more information.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("TRANSBEND")
   
   rtinput("mysound.snd")
   
   dur = DUR(0)
   amp = 1
   pan = 0.5
   
   /* amplitude curve */
   setline(0,0, 1, 1, 90, 1, 100, 0)
   
   /* transpose from 4 semitones up to 8 down - stored in gen slot 2 */
   makegen(-2, 18, 512, 1,.04, 512,-.08)
   
   TRANSBEND(0, 0, dur, amp, 2, 0, pan)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="MOCKBEND.php">MOCKBEND</a>,
<a href="SCRUB.php">SCRUB</a>,
<a href="TRANS.php">TRANS</a>,
<a href="TRANS3.php">TRANS3</a>,
<a href="PVOC.php">PVOC</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

