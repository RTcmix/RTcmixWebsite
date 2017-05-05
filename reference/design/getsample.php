<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - getsample/GETSAMPLE/getsetnote</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>getsample/GETSAMPLE/getsetnote</h3>
<i>older disk-based cmix instruments</i>
<p>superceded by
<a href="rtgetin.php">rtgetin</a> and
<a href="rtsetinput.php">rtsetinput</a>.
<br>
<br>
Here is the original documentation:
<hr>
<h3>Synopsis</h3>
<UL>
     #include "ugens.h"<BR>
<BR>
     getsetnote(starttime,duration,filenum)<BR>
     float starttime,dur;<BR>
     int filenum;<BR>
<BR>
     (*getsample)(samplenum,c,filenum);<BR>
     float samplenum,*c;<BR>
     int filenum;<BR></UL>

<h3>Description</h3>

     <B>getsample</B> will fetch a block of samples (one for each channel) at sample number <B>samplenum</B> from a soundfile.   If <B>samplenum</B> has a fractional part, the values returned will be
     interpolated between samples.  The values are returned in
     the <B>c </B>array, channel 0 in <B>c</B>[0], channel 1  in <B>c</B>[1] etc.  The
     <B>c</B> array must be dimensioned properly in the calling routine.
     The argument <B>filenum</B> is the assigned number of the input
     file being read.  <B>getsetnote</B> is the required initialization
     routine and is identical in function with <A HREF="setnote.php">setnote  </A>  except
     that it points (*<B>getsample</B>)() to the appropriate floating
     point or integer routine, depending on the nature of the
     file being read, and does some additional necessary file
     positioning.  In ugens.h GETSAMPLE is defined as (*getsample) so the routine can be called analogously with
<A HREF="ADDOUT.php">ADDOUT</a>,
<a href="LAYOUT.php">LAYOUT</A>,
etc., e.g.<P>

     GETSAMPLE(samplenum,c,filenum)

<h3>See Also</h3>

<A HREF="setnote.php">setnote</A>,
<A HREF="GETIN.php">GETIN</A>,
<A HREF="ADDOUT.php">ADDOUT</A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
