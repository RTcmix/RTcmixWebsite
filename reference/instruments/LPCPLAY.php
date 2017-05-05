<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - LPCPLAY/LPCIN</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>LPCPLAY/LPCIN</b> -- linear-predictive filter coding resynthesis
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>LPCPLAY</b>(outsk, dur, AMP, PITCH, startframe, endframe[, WARP, RESONCF, RESONBW])
	<br><br>
	<b>LPCIN</b>(outsk, insk, dur, AMP, startframe, endframe[, WARP, RESONCF, RESONBW])
	<br><br>
	<b>dataset</b>(name [, npoles])
	<br><br>
	<b>lpcstuff</b>(thresh, noiseamp [, unvoicedrate, rise, decay, threshcutoff])
	<br><br>
	<b>set_thresh</b>(voiced_thresh, unvoiced_thresh)
	<br><br>
	<b>setdev</b>(dev)
	<br><br>
	<b>set_hnfactor</b>(factor)
	<br><br>
	<b>setdevfactor</b>(devfactor)
	<br><br>
	<b>freset</b>(param)
	<br><br>
	<b>use_autocorrect</b>(???)

	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/pfieldblurb.inc'); ?>
	<hr>
	<br>

The subcommands of <b>LPCPLAY</b> are used to set various parameters
for the LPC synthesis.  Several of them necessarily need to precede
the <b>LPCPLAY</b> command itself.  See the <i>Usage Notes</i>
below.
<br>
<br>
<br>

<b>LPCPLAY</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = amplitude multiplier (relative multiplier of original signal)
   p3 = transposition (oct.pc, relative to base pitch of original signal
      or absolute pitch -- it will try to 'cluster' near the specified pitch)
   p4 = starting LPC frame
   p5 = ending LPC frame
   p6 = warp factor (-1.0 - 1.0)  [optional; default is 0]
   p7 = reson center frequency [optional; 0 bypasses]
   p8 = reson bandwidth [optional; used only if p7 is specified]

   p2 (amplitude), p3 (transposition), p6 (warp), p7 (reson cf) and p8 (reson bw)
   can receive dynamic updates from a table or real-time contol source.
</pre>
<br>

<b>LPCIN</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = input start time (seconds)
   p2 = duration (seconds)
   p3 = amplitude multiplier (relative multiplier of original signal)
   p4 = starting LPC frame
   p5 = ending LPC frame
   p6 = warp factor (-1.0 - 1.0)  [optional; default is 0]
   p7 = reson center frequency [optional; 0 bypasses]
   p8 = reson bandwidth [optional; used only if p7 is specified]

   p2 (amplitude), p3 (transposition), p6 (warp), p7 (reson cf) and p8 (reson bw)
   can receive dynamic updates from a table or real-time contol source.
</pre>
<br>

<b>dataset</b>
<br>
<pre>
   p0 = dataset name (the file with LPC analysis data)
   p1 = number of filter poles in the original analysis [optional; the default value
      0 will cause the number of filter poles to be read from the analysis file]

   NOTE: this subcommand is required for LPCPLAY to function
</pre>
<br>

<b>lpcstuff</b>
<br>
<pre>
   p0 = voice/unvoiced threshold (usually <= 0.1 for normal resynthesis)
   p1 = noise amplitude (usually <= 0.1 for normal resynthesis)
   p2 = unvoiced frame rate [optional; the default value 0 will cause voiced and
      unvoiced frames to be synthesized at the same rate]
   p3 = rise [optional; default 0]
   p4 = decay [optional; default 0]
   p5 = threshold cutoff [optional; default 0]

   it is unclear what p3, p4 and p5 do (values &gt 1 may yield hi-pass filtering).
   it is also unclear if p0 functions in this command.
   Use the <b>set_thresh</b> subcommand instead.

   NOTE: this subcommand is required for LPCPLAY to function
</pre>
<br>

<b>set_thresh</b>
<br>
<pre>
   p0 = voiced (buzz) threshold (usually close to 0.1)
   p1 = unvoiced (noise) threshold (usually close to 0.1 also)

   NOTE: this subcommand is optional for LPCPLAY to function
</pre>
<br>

<b>set_hnfactor</b>
<br>
<pre>
   p0 = harmonic count in buzz (voiced) signal (should be > 0)

   NOTE: this subcommand is optional for LPCPLAY to function
</pre>

<b>setdevfactor</b>
<br>
<pre>
   p0 = this sort-of works like <b>set_dev</b>,but not sure exactly how

   NOTE: this subcommand is optional for LPCPLAY to function
</pre>
<br>

<b>freset</b>
<br>
<pre>
   p0 = resets how often the frames are reinitialized.  Not sure what effect this has...

   NOTE: this subcommand is optional for LPCPLAY to function
</pre>
<br>

<b>use_autocorrect</b>
<br>
<pre>
   p0 = 0 or 1, turns this on or off.  It looks unimplemented, though.

   NOTE: this subcommand is optional for LPCPLAY to function
</pre>
<br>
<hr>
<br>

