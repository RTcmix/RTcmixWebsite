<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MOCKBEND</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MOCKBEND</b> -- cubic spline dynamic pitch-shifter
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MOCKBEND</b>(outsk, insk, dur, amp, pitchenvgenno[, inputchan, pan])
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
   p4 = function table number for pitch envelope
   p5 = input channel [optional, default is 0]
   p6 = percent to left [optional, default is .5]
	Assumes gen table 1 is amplitude curve for the note.

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sysystem should be used:

   assumes function table 1 is the amplitude envelope

   Author:  Ivica Ico Bukvic (based on Doug Scott's <a href="TRANSBEND.php">TRANSBEND</a> instrument)
</pre>
<br>
<hr>
<br>

<b>MOCKBEND</b> performs a time-varying pitch transposition on a mono input
signal (channel-selectable) using cubic spline interpolation 

<h3>Usage Notes</h3>

<b>MOCKBEND</b> is a version of
<a href="TRANSBEND.php">TRANSBEND</a>
designed to work with real-time input sources, such as a microphone or aux bus.
It processes only one channel at a time.
<p>
<b>MOCKBEND</b> uses the older
<a href="/reference/scorefile/makegen.php">makegen</a>
control envelope system to specify the pitch-transposition envelope.
It uses the function table specified by p4 for this data.
The interval values in this table are expressed in linear octaves
(<a href="/reference/scorefile/gen2.php">makegen(2, ...)</a> is probably
best for this).
<p>
<b>MOCKBEND</b> can produce either mono or stereo output.

<h3>Sample Scores</h3>

basic use:
<pre>
   rtsetparams(44100, 2)
   load("MOCKBEND")

   rtinput("mysoundfile.aif")
   
   dur = DUR(0)
   amp = 1.5
   pan = 0.5
   
   /* amplitude curve */
   setline(0,0, 1,1, 90,1, 100,0)
   
   /* transpose from 4 semitones up to 8 down - stored in gen slot 2 */
   makegen(-2, 18, 512, 1,.4, 512,-.8)
   
   MOCKBEND(0, 0, dur, amp, 2, 0, pan)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="PVOC.php">PVOC</a>,
<a href="SCRUB.php">SCRUB</a>,
<a href="TRANS.php">TRANS</a>,
<a href="TRANS3.php">TRANS3</a>,
<a href="TRANSBEND.php">TRANSBEND</a>
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

