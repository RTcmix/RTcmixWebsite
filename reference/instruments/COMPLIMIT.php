<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - COMPLIMIT</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>COMPLIMIT</b> -- compress/limit an input signal
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>COMPLIMIT</b>(outsk, insk, dur, PREAMP, POSTAMP, ATTACK, RELEASE, THRESHOLD, COMPRESSRATIO, lookahead, windowsize[, DETECTIONTYPE, BYPASS, INPUTCHAN, PAN])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0  = output start time (seconds)
   p1  = input start time (seconds)
   p2  = duration (seconds)
   p3  = gain applied to input before compression (in dBFS; 0 is no change)
   p4  = gain applied to output after compression - "makeup gain" (in dBFS)
   p5  = attack time (seconds)
   p6  = release time (seconds)
   p7  = threshold (in dBFS)
   p8  = compression ratio - e.g. 20 means 20:1 (100 is infinity)
   p9  = look-ahead time (seconds)
   p10 = peak detection window size (power of 2 <= RTCmix output buffer size)
   p11 = detection type (0: peak, 1: average peak, 2: rms) [optional; default is 0)
   p12 = bypass (0: bypass off, 1: bypass on) [optional; default is 0]
   p13 = input channel  [optional; default is 0]
   p14 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]

   p3 (amplitude), p4 (preamp), p5 (postamp), p6 (attack), p7 (release),
   p8 (threshold), p9, (compressratio), p11 (detection type), p12 (bypass)
   p13 (input channel) and p14 (pan) can receive dynamic updates from a table
   or real-time control source.

   Author: John Gibson <johgibso at indiana dot edu>, 4/21/00; rev. for v4, 6/18/05
</pre>
<br>
<hr>
<br>


<b>COMPLIMIT</b>
applies dynamic compression or limiting to an audio signal

<h3>Usage Notes</h3>

For information about how compression/limiting works, look for articles
on the web.  The parameters of this instrument are fairly standard.
<p>
One minor problem: sometimes the compressor will stay in sustain for too long.
This happens when the source sound has a long decaying envelope
 where some of the decay is above the threshold.
<p>
<b>COMPLIMIT</b> can produce stereo or mono output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("COMPLIMIT")
   
   rtinput("mysound.aif")

   inskip = 1
   dur = 5
   
   ingain = 0
   outgain = 0
   attack = 0.01
   release = 0.06
   threshold = -10
   ratio = 100
   lookahead = attack
   windowlen = 128
   detect_type = 0
   bypass = 0
   
   outskip = 0
   COMPLIMIT(outskip, inskip, dur, ingain, outgain, attack, release, threshold,
             ratio, lookahead, windowlen, detect_type, bypass, inchan=0, pctleft=.5)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("COMPLIMIT")
   
   rtinput("mysound.aif")
   inskip = 0
   dur = DUR()
   
   ingain = 18
   outgain = 0
   attack = 0.001
   release = 0.02
   threshold = -20
   ratio = 4
   lookahead = attack
   windowlen = 128
   detect_type = 0
   bypass = 0
   
   COMPLIMIT(0, inskip, dur, ingain, outgain, attack, release, threshold,
      ratio, lookahead, windowlen, detect_type, bypass, inchan=0, pan=.5)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="DECIMATE.php">DECIMATE</a>,
<a href="DISTORT.php">DISTORT</a>,
<a href="SHAPE.php">SHAPE</a>,
<a href="DCBLOCK.php">DCBLOCK</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