<b>LPCPLAY</b> is one of the oldest and least-updated instruments in
the RTcmix distribution.  It is a fairly complex instrument, and
it requires a number of steps (and "massaging" of data) for it
to function properly.  It is a fairly specific synthesis technique
(called "source-filter" or "formant" synthesis, using a real-world
model; typically a human voice or an instrument with pronounced
filter formants), and it also has a relatively unique sound.  Paul
Lansky used LPC for many of his early 'breakthrough' computer-music
pieces, such as <i>Six Fantasies on a Poem by Thomas Campion</i>
and his <i>Idle Chatter</i> pieces.

<h3>Usage Notes</h3>

To use <b>LPCPLAY</b>, you first need to create an LPC analysis.
The best program for doing this is Doug Scott's
<a href="http://music.columbia.edu/~doug/MixViews/MiXViews.html">MiXViews</a>
app.  MiXViews extracts the filter (formant) information and does a
pitch analysis on your source (or model) file.  The resulting file
(using the ancient term "dataset") is then read by the <b>LPCPLAY</b>
instrument and used to guide the sound synthesis.
<p>
There are many parameters that can be set, and many of them interact
with each other.  Here are a few of the effects possible:
<ul>
<li>The frame rate of the original analysis is typically 200-300 frames/second
[NOTE:  This is set in the original analysis; i.e. by MixViews].
By altering the startframe and endframe relative to the duration specified
in <b>LPCPLAY</b>, time-stretching or time-compression of the resynthesized
sound will occur.
<br>
<li>The <b>set_thresh</b> subcommand determines when the resynthesis
algorithm will use a pitched (buzz) sound source or an unpitched (noise)
sound source to send through the filters.  This is intended to allow
for the synthesis of vowels (pitched) and consonants (unpitched).
The determination is made by checking the error value of the pitch-tracking
algorithm and comparing it to the thresholds specified.
Setting the voiced_thresh parameter to a negative number and the
unvoiced_thresh to 0.0 will produce a completely unvoiced ("whispered")
output.  Setting them both to a value &gt 1.0 (the unvoiced_thresh has
to be &gt the unvoiced_thresh) will result in completely 'voiced' speech.
<br>
<li>The pitch parameter in <b>LPCPLAY</b> can be used to specify a relative
transposition (in oct.pc) of the original pitch analysis (i.e. 0.02 will
transpose the sound up 2 semitones, -0.0587 will transpose down 5.87 semitones).
If an oct.pc pitch is given &gt 1.0, the synthesis will use that
base as a 'center' for the original pitch analysis and adjust the pitches
accordingly.
<br>
<li><b>setdev</b> controls how much an adjusted pitch analysis will
'spread' -- a value of 1 will produce almost no spread, i.e. a single
pitch.  Higher values will start reflecting more and more of the
pitch deviation from the original pitch analysis.  0 turns this
action off.
<br>
<li>The warp parameter will shift the filter formants up or down from
their original values.  &gt 0.0 causes an upwards shift, &lt 0.0 does
a downward shift.
</ul>
<b>LPCIN</b> functions the same way as <b>LPCPLAY</b>, except
that an input soundfile takes the place of the pitched (buzz)
signal in the resynthesis.  The various threshold parameters
then determine when this input sound will be sent through the
filters.  The result is a vocoder-like sound.  It is usually
wise to choose a source sound with a wide frequency range
represented, as the LPC filters subtract quite a bit from the
signal.
<p>
Care should be taken in the original analysis to fix unstable filter
frames and "massage" the pitch tracking data for best results.
<p>
NOTE:  <b>LPCPLAY</b> is a mono-output instrument.

<h3>Sample Scores</h3>

very basic:
<pre>
   rtsetparams(44100, 1)
   load("LPCPLAY")

   dataset("myanalysisfile.lpc")

   lpcstuff(0.09, 0.1)
   set_thresh(0.09, 0.1)

   // basic resynthesis, frames 1-890 for a duration of 4.5 seconds
   LPCPLAY(0, 4.5, 1.0, 0.0, 1, 890)
</pre>
<br>
<br>
another basic one:
<pre>
   rtsetparams(44100, 1)
   load("LPCPLAY")

   dataset("myanalysisfile.lpc")

   lpcstuff(0.09, 0.1)
   set_thresh(-1.0, 0.0) // unvoiced ("whispering") resynthesis

   // stretch the time by a factor of 2, still using frames 1-890
   LPCPLAY(0, 2*4.5, 1.0, 0.0, 1, 890)
</pre>
<br>
<br>
an LPCIN example:
<pre>
   rtsetparams(44100, 1)
   load("LPCPLAY")

   rtinput("mysoundfile.aif")

   dataset("myanalysisfile.lpc")

   lpcstuff(0.09, 0.1)
   set_thresh(0.09, 0.1)

   LPCIN(0, 0.0, 4.5, 1.0, 0.0, 1, 890)
