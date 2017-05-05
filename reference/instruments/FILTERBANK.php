<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - FILTERBANK</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>FILTERBANK</b> -- multi-band reson instrument
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>FILTERBANK</b>(outsk, insk, dur, AMP, ringdowndur, inputchan, PAN, CFREQ1, BANDWIDTH1, RELAMP1, ... CFREQN, BANDWITHN, RELAMPN)
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = input duration (seconds)
   p3 = amplitude multiplier (relative multiplier of input signal)
   p4 = ring-down duration (seconds)
   p5 = input channel
   p6 = pan (0-1 stereo; 0.5 is middle)
   p7, p8, p9, ... pN-2, pN-1, pN
      starting with p7, the next N pfields are triples, the first being the
      center frequency of a filter "hump" (Hz or oct.pc * (see note below)), the
      second being the bandwidth of the "hump" (expressed as a multiplier of the
      center frequency, 0-1), and the third being the relative amplitude of that
      "hump" in the final constructed filter (0-1).  Up to 60 cf-bw-amp triples 
      can be specified.

   p3 (amplitude), p6 (pan) as well as the center frequency, bandwidth, and
   relative amplitude pfields for individual bands can receive dynamic updates
   from a table or real-time control source.

   * If the value of the center frequency pfield(s) ("CFREQ1 ... CFREQN") is < 15.0,
   it assumes oct.pc.  Use the <a href="/reference/scorefile/pchcps.php">pchcps</a>
   scorefile convertor for direct frequency specification below 15.0 Hz.

   Author: John Gibson, 25 Feb 2007
</pre>
<br>
<hr>
<br>


<b>FILTERBANK</b> is very similar to the older
<a href="IIR.php">IIR</a>
instrument.  It builds a series of
infinite impulse response (or recursive) filters with
center frequency, bandwidth, and amplitude boost defined in triplets.
These filters, combined together, allow the specification of
complex frequency-response curves.

<h3>Usage Notes</h3>

The two main differences between <b>FILTERBANK</b> and
<a href="IIR.php">IIR</a>
are, first,  the elimination of the <b>setup</b> subcommand for designing
the filter in favor of extended pfield-parameters in the main
<b>FILTERBANK</b> note specification.  This leads to the second main
difference:  each of the center-frequency/bandwith/relative-amplitude
may be dynamically modified using the
<a href="pfield-enabled.php">pfield-enabled</a>
control system.  This gives the <b>FILTERBANK</b> instrument
a high degree of flexibility.
<p>
oct.pc format generally will not work as you expect for the center
frequency specifications if the pfield changes dynamically.
This is  because of the 'mod 12' aspect of
the pitch-class (.pc) specification.  Use direct frequency (hz) or
linear octaves instead.
<p>
The bandwith of each filter is specified as a multiplier of the center
frequency of each filter.  The older
<a href="IIR.php">IIR</a>
instrument
had an option to specify this bandwidth directly as a Hz value.  This is
not the case with <b>FILTERBANK</b>.
<p>
The point of the ring-down duration parameter (p4) is to let you control
how long the filter will sound after the input has stopped.  Too short
a time, and the sound may be cut off prematurely, resulting in a click.
<p>
The output of <b>FILTERBANK</b> can be either mono or stereo.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 2)
   load("FILTERBANK")
   
   rtinput("mysound.aif")
   inchan = 0
   inskip = 0
   dur = DUR()
   ringdur = 10
   
   amp = 0.25
   bw = 0.0003
   
   cf1 = maketable("line", "nonorm", 100, 0,200, 1,1200)
   cf2 = maketable("line", "nonorm", 100, 0,1100, 1,300)
   cf3 = maketable("line", "nonorm", 100, 0,600, 1,2200)
   cf4 = maketable("line", "nonorm", 100, 0,2000, 1,900)
   
   start = 0
   FILTERBANK(start, inskip, dur, amp, ringdur, inchan, pan=0.5,
      cf1, bw, g=1, cf2, bw, g=1, cf3, bw, g=1, cf4, bw, g=1)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("FILTERBANK")
   
   rtinput("mysound.aif")
   inchan = 0
   inskip = 0
   dur = DUR()
   ringdur = 5
   
   amp = 0.1
   bw = maketable("line", "nonorm", 1000, 0,0.01, dur,0.001, dur+ringdur,0.001)
   
   start = 0
   FILTERBANK(start, inskip, dur, amp, ringdur, inchan, pan=0.1,
      cf=9.02, bw, g=1,
      cf=9.09, bw, g=1,
      cf=10.01, bw, g=1,
      cf=10.06, bw, g=1,
      cf=11.02, bw, g=1)
   FILTERBANK(start, inskip, dur, amp, ringdur, inchan, pan=0.9,
      cf=8.02, bw, g=1,
      cf=9.05, bw, g=1,
      cf=10.03, bw, g=1,
      cf=10.10, bw, g=1,
      cf=11.04, bw, g=1)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="BUTTER.php">BUTTER</a>,
<a href="ELL.php">ELL</a>,
<a href="EQ.php">EQ</a>,
<a href="FIR.php">FIR</a>,
<a href="FILTSWEEP.php">FILTSWEEP</a>,
<a href="FOLLOWBUTTER.php">FOLLOWBUTTER</a>,
<a href="IIR.php">IIR</a>,
<a href="JFIR.php">JFIR</a>,
<a href="MOOGVCF.php">MOOGVCF</a>,
<a href="MULTEQ.php">MULTEQ</a>
<a href="SPECTEQ.php">SPECTEQ</a>,
<a href="SPECTEQ2.php">SPECTEQ2</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

