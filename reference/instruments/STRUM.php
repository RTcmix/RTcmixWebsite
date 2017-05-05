<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - STRUM</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>STRUM</b> -- extended Karplus-Strong ("plucked string") physical model
with distortion and feedback
<br>
<i>in RTcmix/insts/std</i>

	<br>
	<br>
	<hr>
	<h5>quick syntax:</h5>
	<b>START</b>(outsk, dur, pitch, funddecay, nyqdecay, amp, squish[, pan, deleteflag])
	<br> <br>
	<b>BEND</b>(outsk, dur, pitch0, pitch1, glissfunc, funddecay, nyqdecay[, updaterate, pan])
	<br> <br>
	<b>FRET</b>(outsk, dur, pitch, funddecay, nyqdecay[, pan])
	<br> <br>
	<b>START1</b>(outsk, dur, pitch, funddecay, nyqdecay, distortiongain, feedbackgain, feedbackpitch, cleanlevel, distortionlevel, amp, squish [, pan, deleteflag])
	<br> <br>
	<b>BEND1</b>(outsk, dur, pitch0, pitch1, glissfunc, funddecay, nyqdecay, distortiongain, feedbackgain, feedbackpitch, cleanlevel, distortionlevel, amp, updatefreq[, pan)]
	<br> <br>
	<b>FRET1</b>(outsk, dur, pitch, funddecay, nyqdecay, distortiongain, feedbackgain, feedbackpitch, cleanlevel, distortionlevel, amp[, pan])
	<br> <br>
	<b>VSTART1</b>(outsk, dur, pitch, funddecay, nyqdecay, distortiongain, feedbackgain, feedbackpitch, cleanlevel, distortionlevel, amp, squish, lowvibrato, hivibrato, vibratodepth[, randomseed, updaterate, pan, deleteflag])
	<br> <br>
	<b>VFRET1</b>(outsk, dur, pitch, funddecay, nyqdecay, distortiongain, feedbackgain, feedbackpitch, cleanlevel, distortionlevel, amp, lowvibrato, hivibrato, vibratodepth[, updaterate, pan])
	<ul>
   These instruments have no pfield-enabled parameters.
   Parameters after the [bracket] are optional and
   default to 0 unless otherwise noted.
	</ul>
	<hr>
	<br>

<b>STRUM</b> consists of a set of sub-instruments, each allowing a
slightly different set of performance parameters.
<br>
<br>
<br>

<a name="START"></a>
<b>START</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = pitch (oct.pc)
   p3 = fundamental decay time (seconds)
   p4 = nyquist decay time (seconds)
   p5 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p6 = squish value (0-10)
   p7 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]
   p8 = flag for deleting pluck arrays (used by FRET, BEND, etc.) [optional; default is 0 (no delete)]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope system should be used:

   assumes makegen 1 is the amplitude envelope
</pre>

<a name="BEND"></a>
<b>BEND</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = pitch0 (oct.pc)
   p3 = pitch1 (oct.pc)
   p4 = function table number for pitch glissando
   p5 = fundamental decay time (seconds)
   p6 = nyquist decay time (seconds)
   p7 = update rate (samples) [optional; default is 100)]
   p8 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope system should be used:

   assumes makegen 1 is the amplitude envelope
</pre>

<a name="FRET"></a>
<b>FRET</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = pitch (oct.pc)
   p3 = fundamental decay time (seconds)
   p4 = nyquist decay time (seconds)
   p5 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope sy
stem should be used:

   assumes makegen 1 is the amplitude envelope
</pre>

<a name="START1"></a>
<b>START1</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = pitch (oct.pc)
   p3 = fundamental decay time (seconds)
   p4 = nyquist decay time (seconds)
   p5 = distortion gain (0-100 (or more!))
   p6 = feedback gain (0-10 -- values > 1.0 are very 'fed-back')
   p7 = feedback pitch (oct.pc)
   p8 = clean signal level (0-1)
   p9 = distortion signal level (0-1)
   p10 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p11 = = squish value (0-10)
   p12 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]
   p13 = flag for deleting pluck arrays (used by FRET, BEND, etc.) [optional; default is 0 (no delete)]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope system should be used:

   assumes makegen 1 is the amplitude envelope
