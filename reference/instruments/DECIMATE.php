<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - DECIMATE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>DECIMATE</b> -- bit-reduce an input signal
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>DECIMATE</b>(outsk, insk, dur, PREAMP, POSTAMP, NBITS[, LOWPASSFREQ, inputchan, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = pre-amp multiplier (before decimation) (relative multiplier)
   p4 = post-amp multiplier (after decimation) (relative multiplier)
   p5 = number of bits to use (1 to 16)
   p6 = low-pass filter cutoff frequency (or 0 to bypass) [optional, default is 0]
   p7 = input channel [optional, default is 0]
   p8 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   p3 (pre-amp), p4 (post-amp), p5 (bits), p6 (cutoff) and p8 (pan) can
   receive dynamic updates from a table or real-time control source.

   JGG <johgibso at indiana dot edu>, 3 Jan 2002, rev for v4, 7/11/04
</pre>
<br>
<hr>
<br>

<b>DECIMATE</b> reduces the number of bits in the input audio signal

<h3>Usage Notes</h3>



<b>DECIMATE</b>
reduces the number of bits used to represent the amplitude of
individual samples.  The sound quality will be altered as a result
<p>
The optional low-pass filter (p5 &gt; 0) is a simple butterworth
filter design.  The cutoff frequency may be modulated dynamically.
<p>
The "PREAMP" (p3) and "POSTAMP" (p4) parameters allow you to adjust
the alteration in amplitude resulting from the bit-rediction.
<p>
The output of <b>DECIMATE</b> can be either mono or stereo.


<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("DECIMATE")

   rtinput("mysound.aif")

   bits = 2
   cutoff = 4000
   dur = DUR()
   amp = 1
   ampenv = maketable("line", 1000, 0,0, 1,1, 5,1, 10,0)

   DECIMATE(0, 0, dur, 1, amp*ampenv, bits, cutoff)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("DECIMATE")
   
   rtinput("mysound.aif")
   
   inchan = 0
   dur = DUR()
   
   bits = 2
   preamp = 2
   postamp = maketable("line", 1000, 0,0, 5,1, 9,1, 10,0)
   cutoff = maketable("line", "nonorm", 1000, 0,1, 1,10000, 2,800)
   pan = maketable("line", 100, 0,0, 1,1)
   
   DECIMATE(0, 0, dur, preamp, 0.9*postamp, bits, cutoff, inchan, pan)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="BUTTER.php">BUTTER</a>,
<a href="COMPLIMIT.php">COMPLIMIT</a>,
<a href="COMPLIMIT.php">COMPLIMIT</a>,
<a href="DISTORT.php">DISTORT</a>,
<a href="SHAPE.php">SHAPE</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


