<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Tutorials - PFields</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>A Short Tour of PField Capabilities</h1>


The <i>PField</i> control mechanism, introduced in RTcmix v. 4.0, is
a way to control aspects of Instruments as notes are executing.  What
the heck does that mean?  Well, instrument parameters that are
"pfield-enabled" can receive and respond to data as a note is
being synthesized.  In previous versions of RTcmix, the parameters
a note had when it was scheduled was the parameters it got.  Period.
Using PField control, note parameters can be changed dynamically.
This is accomplished using special
variables called <i>pfield-handles</i> or <i>table-handles</i>.
<p>
These two terms are used somewhat interchangeably because they
both accomplish pretty much the same thing, and they both allow
pretty much the same operations.  There is a difference, however,
in that <i>table-handles</i> generally deal with data that is
fixed in advance (such as wavetables), although potentially modifiable
during sound synthesis.  <i>pfield-handles</i> are usually variables
through which data generated "on-the-fly" will be sent.  For the
purposes of this 'short tour', we won't really differentiate between
the two.
<p>
The best way to get a handle on these <i>handles</i> is to see
how they are used.  Suppose that we have what we think is an
almost perfect sound:
<pre>
       rtsetparams(44100, 2)
       load("WAVETABLE")

       amp = maketable("window", 1000, "hanning")
       wavetable = maketable("wave", 1000, "tri")

       WAVETABLE(0, 3.5, 20000*amp, 7.05, 0.5, wavetable)
</pre>
We are using two <i>table-handles</i> already: <i>amp</i>
and <i>wavetable</i>.  However, this is only an <u>almost</u>
perfect sound.  Our unerring internal aesthetic sensibility tells
us that it would be <u>absolutely</u> perfect if only we could add
a little vibrato to the note.
<p>
There are two ways to do this.  The HARD WAY is to 
<a href="instrument_design.php">rewrite the instrument</a>
to accommodate another oscillator to do the vibrato-ing.
The EASY WAY is to notice in the
<a href="/reference/instruments/WAVETABLE.php">WAVETABLE</a>
documentation that p3 (the pitch) is 'pfield-enabled'.  This
means that we can dynamically change the pitch of the note as
it plays.  Hey!  That's what vibrato is!
<p>
How can we generate a vibrato pitch deviation to use in WAVETABLE
p3?  The pfield-generating scorefile command
<a href="/reference/scorefile/makeLFO.php">makeLFO</a>
is what we need ("LFO" stands for <b>L</b>ow <b>F</b>requency
<b>O</b>scillator).
<p>
We are specifying the pitch of our almost-perfect sound using
octave.pitch-class notation (7.05).  In this notation, one semitone
on the equal-tempered scale is equivalent to 0.01.  If we want
our vibrato to deviate from the base pitch by one-half semitone
above and below the pitch, then we need to generate an LFO
signal that will travel between -0.005 and +0.005, and then add
this to our base pitch.  <i>makeLFO</i> makes this trivial
to do:
<pre>
       vibsig = makeLFO("sine", 1.5, -0.005, 0.005)
       WAVETABLE(0, 3.5, 20000*amp, 7.05+vibsig, 0.5, wavetable)
</pre>
The pfield-handle variable <i>vibsig</i> will track a sine waveform
that cycles at 1.5 Hz, travelling between -0.005 and +0.005.  Adding this
to the base pitch of 7.05 will give us a sound that modulates between
7.045 and 7.055.  Our perfect sound!
<p>
One caution about the above code -- the <i>vibsig</i> deviating between
-0.005 and +0.005 will work fine for an oct.pitch-class of 7.05, but
be wary of what would happen if our base pitch was 8.00 (think about it).
Often a vibrato is better done using a direct frequency (Hz)
specification.
<p>
Noticing that other p-fields of WAVETABLE are listed as "pfield-enabled",
it might be fun to extend our real-time control.  Let's imagine
that we want to randomly pan our vibrato-ed note between the two
output channels.  A handy <i>pfield-handle</i> command called
<a href="/reference/scorefile/makerandom.php">makerandom</a>
seems like it would do the job nicely:
<pre>
       pan = makerandom("linear", 2.0, 0.0, 1.0)
       WAVETABLE(0, 3.5, 20000*amp, 7.05+vibsig, pan, wavetable)
