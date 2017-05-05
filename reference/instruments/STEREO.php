<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - STEREO</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>STEREO</b> -- mix input to stereo output with adjustable pan</b>
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>STEREO</b>(outsk, insk, dur, AMP, P4-N: input/output channel pan assigns)
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (or endtime if negative) (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4-n = input/output channel pan assigns (0-1 stereo; 0.5 is middle)

   p3 (amplitude) and the p4-n (pan assigns) pfields can receive dynamic
   updates from a table or real-time control source.

   Author:  Brad Garton; rev. for v4.0 by JGG, 7/9/04
</pre>
<br>
<hr>
<br>

<b>STEREO</b> will mix any number of input channels to stereo outputs with
global amplitude control and individual pans for each input channel.


<h3>Usage Notes</h3>


<b>STEREO</b> mixes channels from the input source into the stereo output,
according to the 'input/output channel pan assign' in the p4-n pfields.
The total number ("n") of these pfields will depend on how many channels
are present in the input.  These pfields
together constitute a 'mix matrix', in which argument position
represents input channel number, and argument value represents output
stereo location.  These output locations are expressed as a 0-1 value,
with 0.5 being in the middle (0 == left channel, 1 == right channel.
<p>
It works like this:  For every input channel, the corresponding
number in the pfield (starting with p4) gives the output stereo pan
for that channel (0-1, 0.5 in middle).  Thus
p4 corresponds to input channel 0, p5 corresponds to input channel 1, etc.
If the value of one of these pfields is negative, then the corresponding
input channel will not be played.  Note that you cannot send a channel
to more than one output pan location.
<p>
Each of these individual input pan values can received dynamic updates
through the
<a href="pfield-enabled.php">pfield-enabled</a>
control system.
<p>
<b>STEREO</b> requires stereo output (obviously).

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("STEREO")

   rtinput("mysoundfile.aif")

   loc = 0.75
   STEREO(outskip=0, inskip=1, dur=3, amp=1, loc)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("STEREO")

   rtinput("mysound.aif")

   ampenv = maketable("line", 1000, 0,0, 1,1, 1.1, 0)
   STEREO(0, 0, 3.5, 0.7*ampenv, 0.5, 0.5)

   ampenv = maketable("line", 1000, 0,0, 0.1,1, 1, 0)
   STEREO(2, 0, 3.5, 0.6*ampenv, 0.1, 0.1)
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 2)
   load("STEREO")

   rtinput("mysound.aif")

   ampenv = maketable("line", 1000, 0,0, .1,1, 2,0)

   reset(44100)
   dur = 1
   for(outsk = 0; outsk < 10.0; outsk = outsk + dur) {
      insk = random() * 7.0
      dur = random() * 0.2
      STEREO(insk, outsk, dur, 1, random(), -1)
   }
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="MIX.php">MIX</a>,
<a href="NPAN.php">NPAN</a>,
<a href="PAN.php">PAN</a>,
<a href="QPAN.php">QPAN</a>,
<a href="REVMIX.php">REVMIX</a>,
<a href="SPLITTER.php">SPLITTER</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

