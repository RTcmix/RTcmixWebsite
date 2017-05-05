<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - VOCODESYNTH</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>VOCODESYNTH</b> -- oscillator-bank channel vocoder
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
   <b>VOCODESYNTH</b>(outsk, insk, dur, AMP, nfilts, CFREQLO/FTABLETRANSP, CFREQMULT/FTABLEFORMAT, transp, filtbw, windowsize, smoothness, threshold, attack}, release, hisigmix, hifreq, inputchan, PAN, WAVETABLE[, SCALINGTABLE, CFREQTABLE])
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>

	<hr>
	<br>

<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = amplitude multiplier (relative multiplier of output signal)
   p4 = number of filters
   p5 = if p4 > 0, lowest filter center frequency (Hz/oct.pc)
        if p4 == 0, transposition of function table (oct.pc)
   p6 = if p4 > 0, center frequency spacing multiplier (> 1)
        if p4 == 0, function table format (0: octave.pc, 1: linear octave; Hz if > 15.0)
   p7 = amount to transpose carrier oscillators (Hz/oct.pc)
   p8 = filter bandwidth proportion of center frequency (> 0)
   p9 = power gauge window length (seconds, try 0.01)
   p10 = smoothness -- how much to smooth the power gauge output (0-1, try 0.5)
   p11 = threshold -- below which no synthesis for a band occurs (0-1, try 0.0)
   p12 = attack time -- how long it takes the oscillator for a band to turn
         on fully once the modulator power for that band rises above the
         threshold (seconds, try 0.001)
   p13 = release time -- how long it takes the oscillator for a band to turn
         off fully once the modulator power for that band falls below the
         threshold (seconds, try 0.01])
   p14 = amount of high-passed modulator signal to mix with output
         (amplitude multiplier, try 0.0)
   p15 = cutoff frequency for high pass filter applied to modulator.
         This pfield ignored if p10 is zero.  (Hz, try 5000)
   p16 = input channel
   p17 = pan (0-1 stereo; 0.5 is middle)
   p18 = pfield reference for wavetable to use
   p19 = pfield reference for table giving the carrier scaling curve, as [freq, amp] pairs
   p20 = pfield reference for table giving list of center frequencies (if p4 is zero)

   p3 (amplitude) and p17 (pan) can receive dynamic updates from a table or
   real-time control source.

   p5 (cfreqlo/ftabletransp), p6 (cfreqmult/ftableformat), p18 (wavetable),
   p19 (scalingtable, if used) and p20 (center freq table, if used) should
   be references to pfield table-handles.

   Author:  John Gibson, 8/7/03.
</pre>
<br>
<hr>
<br>


<b>VOCODESYNTH</b> performs a filter-bank analysis of the input channel
(the modulator), and uses the time-varying energy measured in the filter
bands to trigger wavetable notes with corresponding frequencies (the carrier).

<h3>Usage Notes</h3>

This is a bit different from the other VOCODE-family instruments like
<a href="VOCODE2.php">VOCODE2</a>
and
<a href="VOCODE3.php">VOCODE3</a>
in that it does a resynthesis of the signal.
This instrument is similar in some respects to
<a href="PVOC.php">PVOC</a>,
but it is a channel vocoder using a bank of band-pass filters
instead of an FFT analysis (like with phase vocoders).
<p>
If parameter p4 ("nfilts") is &gt; 0, then p5 ("CFREQLO/FTABLETRANSP")
is interpreted as the lowest center frequency of the filters.  This
can be specified in Hz or oct.pc, &lt; 15.0 is the point at which it will be
interepreted as oct.pc.  p6 ("CFREQMULT/FILTMULT") will be interpreted
as a multiplier of p5 -- it will space the center frequencies of all the
filters (up to "nftilts", p4) as a multiple of each succesive center frequency.
For example, p6 = 2.0 will make a stack of octaves;
p6 = 1.5 will make a stack of perfect (Pythagorian) fifths.  To
get stacks of an equal tempered interval (in oct.pc), you can
use the
<a href="/reference/scorefile/cpspch.php">cpspch</a>
convertor:
<ul>
<pre>
           p6 = cpspch(interval) / cpspch(0.0)