</pre>


<a name="BEND1"></a>
<b>BEND1</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = pitch0 (oct.pc)
   p3 = pitch1 (oct.pc)
   p4 = function table number for pitch glissando
   p5 = fundamental decay time (seconds)
   p6 = nyquist decay time (seconds)
   p7 = distortion gain (0-100 (or more!))
   p8 = feedback gain (0-10 -- values > 1.0 are very 'fed-back')
   p9 = feedback pitch (oct.pc)
   p10 = clean signal level (0-1)
   p11 = distortion signal level (0-1)
   p12 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p13 = update rate (samples) [optional; default is 100)]
   p14 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope system should be used:

   assumes makegen 1 is the amplitude envelope
</pre>

<a name="FRET1"></a>
<b>FRET1</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = pitch (oct.pc)
   p3 = fundamental decay time (seconds)
   p4 = nyquist decay time (seconds)
   p5 = distortion gain (0-100 (or more!))
   p6 = feedback gain (0-10 -- values > 1.0 are very 'fed-back')
   p7 = feedback pitch (oct.pc)
   p8 = clean signal level (0-1)
   p9 = distortion signal level (0-1)
   p10 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p11 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope system should be used:

   assumes makegen 1 is the amplitude envelope
</pre>

<a name="VSTART1"></a>
<b>VSTART1</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = pitch (oct.pc)
   p3 = fundamental decay time (seconds)
   p4 = nyquist decay time (seconds)
   p5 = distortion gain (0-100 (or more!))
   p6 = feedback gain (0-10 -- values > 1.0 are very 'fed-back')
   p7 = feedback pitch (oct.pc)
   p8 = clean signal level (0-1)
   p9 = distortion signal level (0-1)
   p10 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p11 = = squish value (0-10)
   p12 = low vibrato rate (Hz)
   p13 = high vibrato rate (Hz)
   p14 = vibrato depth (Hz)
   p15 = random seed value
   p16 = update rate (samples) [optional; default is 100)]
   p17 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]
   p18 = flag for deleting pluck arrays (used by FRET, BEND, etc.) [optional; default is 0 (no delete)]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope system should be used:

   assumes makegen 1 is the amplitude envelope
</pre>

<a name="VFRET1"></a>
<b>VFRET1</b>
<br>
<pre>
   p0 = output start time (seconds)
   p1 = duration (seconds)
   p2 = pitch (oct.pc)
   p3 = fundamental decay time (seconds)
   p4 = nyquist decay time (seconds)
   p5 = distortion gain (0-100 (or more!))
   p6 = feedback gain (0-10 -- values > 1.0 are very 'fed-back')
   p7 = feedback pitch (oct.pc)
   p8 = clean signal level (0-1)
   p9 = distortion signal level (0-1)
   p10 = amplitude (absolute, for 16-bit soundfiles: 0-32768)
   p11 = low vibrato rate (Hz)
   p12 = high vibrato rate (Hz)
   p13 = vibrato depth (Hz)
   p14 = update rate (samples) [optional; default is 100)]
   p15 = pan (0-1 stereo; 0.5 is middle) [optional; default is 0]

   Because this instrument has not been updated for pfield control,
   the older <a href="/reference/scorefile/makegen.php">makegen</a> control envelope system should be used:

   assumes makegen 1 is the amplitude envelope
</pre>
<br>
<hr>
<br>

