<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - SHAPE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>SHAPE</b> -- input sound waveshaping instrument
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>SHAPE</b>(outsk, insk, dur, AMP, MINDIST, MAXDIST, AMPNORMTABLE, inputchan, PAN, TRANSFERFUNC[, INDEXENV])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = minimum distortion index (0.0-1.0)
   p5 = maximum distortion index (0.0-1.0)
   p6 = reference to an amplitude normalization table, or 0 for no normalization
   p7 = input channel
   p8 = pan (0-1 stereo; 0.5 is middle)
   p9 = reference to waveshaping tranfer function table
   p10 = index control envelope [optional; default is constant 1.0]

   p3 (amplitude), p4 (min index), p5 (max index), p8 (pan) and p10 (index)
   can receive dynamic updates from a table or real-time control source.

   p6 (amp normalization table) and p9 (transfer function) should be references to pfield table-handles.

   Author:  John Gibson, 3 Jan 2002; rev for v4, 7/21/04
</pre>
<br>
<hr>
<br>


<b>SHAPE</b> does a table-lookup waveshaping (distortion) on an arbitrary
input soundfile.  The
<a href="WAVESHAPE.php">WAVESHAPE</a>
instrument uses a similar approach, but does synthesis instead of
signal-processing.

<h3>Usage Notes</h3>



<b>SHAPE</b> accepts input from a file, a real-time
audio device, or from a bus.  It also offers a different way of
performing amplitude normalization than
<a href="WAVESHAPE.php">WAVESHAPE</a>.
<b>SHAPE</b> accomplishes this by
applying a waveshaping transfer function to the input source.  (See
Dodge and Jerse, or any other computer music text, for a detailed explanation
of this technique.)
<p>
For a short explanation of the waveshaping process and how to configure
the transfer function (p8, "TRANSFERFUNCTION") along with the
index control function (p9, "INDEXENV" if used) and index constraints
(p3 and p4, "INDEXMIN", "INDEXMAX"), see the
<a href="WAVESHAPE.php#usage_notes">WAVESHAPE Usage Notes</a>.
<p>
If you want to perform amplitude normalization, use a pfield table
through p6 ("AMPNORMTABLE") with the normalization curve.
Otherwise, set p6 to zero.  The amplitude normalization control
table allows you to
decouple amplitude and timbral change, to some extent.  (Read about this in the
Roads "Computer Music Tutorial'' chapter on waveshaping.) The table maps
incoming signal amplitudes, on the X axis, to amplitude multipliers, on the Y
axis.  The multipliers should be from 0 to 1.  The amplitude multipliers are
applied to the output signal, along with whatever overall amplitude curve is in
effect.  Generally, you'll want a curve that starts high and moves lower for
the higher signal amplitudes.  This will keep the bright and dark timbres more
equal in amplitude.  But anything is possible.
</p>
The output of <b>SHAPE</b> can be either stereo or mono.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("WAVETABLE")
   load("SHAPE")

   bus_config("WAVETABLE", "aux 0 out")
   bus_config("SHAPE", "aux 0 in", "out 0-1")

   dur = 10
   amp = 10000
   freq = 200
   start = 0
   WAVETABLE(start, dur, amp, freq, 0)

   amp = 1.0
   ampenv = maketable("line", 1000, 0,0, 9,1, 10,0)

   transferfunc = maketable("cheby", "nonorm", 1000, 0.9, 0.3, -0.2, 0.6, -0.7, 0.9, -0.1)

   min = 0; max = 3.0
   indexguide = maketable("window", 1000, "hanning")    // bell curve

   SHAPE(start, inskip = 0, dur, amp*ampenv, min, max, 0, inchan=0, pan=0.5, transferfunc, indexguide)
</pre>
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("WAVETABLE")
   load("SHAPE")

   bus_config("WAVETABLE", "aux 0 out")
   bus_config("SHAPE", "aux 0 in", "out 0-1")

   dur = 20
   freq = 60

   amp = 20000
   wavet = maketable("wave", 2000, 1, .3, .1)
   WAVETABLE(start=0, dur, amp, freq, 0, wavet)

   transferfunc = maketable("wave", 1000, "square13")

   // sample-and-hold distortion index
   speed = 7   // sample-and-hold changes per second
   indexguide = makerandom("even", speed, min=0, max=1, seed=1)
   indexguide = makefilter(indexguide, "smooth", lag=20)
   minidx = 0.0
   maxidx = 3.0

   normfunc = maketable("curve", "nonorm", 1000, 0,1,-1, 1,.3)

   amp = 0.8
   env = maketable("line", 1000, 0,1, dur-.03,1, dur,0)

   SHAPE(start, inskip=0, dur, amp * env, minidx, maxidx, normfunc, 0, 1, transferfunc, indexguide)

   // vary distortion index for other channel
   indexguide = makerandom("even", speed, min=0, max=1, seed + 1)
   indexguide = makefilter(indexguide, "smooth", lag=20)
   SHAPE(start, inskip=0, dur, amp * env, minidx, maxidx, normfunc, 0, 0, transferfunc, indexguide)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makerandom.php">makerandom</a>,
<a href="/reference/scorefile/makefilter.php">makefilter</a>,
<a href="DISTORT.php">DISTORT</a>,
<a href="SHAPE.php">SHAPE</a>,
<a href="DECIMATE.php">DECIMATE</a>,
<a href="COMPLIMIT.php">COMPLIMIT</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

