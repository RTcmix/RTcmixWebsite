<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - EQ</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>EQ</b> -- equalizer instrument (peak/notch, shelving and high/low pass filter)
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>EQ</b>(outsk, insk, dur, AMP, EQTYPE, inputchan, PAN, BYPASS, FILTFREQ, FILTQ[, FILTAMP])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = EQ type ("lowpass", "highpass", "lowshelf", "highshelf", "peaknotch";
      or numeric codes for the EQ type (0: lowpass, 1: highpass, 2: lowshelf, 3: highshelf, 4: peaknotch)
   p5 = input channel
   p6 = pan (0-1 stereo; 0.5 is middle)
   p7 = bypass filter (0: bypass off, 1: bypass on) (usually use 0)
   p8 = filter frequency (Hz)
   p9 = filter Q (values from 0.5 to 10.0, roughly)
   p10 = filter gain (dB) [optional; shelf and peak/notch only]
         use gen 4] *****

   p3 (amplitude), p4 (type), p6 (pan), p7 (bypass), p8 (freq), p9 (Q)
   and p10 (gain) can receive dynamic updates from a table or real-time
   control source.  p4 (type) can be updated only when using numeric codes.

   Author: John Gibson, 7 Dec 2003; rev for v4, 7/23/04
   Based on formulas by Robert Bristow-Johnson ("Audio-EQ-Cookbook") and code
   by Tom St Denis (see <a href="http://musicdsp.org">musicdsp.org</a>)
</pre>
<br>
<hr>
<br>


<b>EQ</b> is an "equalizer" (another name for "filter") instrument
able to instantiate several different types of audio filters.

<h3>Usage Notes</h3>

<b>EQ</b> can be set to do several different types of filters
(peak/notch, shelving and high/low pass types), depending on the
setting of p4 ("EQTYPE").
<p>
A standard 'biquad' DSP filter algorithm is used to build these different
types of filters.
<p>
In addition to the filter frequency and gain, the 'Q' ("FILTQ", p9) can
be used to determine how 'steep' the filter will be.  Filter parameters
are interpreted depening on what type of filter (p4) is selected.
<p>
The
<a href="MULTEQ.php">MULTEQ</a>
instrument allows for the processing of multiple bands, each (up to 8)
a separate instantiation of <b>EQ</b>.
<p>
The output of <b>EQ</b> can be either mono or stereo.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("EQ")
   
   rtinput("mystereofile.wav")
   inskip = 0
   dur = DUR()
   amp = 0.6
   bypass = 0
   type = "lowshelf"
   freq = 500
   Q = 3.0
   gain = 6.0
   
   EQ(0, inskip, dur, amp, type, 0, 1, bypass, freq, Q, gain)
   EQ(0, inskip, dur, amp, type, 1, 0, bypass, freq, Q, gain)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("EQ")
   
   rtinput("mysound.aiff")
   inskip = 0
   dur = DUR()
   
   start = 2
   amp = 1
   bypass = 0
   
   //type = "lowpass"
   type = "highpass"
   //type = "lowshelf"
   //type = "highshelf"
   //type = "peaknotch"
   
   pan = maketable("line", 100, 0,1, 1,0)
   freq = makeconnection("mouse", "x", min=200, max=2000, dflt=min, lag=50,
   			"freq", "Hz", 1)
   Q = 1.0
   gain = makeconnection("mouse", "y", min=-30, max=20, dflt=0, lag=50,
   			"gain", "dB", 1)
   
   EQ(start, inskip, dur, amp, type, inchan=0, pan, bypass, freq, Q, gain)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeconnection.php">makeconnection</a>,
<a href="BUTTER.php">BUTTER</a>,
<a href="ELL.php">ELL</a>,
<a href="FIR.php">FIR</a>,
<a href="FILTSWEEP.php">FILTSWEEP</a>,
<a href="FILTERBANK.php">FILTERBANK</a>,
<a href="FOLLOWBUTTER.php">FOLLOWBUTTER</a>,
<a href="IIR.php">IIR</a>,
<a href="JFIR.php">JFIR</a>,
<a href="MOOGVCF.php">MOOGVCF</a>,
<a href="MULTEQ.php">MULTEQ</a>,
<a href="SPECTEQ.php">SPECTEQ</a>,
<a href="SPECTEQ2.php">SPECTEQ2</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

