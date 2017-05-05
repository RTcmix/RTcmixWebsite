<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - SPLITTER</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>SPLITTER</b> -- send mono input to multiple outputs
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>SPLITTER</b>(outsk, insk, dur, GLOBAL_AMP, input_channel, OUTCHAN0_AMP, OUTCHAN1_AMP, ...)
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = global amp multiplier (relative multiplier of input signal)
   p4 = input channel
   p5-n = amplitude multiplier for each output channel (relative multiplier)

	ps (global amp) and p5-n (channel output amps) can receive dynamic updates
   from a table or real-time control source.

   John Gibson, 1/22/06
</pre>
<br>
<hr>
<br>



<b>SPLITTER</b> is a utility istrument for routing signals into the different
RTcmix busses (and outputs).

<h3>Usage Notes</h3>

<b>SPLITTER</b> does essentially
the opposite that the
<a href="MIX.php">MIX</a>
instrument does, with an added amplitude multiplier for each output
channel in the output matrix.  The number of outputs is set
by the
<a href="/reference/scorefile/bus_config.php">bus_config</a>
scorefile command.
<p>
<b>SPLITTER</b> is necessary for setting up parallel processing
chains, where the signal originating from one instrument or input
is intended to be routed through several seperate
processing chains simultaneously.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   
   load("WAVETABLE")
   load("SPLITTER")
   
   dur = 10
   amp = 5000
   freq = 440
   bus_config("WAVETABLE", "aux 0 out")
   WAVETABLE(0, dur, amp, freq)
   bus_config("WAVETABLE", "aux 1 out")
   freq = 770
   WAVETABLE(0, dur, amp, freq)
   
   bus_config("SPLITTER", "aux 0 in", "aux 10 out", "aux 12 out")
   inchan = 0
   SPLITTER(0, 0, dur, 1, inchan, 1, 1)
   bus_config("SPLITTER", "aux 1 in", "aux 11 out", "aux 13 out")
   SPLITTER(0, 0, dur, 1, inchan, 1, 1)
   
   //bus_config("MIX", "aux 10-11 in", "out 0-1")
   bus_config("MIX", "aux 12-13 in", "out 0-1")
   MIX(0, 0, dur, 1, 0, 1)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   
   load("STRUM2")
   load("FLANGE")
   load("PANECHO")
   load("SPLITTER")
   
   bus_config("STRUM2", "aux 0-1 out")
   bus_config("SPLITTER", "aux 0-1 in", "aux 2-3 out", "aux 4-5 out")
   bus_config("MIX", "aux 2-3 in", "out 0-1")
   bus_config("FLANGE", "aux 4-5 in", "aux 6-7 out")
   bus_config("PANECHO", "aux 6-7 in", "out 0-1")
   
   srand()
   
   beat = 1
   bases = { 10.00, 9.07, 9.05, 9.00 }
   
   amp = 30000
   
   notes = { 0.00, 0.02, 0.04, 0.05, 0.07, 0.09, 0.11, 1.00 }
   nnotes = len(notes)
   
   durs = {  1,    1,    1,    1,    2,    2,    2,    2,
      1,    1,    1,    1,    2,    2,    4,
      1,    1,    1,    1,    2,    2,    2,    2,
      1,    1,    1,    1,    2,    2,    4 }
   ndurs = len(durs)
   
   tdur = 0 
   for (i = 0; i < ndurs; i += 1) tdur += durs[i]
   tdur *= beat
   // do the whole thing 2X
   tdur *= 2
   
   
   hitincr = 0.05
   dur = beat*0.3
   st = irand(0, 7*beat)
   while (st < tdur) {
   	nhits = irand(150, 250)
   	base = bases[trand(0, len(bases))]
   	for (i = 0; i < nhits; i += 1) {
   		pitch = base + notes[trand(0, nnotes)]
   		sq = 10 - ((i/nhits) * 8)
   		STRUM2(st, dur, amp, pitch, sq, dur, random())
   		st += irand(0, hitincr)
   	}
   
   	for (i = 0; i < nhits; i += 1) {
   		pitch = base + notes[trand(0, nnotes)]
   		sq = 8 * (i/nhits) + 2
   		STRUM2(st, dur, amp, pitch, sq, dur, random())
   		st += irand(0, hitincr)
   	}
   
   	st += irand(5*beat, 11*beat)
   }
   
   
   // flange + panecho
   SPLITTER(0, 0, st, 1, 0, 1.0, 0, 1.8, 0)
   SPLITTER(0, 0, st, 1, 1, 0, 1.0, 0, 1.8)
   
   fwave = maketable("wave", 10000, "sine")
   
   amp = 0.8
   c0del = irand(0.4, 0.7)
   c1del = irand(0.2, 0.45)
   
   FLANGE(0, 0, st, amp, 0.02, 0.005, 70, 0.4, 1, "iir", 0, 0.5, 1.0, fwave)
   
   PANECHO(0, 0, st, 0.7, c0del, c1del, 0.8, 10.0, 0)
   
   MIX(0, 0, st, 1, 0, 1)
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
<a href="STEREO.php">STEREO</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

