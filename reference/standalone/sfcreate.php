<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - sfcreate</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>sfcreate</b> - create soundfile header, or change existing one

<hr>
<h3>Synopsis</h3>
<P><STRONG>sfcreate</STRONG>
[ <STRONG>-r</STRONG> <EM>sampling_rate</EM> ]
[ <STRONG>-c</STRONG> <EM>num_channels</EM> ]
[ <STRONG>-t</STRONG> <EM>header_format</EM> ]
[ <STRONG>-i</STRONG> | <STRONG>-f</STRONG> ]
[ <STRONG>-b</STRONG> | <STRONG>-l</STRONG> ]
[ <STRONG>--force</STRONG> ]
<EM>file_name</EM></P>
<P>
<hr>
<h3>Description</h3>

<P>If <EM>file_name</EM> doesn't exist, <STRONG>sfcreate</STRONG> creates a new file with the
specified soundfile header.  If <EM>file_name</EM> already exists,
<STRONG>sfcreate</STRONG> puts a soundfile header at the beginning of the file,
overwriting whatever was there.  (See <STRONG>WARNINGS</STRONG> below.)  Without a
<EM>file_name</EM> argument, <STRONG>sfcreate</STRONG> just prints a help summary.</P>
<P>This command is mainly useful for disk-based Cmix scripts, in which
the <STRONG>output</STRONG> function expects to find a file with a soundfile header.
You can run <STRONG>sfcreate</STRONG> from within such a script by using the
<A HREF="/reference/scorefile/system.php">system</A> function.</P>
<P>
<hr>
<h3>Options</h3>
<DL>
<DT><STRONG>-b</STRONG><BR>
<DD>
Use big-endian sample data format.
This is the default for all file types except <EM>wav</EM>.
(Use either this or <STRONG>-l</STRONG>.)
<P></P>
<DT><STRONG>-c</STRONG> <EM>num_channels</EM><BR>
<DD>
Use <EM>num_channels</EM> number of channels.  The default is 2.
<P></P>
<DT><STRONG>-f</STRONG><BR>
<DD>
Use floating-point sample data format.  (Use either this or <STRONG>-i</STRONG>.)
<P></P>
<DT><STRONG>-i</STRONG><BR>
<DD>
Use 16-bit (short) integer sample data format.  This is the default.
(Use either this or <STRONG>-f</STRONG>.)
<P></P>
<DT><STRONG>-l</STRONG><BR>
<DD>
Use little-endian sample data format.  This is the default for
<STRONG>-t</STRONG> <EM>wav</EM>.  (Use either this or <STRONG>-b</STRONG>.)
<P></P>
<DT><STRONG>-r</STRONG> <EM>sampling_rate</EM><BR>
<DD>
Use the sampling rate given by <EM>sampling_rate</EM>.  44100 is the default.
<P></P>
<DT><STRONG>-t</STRONG> <EM>header_format</EM><BR>
<DD>
Use the specified file format.  The possibilities are:
<DL>
<DT><EM>aiff</EM><BR>
<DD>
AIFF format
<P></P>
<DT><EM>aifc</EM><BR>
<DD>
AIFC format
<P></P>
<DT><EM>wav</EM><BR>
<DD>
Microsoft RIFF (Wav) format
<P></P>
<DT><EM>next</EM><BR>
<DD>
NeXT format (same as <EM>sun</EM>)
<P></P>
<DT><EM>sun</EM><BR>
<DD>
Sun "au'' format (same as <EM>next</EM>)
<P></P>
<DT><EM>ircam</EM><BR>
<DD>
IRCAM format
<P></P></DL>
<P><EM>aiff</EM> (or <EM>aifc</EM> for floats) is the default.</P>
<DT><STRONG>--force</STRONG><BR>
<DD>
Overwrite the header of an existing file, even if this might result
in swapped channels or corrupted sample words.  You will be told if
these things have happened after they've happened.  (Isn't that nice!)
<P></P></DL>
<P>
<hr>
<h3>Examples</h3>
<P>
<hr>
<h3>See Also</h3>
<P><A HREF="sfprint.php">sfprint</A>, <A HREF="sfhedit.php">sfhedit</A>, <A HREF="sffixsize.php">sffixsize</A></P>
<P>
<hr>
<h3>Authors</h3>
<P>John Gibson &lt;johgibso at indiana edu&gt;, based on the original
Cmix <STRONG>sfcreate</STRONG>, but revised to work with multiple soundfile header
types.  Thanks to Bill Schottstaedt, whose sndlib sound file library
makes this possible.</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
