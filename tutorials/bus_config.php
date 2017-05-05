<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Tutorials - Using bus_config</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>Using bus_config</h1>

RTcmix version 3.0 adds a major feature: the ability to route signals
between instruments and to multiple outputs. A new instrument by Dave
Topper, MIXN, takes full advantage of multiple outputs.

<h2>Bus architecture</h2>

Formerly, all instruments added their output into one master mix bus.
Now you can tell an instrument to send its output into an intermediate
bus, called an "aux" bus, and to take its input from another aux bus.
This lets you create a chain of instruments. For example, you could
send the output of WAVETABLE into FLANGE, and then send the output
of FLANGE into REVERBIT. In addition to instrument chaining, RTcmix
lets you make full use of multi-channel audio cards. You can route
STEREO to outputs 0 and 1, while routing FILTSWEEP to outputs 2 and 3.

<h2>The bus_config Minc function</h2>

There are three types of bus:

<blockquote>
  "in"   input from file or from real-time audio source (e.g., mic)<br />
  "aux"  intermediate bus, functioning as either an input or an outputh2<br />
  "out"  output to a file or to the sound card
</blockquote>

You configure the arrangement of buses with a new Minc function,
bus_config. This associates an instrument name with a set of buses.
Every call to the instrument following its bus_config uses this bus
configuration. It's possible to change this with another call to
bus_config, which overrides the first (in the manner of makegen).
<p>
The first argument to bus_config is the name of the instrument, in
double quotes. Following that are any number of bus specification
strings, which combine the name of a bus type ("in", "out") with a
bus number or range of numbers. Buses are numbered from zero. Since
an aux bus can be an input or an output, you have to say which.

Some examples (the quotes are obligatory):

<blockquote>
   bus_config("WAVETABLE", "out 0-1")

		<blockquote>
      This sends the output of subsequent WAVETABLE calls to the
      first two channels of the sound card (or to a file, if rtoutput
      has been called).
		</blockquote>

   bus_config("WAVETABLE", "out 0", "out 1")

		<blockquote>
      This means the same thing.
		</blockquote>

   bus_config("WAVETABLE", "out 3", "out 7")

		<blockquote>
      Output goes to channels 3 and 7 (counting from zero).
		</blockquote>

   bus_config("WAVETABLE", "aux 0-1 out")

		<blockquote>
      Output goes to aux buses 0 and 1. Unless another instrument reads
      these and sends output to the sound card, you'll hear nothing.
		</blockquote>

   bus_config("INPUTSIG", "aux 4-5 in", "out 0-1")

		<blockquote>
      Input comes from aux buses 4 and 5; output goes to channels 0 
      and 1 of the sound card (or rtoutput file).
		<p>
      (Notice that the instrument name is not the family name ("IIR"),
      but the name of the function you call to make sound. Same thing
      goes for the STRUM family.)
		</blockquote>

   bus_config("FILTSWEEP", "aux 2 in", "aux 5 in", "aux 1 out", "aux 7 out")

 		<blockquote>
     Reads from aux buses 2 and 5; writes to aux buses 1 and 7.
		</blockquote>

   bus_config("STEREO", "in 0", "out 0-1")

 		<blockquote>
     You'd think this would read from channel 0 of an input file, even
      if the file has more channels. But RTcmix insists on reading all
      channels from a file. (See below for more about this inconsistency.)
      If the last rtinput call gives the source as "MIC", then the inst
      does read just from the first channel.
      </blockquote>
</blockquote>

There are 16 "aux" buses available (defined as MAXBUS in H/bus.h). You
set the maximum number of "out" buses in the call to rtsetparams. 
<p>
If you don't call bus_config before using an instrument, you'll get
a default configuration roughly equal to:

<blockquote>
   bus_config("FOO", "in 0-1", "out 0-1")
</blockquote>

Currently it is not possible to read from both an "in" bus and an "aux"
bus in the same instrument. Nor is it possible to write to both an "out"
bus and an "aux" bus. This restriction will be removed later.

<h2>An inconsistency for file input</h2>

<b>Executive summary:</b><br />
When reading from a file, RTcmix ignores the bus numbers you use with
the "in" bus in the call to bus_config. Instead, it reads all the
channels in the file. This behavior may change in a future version.
<p>
<b>More detail:</b><br />
"Aux" buses and real-time "in" buses (e.g., mic) are shared among all
instruments using them. Unlike these, sound file input buses are not
shared between instruments. They aren't really buses at all, but private
buffers. That's because instrument calls will often read from different
parts of a file, so it would make no sense for them to share file buses.
So we have an inconsistency in bus_config. When you specify that an
instrument reads from "in" buses, and you make it read -- via rtinput --
from a file rather than a real-time source, then RTcmix will ignore the
bus numbers you give bus_config, and will read all the channels in the
file. Note that many instruments have an <inchan> pfield to let you say
which channel you want.

It's possible that this scheme will change in the future.

<h2>Some constraints on reading from an aux bus</h2>

A call to an instrument reading from a real-time audio source, whether it
be an aux bus or microphone input, MUST use an inskip of zero. You can't
read a segment of sound that hasn't happened yet!
<p>
Also, some instruments just won't work well (or at all) when reading from
a real-time source. TRANS is an example of this. When it transposes up an
octave, it has to consume two samples for every output sample. So it will
always be left gasping for more input.  When it transposes down, it has
no way of keeping the ever-lengthening history of samples it would need
to generate output.
<p>

(For instruments that need to look into the future by a constant interval,
like COMPLIMIT with non-zero lookahead, the instrument merely delays its
output enough to "catch up" with its input.)

<h2>For instrument designers</h2>

Please see "README.inst_porting" for instructions on making your instruments
compatible with this version of RTcmix.
<p>
John Gibson<br />
Dave Topper<br />


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

