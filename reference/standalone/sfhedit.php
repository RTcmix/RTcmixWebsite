<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - sfhedit</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>



<b>sfhedit</b> - edit soundfile header

<HR>
<h3>Synopsis</h3>
<P><STRONG>sfhedit</STRONG>
[ <STRONG>-c</STRONG> <EM>num_channels</EM> ]
[ <STRONG>-i</STRONG> | <STRONG>-f</STRONG> ]
[ <STRONG>-p</STRONG> ]
[ <STRONG>-r</STRONG> <EM>sampling_rate</EM> ]
[ <STRONG>-w</STRONG> ]
[ <STRONG>-z</STRONG> ]
<EM>file_name</EM></P>
<P>
<HR>
<h3>Description</h3>

<P><STRONG>sfhedit</STRONG> lets you edit some parts of a soundfile header.
Without a <EM>file_name</EM> argument, <STRONG>sfhedit</STRONG> just prints a
help summary.</P>
<P>
<HR>
<h3>Options</h3>
<DL>
<DT><STRONG><STRONG>-c</STRONG> <EM>num_channels</EM></STRONG><BR>
<DD>
Set the number of channels to <EM>num_channels</EM>.
<P></P>
<DT><STRONG><STRONG>-f</STRONG></STRONG><BR>
<DD>
Set the sample data format to floating-point.
<P></P>
<DT><STRONG><STRONG>-i</STRONG></STRONG><BR>
<DD>
Set the sample data format to 16-bit (short) integer.
<P></P>
<DT><STRONG><STRONG>-p</STRONG></STRONG><BR>
<DD>
Interactively asks you for the peak amplitude and frame location
for each channel.
<P></P>
<DT><STRONG><STRONG>-r</STRONG> <EM>sampling_rate</EM></STRONG><BR>
<DD>
Set the sampling rate to <EM>sampling_rate</EM>.
<P></P>
<DT><STRONG><STRONG>-w</STRONG></STRONG><BR>
<DD>
Throws you into vi so you can edit the comment.
<P></P>
<DT><STRONG><STRONG>-z</STRONG></STRONG><BR>
<DD>
Truncates the data in the file, leaving only the header.
<P></P></DL>
<P>
<HR>
<h3>Bugs</h3>
<P>There are currently some problems with this program.  Don't use
it on anything irreplaceable.</P>
<P>
<HR>
<h3>See Also</h3>
<P><A HREF="sfprint.php">sfprint</A>, <A HREF="sfcreate.php">sfcreate</A>, <A HREF="sffixsize.php">sffixsize</A></P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