</pre>
<br>
<br>
slightly more advanced:
<pre>
   rtsetparams(44100, 1)
   load("LPCPLAY")

   dataset("myanalysisfile.lpc")

   lpcstuff(0.09, 0.1)
   set_thresh(0.09, 0.1)

   // time-stretch and build a floating chord
   LPCPLAY(0, 14.5, 1.0, 0.0, 1, 890)
   LPCPLAY(0, 14.5, 1.0, -0.02, 1, 890)
   LPCPLAY(0, 14.5, 1.0, 0.05, 1, 890)
   LPCPLAY(0, 14.5, 1.0, 0.07, 1, 890)
</pre>
<br>
<br>
another slightly more advanced:
<pre>
   rtsetparams(44100, 1)
   load("LPCPLAY")

   dataset("myanalysisfile.lpc")

   lpcstuff(0.09, 0.1)
   set_thresh(0.09, 0.1)

   setdev(1) // monotone pitch, virtually no deviation
   // warp formants down, synthesis at middle "C"
   LPCPLAY(0, 4.5, 1.0, 8.00, 1, 890, -0.3)
   // warp formants up, synthesis at "G" below middle "C"
   LPCPLAY(2.1, 4.5, 1.0, 7.07, 1, 890, 0.213)
</pre>
<br>
<br>
an older score, showing various aspects:
<pre>
   rtsetparams(44100, 1)
   load("LPCPLAY")

   dataset("myanalysisfile.lpc")

   lpcstuff(thresh = .09,  randamp = .1,   0, 0,0,0)
   set_thresh(buzthresh = 0.09, noisethresh = 0.1);

   fps = 44100/250

   frame1=0
   frame2=600
   warp=0
   bw=0
   cf=0
   amp=10

   /* this calculation is just a trick to make 'dur' exactly equal to the */
   /* time elapsed between frame1 and frame2 of the lpc data */
   dur=(frame2-frame1)/fps

   /* straightforward synthesis */
   LPCPLAY(start=0,dur,amp,transp = .00001,frame1,frame2,warp,cf,bw)

   setdev(1)  /* very slight deviation about base pitch, flat result */
   LPCPLAY(start=start+dur+1,dur,amp,transp = 8,frame1,frame2,warp,cf,bw)

   setdev(0)  /* back to normal deviation, slower, higher, raise formants */
   LPCPLAY(start=start+dur+1,dur*1.5,amp,transp = .08,frame1,frame2,warp=.2,cf,bw)

   /* lower, slower, lower formants --sex change operation */
   LPCPLAY(start=start+dur*1.5+1,dur*1.5,amp,transp= -.12,frame1,frame2,warp=-.25,cf,bw)

   /* even more */
   LPCPLAY(start=start+dur*1.5+1,dur*1.5,amp,transp= 6.00,frame1,frame2,warp=-.25,cf,bw)

   /* distorted curve, some formant shift, speeding up slightly */
   setdev(30)
   LPCPLAY(start=start+dur*1.5+1,dur*.9,amp,transp=.02,frame1,frame2,warp=-.1,cf,bw)

   /* modify pitch curves */
   setdev(0)
   LPCPLAY(start=start+dur+1,dur*.9,amp,transp=8,frame1,frame2,warp=0,cf, bw,frame1+50,8,frame1+100,7,frame1+150,7.05,frame2,9)

   /* some whispered speech */
   lpcstuff(thresh = -.01, randamp = .1,   0,0,0,0)
   set_thresh(0.9, 1);
   LPCPLAY(start=start+dur+1,dur,amp,transp=8,frame1,frame2,warp=0,cf,bw)

   /* highpass whispered speech */
   LPCPLAY(start=start+dur+1,dur,amp,transp=8,frame1,frame2,warp=0,cf=5,bw=.1)

   /* highpass whispered speech, shift formants */
   LPCPLAY(start=start+dur+1,dur,amp,transp=8,frame1,frame2,warp=-.3,cf=7,bw=.05)

   /* andrews sisters */
   lpcstuff(thresh = .09,  randamp = .1,   0, 0,0,0)
   set_thresh(buzthresh, noisethresh);
   setdev(15)
   amp = 3
   LPCPLAY(start=start+dur+1,dur,amp,transp=.01,frame1,frame2,warp=0,cf=0,bw=0)
   LPCPLAY(start,dur,amp,transp=.05,frame1,frame2,warp=0,cf=0,bw=0)
   LPCPLAY(start,dur,amp,transp=.08,frame1,frame2,warp=0,cf=0,bw=0)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="CONVOLVE1.php">CONVOLVE1</a>,
<a href="EQ.php">EQ</a>,
<a href="FIR.php">FIR</a>,
<a href="FILTERBANK.php">FILTERBANK</a>,
<a href="IIR.php">IIR</a>,
<a href="JFIR.php">JFIR</a>,
<a href="LPCIN.php">LPCIN</a>,
<a href="VOCODE2.php">VOCODE2</a>,
<a href="VOCODE3.php">VOCODE3</a>,
<a href="VOCODESYNTH.php">VOCODESYNTH</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

