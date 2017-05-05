<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - setnote</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>setnote</h3>
<i>older disk-based cmix instruments</i>
<p>superceded by
<a href="rtsetoutput.php">rtsetoutput</a> and and
<a href="rtsetinput.php">rtsetinput</a>.
<br>
<br>
Here is the original documentation:
<hr>

<h3>Synopsis</h3>
<UL>
#include "ugens.h"<BR>
<BR>
setnote(starttime,duration,filenum)<BR>
float starttime,dur;<BR>
int filenum;<BR>
<BR></UL>
<h3>Description</h3>

<B>  setnote() </B>positions the disk pointers on the previously
opened file number to compute (duration * sampling rate).
If <B>starttime</B> is a negative value its absolute value is equal
to the number of samples per channel to skip on the file
before reading or writing, and if <B>duration</B> is negative its
value equals the number of samples per channel to compute.
If <B>setnote()</B> seeks beyond the current end of the file empty
space will be created between that point and the position it
points to.  This will appear to all software as 0's but will
not actually hog up any real disk space.  The D-A conversion
program will play silence during that point.
<P>
<h3>See Also</h3>

<A HREF="ADDOUT.php">ADDOUT</A>,
<A HREF="WIPEOUT.php">WIPEOUT</A>,
<A HREF="LAYOUT.php">LAYOUT</A>,
<A HREF="endnote.php">endnote </A>

<h3>Diagnostics</h3>

If something is wrong <B>setnote() </B>will kill the run by itself.

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