The <b>STRUM</b> package is a family of related instruments based
on the famous "plucked string" model developed by Kevin Karplus and Alex Strong.
The Karplus-Strong plucked-string algorithm is a subtractive synthesis system
featuring a burst of white noise, a recirculating delay line, a lowpass
filter, an allpass filter, and a snazzy recursion (see Roads, 1997).
<p>
The basic idea is that a burst of noise is pushed through a delay line,
which splits its output, sending one half as output and the rest of it
back into itself after going through a lowpass and allpass filter setup.
The result is a burst of rich sound that gradually loses its higher
harmonics as it decays (as does, interestingly enough, a plucked string).
<p>
Charles Sullivan added an additional delay with waveshaping distortion
to produce a simulation of a distorted electric guitar with
feedback.  The <b>START</b>, <b>BEND</b> and <b>FRET</b> instruments
do the basic Karplus-Strong synthesis, and the <b>START1</b>,
<b>BEND1</b>, <b>FRET1</b>, <b>VSTART1</b> and <b>VFRET1</b>
instruments include the Sullivan distortion/feedback additions.

<h3>Usage Notes</h3>

The <b>STRUM</b> instruments are older, reflected in the
separate instruments for doing vibrato (<b>VSTART1</b> and <b>VFRET1</b>)
and pitch-bending (<b>BEND</b>, <b>BEND1</b>).  This can now
be done using
<a href="pfield-enabled.php">pfield-enabled</a>
parameters.  There are two newer versions of the <b>STRUM</b>
instruments,
<a href="STRUM2.php">STRUM2</a>
(for doing the basic Karplus-Strong algorithm) and
<a href="STRUMFB.php">STRUMFB</a>
(with the Sullivan distortion/feedback extensions).  These are
probably better to use.
<p>
The <b>START</b>, <b>START1</b> and <b>VSTART1</b> instruments
implement the basic synthesis algorithm.  <b>START</b> does
the plucked-string algorithm, <b>START1</b> adds distortion and
feedback, and <b>VSTART1</b> adds randomly-varying vibrato
to <b>START1</b>.
<p>
<b>BEND</b> and <b>BEND1</b> follow a defined
pitch-bend control envelope (created using the older
<a href="/reference/scorefile/makegen.php">makegen</a> control envelope system)
between the pitches "pitch0" and "pitch1" (p3 and p4 in both instruments).
When the control envelope is at 0 then "pitch0" will be played; when
the envelope reaches 1 then "pitch1" will result.  The original
note has to start with a <b>START</b> or <b>START1</b>
instrument -- they are used to setup the initial synthesis.  They
may have 0 duration, however, if the desired pitch-bend should
happen at the beginning of a note.  If not, then the "outsk" (p0)
for the <b>BEND</b> and <b>BEND1</b> instruments should follow
immediately after the originating <b>START</b> or <b>START1</b>
instrument ends.  Additionally, the optional "deleteflag" argument
in <b>START</b>/<b>START1</b> (p8/p13) should be set to 0 (the
default) so that the synthesis information will carry from
the <b>START</b> instruments to the <b>BEND</b> instruments.
<p>
Similarly, the <b>FRET</b>, <b>FRET1</b> and <b>VFRET1</b>
instruments can 'pick up' after a <b>START</b> or <b>START1</b>
initialization.  The  <b>FRET</b>/<b>FRET1</b>/<b>VFRET1</b>
instruments allow the various parameters to change without initializing
a new note -- like sliding a finger up a fretboard of a guitar,
or changing the feedback pitch, or adding vibrato (<b>VFRET1</b>)
after a note has been sustained.  As with the
<b>BEND</b>/<b>BEND1</b> instruments the optional "deleteflag" argument
should be set to 0.
<p>
The <b>VSTART1</b> and <b>VFRET1</b> impart a vibrato to the note.
The upper and lower rates of the vibrato are defined using
the "lowvibrato" and "hivibrato" pfields (p12/p13 in <b>VSTART1</b>,
p11/p12 in <b>VFRET1</b>).  The depth of
the vibrato is defined by the amount of deviation in Hz from the sounding
pitch of the note (p14/p13).  During synthesis, the vibrato rate will vary
randomly for each cycle of the vibrato between the "lowvibrato" and
"hivibrato" rates.  <b>VSTART1</b> allows the setting of a random
seed for this vibrato rate in the optional "randomseed" pfield
(p15).
<p>
For the vibrato and pitch-bend instruments, the rate at which the
pitch-changing will be updated is set as a number of samples
in the optional "updaterate"
parameter (p7 in <b>BEND</b>, p13 in <b>BEND1</b> and p16 in <b>VSTART1</b>).
This rate is independent of the
<a href="/reference/scorefile/reset.php">reset</a>
rate used for pfield updates.  The default is to update every 100 samples.
<p>
Specifying duration involves 3 of the parameters:  "dur" (p1),
"funddecay" (p3 or p4; decay rate of the fundamental) and "nyqdecay"
(p4 or p5; decay rate of partials at the Nyquist frequency).
These can be explained most simply by
thinking about a plucked string's behavior.  After you pluck it, the
sound decays.  The higher partials decay, first, and on downward, until,
finally, the fundamental frequency decays to 0.  You can exert
some influence over 
how this happens with the "nyqdecay" and "funddecay" parameters.
These are specified in seconds.  (Remember that nyquist is the highest
possible frequency for a given sampling rate, in our case 22050 Hz.)  Thus
"nyqdecay" attempts to control the decay rate of the highest,
fastest-decaying partials of the sound.   "funddecay", then, controls the
decay rate of the lowest, slowest-decaying partial.  Now, here's the
tricky part:  if you want a given pluck to ring out for its full decay-time,
you just make sure that funddecay and duration are equal.
If you want to "cut-short" the decay-time of a
pluck, then you can make duration shorter than the funddecay.
Essentially, the ratio of the "funddecay" and "nyqdecay" parameters
effect the brightness of the plucked note.
<p>
If you use the distortion/feedback instruments, and the
"feedbackgain" parameter is high enough (usually this means
&gt; 0.01) then the duration will
sustain for as long as the duration of the note no matter what the
setting of "funddecay".  Feedback!  Sustain!  Rock and Roll!
<p>
The "squish" parameter tells how "squishy" is the item
being used to pluck the string.  Values are integers ranging from 0 to 10
The lower the value, the harder the plucking object (0 is like
plucking with a steel pick).  The higher, the more "fleshy" (fat fingers!).
<p>
The "feedbackpitch" parameter in distortion instruments sets up
a delay corresponding to the desired pitch for the feedback sound.
This does not mean that you will get this pitch as a result.  Instead,
the feedback will generally align with some harmonic of this pitch.
However, not even that is guaranteed.  This is a very non-linear
parameter.  Altering this pitch as a note evolves (using <b>FRET1</b>
or <b>VFRET1</b>) can produce interesting changes in the output,
kind of like Jimi Hendrix leaning into and away from his amplifier
(essentially he was altering the length (pitch) of the feedback
"delay line" between the amp and his guitar).
<p>
"feedbackgain" is a very sensitive parameter.  You can set this
to virtually any value you want, but high values don't necessarily
produce much change.  Often very low values (&lt; 0.01) are necessary
for subtle feedback sounds.
<p>
Simularly, "distortiongain" can be set arbitrarily (we can go 
waaaaay 'beyond 11'), but at some point it won't make much
difference.
<p>
The "cleanlevel" and "distortionlevel" can be set to mix between the
'straight' Karplus-Strong sound and the distorted sound, if desired.
<p>
The "deleteflag" was discussed earlier for the <b>FRET</b> and <b>BEND</b>
instruments.
Generally you can safely let this default to 0.  However,
the <b>STRUM</b> instruments do
allocate memory for some of the delay lines they use.
If you generate huge numbers of notes from an interactive application
you can cause a serious memory drain on the poor computer.  Setting this
optional p-field to "1" will free this memory after every
note, and will allow you to create billions and billions of notes.  A
setting of "1" will disable any future <b>FRET</b>/<b>FRET1</bs or
<b>BEND</b>/<b>BEND1</b>s on that particular
note, though... because the memory is freed, the
<b>FRET</b>s or <b>BEND</b>s will not have any sound to work with.
<p>
All of these instruments can produce mono or stereo output.

