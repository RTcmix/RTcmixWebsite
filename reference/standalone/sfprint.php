<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - sfprint</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>sfprint</b> - print soundfile information

<hr>
<h3>Synopsis</h3>
<P><STRONG>sfprint</STRONG> [<STRONG>-v</STRONG>] [<STRONG>-q</STRONG>] <EM>filename</EM> [<EM>filename</EM>...]</P>
<P>
<hr>
<h3>Description</h3>

<P>Prints the following information about a soundfile: the header type
and data format, the sampling rate, the number of channels, the number
of bytes per sample word ("class''), the maximum amplitude value for each
channel and its location (if available), and the duration of the sound.</P>
<P>Without a <EM>filename</EM> argument, <STRONG>sfprint</STRONG> prints a help summary.</P>
<P>
<hr>
<h3>Options</h3>
<DL>
<DT><STRONG>-v</STRONG><BR>
<DD>
Also print the number of sample frames and the header size.
<P></P>
<DT><STRONG>-q</STRONG><BR>
<DD>
Don't print anything, not even error messages.  Only return status.
<P></P></DL>
<P>
<hr>
<h3>Returns</h3>
<P>0 if successful; 1 if any of the file arguments is not a sound file.</P>
<P>
<hr>
<h3>Notes</h3>
<P>The output is roughly in the same format as sfprint in classic cmix.</P>
<P>Recognizes any sound file type understood by the sndlib sound file
library, including AIFF, AIFC, WAV, NeXT, Sun, IRCAM, among others.
Raw (headerless) sound files are not recognized and will produce an
error message.</P>
<P>
<hr>
<h3>See Also</h3>
<P><A HREF="sfcreate.php">sfcreate</A>, <A HREF="sfhedit.php">sfhedit</A>, <A HREF="sffixsize.php">sffixsize</A></P>
<P>
<hr>
<h3>Authors</h3>
<P>John Gibson &lt;johgibso at indiana edu&gt;, based on the original
Cmix <STRONG>sfprint</STRONG>, but revised to work with multiple soundfile header
types.  Thanks to Bill Schottstaedt, whose sndlib sound file library
makes this possible.</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
