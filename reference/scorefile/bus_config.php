<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - bus_config</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>bus_config</b> - configure input and output buses for an instrument
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
<b>bus_config</b>(<i>instrument_name</i>
[, <i>input_bus_range</i>, <i>input_bus_range</i>, ... ],
<i>output_bus_range</i> [, <i>output_bus_range</i>, ... ])
<p>
Parameters inside the [brackets] are optional.
</P>
<P>

<i>(note:  See the
<a href="/tutorials/bus_config.php">bus_config tutorial</a>
for more information on the command.)</i>
<p>


<HR>
<h3>Description</h3>
<P>
RTcmix lets you direct an instrument to receive input from, and deliver
output to, other instruments, as well as sound files and the audio device.
For example, an instrument can read from a sound file and send its output
to another instrument, which in turn can send its output to the audio
device so that you can hear it.  You can create a chain of sound-processing
instruments in this manner.
<p>
This kind of signal routing is made possible by an "aux bus" -- an 
intermediate path for sound to take inside RTcmix.  (The name comes
from aux buses on analog mixers, but the analogy isn't perfect.)
<p>
You can also make use of multi-channel audio hardware with RTcmix.
Most instruments work only in stereo, but you can route their outputs
to any pair of channels.
<p>
You configure the signal-routing path using the <b>bus_config</b> script
command.  This associates an instrument with a set of input and output
buses.  Every call to the instrument following its <b>bus_config</b> uses
this bus configuration.  You can change the configuration for subsequent
instances of the same instrument by calling <b>bus_config</b> again.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_instrument_name"><i>instrument_name</i></A><BR>
<DD>
Name of the instrument whose buses you want to configure, in double-quotes.
<p>
For instrument families, this must be the name of the individual instrument,
not the name of the family.  For example, 
<a href="/reference/instruments/IIR.php">IIR</a>
is the name of a family,
and <a href="/reference/instruments/IIR.php#INPUTSIG">INPUTSIG</a>,
and <a href="/reference/instruments/IIR.php#BUZZ">BUZZ</a>,
and <a href="/reference/instruments/IIR.php#IINOISE">IINOISE</a>
and
and <a href="/reference/instruments/IIR.php#PULSE">PULSE</a>
are names of individual instruments in the family.

<DT><A NAME="item_input_bus_range"><i>input_bus_range</i></A><BR>
<DD>
<DT><A NAME="item_output_bus_range"><i>output_bus_range</i></A><BR>
<DD>
A "bus range" is a description of a bus type, and one or more channels
on that bus.  The bus range must be in double-quotes.  There can be
any number of bus ranges in a <b>bus_config</b> call, as long as they
all make sense.
<p>
There are three bus types:
<DL>
<DT><A NAME="item_in_%2D_input_from_file_or_audio_device"><i>in</i> - input from file or audio device</A><BR>
<DD>
<DT><A NAME="item_out_%2D_output_to_file_or_audio_device"><i>out</i> - output to file or audio device</A><BR>
<DD>
<DT><A NAME="item_aux_%2D_intermediate_bus%2C_used_to_connect_instru"><i>aux</i> - intermediate bus, used to connect instruments</A><BR>
<DD>
</DL>
<P>("Audio device" just refers to the hardware that handles sound I/O,
such as a sound card on a PC or the built-in hardware on a Mac.)
<p>
You combine the bus type with a channel number, or a range of channels
specified by two channel numbers separated by a hyphen.  Channels are
numbered from zero.
<p>
Since an aux bus can function as either an input or an output, you have
to say which.
<p>
Valid bus ranges include "in 0", "out 0-1", "aux 0 in", "aux 4-5 out".
<p>
There must always be at least one <i>output_bus_range</i>.  Instruments
that require input must also have at least one <i>input_bus_range</i>.
<p>
Specifying an output bus that doesn't exist is an error.  The number
of output buses is set using
<A HREF="rtsetparams.php">rtsetparams</A>.
</DL>
<P>


<HR>
<h3>Examples</h3>
<PRE>
   bus_config(&quot;WAVETABLE&quot;, &quot;out 0-1&quot;)</PRE>
<p>
This sends the output of subsequent
<A HREF="/reference/instruments/WAVETABLE.php">WAVETABLE</A>
calls to the first two channels of the audio device, or to a file, if
<A HREF="rtoutput.php">rtoutput</A> has been called.
<PRE>
   bus_config(&quot;WAVETABLE&quot;, &quot;out 0&quot;, &quot;out 1&quot;)</PRE>
<p>
This means the same thing.
<PRE>
   bus_config(&quot;WAVETABLE&quot;, &quot;out 3&quot;, &quot;out 7&quot;)</PRE>
<p>
Output goes to channels 3 and 7 (counting from zero).
<PRE>
   bus_config(&quot;WAVETABLE&quot;, &quot;aux 0-1 out&quot;)</PRE>
<P>Output goes to aux buses 0 and 1.  Unless another instrument reads
these and sends output to the audio device, you'll hear nothing.
<PRE>
   bus_config(&quot;INPUTSIG&quot;, &quot;aux 4-5 in&quot;, &quot;out 0-1&quot;)</PRE>
<p>
Input comes from aux buses 4 and 5; output goes to channels 0 and 1
of the audio device, or a file opened with
<A HREF="rtoutput.php">rtoutput</A>.
<p>Notice that the instrument name is not the family name
(<a href="/reference/instruments/IIR.php">IIR</a>),
but the name of the function you call to make sound.
<PRE>
   bus_config(&quot;FILTSWEEP&quot;, &quot;aux 2 in&quot;, &quot;aux 5 in&quot;,
                           &quot;aux 1 out&quot;, &quot;aux 7 out&quot;)</PRE>
<p>
Reads from aux buses 2 and 5; writes to aux buses 1 and 7.
<PRE>
   bus_config(&quot;STEREO&quot;, &quot;in 0&quot;, &quot;out 0-1&quot;)</PRE>
<p>
You'd think this would read from channel 0 of an input file, even
if the file has more channels.  But RTcmix insists on reading all
channels from a file.  (See below for more about this inconsistency.)
If the last
<A HREF="rtinput.php">rtinput</A>
call gives the source as "MIC", then
the instrument does read just from the first channel.
<PRE>
   bus_config(&quot;WAVETABLE&quot;, &quot;out 3&quot;)
   WAVETABLE(start, dur, amp, freq)
   bus_config(&quot;WAVETABLE&quot;, &quot;out 7&quot;)
   WAVETABLE(start, dur, amp, freq)</PRE>
<p>
The two WAVETABLE notes are identical and play at the same time,
except the first goes to channel 3 and the second goes to channel 7.
<p>For examples of instrument chaining, see the scripts in
RTcmix/docs/sample_scos_3.0/.
<P>


<HR>
<h3>NOTES</h3>
<p>
If you don't call bus_config before using an instrument, you'll get
a default configuration roughly equal to:
<PRE>
   bus_config(&quot;FOO&quot;, &quot;in 0-1&quot;, &quot;out 0-1&quot;)</PRE>
<p>
There are 16 aux buses (though this can be changed by recompiling your
copy of RTcmix -- see MAXBUS in H/bus.h).
<P>


<HR>
<h3>LIMITATIONS</h3>
<P>
<H2><A NAME="an inconsistency for file input">An inconsistency for file input</A></H2>
<p>
When reading from a file, RTcmix ignores the bus numbers you use with
the "in" bus in the call to <b>bus_config</b>.  Instead, it reads all the
channels in the file.  This behavior may change in a future version.
<p>
For more detail, see <i>RTcmix/docs/README.bus_config</i>.
<p>
<H2><A NAME="constraints on reading from an aux bus">Constraints on reading from an aux bus</A></H2>
<p>
A call to an instrument reading from a real-time audio source, whether
it be an aux bus or microphone input, <b>must</b> use an inskip of zero.
You can't read a segment of sound that hasn't happened yet!
<p>
Also, some instruments just won't work well (or at all) when reading
from a real-time source.
<A HREF="/reference/instruments/TRANS.php">TRANS</A>
is an example of this.  When
it transposes up an octave, it has to consume two samples for every
output sample.  So it will always be left gasping for more input.
<p>
For instruments that need to look into the future by a constant interval,
like 
<a href="/reference/instruments/COMPLIMIT.php">COMPLIMIT<a>
with non-zero lookahead, the instrument
merely delays its output enough to "catch up" with its input.  Such
an instrument will work with input from an aux bus.
<p>
<H2><A NAME="multiple bus types">Multiple bus types</A></H2>
<p>
Currently it is not possible to read from both an "in" bus and an "aux"
bus in the same instrument.  Nor is it possible to write to both an "out"
bus and an "aux" bus.
<P>


<HR>
<h3>See Also</h3>
<p>
<A HREF="rtsetparams.php">rtsetparams</A>,
<A HREF="rtinput.php">rtinput</A>,
<A HREF="rtoutput.php">rtoutput</A>,
<A HREF="set_option.php">set_option</A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