</pre>
The problem is that <i>makerandom</i> command above generates
discrete values 2.0 times/second, and this causes discontinuous
shifts in the signal between the two channels (i.e. clicks).  We
need a way of smoothing the signal coming through the <i>pan</i>
variable.  The <i>pfield-handle</i> command <i>makefilter</i>
can accomplish this:
<pre>
       pan = makerandom("linear", 2.0, 0.0, 1.0)
       smoothpan = makefilter(pan, "smooth", 70)
       WAVETABLE(0, 3.5, 20000*amp, 7.05+vibsig, smoothpan, wavetable)
</pre>
This vibrato-ed sound is so wonderful that <u>TWO</u> vibrato-ed
notes will obviously double our musical pleasure.  But we want to
be artistically engaging about our sonic productions, so we decide
that we want one note to vibrato in exactly the opposite direction
(pitch-wise, that is) as the other.  We can also use the <i>makefilter</i>
command to do this:
<pre>
       vibsig = makeLFO("sine", 1.5, -0.005, 0.005)
       pan = makerandom("linear", 2.0, 0.0, 1.0)
       smoothpan = makefilter(pan, "smooth", 70)
       WAVETABLE(0, 3.5, 20000*amp, 7.05+vibsig, smoothpan, wavetable)

       vibsig2 = makefilter(vibsig, "invert", 0.0)
       pan2 = makerandom("linear", 2.0, 0.0, 1.0)
       smoothpan2 = makefilter(pan2, "smooth", 70)
       WAVETABLE(0, 3.5, 20000*amp, 7.05+vibsig2, smoothpan2, wavetable)
</pre>
Note the use of separate <i>pan/pan2</i> and <i>smoothpan/smoothpan2</i>
variables for the two WAVETABLE notes.  This is so that the two notes
would have independent panning trajectories.  Be aware that in general
most <i>pfield-handle</i> variables are assumed to be assigned
to only one executing note.  At present (RTcmix 4.0) this is part of
how the PField system works; the <i>pfield-handle</i> variables
'draw' data into the note, and it is assumed that each one will
be relatively unique.  You can, however, reuse <i>pfield-handle</i>
variable names in the scorefile, so that if you wanted to have two
WAVETABLE notes with vibrato operating with the same LFO
frequency, you could do the following:
<pre>
       vibsig = makeLFO("sine", 1.5, -0.005, 0.005)
       WAVETABLE(0, 3.5, 20000*amp, 7.05+vibsig, 0.0, wavetable)
       vibsig = makeLFO("sine", 1.5, -0.005, 0.005)
       WAVETABLE(0, 3.5, 20000*amp, 7.02+vibsig, 1.0, wavetable)
</pre>
But <i>table-handles</i> don't have this restriction, and
<i>IN THE FUTURE</i> this will probably be lifted for every
use of <i>pfield-</i> and <i>table-handles</i>.
<p>
As a final modification to our incredibly amazing
vibrato sound, let's suppose that we want to show off
our highly-trained abilities to move a mouse/cursor to control
the amplitude of our notes.  Instead of assigning the
<i>amp</i> variable to a <i>table-handle</i> (<i>maketable</i>),
we can do this:
<pre>
       amp = makeconnection("mouse", "x", minval=0.0, maxval=1.0, default=0.5, lag=80)
</pre>
and the 0.0-1.0 amplitude range will be
determined by the mouse/cursor position along the x-axis in a
window that will be created when the scorefile executes.
We can use this variable in both
instances of WAVETABLE because the data is being read continuously
from the mouse position.
<p>
So our final, <u><i>Absolutely Amazing and Wonderful</i></u>
scorefile is:
<pre>
       rtsetparams(44100, 2)
       load("WAVETABLE")

       amp = makeconnection("mouse", "x", 0.0, 1.0, 0.5, 80)
       wavetable = maketable("wave", 1000, "tri")

       vibsig = makeLFO("sine", 1.5, -0.005, 0.005)
       pan = makerandom("linear", 2.0, 0.0, 1.0)
       smoothpan = makefilter(pan, "smooth", 70)
       WAVETABLE(0, 35.0, 20000*amp, 7.05+vibsig, smoothpan, wavetable)

       amp2 = makeconnection("mouse", "x", 0.0, 1.0, 0.5, 80)
       vibsig2 = makefilter(vibsig, "invert", 0.0)
       pan2 = makerandom("linear", 2.0, 0.0, 1.0)
       smoothpan2 = makefilter(pan2, "smooth", 70)
       WAVETABLE(0, 35.0, 20000*amp2, 7.05+vibsig2, smoothpan2, wavetable)
