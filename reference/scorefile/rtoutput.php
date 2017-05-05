<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rtoutput</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>rtoutput</b> - open a new sound file for writing
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
<b>rtoutput</b>(<i>"file_name"</i> [, <i>"header_type"</i> ] [, <i>"data_format"</i> ])
<p>
Parameters inside the [brackets] are optional.
</P>
<P>


<HR>
<h3>Description</h3>
<P>
Call <b>rtoutput</b> to open a new sound file for subsequent writing
by real-time instruments.
<P>
After <b>rtoutput</b> creates a sound file, it prints information about
the file, such as the header type and sampling rate (unless the
<a href="print_off.php">print_off</a>
scorefile command has been issued).
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_file_name"><i>"file_name"</i></A><BR>
<DD>
A text string with
the name of a sound file, in double-quotes.  If the file already
exists, the script will terminate with an error, unless you've
turned on file clobbering with
<A HREF="set_option.php#clobber">set_option</A>
(by saying
set_option("clobber = on")).  If you name the file with a recognized
suffix, that suffix will determine the header type, unless overridden
by a <i>"header_type"</i> string.  Recognized suffixes: ".wav'', ".aif'',
".aiff'', ".aifc'', ".snd'' (NeXT/Sun), ".au'' (NeXT/Sun), ".sf'' (IRCAM),
and ".raw''.
<P></P>
<DT><A NAME="item_header_type"><i>"header_type"</i></A><BR>
<DD>
The type of header to use for the sound file, as a double-quoted
string.  Note that if you name the file with a recognized suffix
(see above), you don't need to specify a header type in this way.
<p>
<DL>
<ul>
<DT><A NAME="item_aiff"><i>aiff</i></A> -- AIFF format
<DT><A NAME="item_aifc"><i>aifc</i></A> -- AIFC format (uncompressed)
<DT><A NAME="item_wav"><i>wav</i></A> -- Microsoft RIFF (Wav) format
<DT><A NAME="item_next"><i>next</i></A> -- NeXT format (same as <i>sun</i>)
<DT><A NAME="item_sun"><i>sun</i></A> -- Sun "au'' format (same as <i>next</i>)
<DT><A NAME="item_ircam"><i>ircam</i></A> -- IRCAM format (the older, non-hybrid BICSF format)
<DT><A NAME="item_raw"><i>raw</i></A> -- raw (headerless) format
</ul>
<P></P></DL>
<P>AIFF is the default if no header type is given.</P>
<DT><A NAME="item_data_format"><i>"data_format"</i></A><BR>
<DD>
The type of data format to use for the sound file, as a double-quoted
string.
<P>
NOTE: The sampling rate and number of channels are specified in a
call to
<A HREF="rtsetparams.php">rtsetparams</A>
at the beginning of the script.
<DL>
<ul>
<DT><A NAME="item_short"><i>short</i></A> -- 16-bit linear
<DT><A NAME="item_float"><i>float</i></A> -- 32-bit floating point
<DT><A NAME="item_normfloat"><i>normfloat</i></A> -- 32-bit floating point, with samples normally between -1 and +1.
<DT><A NAME="item__16"><i>16</i></A> -- synonym for "short''
<DT><A NAME="item__24"><i>24</i></A> -- 24-bit linear
</ul>
<P></P></DL>
<P>"short'' is the default if no data format is given.
</DL>
<P>


<HR>
<h3>NOTES</h3>
<P>
If you don't want RTcmix to play while you're writing a file,
use
<A HREF="set_option.php#audio">set_option</A>
to turn off playing
before you invoke any instruments, by saying set_option("audio = off").
<P>
The case of the <i>header_type</i> and <i>data_format</i> arguments is not
significant, nor is their order.
<P>
All formats are big-endian, except for "wav,'' which is always
little-endian, and "raw,'' which has host byte order.
<P>
If you ask for "aiff'' and "float'' (or "normfloat''), you'll get "aifc''
format instead, because AIFF doesn't support floating-point files.
<P>
Although most soundfile programs now deal with nearly all soundfile
types, older advice in this documentation suggested that
if you want to use floating-point files in the
<a href="https://ccrma.stanford.edu/software/snd/">Snd</a>
editor, choose
"normfloat'' format.  If you want to use them in
<a href="http://www.music.columbia.edu/~doug/MiXViews/MiXViews.html">MiXViews</a>
editor, choose the "next'' header type.  Many programs don't read AIFC files,
maybe because they assume these are always compressed.
<P>


<HR>
<h3>Examples</h3>
<PRE>
   rtsetparams(22050, 2)
   rtoutput("mysound")
</PRE>
writes a stereo, 16-bit linear AIFF file with 22050 sampling rate.
<PRE>
   rtsetparams(44100, 1)
   set_option("audio = off", "clobber = on")
   rtoutput("myothersound", "wav", "float")
</PRE>
writes a mono, 32-bit floating-point WAV file with 44100 sampling rate.
RTcmix will write over any existing file with the same name, and will
not play audio while writing.
<P>

<HR>
<h3>See Also</h3>
<p>
<A HREF="bus_config.php">bus_config</A>,
<A HREF="rtsetparams.php">rtsetparams</A>,
<A HREF="rtoutput.php">rtoutput</A>,
<A HREF="set_option.php">set_option</A>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

