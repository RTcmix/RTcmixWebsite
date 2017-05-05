<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Instrument</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<h3>Instrument</h3>
<i>INSTRUMENT design -- base class for INSTRUMENT creation</i>
<br>
<br>
The <b>Instrument</b> object is used as the base class for deriving
RTcmix user-written INSTRUMENTS.  It is never used directly, although
many of its attributes are essential to RTcmix INSTRUMENT design.
Someone writing an RTcmix instrument generally only needs to fill in
two of the Instrument methods: the <i>INSTRUMENT::init()</i> method
for initializing INSTRUMENT notes, and the <i>INSTRUMENT::run()</i>
method for computing samples.  See the RTcmix instrument design
<a href="/tutorials/instrumentdesign.php">tutorial</a>
for how this is done.
<hr><h3>Class Variables</h3>
<i>NOTE:  Although older RTcmix instruments access and modify many
of these variables directly, it is better to use the 
<a href="#access">Access Methods</a>
described below.  In fact, I'm not even sure that these variables can
be used directly, but it's probably good to know about them.  So here they are...</i>
<ul>
<li><i>float</i> <b>_start</b> is the starting time (in seconds)
of the scheduled INSTRUMENT note.  This is set by the
<a href="rtsetoutput.php">rtsetoutput</a> function.
Use the
<b><a href="#getstart">getstart</a></b>
method to retrieve the value of this variable.
<br>
<br>

<li><i>float</i> <b>_dur</b> is the duration (in seconds)
of the scheduled INSTRUMENT note.  This is set by the
<a href="rtsetoutput.php">rtsetoutput</a> function.
Use the
<b><a href="#getdur">getdur</a></b>
method to retrieve the value of this variable.
<br>
<br>

<li><i>int</i> <b>cursamp</b> is the current sample being computed.
The user should increment this variable in the sample-computing loop
using the
<b><a href="#increment">increment</a></b>
method:
<ul>
<pre>
MYINSTRUMENT::run()
{
	int i;

	...

	for (i = 0; i < framesToRun(); i++)
	{
		...

		increment();
	}
}
</pre>
</ul>
<b>cursamp</b> will range from <i>0</i> to <i>_nsamps-1</i> during
note execution.
Use the
<b><a href="#currentFrame">currentFrame</a></b>
method to retrieve the value of this variable.
<br>
<br>

<li><i>int</i> <b>chunksamps</b> is the number of samples ("frames")
to be computed during each RTcmix scheduler "chunk".  The
<i>INSTRUMENT::run()</i> method is called once for each scheduler "chunk"
for every note executing at a given time.
Use the
<b><a href="#framesToRun">framesToRun</a></b>
method to retrieve the value of this variable.
Also, the
<b><a href="#setchunk">setchunk</a></b>
method can be used to change the value of this variable, although
this may negatively affect the execution of RTcmix.
<br>
<br>

<li><i>int</i> <b>endsamp</b> is the ending sample number (frame).
This is an absolute number from the very start
of RTcmix running (I think...).  In other words, it is (start+dur)*SR.
Use the
<b><a href="#getendsamp">getendsamp</a></b>
method to retrieve the value of this variable.
The
<b><a href="#setendsamp">setendsamp</a></b>
method can be used to change the value of this variable.
<br>
<br>

<li><i>int</i> <b>_nsamps</b> (formerly <b>nsamps</b>)
is the number of samples ("frames")
to be executed for the entire note.  This is computed by RTcmix.
In RTcmix versions prior to 4.0, it used to be
set by the
<a href="rtsetoutput.php">rtsetoutput</a> function
Use the
<b><a href="#nSamps">nSamps</a></b>
method to retrieve the value of this variable.
<br>
<br>

<li><i>struct InputState</i> <b>_input</b> is a structure containing
information about the input devices and/or files to RTcmix.  The structure
is defined as:
<ul>
<pre>
struct InputState {
   InputState();
   int            fdIndex;         // index into unix input file desc. table
   off_t          fileOffset;      // current offset in file for this inst
   double         inputsr;       // SR of input file
   int            inputchans;    // Chans of input file
};
</pre>
</ul>
Two members of this structure have been used in older instruments as
Instrument class variables:
<br>
<br>
<ul>
<li><i>double</i> <b>inputsr</b> is the sampling rate of the
input soundfile or input device (in samples/second).
<br>
<br>
<li><i>int</i> <b>inputchans</b> is the number of input channels
for the input soundfile or input device.
</ul>
<br>
<br>
<i>inputsr</i> and <i>inputchans</i> can no longer be accessed directly.
Use the
<b><a href="#inputChannels">inputChannels</a></b>
method to retrieve the value of the <i>inputchans</i> variable.
The <i>inputsr</i> sampling rate is assumed to be the same as the
value of the <i>SR</i> variable.

<br>
<br>
<li><i>int</i> <b>outputchans</b> is the number of output channels
for the output soundfile or output device.
Use the
<b><a href="#outputChannels">outputChannels</a></b>
method to retrieve the value of this variable.
<br>
<br>


