<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - MIX</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>MIX</b> -- mix inputs to outputs
<br>
<i>in RTcmix/insts/base</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>MIX</b>(outsk, insk, dur, AMP, p4-n: output channel assigns)
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (or endtime if negative) (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4-n = channel mix maxtrix

   p3 (amplitude) can receive dynamic updates from a table or real-time
   control source.

   rev for v4, JGG, 7/9/04
</pre>
<br>
<hr>
<br>

<b>MIX</b> is the oldest and simplest of the cmix family of instruments.
It takes an input file and, well, mixes it to an output file.  Since you
can change the input file as the score is parsed,
you can use it to mix a number of files together.  Because of its
lack of panning,
<b>MIX</b> is basically outdated for general 'stereo'
purposes, and normally you will want to
use the
<a href="STEREO.php">STEREO</a>
instrument.  We include it here mainly for historical reasons,
plus it is still valuable when dealing with more than two input or output
channels or a range of
<a href="/reference/scorefile/bus_config.php">aux buses (bus_config)</a>.

<h3>Usage Notes</h3>


The trickiest part of <b>MIX</b> is understanding how
the p4-pN channel mix matrix works.  Thus:<br>
<ul>
<tt>The next (up to 4) arguments are the numbers of the output channel
in which to place the input channel as determined by its order in the
series. In other words the series, 0 1 1 0 would indicate that you are
placing input channel 0 in output channel 0, input channel 1 in output
channel 1, input channel 2 in output channel 1, and input channel 3 in
output channel 0. If you specify an incorrect number of channels the program
will barf. If you want to skip over an input channel simply put a -1 in
that field</tt>
(quoted from Lansky, 1987).
</ul>
The number of p4-pN p-fields available is then set by the number
of input channels, and each one can be assigned to the range of
output channels available.  Note that channels are counted beginning
with "0".  Also
Note that channels can't be "panned", only assigned to an available
output channel.
<p>
Using a "-1" in the output channel assignment (as stated above) efectively
mutes that input channel.  This can be useful for extracting single
channels from a multi-channel input file.  
<p>
Also note that the sample scores have no "load()" directive.
<b>MIX</b> is the main RTcmix
object ("mix" in the old, disk-based cmix filled the parallel role),
and thus does
not need to be dynamically-loaded.  It is 'always there'.  Always.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)

   rtinput("mystereosound.aiff")
   ampenv = maketable("line", 1000, 0,0, 1,1)

   MIX(0, 0, 7.0, 1*ampenv, 0, 0)

   ampenv = maketable("line", 1000, 0,0, 1,1, 2,0)
   MIX(0.1, 0, 7.0, 1*ampenv, 1, 1)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 1) // note rtsetparams() sets *output* channels

   rtinput("myquadsound.aiff")

   MIX(0, 0, 6, 1, -1, 0, -1, -1) // extracts channel 1 from the quad file
</pre>
<br>
<br>

fun stuff!
<pre>
   // granular-like!
   rtsetparams(44100, 2)
   
   rtinput("mysoundfile.wav")
   filedur = DUR()
   
   amp = 1.0
   env = maketable("line", 1000, 0,0, .2,1, 2,0)
   
   // to make sure these very short notes are enveloped precisely
   control_rate(10000)
   
   dur = 1
   for (outsk = 0; outsk < 14.0; outsk += dur) {
   	insk = random() * filedur
   	dur = random() * 0.2
   
   	if (random() > 0.5)
   		ch1 = 0
   	else
   		ch1 = 1
   	if (random() > 0.5)
   		ch2 = 0
   	else
   		ch2 = 1
   
   	MIX(outsk, insk, dur, amp * env, ch1, ch2)
   }
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="NPAN.php">NPAN</a>,
<a href="PAN.php">PAN</a>,
<a href="QPAN.php">QPAN</a>,
<a href="REVMIX.php">REVMIX</a>,
<a href="SPLITTER.php">SPLITTER</a>,
<a href="STEREO.php">STEREO</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

