<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - REVMIX</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>REVMIX</b> -- play an input soundfile backwards
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>REVMIX</b>(outsk, insk, dur, AMP[, inputchan, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = input channel [optional; default is 0]
   p5 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   p3 (amplitude) and p5 (pan) can receive dynamic updates from a table or
   real-time control source.

   Author: Ivica "Ico" Bukvic, 27 May 2000
   (with John Gibson <johngibson@virginia.edu>)
   rev. for v4.0, JGG, 7/9/04
</pre>
<br>
<hr>
<br>

<b>REVMIX</b> plays a selected channel of
the input file backward for the specified duration, starting
at the input start time.

<h3>Usage Notes</h3>



If you specify a duration that would result
in an attempt to read before the start of the input file, <b>REVMIX</b>
will shorten the note to prevent this.
<p>
Note that you can't use this instrument with a real-time input
(microphone or aux bus), only with input from a sound file. (That's
because the input start time of an inst taking real-time input must
be zero, but this instrument reads backward from its inskip.)  Duh...
<p>
The output of <b>REVMIX</b> may be mono or stereo

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("REVMIX")

   rtinput("mysound.aif")

   // do both channels of a stereo input file
   REVMIX(outskip=0, inskip=5, dur=3, amp=1, inchan=0, loc=0.0)
   REVMIX(outskip=0, inskip=5, dur=3, amp=1, inchan=1, loc=1.0)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="MIX.php">MIX</a>,
<a href="STEREO.php">STEREO</a>,
<a href="PAN.php">PAN</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