<h3>Sample Scores</h3>


very basic:
<pre>
   rtsetparams(44100, 1)
   load("STRUM")

   START1(0, 7, 6.08, 1, 1, 10, 0.05, 7.00, 0, 1, 10000, 2)
   START1(8, 7, 6.08, 1, 1, 10, 0.05, 7.01, 0, 1, 10000, 2)
   START1(16, 7, 6.08, 1, 1, 10, 0.05, 6.01, 0, 1, 10000, 2)
</pre>
<br>
<br>

slightly more advanced:
<pre>
   rtsetparams(44100, 2)
   load("STRUM")

   srand(0.314)

   makegen(1, 24, 1000, 0,1, 1,1) // amplitude envelope
   pitches = {7.00, 7.02, 7.05, 7.07, 7.10, 8.00, 8.07}
	lpitches = len(pitches)
   
   for (st = 0; st < 15; st = st + 0.1) {
      pindex = trand(0, lpitches)
      pitch = pitches[pindex]
      START(st, 1.0, pitch, 1.0, 0.1, 10000.0, 1, random())
   }
</pre>
<br>
<br>

another one:
<pre>
   rtsetparams(44100, 2)
   load("STRUM")

   srand(0.414)

   makegen(1, 24, 1000, 0,1,1,1) // amplitude envelope
   pitches = {7.00, 7.02, 7.05, 7.07, 7.10, 8.00, 8.07}
	lpitches = len(pitches)
 
   for (st = 0; st < 15; st = st + 0.2) {
      pindex = trand(0, lpitches)
      pitch = pitches[pindex]
      stereo = random()
      START(st, 0.05, pitch, 1.0, 0.1, 10000, 1,  stereo)
      FRET(st+0.05, 0.05, pitch+0.07, 1.0, 0.1, stereo)
      FRET(st+0.1, 0.05, pitch+0.04, 1.0, 0.1, stereo)
      FRET(st+0.15, 0.05, pitch+0.02, 1.0, 0.1, stereo)
   }
