<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - SPECTEQ2</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>SPECTEQ2</b> -- FFT-based EQ
<br>
<i>in RTcmix/insts/jg/SPECTACLE2</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>SPECTEQ2</b>(outsk, insk, dur, AMP, fftsize, windowsize, WINDOWTABLE, overlap, EQTABLE[, MINFREQ, MAXFREQ, BYPASS, inputchan, PAN]) 
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0  = output start time (seconds)
   p1  = input start time (seconds)
   p2  = duration (seconds)
   p3  = amplitude multiplier (relative multiplier of input signal)
   p4  = FFT length (samples, power of 2, usually 1024)
   p5  = window length (samples, power of 2, usually FFT length * 2)
   p6  = window table (or zero for internally generated Hamming window)
   p7  = overlap - how much FFT windows overlap (positive power of 2)
      1: no overlap, 2: hopsize=FFTlen/2, 4: hopsize=FFTlen/4, etc.
      2 or 4 is usually fine; 1 is fluttery; higher overlaps use more CPU.
   p8  = EQ table (i.e., amplitude scaling of each band),
      in dB (0 dB means no change, + dB boost, - dB cut).
   p9  = minimum frequency (Hz) [optional; default is 0 Hz]
   p10 = maximum frequency (Hz) [optional; default is Nyquist] 
   p11 = bypass (0: bypass off, 1: bypass on) [optional; default is 0]
   p12 = input channel [optional; default is 0]
   p13 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   p3 (amp), p9 (min. freq.), p10 (max. freq.), p11 (bypass) and p13 (pan)
   can receive dynamic updates from a table or real-time control source.

   p6 (window table, if used) and p8 (EQ table) should be
   references to pfield table-handles.

   Author:  John Gibson, 6/12/05
</pre>
<br>
<hr>
<br>
<b>SPECTEQ2</b> is an evolution of the earlier
<a href="SPECTEQ.php">SPECTEQ</a>
instrument.  It can do very specific filtering jobs, operating
directly on the FFT analysis of a signal spectrum.


<a name="usage_notes"></a>
<h3>Usage Notes</h3>

<b>SPECTEQ2</b> is very similar in design to the
<a href="SPECTACLE2.php">SPECTACLE2</a>
instrument.  You may wish to consult the
<a href="SPECTACLE2.php#usage_notes">SPECTACLE2 Usage Notes</a>
for additional information.
<p>
As in
<a href="SPECTACLE2.php">SPECTACLE2</a>,
it is possible to update the EQ table (p8, "EQTABLE") dynamically using the
<a href="/reference/scorefile/modtable.php#draw">modtable(table, "draw", ...)</a>
scorefile command.
<p>
Output begins after a brief period of time during which internal buffers
are filling.  This time is the duration corresponding to the following
number of sample frames:  window length - (fft length / overlap).
<p>
Parameters p9 ("MINFREQ") and p10 ("MAXFREQ") operate in a similar
way to the range parameters in
<a href="SPECTACLE2.php">SPECTACLE2</a>.
<ul>
If both minimum and maximum frequency values are zero (i.e., max. is Nyquist),
and the EQ table is sized to half the FFT length (p4), then the instrument
behaves similarly to the older
<a href="SPECTEQ.php">SPECTEQ</a>
instrument.  That is, each table element controls one
FFT bin.  If the control table is larger than half the FFT length, then
the extra values at the end of the table are ignored (and a warning
printed).  If the table is less than half the FFT length, then the scheme
described below applies.
<p>
In all other cases, the first element of a table controls all FFT bins
below and including the minimum frequency.  Successive table elements
control groups of bins above this frequency.  The last element of the
table controls all FFT bins at and above the maximum frequency.  So you
can think of the first table element as a low shelf (brick wall) filter
cutoff frequency, and the last element as a high shelf filter cutoff
frequency.  Interior elements are like peak/notch filters.  If the EQ
table has too many elements, then the extra values at the end of the
table are ignored.
<p>
If the EQ table is smaller than the number of FFT bins it affects, then
the table elements are mapped to FFT bins in a particular way.  The method
used creates greater resolution for lower frequencies.  For example, if
there are 512 FFT bins (i.e., half the FFT length), but the EQ table has
only 32 elements, then there is a one-to-one mapping from table elements
to bins for the lower frequencies.  For the higher frequencies, one table
element might control 30 or more bins.
</ul>
<b>SPECTEQ2</b> can produce either mono or stereo output.
<br>
<br>
<br>
There are no sample scorefiles.
<br>

<hr>
<h3>See Also</h3>

<a href="CONVOLVE1.php">CONVOLVE1</a>,
<a href="LPCPLAY.php">LPCPLAY</a>,
<a href="PVOC.php">PVOC</a>,
<a href="SPECTACLE.php">SPECTACLE</a>,
<a href="SPECTACLE2.php">SPECTACLE2</a>,
<a href="SPECTEQ.php">SPECTEQ</a>,
<a href="TVSPECTACLE.php">TVSPECTACLE</a>,
<a href="VOCODE2.php">VOCODE2</a>,
<a href="VOCODE3.php">VOCODE3</a>,
<a href="VOCODESYNTH.php">VOCODESYNTH</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

