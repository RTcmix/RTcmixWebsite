<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - VOCODE2</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>VOCODE2</b> -- channel vocoder
<br>
<i>in RTcmix/insts/jg</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>VOCODE2</b>(outsk, insk, dur, AMP, nfilts, CFREQLO/FTABLETRANSP, CFREQMULT/FILTMULT, transp, filtbw[, filtresponse, hisigmix, hifreq, NOISEAMP, noiserate, PAN, CFREQTABLE])
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
        if p4 == 0, transposition table (oct.pc)
   p6 = if p4 > 0, center frequency spacing multiplier (> 1)
        if p4 == 0, multipler of p5 to add additional filters
   p7 = amount to transpose carrier filters (Hz/oct.pc)
   p8 = filter bandwidth proportion of center frequency (> 0)
   p9 = filter response time (seconds)  [optional; default is 0.01]
   p10 = amount of high-passed modulator signal to mix with output (amplitude multiplier)
         [optional; default is 0]
   p11 = cutoff frequency for high pass filter applied to modulator. (Hz, ignored if p10 == 0)
         [optional, default is 5000 Hz]
   p12 = amount of noise signal to mix into carrier before processing
         (amplitude multiplier applied to full-scale noise signal) [optional; default is 0]
   p13 = specifies how often (in samples) to get new random values from
         the noise generator.  This pfield is ignored if p12 is zero.
         [optional; default is 1 -- a new value every sample]  
   p14 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0.5]
   p15 = table giving list of center frequencies (if p4 == 0)

   p3 (amplitude), p12 (noise amp) and p14 (pan) can receive dynamic updates
   from a table or real-time control source.

   p5 (cfreqlo/ftabletransp), p6 (cfreqmult/filtmult) and p15 cfreqtable should be
   references to pfield table-handles if p4 == 0.

   Author:  John Gibson, 6/3/02
</pre>
<br>
<hr>
<br>


<b>VOCODE2</b> performs a filter-bank analysis of the right input
channel (the modulator), and uses the time-varying energy measured in the
filter bands to control a corresponding filter bank that processes the left
input channel (the carrier).  The two filter banks have identical
characteristics, but there is a way to shift all of the center frequencies
of the carrier's bank.
<p>
The
<a href="VOCODE3.htm">VOCODE3</a>
instrument may be better to use; it is fully updated with
<a href="pfield-enabled.php">pfield-enabled</a>
parameters.

<h3>Usage Notes</h3>

The carrier/modulator approach used in <b>VOCODE2</b>
is similar to the amplitude-envelope following instrument
<a href="FOLLOWER.php">FOLLOWER</a>.
Currently in RTcmix it's not possible for an instrument to take
input from both an "in" bus and an "aux in" bus at the same time.
So, for example, if you want the modulator to come from a microphone,
which must enter via an "in" bus, and the carrier to come from a
<a href="WAVETABLE.php">WAVETABLE</a>
instrument via an "aux" bus, then you must route the
mic into the
<a href="MIX.php">MIX</a>
instrument as a way to convert it from "in" to
"aux in".  If you want the carrier to come from a file, then it
must first go through
<a href="MIX.php">MIX</a>
(or some other instrument) to send it
into an aux bus.  Since the instrument is usually taking input
from an aux bus, the input start time for this instrument must be
zero.  The only exception would be if you're taking the carrier
and modulator signals from the left and right channels of the same sound file.
<p>
The "left" input channel comes from the bus with the lower number;
the "right" input channel from the bus with the higher number.
<p>
This instrument is similar in some respects to
<a href="PVOC.php">PVOC</a>,
but it is a channel vocoder using a bank of band-pass filters
instead of an FFT analysis (like with phase vocoders).
This kind of instrument was originally
designed for cross-synthesis work, but a wide range of effects
are possible.
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
However, if p4 == 0, then p15 ("CFREQTABLE") has to be present.
It is interpreted as a reference to a
table containing the oct.pc center frequencies of all the filters used.
Parameter p5 ("CFREQLO/FTABLETRANSP") is a list of values (oct.pc)
by which those filters will be transposed.
The number of filters will be dependent upon the length of this table.
p6 ("CFREQMULT/FILTMULT") is interpreted as a multiplier of the
values in the p5 table for easier
specification of the filters.  For example, 
if the table has 300 and 500, and p6 is 2, filters will
be constructed at 300, 500, 600, and 1000 Hz.
<p>
Parameters p10 ("hisigmix") and p11 ("hifreq") allow some of the
original signal to appear in the output.  This is helpful in capturing
sharp noise transients (such as consonants in speech) that aren't
captured well by standard FFT analysis.
<p>
When p13 ("noiserate") is greater than 1 sample, successive noise
samples are connected using linear interpolation. This acts as a
low-pass filter; the higher the interval, the lower the cutoff frequency.
<p>
The output of <b>VOCODE2</b> can be either mono or stereo.

