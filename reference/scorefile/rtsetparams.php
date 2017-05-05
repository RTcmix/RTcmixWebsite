<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rtsetparams</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>rtsetparams</b> - set sampling rate, output channels, etc.
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P><b>rtsetparams</b>(<i>sampling_rate</i>, <i>num_channels</i> [, <i>buffer_size</i> ])
</P>
<P>


<HR>
<h3>Description</h3>
<P>
Set the sampling rate, number of output channels, and (optionally)
the buffer size for an RTcmix session.
<P>
You must call <b>rtsetparams</b> before calls to
<A HREF="rtinput.php">rtinput</A>,
<A HREF="rtoutput.php">rtoutput</A>,
or instruments.  You can only call <b>rtsetparams</b>
once in a script.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_sampling_rate"><i>sampling_rate</i></A><BR>
<DD>
The sampling rate for all synthesis and processing.  Any input sound
files must have this rate, and the output sound file will have this
rate.  Similarly, the input and output devices (audio hardware) will
have this rate.
<P></P>
<DT><A NAME="item_num_channels"><i>num_channels</i></A><BR>
<DD>
The number of output channels.  This affects any file opened for
writing by
<A HREF="rtoutput.php">rtoutput</A>,
as well as the audio output device.
<P></P>
<DT><A NAME="item_buffer_size"><i>buffer_size</i></A><BR>
<DD>
The number of sample frames in each buffer.  RTcmix instruments
process sound in buffer-sized chunks.  The buffer size determines
the latency for real-time applications, such as sending sound from
a microphone into a reverb instrument.  For situations like that,
you'll want to reduce the <i>buffer_size</i> to minimize the delay
between the input signal and its processed output.  You can have a
<i>buffer_size</i> as small as 64 or even 32, depending on the audio
driver and machine load.
<P>
The default <i>buffer_size</i> is 4096 sample frames.  At a sampling
rate of 44100 kHz, this gives a latency of nearly 0.1 seconds, which
is unsuitable for real-time work.</P>
<P></P></DL>
<P>


<HR>
<h3>NOTES</h3>
<P>
To have an audio device that handles input and output at the same, you
must turn on the <i>record</i> option
before calling <b>rtsetparams</b>.  Do this with
<A HREF="set_option.php#record">set_option</A>
(by saying set_option("record = 1")).
<P>
If you want to write a sound file that has more channels than your 
audio device permits, turn off the audio device with
<A HREF="set_option.php#audio">set_option</A>
before calling <b>rtsetparams</b> (by saying
set_option("audio = off")).
<P>


<HR>
<h3>Examples</h3>
<PRE>
   rtsetparams(44100, 2)
</PRE>
sets up the session for 44100 sampling rate and two output channels.
<PRE>
   rtsetparams(44100, 4, 128)
</PRE>
sets up the session for 44100 sampling rate, four output channels, and
a buffer size of 128 sample frames.
<PRE>
   set_option("record=TRUE")
   rtsetparams(44100, 2, 64)
   rtinput("AUDIO")
</PRE>
sets up the session for real-time processing of a signal reaching RTcmix
from the audio device.  You must turn on full duplex operation to tell
the audio device to handle input and output simultaneously.
<P>

<HR>
<h3>See Also</h3>
<p>
<A HREF="rtinput.php">rtinput</A>,
<A HREF="rtoutput.php">rtoutput</A>,
<A HREF="set_option.php">set_option</A>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

