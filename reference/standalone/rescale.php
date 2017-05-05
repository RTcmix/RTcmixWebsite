<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - rescale</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>rescale</b> - convert 32-bit float to 16-bit integer sound file

<hr>
<h3>Synopsis</h3>
<P><STRONG>rescale</STRONG>
[ <STRONG>-P</STRONG> <EM>desired_peak</EM> ]
[ <STRONG>-p</STRONG> <EM>input_peak</EM> ]
[ <STRONG>-f</STRONG> <EM>factor</EM> ]
[ <STRONG>-r</STRONG> ]
[ <STRONG>-t</STRONG> ]
[ <STRONG>-s</STRONG> <EM>input_skip</EM> ]
[ <STRONG>-o</STRONG> <EM>output_skip</EM> ]
[ <STRONG>-d</STRONG> <EM>duration</EM> ]
[ <STRONG>-e</STRONG> <EM>end_silence</EM> ]
[ <STRONG>-h</STRONG> ]
<EM>input_file</EM>
[ <EM>output_file</EM> ]</P>
<P>
<hr>
<h3>Description</h3>

<P>This command-line utility converts a 32-bit floating-point sound file
to 16-bit integer.  It does this by first scaling every sample by a
factor, and then chopping off the portion to the right of the decimal
point.  (So if the factor is 1, a sample of 22091.428915 becomes 22091.)</P>
<P>There are several options that affect what factor <STRONG>rescale</STRONG> uses, where
the output goes, and whether to dither before truncating from 32 bits.</P>
<P>
<hr>
<h3>Options</h3>
<DL>
<DT><STRONG>-P</STRONG> <EM>desired_peak</EM><BR>
<DD>
Rescale so that <EM>desired_peak</EM> is the new peak.  Ignored if you also
specify <EM>factor</EM>.
This is 32767 by default.
<P></P>
<DT><STRONG>-p</STRONG> <EM>input_peak</EM><BR>
<DD>
Specify the peak of the input file.
This is taken from the input file header by default.
<P></P>
<DT><STRONG>-f</STRONG> <EM>factor</EM><BR>
<DD>
Multiply every sample value by this factor before converting to integer.
This is <EM>desired_peak</EM> / <EM>input_peak</EM> by default.
<P></P>
<DT><STRONG>-r</STRONG><BR>
<DD>
Replace <EM>input_file</EM> with the rescaled version.  Ignores <EM>output_file</EM>.
By default, <STRONG>rescale</STRONG> writes to a new file.  (See <EM>output_file</EM> below.)
<P></P>
<DT><STRONG>-t</STRONG><BR>
<DD>
Use dithering algorithm.
This is off by default.
<P></P>
<DT><STRONG>-s</STRONG> <EM>input_skip</EM><BR>
<DD>
Skip this many seconds on the input file before reading.
This is 0 by default.
<P></P>
<DT><STRONG>-o</STRONG> <EM>output_skip</EM><BR>
<DD>
Skip this many seconds on the output file before writing.
This is 0 by default.
<P></P>
<DT><STRONG>-d</STRONG> <EM>duration</EM><BR>
<DD>
Rescale this many seconds of the input file.
This is the entire file by default.
<P></P>
<DT><STRONG>-e</STRONG> <EM>end_silence</EM><BR>
<DD>
Write this many seconds of zeros at the end of the output file.
This is 0 by default.
<P></P>
<DT><STRONG>-h</STRONG><BR>
<DD>
Print usage summary.
<P></P>
<DT><STRONG>input_file</STRONG><BR>
<DD>
The name of the input file, which can be either 32-bit floating point
or 16-bit integer in any of the formats understood by RTcmix.
<P></P>
<DT><STRONG>output_file</STRONG><BR>
<DD>
Write rescaled output to this file, which cannot already exist.
Ignored if <STRONG>-r</STRONG> also specified.
If neither <STRONG>-r</STRONG> nor <STRONG>output_file</STRONG> given, rescale writes to a new file
with the same name as <EM>input_file</EM>, but with ".rescale'' appended.
<P>This file has the same header format as the input file, as long as
that is one of the types that RTcmix can write (AIFF, AIFC, WAVE,
NeXT, IRCAM).  If it's a type that RTcmix can read, but not write,
then the output format will be AIFF.</P>
<P></P></DL>
<P>
<hr>
<h3>Examples</h3>
<PRE>
   rescale foo.wav</PRE>
<P>Assuming "foo.wav'' is a 32-bit float file, this command rescales
the file so that its peak amplitude is 32767, and writes the 16-bit
output to "foo.wav.rescale.''</P>
<PRE>
   rescale -r -f 1 foo.wav</PRE>
<P>rescales "foo.wav'' using a factor of 1.0 (i.e., it merely drops
digits of precision to the right of the decimal point), and writes
the output to "foo.wav,'' overwriting the original 32-bit file.</P>
<PRE>
   rescale -P 20000 -t foo.wav newfoo.wav</PRE>
<P>rescales "foo.wav'' so that its peak amplitude is 20000, and writes
the output to a new file, "newfoo.wav.''  Before truncating to 16
bits, applies the dithering algorithm to each sample.</P>
<P>
<hr>
<h3>Authors</h3>
<P>John Gibson &lt;johgibso at indiana edu&gt;, based on the original
Cmix <STRONG>rescale</STRONG>, but revised and expanded.</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