</pre>
<br>
<br>

fun stuff!
<pre>
   rtsetparams(44100, 1)
   load("STRUM")

   START1(0, 2, 6.08, 1, 1, 10, 0.05, 7.00, 0, 1, 10000, 2)

   makegen(10, 24, 1000, 0, 0, 1, 1, 2, 0) // pitch bend envelope
   BEND1(2, 4, 6.08, 7.00, 10, 1, 1, 10, 0.05, 7.00, 0, 1, 10000, 100)

   FRET1(6, .2, 6.10, 1, 1, 10, 0.05, 7.00, 0, 1, 10000)
   FRET1(6.2, .1, 7.00, 1, 1, 10, 0.05, 7.00, 0, 1, 10000)
   FRET1(6.3, .1, 7.02, 1, 1, 10, 0.05, 7.00, 0, 1, 10000)
   FRET1(6.4, .1, 7.00, 1, 1, 10, 0.05, 7.00, 0, 1, 10000)
   FRET1(6.5, 1, 6.10, 1, 1, 10, 0.5, 7.00, 0, 1, 10000)
   FRET1(7.5, 1, 6.10, 1, 1, 10, 0.5, 7.07, 0, 1, 10000)
   FRET1(8.5, 1, 6.10, 1, 1, 10, 0.5, 7.09, 0, 1, 10000)
   FRET1(9.5, 2, 6.10, 1, 1, 10, 0.5, 6.01, 0, 1, 10000)
   FRET1(11.5, 2, 6.10, 1, 1, 10, 0.5, 8.01, 0, 1, 10000)
</pre>
<br>


<hr>
<h3>See Also</h3>

<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="MSITAR.php">MSITAR</a>,
<a href="STRUM2.php">STRUM2</a>,
<a href="STRUMFB.php">STRUMFB</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

