<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - set_option</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>set_option</b> - turn on and off various RTcmix options
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
<b>set_option</b>(<i>option_name</i> [, <i>option_name</i>, ... ])
<p>
Parameters inside the [brackets] are optional.
</P>
<P>


<HR>
<h3>Description</h3>
<P>
Use <b>set_option</b> to control the behavior of RTcmix: whether to
play audio, to report clipping and peak amplitude, to overwrite
existing sound files, and so on.
<p>
The <b>set_option</b> command generally precedes the
<a href="rtsetparams.php">rtsetparams</a>
command because much of what it does effects how
<a href="rtsetparams.php">rtsetparams</a>
sets up the RTcmix process.
</P>
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_option_name"><i>option_name</i></A><BR>
<DD>
An <i>option_name</i> is a double-quoted string of the form
"option = val", where <i>option</i> is a valid RTcmix option for
controlling global aspects of RTcmix execution, and <i>val</i> is
a boolean parameter determining whether to turn the option on or off,
or in certain cases a parameter string used by internally by RTcmix
(hardware device names, etc.).  The boolean values for <i>val</i>
accepted by the RTcmix parser are "yes", "true", "on", and "1" for turning
an option on, and "no", "false", "off", and "0" for turing an option off.  Case
does not matter in the <i>option_name</i> string, and spaces are ignored.
For example:
<pre>
   set_option("audio = on")
   set_option("AUDIO=yes")
   set_option("AUDIO= TRUE")
   set_option("audio=1")
</pre>
are all equivalent.
<p>
A call to <b>set_option</b> can contain more than one <i>option_name</i>,
separated by commas.  There can be more than one call to <b>set_option</b>
in a script.  If two calls to <b>set_option</b> in a script conflict, the
last one will take precedence.
<p>
Some older RTcmix scores will use a <b>set_option</b> system with single
option strings.  These generally took the form "option_on"
or "option_off", depending on whether you wanted to turn the option
on or off.  Again, the case used for the string is not significant.  These
older options are still valid; they are noted in the documentation below.
<p>
The current options are:
<p>


<DL>
<DT><A NAME="audio"><i>audio = [0|1]</i></A><BR>
<DD>
controls whether RTcmix plays audio while executing the scorefile.  Turning
audio off will cause RTcmix to execute faster than real-time if a soundfile
is being written and the scorefile doesn't place a significant load on
the processor or disk.  For instruments taking real-time input, however,
turning the audio off will defeat the input into the instrument.
The older-style <b>set_option</b> used the parameters
<i>"audio_on"</i> and <i>"audio_off"</i> to control this option.
<p>
The default is <i>"AUDIO = ON"</i>.
<P></P>

<DT><A NAME="play"><i>play = [0|1]</i></A><BR>
<DD>
turns off the audio output during scorefile execution.  This option
also interacts with the <b>audio</b> option above.
The older-style <b>set_option</b> used the parameters
<i>"play_on"</i> and <i>"play_off"</i> to control this option.
<p>
The default is <i>"PLAY = ON"</i>.
<P></P>

<DT><A NAME="record"><i>record = [0|1]</i></A><BR>
<DD>
turns off audio input during scorefile execution.  This option
also interacts with the <b>audio</b> option above.  It is also
affected by the older
<a href="#full_duplex">full_duplex_on, full_duplex_off</a>
option.  When <i>record</i> is off (or <i>full_duplex_off</i> is in effect),
then instruments will not receive any real-time input.  In other words,
you need to set <i>"record = true"</i> (or the equivalent "on", "1", etc.)
if you want to process sound from a mic or line real-time input.
Note that this option should be set prior to a call
to the
<a href="rtsetparams.php">rtsetparams</a>
scorefile command.
The older-style <b>set_option</b> used the parameters
<i>"record_on"</i> and <i>"record_off"</i> to change this option.
<p>
The default is <i>"RECORD = OFF"</i>, except in the
<a href="/rtcmix~/">rtcmix~</a>
object; <i>"RECORD = ON"</i> is always enabled for the object.
<P></P>

<DT><A NAME="clobber"><i>clobber = [0|1]</i></A><BR>
<DD>
controls whether RTcmix overwrites existing sound files without asking.
A "true" ("1", "on", etc.) value for <i>clobber</i> means that
overwriting is enabled.
The older-style <b>set_option</b> used the parameters
<i>"clobber_on"</i> and <i>"clobber_off"</i> to control this option.
<p>
The default is <i>"CLOBBER = OFF"</i>.
<P></P>

