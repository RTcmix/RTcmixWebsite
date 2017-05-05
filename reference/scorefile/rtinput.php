<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rtinput</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>rtinput</b> - open a sound file or audio device for reading
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
<b>rtinput</b>(<i>"input_source"</i>)
<P>


<HR>
<h3>Description</h3>
<P>
Call <b>rtinput</b> to open a sound file, or an audio device,
for subsequent reading by real-time instruments.
<P>
("Audio device'' just refers to the hardware that handles sound I/O,
such as a sound card on a PC or the built-in hardware on a Mac.
Different device types may be specified using the
<a href="set_option.php#device">set_option</a> scorefile command.)
<P>
After <b>rtinput</b> opens a sound file, it
prints information about
the file, such as the header type and sampling rate (unless the
<a href="print_off.php">print_off</a>
scorefile command has been issued).
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_input_source"><i>"input_source"</i></A><BR>
<DD>
A text string with
the name of a sound file, in double-quotes, having a header format
that RTcmix understands.  (These include, but are not limited to,
AIFF, AIFC, WAVE, NeXT, and IRCAM.)  Only files with data formats
of 32-bit floating point or 16-bit or 24-bit integer are readable.
NOTE:  mp3 and other compressed formats are not supported at present.
<P>
If <i>input_source</i> is "AUDIO", then input comes from the audio
device.  This lets you send input to RTcmix from a microphone
or line-level source.  The mic/line audio device is selected
using the
<a href="set_option.php#device">set_option</a> scorefile command.
For linux users, there is a utility program called "alsaprobe"
in RTcmix/test/alsa that can list the available devices.  A
similar program exists for OSX users ("coreaudioprobe") in
RTcmix/test/coreaudioprobe.  For 'full duplex' (i.e. input and
output simultaneously) use of RTcmix, OSX users need to create
an "aggregate device" using the AudioMIDISetup.app (in /Applications/Utilities)
with both in and out capabilities.  As an example, this "aggregate
device" is selected using
<a href="set_option.php#device">set_option</a>
as followe:
<ul>
<pre>
set_option("record = on", "device = Aggregate Device:0,0")
rtsetparams(44100,2)
rtinput("AUDIO")
</pre>
</ul>
Note that the
<a href="set_option.php#device">set_option</a>
command has to precede the
<a href="rtsetparams.php">rtsetparams</a>
command in the scorefile.
</DL>
<P>


<HR>
<h3>Examples</h3>
<PRE>
   rtinput("myfile.aif")
</PRE>
<P>
Opens "myfile.aif,'' an AIFF file in the current directory, for reading
by any instruments that follow this line in the script.
<PRE>
   rtinput("/home/bubba/snd/trouble.wav")
</PRE>
<P>
Opens "trouble.wav'' using a full path name.
<PRE>
   rtinput("AUDIO)"
</PRE>
<P>
Opens the audio device for reading.
<P>

<HR>
<h3>See Also</h3>
<p>
<A HREF="bus_config.php">bus_config</A>,
<A HREF="rtsetparams.php">rtsetparams</A>,
<A HREF="rtoutput.php">rtoutput</A>,
<A HREF="set_option.php">set_option</A>,
<a href="DUR.php">DUR</a>,
<a href="PEAK.php">PEAK</a>,
<a href="SR.php">SR</a>,
<a href="filechans.php">filechans</a>,
<a href="filedur.php">filedur</a>,
<a href="filepeak.php">filepeak</a>,
<a href="filesr.php">filesr</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