<li><i>int</i> <b>_skip</b> is the number of samples corresponding
to the current <i>resetval</i> set by the
<a href="/reference/scorefile/reset.php">reset</a>
scorefile command.  It is accessed through the
<b><a href="#getSkip">getSkip</a></b>
member function, and can be used in setting up control-rate
branches during note execution.  The default value is 1000.
<br>
<br>


<li><i>float</i> <b>SR</b> -- the output sampling rate (in samples/second)
set by the <a href="/reference/scorefile/rtsetparams.php">rtsetparams</a> directive in the
scorefile.
<br>
<br>
<li><i>int</i> <b>NCHANS</b> -- the number of channels in the output
(should be the same is <i>outputchans</i>
set by the <a href="/reference/scorefile/rtsetparams.php">rtsetparams</a> directive in the
scorefile.
<br>
<br>
<li><i>int</i> <b>RTBUFSAMPS</b> -- the number of samples ("frames") in
each RTcmix buffer (should be the same as <i>chunksamps</i>, I believe).
This can be set by the
<a href="/reference/scorefile/rtsetparams.php">rtsetparams</a> directive in the
scorefile, although it is an optional parameter.  The default value
varies depending on the computing platform.

<br>
<br>
<br>
<br>
There are a bunch of other variables associated with the <b>Instrument</b>
object, but I'll be blamed if I can recall or ascertain what they all do.
Aaah!  I'm old!  Many of them are used internally by RTcmix during
execution, and are of limited utility for an instrument designer.
See the <i>Instrument.h</i> and <i>Instrument.cpp</i>
files in the "RTcmix/src/rtcmix/" directory for a complete
look at these.


<br>
<br>
</ul>

<a name="access"></a>
<hr>
<h3>Access Methods</h3>
<ul>
<a name="currentFrame"></a>
<b>int Instrument::currentFrame()</b>
<br>
<br>
<dd>
returns the current sample (frame) being computed.  This is the value
of the variable <i>cursamp</i>.
</dd>
<br>
<br>
<a name="framesToRun"></a>
<b>int Instrument::framesToRun()</b>
<br>
<br>
<dd>
returns the number of samples (frames) to compute in each
invocation of the <b>Instrument::run()</b> method.  Usually this
is the value of the variable <i>chunksamps</i>.
</dd>
<br>
<br>
<a name="nSamps"></a>
<b>int Instrument::nSamps()</b>
<br>
<br>
<dd>
returns the total number of samples (frames) to run for the note.  This
is the value of the variable <i>_nsamps</i>.
</dd>
<br>
<br>
<a name="inputChannels"></a>
<b>int Instrument::inputChannels()</b>
<br>
<br>
<dd>
returns the number of input channels for the input device
or file (specified
in the <a href="/reference/scorefile/rtinput.php">rtinput</a> scorefile directive).
This is the value of the variable <i>inputchans</i>.
</dd>
<br>
<br>
<a name="outputChannels"></a>
<b>int Instrument::outputChannels()</b>
<br>
<br>
<dd>
returns the number of output channels for the output device
or file (specified
in the <a href="/reference/scorefile/rtsetparams.php">rtsetparams</a> scorefile directive).
This is the value of the variable <i>outputchans</i>.
</dd>
<br>
<br>

<a name="getPFieldTable"></a>
<b>float* Instrument::getPFieldTable(<i>int index, int *tablelen</i>)</b>
<br>
<br>
<dd>
returns a pointer to the floating-point array of a table constructed
by, for example, the
<a href="/reference/scorefile/maketable.php">maketable()</a>
scorefile command. <i>index</i> designates which PField from the
incoming p[]-array (starting from 0, of course)
holds the reference to the table, and
<i>*tablelen</i> is an int variable passed into the
method by reference; the resulting value loaded into
the <i>tablelen</i> variable will be the length of the array.
</dd>
<br>
<br>

<a name="getSkip"></a>
<b>int Instrument::getSkip()</b>
<br>
<br>
<dd>
returns the value of the variable <i>_skip</i>, which is
set by the
<a href="/reference/scorefile/reset.php">reset</a>
scorefile command.  This is the number of samples to count down for
one 'control-rate' period.  See the
<a href="update.php">update</a>
function for an example of how this might be used.  The default
value is 1000.
</dd>
<br>
<br>

<a name="increment"></a>
<b>void Instrument::increment()</b>
<br>
<br>
<dd>
increments the value of <i>cursamp</i>, used to keep track
of how many samples (frames) have been executed.  Equivalent
to <i>++cursamp</i>.
</dd>
<br>
<br>
<b>void Instrument::increment(</b><i>int amount</i><b>)</b>
<br>
<br>
<dd>
increments the value of <i>cursamp</i> by <i>amount</i>,
used to keep track
of how many samples (frames) have been executed.  Equivalent
to <i>cursamp += amount</i>.
</dd>
<br>
<br>
<a name="getstart"></a>
<b>float Instrument::getstart()</b>
<br>
<br>
<dd>
returns the start time (in seconds) of the INSTRUMENT note.  This is the
value of the variable <i>_start</i>.
</dd>
<br>
<br>
<a name="getdur"></a>
<b>float Instrument::getdur()</b>
<br>
<br>
<dd>
returns the duration (in seconds) of the INSTRUMENT note.  This is the
value of the variable <i>_dur</i>.
</dd>
<br>
<br>

<a name="getendsamp"></a>
<b>int Instrument::getendsamp()</b>
<br>
<br>
<dd>
returns the ending sample number (frame) of the INSTRUMENT note.  This is the
value of the variable <i>endsamp</i>.
</dd>
<br>
<br>

<a name="setchunk"></a>
<b>void Instrument::setchunk(</b><i>int chunksize</i><b>)</b>
<br>
<br>
<dd>
sets the value of the <i>chunksamps</i> variable to
<i>chinksize</i>.  This is the number of sample frames that will
be processed during each invocation of the <b>run</b> sample-computing
method.
</dd>
<br>
<br>

<a name="setendsamp"></a>
<b>void Instrument::setendsamp(</b><i>int sampno</i><b>)</b>
<br>
<br>
<dd>
sets the ending sample number (frame) of the INSTRUMENT note to <i>sampno</i>.
This sets the value of the variable <i>endsamp</i>.
</dd>
<br>
<hr width=75%>
<br>
The following virtual methods can be overridden by the INSTRUMENT
designer in building an RTcmix instrument:
<br>
<br>

<a name="init"></a>
<b>int Instrument::init(</b><i>double p[], int n_args</i><b>)</b>
<br>
<br>
<dd>
is called by the parser to set up and schedule an INSTRUMENT for
execution.  The <i>p[]</i> array contains the parameters for
the INSTRUMENT note passed in from the scorefile, and <i>n_args</i>
is the total number of parameters parsed for that INSTRUMENT note.
The maximum size of this <i>p[]</i> array is set by
<ul>
<pre>
#define  MAXDISPARGS  1024
</pre>
</ul>
in the "RTcmix/src/include/maxdispargs.h" file.  The number of samples
to be computed for the note (see the
<b><a href="#nSamps">nSamps</a></b>
method) is returned, or the token <i>DONT_SCHEDULE</i> if there
was an error in the initialization of the INSTRUMENT note.
See the RTcmix instrument design
<a href="/tutorials/instrumentdesign.php">tutorial</a>
for more information on this INSTRUMENT class method.
</dd>
<br>
<br>

<a name="run"></a>
<b>int Instrument::run()</b>
<br>
<br>
<dd>
is called during RTcmix execution to compute samples for each INSTRUMENT
note that is scheduled.  It is expected that this method will produce
<i>chunksamps</i> samples (see the
<b><a href="#framesToRun">framesToRun</a></b>
method) each time it is called.  Generally the number of samples
computed is returned.
See the RTcmix instrument design
<a href="/tutorials/instrumentdesign.php">tutorial</a>
for more information on this INSTRUMENT class method.
</dd>
<br>
<br>

<a name="configure"></a>
<b>int Instrument::configure()</b>
<br>
<br>
<dd>
is sometimes called to set up sample buffers or initialize run-time
variables for specific INSTRUMENTs.  <b>configure</b> is also called once
at the beginning of a scheduled note (except in the older 'rtinteractive mode'
using a TCP/IP socket interface), so it can be used to perform one-time
tasks that need to happen just as an INSTRUMENT begins a note.
<br>
<br>
0 is returned for a successful completion, -1 otherwise.
</dd>
<br>
<hr width=75%>
<br>
Other INSTRUMENT class methods that are of general utility have their
own documentation entrries.  These include:
<br>
<br>
<ul>
<li><b><a href="rtsetoutput.php">rtsetoutput</a></b>
<br>
<li><b><a href="rtsetinput.php">rtsetinput</a></b>
<br>
<li><b><a href="rtinrepos.php">rtinrepos</a></b>
<br>
<li><b><a href="rtgetin.php">rtgetin</a></b>
<br>
<li><b><a href="rtaddout.php">rtaddout</a></b>
<br>
<li><b><a href="rtbaddout.php">rtbaddout</a></b>
<br>
<li><b><a href="update.php">update</a></b>
</ul>

</ul>

<br>
<blockquote>
<i>[NOTE:  There are a number of other methods associated with the INSTRUMENT
class, but these work upon scheduling aspects of RTcmix execution
that probably shouldn't be addressed within an instrument.  However,
if you need to do this kind of modification, please see the source
files "RTcmix/src/rtcmix/Instrument.cpp"
and "RTcmix/src/rtcmix/Instrument.h"]</i>
</blockquote>
<hr><h3>Examples</h3>
oh there are many of them...

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