<DT><A NAME="print"><i>print = [0|1]</i></A><BR>
<DD>
determines whether or not RTcmix will print information to the standard
output and standard error output (i.e. the terminal window) related
to scorefile execution -- note parsing and scheduling information,
instrument messages, etc.  See also the
<a href="print_on.php">print_on</a>
and
<a href="print_off.php">print_off</a>
scorefile commands.
<p>
The default is <i>"PRINT = ON"</i>.
<P></P>

<DT><A NAME="report_clipping"><i>report_clipping = [0|1]</i></A><BR>
<DD>
controls whether RTcmix reports samples that exceed the range provided
by signed 16-bit integers.
The older-style <b>set_option</b> used the parameters
<i>"report_clipping_on"</i> and <i>"report_clipping_off"</i> to
set this option.
<p>
The default is <i>"REPORT_CLIPPING = ON"</i>.
<P></P>

<DT><A NAME="check_peaks"><i>check_peaks = [0|1]</i></A><BR>
<DD>
controls whether RTcmix checks, reports, and stores peak amplitude
stats in soundfile headers.
The older-style <b>set_option</b> used the parameters
<i>"check_peaks_on"</i> and <i>"check_peaks_off"</i> to
alter this option.
<p>
The default is <i>"CHECK_PEAKS = ON"</i>.
<P></P>

<DT><A NAME="exit_on_error"><i>exit_on_error = [0|1]</i></A><BR>
<DD>
determines whether or not RTcmix exits the process when a 'fatal'
error is encountered.  Generally this is the desired behavior,
but if RTcmix is used
<a href="/tutorials/embed.php">embedded within another application</a>,
then a full exit may not be appropriate.
<p>
The default is <i>"EXIT_ON_ERROR = ON"</i>, except in the
<a href="/rtcmix~/">rtcmix~</a>
object; <i>"EXIT_ON_ERROR = OFF"</i> is set because shutting
down the entire max/msp patch or application for an RTcmix
error probably isn't a good idea.
<P></P>

<DT><A NAME="auto_load"><i>auto_load = [0|1]</i></A><BR>
<DD>
sets the ability of RTcmix to automatically load Instruments
if an Instrument name is parsed.  If this option is set to "true",
then an explicit
<a href="load.php">load</a>
command is not required for each Instrument used in the score.
The default directory for Instrument shared libraries is
used (usually RTcmix/shlib), or a different directory
can be set using the
<a href="#dsopath">dsopath</a>
option.
<p>
The default is <i>"AUTO_LOAD = OFF"</i>.
<P></P>

<DT><A NAME="fast_update"><i>fast_update = [0|1]</i></A><BR>
<DD>
allows RTcmix to use a direct-access of static table functions
for certain instruments, thus increasing the efficiency of these
instruments.  Using this option will disable the
<a href="/reference/instruments/pfield-enabled.php">PField-updating</a>
scheme, however.  Tables for waveforms and envelopes need to be
pre-created using <i>fast_update</i>.
<p>
The current list of instruments with this capability includes:
<a href="/reference/instruments/WAVETABLE.php">WAVETABLE</a>,
<a href="/reference/instruments/FMINST.php">FMINST</a>,
<a href="/reference/instruments/MIX.php">MIX</a>,
<a href="/reference/instruments/IIR.php">IIR</a>,
<a href="/reference/instruments/STEREO.php">STEREO</a>
and
<a href="/reference/instruments/TRANS.php">TRANS</a>.

<p>
The default is <i>"FAST_UPDATE = OFF"</i>.
<P></P>

<DT><A NAME="full_duplex"><i>full_duplex_on, full_duplex_off</i></A><BR>
<DD>
controls whether RTcmix opens the audio device for simultaneous
input and output.  This option has largely been superceded by the
<a href="#record">record</a>
option.  Note that this option should be set prior to a call
to the
<a href="rtsetparams.php">rtsetparams</a>
scorefile command, like the <i>record</i> option.
<p>
The default is <i>"FULL_DUPLEX = OFF"</i>, except in the
<a href="/rtcmix~/">rtcmix~</a>
object; <i>"FULL_DUPLEX = ON"</i> is always enabled for the object.
<P></P>

<DT><A NAME="buffer_frames"><i>buffer_frames = nsamps</i></A><BR>
<DD>
This option sets the default number of samples (<i>nsamps</i>)
in each buffer used by RTcmix.  Although this seems a rather
esoteric paramater, it can have a noticeable
effect on RTcmix performance, especially in an interactive
application.  This option should be set prior to a call to the
<a href="rtsetparams.php">rtsetparams</a>
scorefile command, and in fact the third (optional) paramater
for
<a href="rtsetparams.php">rtsetparams</a>
will override this default setting.
<p>
The default is <i>"BUFFER_FRAMES = 4096"</i>, except in the
<a href="/rtcmix~/">rtcmix~</a>
object.  The value for <i>nsamps</i> is determined by max/msp.
<P></P>

