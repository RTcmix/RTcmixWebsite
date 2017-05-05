<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - JDELAY</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>JDELAY</b> -- simple regenerating delay-line + filter
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>JDELAY</b>(outsk, insk, dur, AMP, DELAYTIME, FEEDBACK, ringdowndur, FILTFREQ, SIGMIX[, inputchan, PAN, prefadesend, dcblock])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = delay time (seconds)
   p5 = delay feedback (regeneration multiplier, 0-1])
   p6 = ring-down duration (seconds)
   p7 = cutoff freq for low-pass filter (Hz, 0 to disable filter)
   p8 = wet/dry mix (0: dry, 1: wet)
   p9 = input channel number [optional; default is 0]
   p10 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]
   p11 = pre-fader send (0: no, 1: yes) [optional, default is no]
   p12 = apply DC blocking filter (0: no, 1: yes) [optional, default is yes]
  
   p3 (amplitude), p4 (delay time), p5 (feedback), p7 (cutoff), p8 (wet/dry)
   and p8 (pan) can receive dynamic updates from a table or real-time control
   source.

   Author:  John Gibson, 6/23/99; rev for v4, 7/21/04
</pre>
<br>
<hr>
<br>

<b>JDELAY</b> instantiates a regenerating delay, similar to
<a href="DELAY.php">DELAY</a>.

<h3>Usage Notes</h3>

The differences between <b>JDELAY</b> and
<a href="DELAY.php">DELAY</a>
are:
<ul>
<li><b>JDELAY</b> uses interpolating delay line fetch and
longer-than-necessary delay line, both of
which make it sound less buzzy for audio-range delays
<p>
<li>provides a simple low-pass filter (p7, "FILTFREQ")
<p>
<li>provides control over wet/dry mix (p8, "SIGMIX")
<p>
<li>provides a DC blocking filter (p12, "dcblock").  DC bias can affect sounds
made with high regeneration setting.
<p>
<li>by default the delay is "post-fader," as before, but there's
a pfield switch (p11, "prefadesend") to make it "pre-fader."
If pre-fader send is set to 1, sends input signal to delay line with
no attenuation. Then p3 ("AMP") controls the entire
note, including delay ring-down.
<p>
<li>The point of the ring-down duration parameter (p6, "ringdowndur")
is to let you control
how long the delay will sound after the input has stopped.  Too short
a time, and the sound may be cut off prematurely.
</ul>
<b>JDELAY</b> can produce mono or stereo output.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 1)
   load("JDELAY")

   rtinput("mysound.aif")

	JDELAY(0, 0, 4.3, 1.0, 0.35, 0.7, 5.0, 0, 1)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("JDELAY")
   
   rtinput("mysound.aif")
   
   outskip = 0
   inskip = 0
   indur = DUR()
   amp = 1.0
   deltime = 1/cpspch(7.02)
   feedback = .990
   ringdur = 1
   percent_wet = 0.5
   prefadersend = 0  // if 0, sound stops abruptly; else env spans indur + ringdur
   
   env = maketable("line", 1000, 0,0, 1,1, 6,1, 10,0)
   
   cutoff = 4000
   JDELAY(outskip, inskip, indur, amp*env, deltime, feedback, ringdur,
      cutoff, percent_wet, inchan=0, pan=0.5, prefadersend)
</pre>
<br>

<hr>
<br>
<b>SEE ALSO</b>
<br>
<br>
<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="COMBIT.php">COMBIT</a>,
<a href="DEL1.php">DEL1</a>,
<a href="DELAY.php">DELAY</a>
<a href="PANECHO.php">PANECHO</a>,

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

