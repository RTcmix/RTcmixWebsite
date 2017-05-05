<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - CLAR</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>CLAR</b> -- physical model clarinet
<br>
<i>in RTcmix/insts/std</i>
<br>
<i>NOTE:  This instrument has largely been superceded by the
<a href="MCLAR.php">MCLAR</a></i> instrument.

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>CLAR</b>(outsk, dur, noiseamp, length1 (samples), length2 (samples), outputamp, d2gain[, pan])
	<ul>
   This instrument has no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
   default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = noise amplitude (0-1)
   p3 = length 1 (1-500, length in samples)
   p4 = length 2 (1-500, length in samples)
   p5 = output amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p6 = d2 gain (0-1)
   p7 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   no <a href="pfield-enabled.php">pfield-enabled</a> control of parameters
   is implemented for this instrument.  Older makegen()-style control
   may be used if desired.
</pre>
<br>
<hr>
<br>

<b>CLAR</b>
is a physical modeling algorithm for a clarinet.
<i>Physical modeling</i> is a synthesis paradigm whereby the computer
synthesizes sound not according to the spectrum of the desired output, but
rather based on a description of the <i>physical process</i> which makes the
sound (to whit: a violin's physical model would include a system describing
the physics of a vibrating string, coupled with a quantified description of
the effects of bow pressure, string vibrato, etc.).  physical modeling
 instruments, therefore, are simulated and controlled by expert systems
describing cause-and-effect relationships of specific performance actions
on corresponding acoustic results.  (adapted from Cook, 1992, 1995).

<h3>Usage Notes</h3>

This is one of the first physical-model instruments implemented.
It is here primarily for 'historical' reasons, the
<a href="MCLAR.php">MCLAR</a></i>
instrument is a better model to use.  For example, to specfy the pitch
in <b>CLAR</b>, it is necessary to find the right combination of
delay lengths and the d2gain parameter.  This isn't really intuitive...
Also, p-field control has not been implemented for this instrument.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 1)
   load("CLAR")

   CLAR(0, 1, 0.02, 78, 31, 7000, 0)
   CLAR(1, 1, 0.02, 35, 4, 7000, 0)
   CLAR(2, 1, 0.02, 35, 9, 7000, 0)
   CLAR(3, 1, 0.02, 51, 20, 7000, 0.5)
</pre>
<br>
<br>
more advanced:
<pre>
   rtsetparams(44100, 2)
   load("CLAR")

   // this is the old makegen() system.  Generally use the
   // maketable() system for dynamic control.  CLAR doesn't use it
   makegen(1, 24, 1000, 0, 1, 1, 1)
   makegen(2, 24, 1000, 0, 1, 1, 1)

   d2 = 0
   for (start = 0; start < 10; start = start + 0.5) {
      CLAR(start, 0.5, 0.02, 69, 34, 7000, d2)
      d2 = d2 + 0.05
   }
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="MCLAR.php">MCLAR</a>,
<a href="MBLOWHOLE.php">MBLOWHOLE</a>,
<a href="MBRASS.php">MBRASS</a>,
<a href="METAFLUTE.php">METAFLUTE</a>,
<a href="MSAXOFONY.php">MSAXOFONY</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