<DT><A NAME="buffer_count"><i>buffer_count = nbufs</i></A><BR>
<DD>
This sets the number of buffers (<i>nbufs</i>) used by the audio
conversion device.  It is, in fact, a rather esoteric parameter,
although it can have an effect on RTcmix perfoprmance.
<p>
The default is <i>"BUFFER_COUNT = 2"</i>.
<P></P>

<DT><A NAME="device"><i>device = audio_device_name</i></A><BR>
<DT><i>indevice = audio_device_name</i><BR>
<DT><i>outdevice = audio_device_name</i><BR>
<DD>
This option specifies the audio device to use for input and output.
The <i>audio_device_name</i> is a string referring to a particular
device.  For a discussion of device names used, see the
<a href="http://www.alsa-project.org/alsa-doc/doc-php/asoundrc.php?module=Generic">ALSA Project</a>
device name page.  See also the discussion of input sources for the
<a href="rtinput.php#item_input_source">rtinput</a>
command.
<p>
The <i>device</i> option is useful for specifying multichannel
output devices, taking advantage of the multichannel capability of
RTcmix.  Different devices can be set for input or output using the
<i>indevice</i> or <i>outdevice</i> options.
<p>
The default is to use the internal computer hardware device.
<P></P>

<DT><A NAME="midi_device"><i>midi_indevice = midi_device_name</i></A><BR>
<DT><i>midi_outdevice = midi_device_name</i><BR>
<DD>
These set the MIDI devices to use for MIDI input (<i>midi_indevice</i>)
and output (<i>midi_outdevice</i>).  As with the audio device, see
the
<a href="http://www.alsa-project.org/alsa-doc/doc-php/asoundrc.php?module=Generic">ALSA Project</a>
device name page for a discussion of how the MIDI devices used are named.
<p>
The default is to use the internal computer hardware MIDI device (if
it exists).
<P></P>

<DT><A NAME="dsopath"><i>dsopath = directory_path</i></A><BR>
<DD>
sets up RTcmix to look for Instrument shared libraries in the directory
specified by <i>directory_path</i>.  This can be an absolute or relative
pathname to a directory.  This directory is searched by the
<a href="load.php">load</a>
operation.
<p>
The default is to use the default RTcmix/shlib directory.
<P></P>

<DT><A NAME="rcname"><i>rcname = filename</i></A><BR>
<DD>
This causes RTcmix to load the file <i>filename</i> containing
settings for the various options outlined above.  See the 
<a href="#rtcmixrcnote">note</a>
below...
<p>
The default setting is to use the <i>.rtcmixrc</i> file in the
user's home directory.
<P></P>

<DT><A NAME="homedir"><i>homedir = pathname</i></A><BR>
<DD>
This will set the internal RTcmix 'homeDir' variable to an arbitrary
directory.
<p>
The default setting is to use the user's home directory.  A whole lotta
usin' goin' on.
<P></P>
</DL>
</DL>
</DD>
<P>


<br>
<hr width=90%>
<a name="rtcmixrcnote"</a>
<dd>
<i>NOTE: All of these options may also be specified in a file
</i>.rtcmixrc<i> created in your home directory.  Check the documentation
for the</i>
<a href="../utilities/setup_rtcmixrc.php">setup_rtcmixrc</a><i>
utility command.</i>
</dd>
<hr width=90%>
<br>


<HR>
<h3>Examples</h3>
<PRE>
   set_option("audio = off", "clobber=1")
   rtoutput("myfile.aif")
</PRE>
turns off audio playback and enables overwriting of existing files.
This is the standard way to make a script that writes a sound file.
<PRE>
   set_option("audio=false")
   set_option("clobber = YES")
   rtoutput("myfile.aif")
</PRE>
this does exactly the same thing.
<PRE>
   set_option("record = on")
   rtsetparams(44100, 2, 128)
   rtinput("AUDIO")
</PRE>
sets up RTcmix to process audio received from the audio device
in real time.
<P>


<HR>
<h3>See Also</h3>
<p>
<A HREF="load.php">load</A>,
<A HREF="print_off.php">print_off</A>,
<A HREF="print_on.php">print_on</A>,
<A HREF="rtsetparams.php">rtsetparams</A>,
<A HREF="rtinput.php">rtinput</A>,
<A HREF="rtoutput.php">rtoutput</A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

