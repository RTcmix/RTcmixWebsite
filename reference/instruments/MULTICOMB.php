<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MULTICOMB</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MULTICOMB</b> -- multiple comb filters
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MULTICOMB</b>(outsk, insk, dur, AMP, combfreqlo (Hz), combfreqhi (Hz), REVERBTIME[, inputchan, ringdowndur])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = comb frequency range bottom (Hz)
   p5 = comb frequency range top (Hz)
   p6 = reverb time (seconds)
   p7 = input channel [optional; default is 0]
   p8 = ring-down duration [optional; default is reverb time (p6)]

   p3 (amplitude) and p8 (reverb time) can receive dynamic updates from a
   table or real-time control source.

   Author:  Brad Garton; rev. for v4.0 by JGG, 7/10/0
</pre>
<br>
<hr>
<br>
<b>MULTICOMB</b> process an input signal using four simultaneous comb
filters randomly chosen within a specified range (and spread across the
stereo field)


<h3>Usage Notes</h3>


You can't specify the actual comb filter frequencies chosen directly,
but it's still fun to use.  Narrow ranges will converge on a particular
pitch if you'd like.
<p>
The optional ring-down duration parameter (p8) is to let you control
how long the combs will ring after the input has stopped.  If the
reverb time is constant, <b>MULTICOMB</b> will figure out the correct ring-down
duration for you.  If the reverb time is dynamic, you need to specify a
ring-down duration if you want to ensure that your sound will not be
cut off prematurely.
<p>
The output of <b>MULTICOMB</b> is stereo.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("MULTICOMB")

   rtinput("mysound.aif")

   ampenv =  maketable("line", 1000, 0,0, 0.5,1, 4.0,1, 4.3,0)

   MULTICOMB(0, 0, 4.3, 0.1*ampenv, cpspch(6.02), cpspch(9.05), 1)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   set_option("full_duplex_on")
   rtsetparams(44100, 2, 256)
   load("MULTICOMB")

   rtinput("AUDIO")
   reset(20000)

   srand(87)

   ampenv = maketable("line", 1000, 0,0, 1,1, 3,1, 5,0)

   for(start = 0; start < 30; start = start + 2.5) {
      low = random() * 500.0 + 50.0
      hi = low + (random() * 300.0)
      MULTICOMB(start, 0, 5, 0.04, low, hi, 2.5)
   }
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="COMBIT.php">COMBIT</a>,
<a href="DELAY.php">DELAY</a>,
<a href="FLANGE.php">FLANGE</a>,
<a href="IIR.php">IIR</a>,
<a href="JDELAY.php">JDELAY</a>,
<a href="REV.php">REV</a>,
<a href="REVERBIT.php">REVERBIT</a>,
<a href="REVERBIT.php">REVERBIT</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