</pre>
We have increased the duration to 35.0 seconds because it is just
so much fun to play around with the amplitude using the mouse.  We also
might have reused the variables <i>amp, vibsig, pan</i> and <i>smoothpan</i>
in the second WAVETABLE note, but decided to give them separate names
for the heck of it.


<br>
<h2>Useful PField Scorefile Commands</h2>


The following, in no particular order, are scorefile commands that
can be used to create and manipulate <i>pfield-handles</i>
and <i>table-handles</i>:
<ul>
<i><u>table-handle commands</u></i>
<br>
<br>
<li>
<a href="/reference/scorefile/maketable.php">maketable</a>
	-- the general command for creating 'tables', or arrays of
	values that can be used as control functions, waveforms, etc.
<br>
<li>
<a href="/reference/scorefile/modtable.php">modtable</a>
	-- this command can be used to modify the data from from a
	<i>table-handle</i>.
<br>
<li>
<a href="/reference/scorefile/copytable.php">copytable</a>
	-- this makes a copy of a table from a <i>table-handle</i>
	variable.  Very useful for guaranteeing that you have 'fixed'
	data... many of the <i>table-handle</i> and <i>pfield-handle</i>
	commands operate on data 'on the fly', or as it is being generated.
	<i>copytable</i> can be used to increase execution efficiency, also.
<br>
<li>
<a href="/reference/scorefile/tablelen.php">tablelen</a>
	-- returns the length (number of elements)
	of a table from a <i>table-handle</i>.
<br>
<li>
<a href="/reference/scorefile/add.php">add</a>,
<a href="/reference/scorefile/div.php">div</a>,
<a href="/reference/scorefile/mul.php">mul</a>,
<a href="/reference/scorefile/sub.php">sub</a>
	-- arithmetic operations that work on all the data in a table given a
	<i>table-handle</i> variable.
<br>
<br>
<br>
<i><u>pfield-handle commands</u></i>
<br>
<br>
<li>
<a href="/reference/scorefile/makeLFO.php">makeLFO</a>
	-- generate Low Frequency Oscillation (usually < 20 Hz) data
	and feed it through a <i>pfield-handle</i> variable.
<br>
<li>
<a href="/reference/scorefile/makerandom.php">makerandom</a>
	-- periodically generate some type of random number
	and feed it through a <i>pfield-handle</i> variable.
<br>
<li>
<a href="/reference/scorefile/makeconnection.php">makeconnection</a>
	-- establish a connection to an 'outside' data source
	and feed it through a <i>pfield-handle</i> variable.
<br>
<li>
<a href="/reference/scorefile/makefilter.php">makefilter</a>
	-- alter the data coming through a <i>pfield-handle</i> variable
	in some way and feed the result through another
	<i>pfield-handle</i> variable.
<br>
<li>
<a href="/reference/scorefile/makeconverter.php">makeconverter</a>
	-- apply a data conversion operation (like
	<a href="/reference/scorefile/octcps.php">octcps</a>,
	<a href="/reference/scorefile/pchmidi.php">pchmidi</a>,
	<a href="/reference/scorefile/ampdb.php">ampdb</a>,
	etc.) to the data coming through a <i>pfield-handle</i> variable
	feed the result through another <i>pfield-handle</i> variable.
<br>
<br>
<br>
<i><u>data output and display  commands</u></i>
<br>
<br>
<li>
<a href="/reference/scorefile/samptable.php">samptable</a>
	-- return a value from a table given a <i>table-handle</i>.
<br>
<li>
<a href="/reference/scorefile/makemonitor.php">makemonitor</a>
	-- display or record data coming through a <i>pfield-handle</i>
	variable.
<br>
<li>
<a href="/reference/scorefile/plottable.php">plottable</a>
	-- plot the data in a table from a <i>table-handle</i>.
<br>
<li>
<a href="/reference/scorefile/dumptable.php">dumptable</a>
	-- print out the contents of a table given a <i>table-handle</i>.
</ul>
<br>
<br>
Brad Garton
<br>
July, 2005


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

