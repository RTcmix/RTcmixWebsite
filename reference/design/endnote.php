<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - endnote</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>endnote</h3>
<i>older disk-based cmix instruments</i>
<p>
<i>[note:  this function is not superceded by anything in RTcmix,
as it is no longer needed.]</i>
<br>
<br>
Here is the original documentation:
<hr>

<h3>Synopsis</h3>
<UL>
     #include "ugens.h"<BR>
<BR>
     endnote(filenum)<BR>
     int filenum;<BR>
</UL>
<h3>Description</h3>

     <B>Endnote</B>  merely writes what it thinks is the current overall
     peak amplitude of the soundfile in the soundfile descriptor,
     and reports on the execution time of the note (usr + sys)
     clocked from the last call to
<A HREF="setnote.php">setnote</A>,
its starting and ending times, the overall peak amplitude so far, and the peak
     amplitude of each output channel.  Its only really important
     functions are to load the peak amplitude (this can be done
     by hand if the run is ended prematurely (see
<A HREF="/reference/standalone/sfhedit.php" >sfhedit</A>),
and write out any incomplete buffer.  If endnote is not called
     chances are that you will not get the last sound segment.
     If
<A HREF="WIPEOUT.php">WIPEOUT</A>
was used to write samples the unused portion of
     the last buffer will be flushed with 0's.
<P>
     The value <B>'filenum'</B> is the number of the file to which you
     have been writing as determined by the second argument of an
     earlier 'open' command.
<P>
<h3>See Also</h3>

<A HREF="WIPEOUT.php">WIPEOUT</A>,
<A HREF="ADDOUT.php">ADDOUT</A>,
<A HREF="LAYOUT.php">LAYOUT</A>,
<A HREF="setnote.php">setnote</A>
<A HREF="/reference/standalone/sfhedit.php">sfhedit</A>

<h3>Diagnostics</h3>

     This call does not return any values. If 'filenum' does not
     point to an opened writeable file the run will be terminated.<P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
