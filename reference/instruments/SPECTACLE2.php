<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - SPECTACLE2</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>SPECTACLE2</b> -- FFT-based delay processing
<br>
<i>in RTcmix/insts/jg/SPECTACLE2</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>SPECTACLE2</b>(outsk, insk, indur, OUTAMP, INAMP, ringdowndur, fftsize, windowsize, WINDOWTABLE, overlap, EQTABLE, DELAYTABLE, FEEDBACKTABLE[, MINEQFREQ, MAXEQFREQ, MINDELAYFREQ, MAXDELAYFREQ, BINMAPTABLE, WETDRYMIX, inputchan, PAN]) 
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0  = output start time (seconds)
   p1  = input start time (seconds)
   p2  = input duration (seconds)
   p3  = output amplitude multiplier (relative multiplier of input signal)
   p4  = input amplitude multiplier (relative multiplier of input signal)
   p5  = ring-down duration (seconds)
   p6  = FFT length (samples, power of 2, usually 1024)
   p7  = window length (samples, power of 2, usually FFT length * 2)
   p8  = window table (or zero for internally generated Hamming window)
   p9  = overlap - how much FFT windows overlap (positive power of 2)
      1: no overlap, 2: hopsize=FFTlen/2, 4: hopsize=FFTlen/4, etc.
      2 or 4 is usually fine; 1 is fluttery; higher overlaps use more CPU.
   p10 = EQ table (i.e., amplitude scaling of each band),
      in dB (0 dB means no change, + dB boost, - dB cut).
   p11 = delay time table (seconds)
   p12 = delay feedback table (multiplier, 0-1)
   p13 = minimum EQ frequency (Hz) [optional; default is 0]
   p14 = maximum EQ frequency (Hz) [optional; default is Nyquist] 
   p15 = minimum delay frequency (Hz) [optional; default is 0]
   p16 = maximum delay frequency (Hz) [optional; default is Nyquist] 
   p17 = bin-mapping table [optional; default is 0 (no mapping done)]
   p18 = wet/dry mix (0: dry -> 1: wet) [optional; default is 1]
   p19 = input channel [optional; default is 0]
   p20 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]


   p3 (output amp), p13 (min. EQ freq.), p14 (max. EQ freq.), p15 (min. delay freq.),
   p16 (max. delay freq.), p18 (wet/dry mix) and p20 (pan) can receive dynamic
   updates from a table or real-time control source.
  
   p4 (input amp), p8 (window table, if used), p10 (EQ table), p11 (delay time table),
   p12 (delay feedback table) and p17 (bin-mapping table, if used) should be
   references to pfield table-handles.

   Author:  John Gibson, 6/12/05
</pre>
<br>
<hr>
<br>


The <b>SPECTACLE2</b> instrument is an evolution of the earlier
<a href="SPECTACLE.php">SPECTACLE</a>
instrument.  It allows the user to delay different parts of the
spectrum of a signal at different rates, leading to some very
interesting echoey-bizarro effects.  Try it!  It's fun!


<a name="usage_notes"></a>
<h3>Usage Notes</h3>