</pre>
</ul>
However, if p4 == 0, then p20 ("CFREQTABLE") has to be present.
It is interpreted as a reference to a
table containing the oct.pc center frequencies of all the filters used.
Parametet p6 ("CFREQMULT/FTABLEFORMAT") then serves as a flag
for how the table referenced in p20 will be interpreted.
If p6 == 0, then the table will be interpreted as containing
oct.pc pitch values.  If p6 == 1, then the table will be interpreted
as linear octave values.  NOTE:  This only applies if the values in the
table ar &lt; 15.0; otherwise they will be interpreted as direct
frequency values regardless of the setting of p6.  The number of filter
bands is determined by length of function table.
<p>
An example of this second method for center frequency specification:
<ul>
<li>Make a table containing the desired center frequencies:
<pre>
   numbands = 5
   cftable - <a href="/reference/scorefile/maketable.php#literal">maketable</a>("literal", "nonorm", numbands, 8.00, 8.07, 9.00, 9.07, 10.02)
</pre>
or specify the table as direct frequencies:
<pre>
   numbands = 9
   cftable - <a href="/reference/scorefile/maketable.php#literal">maketable</a>("literal", "nonorm", numbands, 100, 200, 300, 400, 500, 600, 700, 800, 900)
</pre>
<li>Set p4 to 0, and pass the "cftable" pfield-handle in through parameter p20.
This table will be transposed by the setting given in p5 ("CFREQLO/FTABLETRANSP").
</ul>
Parameter p9 ("windowsize") determines how often changes in modulator
power are measured.  p10 ("smoothness") operates upon the output of
p9.  It has more of an effect for longer p9 values.
<p>
Parameters p14 ("hisigmix") and p15 ("hifreq") allow some of the
original signal to appear in the output.  This is helpful in capturing
sharp noise transients (such as consonants in speech) that aren't
captured well by standard FFT analysis.  p15 is ignored if p10
is set to 0.
<p>
p18 ("WAVETABLE") is a reference to a waveform table that will be used by
the internal wavetable oscillators.
<p>
p19 ("SCALINGTABLE") is a table used for scaling the carrier notes,
interpreted as [frequency, amplitude] pairs.
<p>
<b>VOCODESYNTH</b> produces both stereo or mono output.

<h3>Sample Scores</h3>


one example:
<pre>
   rtsetparams(44100, 2)
   load("VOCODESYNTH")

   rtinput("mysound.aif")

   inskip = 0.0
   dur = DUR()

   amp = 4.0
   env = maketable("line", 1000, 0,0, .1,1, dur-.1,1, dur,0)

   numbands = 25
   lowcf = 300
   interval = 0.025
   cartransp = 0.00
   bw = 0.009
   winlen = 0.001
   smooth = 0.98
   thresh = 0.0001
   atktime = 0.001
   reltime = 0.01
   hipassmod = 0.0
   hipasscf = 2000

   carwavetable = maketable("wave", 10, 20000, "sine")

   scale1 = 0.5
   scale2 = 1.0
   scalecurve = maketable("curve", "nonorm", 100, 0,scale1,1, 1,scale2)

   spacemult = cpspch(interval) / cpspch(0.0)

   VOCODESYNTH(0, inskip, dur, amp * env, numbands, lowcf, spacemult, cartransp,
      bw, winlen, smooth, thresh, atktime, reltime, hipassmod, hipasscf,
      inchan=0, pan=1, carwavetable, scalecurve)

   cartransp += 0.001
   spacemult += 0.002
   VOCODESYNTH(0, inskip, dur, amp * env, numbands, lowcf, spacemult, cartransp,
      bw, winlen, smooth, thresh, atktime, reltime, hipassmod, hipasscf,
      inchan=0, pan=0, carwavetable, scalecurve)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="CONVOLVE1.php">CONVOLVE1</a>,
<a href="LPCIN.php">LPCIN</a>,
<a href="PVOC.php">PVOC</a>,
<a href="SPECTACLE.php">SPECTACLE</a>,
<a href="SPECTACLE2.php">SPECTACLE2</a>,
<a href="SPECTEQ.php">SPECTEQ</a>,
<a href="SPECTEQ2.php">SPECTEQ2</a>,
<a href="TVSPECTACLE.php">SPECTACLE</a>,
<a href="VOCODE2.php">VOCODE2</a>,
<a href="VOCODE3.php">VOCODE3</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