<h3>Sample Scores</h3>


one example:
<pre>
   rtsetparams(44100, 2)

   load("VOCODE2")
   load("WAVETABLE")

   bus_config("MIX", "in 0", "aux 1 out")
   bus_config("WAVETABLE", "in 0", "aux 0 out")
   bus_config("VOCODE2", "aux 0-1 in", "out 0-1")

   // modulator
   rtinput("mysound.wav")
   inskip = 0
   dur = DUR() - inskip
   amp = 1
   MIX(0, inskip, dur, amp, 0)

   // carrier
   amp = 5000
   wavet = maketable("wave", 10000, "buzz20")
   pitchtab = { 8.00, 8.02, 8.05, 8.07, 8.08, 8.10, 9.00 }
   numpitches = len(pitchtab)
   transp = octpch(0.00)
   for (i = 0; i < numpitches; i += 1) {
      freq = cpsoct(octpch(pitchtab[i]) + transp)
      WAVETABLE(0, dur, amp, freq, 0, wavet)
   }


   // --------------------------------------------------------------------------
   dur += 5
   maxamp = 10.0
   amp = maketable("line", "nonorm", 1000, 0,0, 0.1,maxamp, dur-2,maxamp, dur,0)

   numfilt = 22
   lowcf = 8.07
   interval = 0.025	// oct.pc
   spacemult = cpspch(interval) / cpspch(0)

   cartransp = 0.00
   bw = 0.0002
   resp = 0.02
   hipass = 0.00
   hpcf = 3000
   noise = 0.2
   noisubsamp = 8
   VOCODE2(0, 0, dur, amp, numfilt, lowcf, spacemult, cartransp, bw, resp, hipass, hpcf, noise, noisubsamp, pan=1)

   spacemult += 0.008	// make right channel sound different
   VOCODE2(0, 0, dur, amp, numfilt, lowcf, spacemult, cartransp, bw, resp, hipass, hpcf, noise, noisubsamp, pan=0)
</pre>
<br>
<br>

another example:
<pre>
   rtsetparams(44100, 2)
   load("VOCODE2")

   rtinput("mysound.wav")

   // carrier
   bus_config("MIX", "in 0", "aux 0 out")
   inskip = 0
   amp = 1
   dur = DUR() - inskip
   MIX(0, inskip, dur, amp, 0)

   // modulator
   bus_config("MIX", "in 0", "aux 1 out")
   inskip = 0
   dur = DUR() - inskip
   amp = 1
   MIX(0, inskip, dur, amp, 0)

   // --------------------------------------------------------------------------
   bus_config("VOCODE2", "aux 0-1 in", "out 0-1")

   maxamp = 1.5
   amp = maketable("line", "nonorm", 1000, 0,maxamp, dur-1,maxamp, dur,0)

   numfilt = 0 // flag indicating that we're using cftab instead of interval stack

   cftab = maketable("literal", "nonorm", 0,
      7.00,
      7.07,
      8.02,
      8.09,
      9.04,
      9.11,
     10.06,
     11.01
   )
   numpitches = tablelen(cftab)

   transp = 0.07
   freqmult = 2.02
   cartransp = -0.02
   bw = 0.008
   resp = 0.0001
   hipass = 0.1
   hpcf = 5000
   noise = 0.01
   noisubsamp = 4

   dur += 2
   VOCODE2(0, 0, dur, amp, numfilt, transp, freqmult, cartransp, bw, resp, hipass, hpcf, noise, noisubsamp, pan=1, cftab)

   transp = transp + 0.002
   VOCODE2(0, 0, dur, amp, numfilt, transp, freqmult, cartransp, bw, resp, hipass, hpcf, noise, noisubsamp, pan=0, cftab)
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
<a href="VOCODE3.php">VOCODE3</a>,
<a href="VOCODESYNTH.php">VOCODESYNTH</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