It is probably a good idea to know in general terms how FFT analysis/synthesis
DSP operates.
<p>
Although they are listed as taking references to pfield table-handles only,
it is possible to update the p10 ("EQTABLE"), p11 ("DELAYTABLE") and
p12 ("FEEDBACKTABLE") tables dynamically using
<a href="/reference/scorefile/modtable.php#draw">modtable(table, "draw", ...)</a>.
If any of these are not tables, then the single constant or changing values
will apply to all FFT bins.  (Useful if you want all bins to use the same
feedback, for example.)
<p>
Output begins after a brief period of time during which internal buffers
are filling.  This time is the duration corresponding to the following
number of sample frames:  window length - (fft length / overlap).  This
duration is called "latency duration" below.
<p>
Most updateable parameters begin at the start of the note, including the
initial latency duration when the instrument plays silence, and act until
the end of the note, including the ring-down duration.  The exception is
the input envelope.  It begins after the latency duration and controls the
time span given by p2 "indur").
<p>
The way the 
frequency range between p13 ("MINEQFREQ") and p14 ("MAXEQFREQ")
and the delay frequency range (p15, "MINDELAYFREQ" and p16, "MAXDELAYFREQ")
operate with the various tables (including the delay feedback table, p12)
is a little complicated:
<ul>
If both min. and max. frequency values are zero (i.e., max. is Nyquist),
and a "control" table (EQ, delay time or feedback) is sized to half the
FFT length (p6), then the instrument behaves similarly to the original
<a href="SPECTACLE.php">SPECTACLE</a>
instrument.
That is, each table element controls one FFT bin.  If the control table
is larger than half the FFT length, then the extra values at the end of
the table are ignored (and a warning printed).  If the table is less
than half the FFT length, then the scheme described below applies.
<p>
In all other cases, the first element of a table controls all FFT bins
below and including the minimum frequency.  Successive table elements
control groups of bins above this frequency.  The last element of the
table controls all FFT bins at and above the maximum frequency.  So for
the EQ table, you can think of the first table element as a low shelf
(brick wall) filter cutoff frequency, and the last element as a high
shelf filter cutoff frequency.  Interior elements are like peak/notch
filters.  If the control tables have too many elements, then the extra
values at the end of the table are ignored.
<p>
If a control table is smaller than the number of FFT bins it affects,
then the table elements are mapped to FFT bins in a particular way.
The method used creates greater resolution for lower frequencies.  For
example, if there are 512 FFT bins (i.e., half the FFT length), but
a control table has only 32 elements, then there is a one-to-one mapping
from table elements to bins for the lower frequencies.  For the higher
frequencies, one table element might control 30 or more bins.
</ul>
If you use the bin-mapping table (p17), it must be the same size as the
EQ and delay tables (p10-12).  If the sum of all the elements of the
mapping table is less than the total number of FFT bins -- which is
(FFT size / 2) + 1, and includes 0 Hz and Nyquist bins -- then the extra
higher-frequency bins will be assigned to the last control table element.
If the sum of mapping table elements is greater than the number of bins,
then some higher-frequency bins will be omitted.  The frequency ranges
discussed in note 3 are ignored when using the bin-mapping table.
Don't you wish you had passed zero here to ignore this feature?
<p>
<b>SPECTACLE2</b> can produce either mono or stereo output.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 2)
   load("SPECTACLE2")

   rtinput("mysound.wav")

   inchan = 0
   inskip = 0
   indur = DUR()
   ringdur = 15           // play after indur elapses, while delay lines flush
   amp = 0.4
   wet = 1                // 100% wet

   fftlen = 1024          // yielding 512 frequency bands
   winlen = fftlen * 2    // the standard window length is twice FFT size
   overlap = 2            // 2 hops per fftlen (4 per window)
   window = 0             // use Hamming window

   // input envelope (spanning <indur>)
   ienv = maketable("line", 1000, 0,0, 1,1, 19,1, 20,0)

   // output envelope (spanning <indur> + <ringdur>)
   oenv = maketable("curve", 1000, 0,1,0, 2,1,-1, 3,0)

   eqtablen = fftlen / 2
   mineqfreq = 0
   maxeqfreq = 0

   // EQ curve: -90 dB at 0 Hz, ramping up to 0 dB at 200 Hz, etc.
   eq = maketable("line", "nonorm", eqtablen, 0,-90, 200,0, 8000,-3, 22050,-6)

   deltablen = fftlen / 2
   mindelfreq = 0
   maxdelfreq = 0

   // fixed delay times between .4 and 3, randomly spread across spectrum
   min = .4
   max = 3
   seed = 1
   deltime = maketable("random", "nonorm", deltablen, "even", min, max, seed)

   // constant feedback of 90% for all freq. bands
   fb = .9

   // do it for the left chan
   SPECTACLE2(0, inskip, indur, amp * oenv, ienv, ringdur, fftlen, winlen,
      window, overlap, eq, deltime, fb, mineqfreq, maxeqfreq,
      mindelfreq, maxdelfreq, 0, wet, inchan, pan=1)

   // shift delay table to decorrelate channels
   deltime = copytable(modtable(deltime, "shift", 2))

   // do it for the right chan
   SPECTACLE2(0, inskip, indur, amp * oenv, ienv, ringdur, fftlen, winlen,
      window, overlap, eq, deltime, fb, mineqfreq, maxeqfreq,
      mindelfreq, maxdelfreq, 0, wet, inchan, pan=0)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   // This shows how to "draw" randomly into the delay time table.  This
   // is an experimental feature, so don't rely on it yet.  -JGG, 6/22/05

   rtsetparams(44100, 2)
   load("SPECTACLE2")

   bus_config("MIX", "in 0", "aux 0 out")
   bus_config("SPECTACLE2", "aux 0 in", "out 0")
   bus_config("SPECTACLE2", "aux 0 in", "out 1")

   rtinput("mysound.wav")

   indur = 60
   ringdur = 10
   dur = DUR()
   amp = 0.2
   for (st = 0; st < indur; st += dur)
      MIX(st, 0, dur, amp, 0)

   // ========================================================================
   indur = st
   wet = 1    // 100% wet

   fftlen = 512            // yielding fftlen / 2 frequency bands
   winlen = fftlen * 2     // the standard window length is twice FFT size
   overlap = 2             // 2 hops per fftlen (4 per window)
   window = 0              // use Hamming window

   // no EQ
   mineqfreq = 0
   maxeqfreq = 0
   eq = 0

   // delay time -------------------------------------------------------------
   mindelfreq = 0
   maxdelfreq = 0

   deltablen = 12    // changing this makes a big difference
   deltimeL = maketable("literal", "nonorm", deltablen, 0)
   deltimeR = copytable(deltimeL)

   // left chan
   randfreq = 9.5
   seed = 1
   index = makerandom("even", randfreq, min = 0, max = deltablen, seed)
   value = makerandom("even", randfreq, min = 0.01, max = 5, seed)
   value = makefilter(value, "smooth", lag = 30)
   deltimeL = modtable(deltimeL, "draw", "literal", index, value, 0)

   // right chan
   randfreq = 9.0
   seed += 1
   index = makerandom("even", randfreq, min = 0, max = deltablen, seed)
   value = makerandom("even", randfreq, min = 0.01, max = 5, seed)
   value = makefilter(value, "smooth", lag = 30)
   deltimeR = modtable(deltimeR, "draw", "literal", index, value, 0)
   // ------------------------------------------------------------------------

   // set feedback and overall gain using mouse
   fb = makeconnection("mouse", "x", min=0, max=1, dflt=0, lag=50, "feedback")
   amp = makeconnection("mouse", "y", min=-60, max=6, dflt=0, lag=50, "gain", "dB")
   amp = makeconverter(amp, "ampdb")

   SPECTACLE2(start=0, inskip=0, indur, amp, iamp=1, ringdur, fftlen, winlen,
      window, overlap, eq, deltimeL, fb, mineqfreq, maxeqfreq, mindelfreq,
      maxdelfreq, 0, wet, inchan=0, pan=1)

   SPECTACLE2(start=0, inskip=0, indur, amp, iamp=1, ringdur, fftlen, winlen,
      window, overlap, eq, deltimeR, fb, mineqfreq, maxeqfreq, mindelfreq,
      maxdelfreq, 0, wet, inchan=0, pan=0)
</pre>
<br>

<hr>
<h3>See Also</h3>

<a href="CONVOLVE1.php">CONVOLVE1</a>,
<a href="LPCPLAY.php">LPCPLAY</a>,
<a href="PVOC.php">PVOC</a>,
<a href="SPECTACLE.php">SPECTACLE</a>,
<a href="SPECTEQ.php">SPECTEQ</a>,
<a href="SPECTEQ2.php">SPECTEQ2</a>,
<a href="TVSPECTACLE.php">TVSPECTACLE</a>,
<a href="VOCODE2.php">VOCODE2</a>,
<a href="VOCODE3.php">VOCODE3</a>,
<a href="VOCODESYNTH.php">VOCODESYNTH</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

