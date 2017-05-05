<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - TVSPECTACLE</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>TVSPECTACLE</b> -- time-varying FFT-based delay
<br>
<i>in RTcmix/insts/jg/SPECTACLE</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>TVSPECTACLE</b>(outsk, insk, dur, amp, ringdowndur, fftsize, windowsize, windowtype, overlap[, sigmix, inputchan, pan])
	<ul>
   This instrument has no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
   default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

NOTE:  This is an older RTcmix instrument, the newer
<a href="SPECTACLE2.php">SPECTACLE2</a>
instrument (with time-varying pfield control) is probably better to use.
<br>
<br>
<br>

<pre>
   p0  = output start time (seconds)
   p1  = input start time (seconds)
   p2  = input duration (seconds)
   p3  = amplitude multiplier (relative multiplier of input signal)
   p4  = ring-down duration (seconds)
   p5  = FFT length (samples, power of 2, usually 1024)
   p6  = window length (samples, power of 2, usually FFT length * 2)
   p7  = window type (0: Hamming, 1: Hanning, 2: Rectangle, 3: Triangle, 4: Blackman, 5: Kaiser)
   p8  = overlap - how much FFT windows overlap (any power of 2)
         1: no overlap, 2: hopsize=FFTlen/2, 4: hopsize=FFTlen/4, etc.
         2 or 4 is usually fine; 1 is fluttery; the higher the more CPU time
   p9  = wet/dry mix (0: dry -> 1: wet) [optional, default is 1]
   p10 = input channel [optional, default is 0]
   p11 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope system should be used:

   Function table 1 is the input amplitude, spanning just the input duration.
   Function table 2 is the output amplitude, spanning the entire note, including ring-down duration.
   Function table 3 is the EQ table A (i.e., amplitude scaling of each band),
      in dB (0 dB means no change, + dB boost, - dB cut).
   Function table 4 is the delay time table A.
   Function table 5 is the delay feedback table A.  Values > 1 are dangerous!
   Function table 6 is the EQ table B
   Function table 7 is the delay time table B.
   Function table 8 is the delay feedback table B.
   Function table 9 describes the curve between EQ tables A and B.
   Function table 10 describes the curve between delay time tables A and B.
   Function table 11 describes the curve between delay feedback tables A and B.

   Author:  John Gibson
</pre>
<br>
<hr>
<br>


<b>TVSPECTACLE</b>
is an FFT-based delay instrument based on the
<a href="SPECTACLE.php">SPECTACLE</a>
instrument.  The difference is that <b>TVSPECTACLE</b> allows
the EQ, delay and feedback parameters to vary over time.
<p>
NOTE:  This is an older RTcmix instrument, the newer
<a href="SPECTACLE2.php">SPECTACLE2</a>
instrument is probably better to use.  The parameter time-variation
can be accomplished using the
<a href="pfield-enabled.php">pfield-enabled</a>
capabilities of
<a href="SPECTACLE2.php">SPECTACLE2</a>.


<a name="usage_notes"></a>
<h3>Usage Notes</h3>

See the
<a href="SPECTACLE.php#usage_notes">SPECTACLE Usage Notes</a>
of an explanation of the basic parameters of this instrument.
<p>
There are two 'sets' of
<a href="/reference/scorefile/makegen.php">makegen</a>
function tables used to specify 'endpoints' for the EQ params
(p3 and p6), the delay times for each FFT bin (p4 and p7) and
the feedback values for each FFT bin (p5 and p8).  Function tables
listed in p9, p10 and p11 then specify the envelope trajectory
between these two sets.  When the envelope in the function table is at
"0", values from the corresponding first set (p4, p5, p6) will
be used.  When the control envelope is at "1", values from
the second set (p7, p8, p9) will be used.  Intermediate control
values will interpolate between the endpoint table values.
<p>
<b>TVSPECTACLE</b> can produce either mono or stereo output.
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
<a href="SPECTEQ2.php">SPECTEQ2</a>,
<a href="VOCODE2.php">VOCODE2</a>,
<a href="VOCODE3.php">VOCODE3</a>,
<a href="VOCODESYNTH.php">VOCODESYNTH</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

