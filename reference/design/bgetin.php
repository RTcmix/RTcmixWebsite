<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - bgetin/blayout/baddout/bwipeout</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>bgetin/blayout/baddout/bwipeout</h3>
<i>older disk-based cmix instruments</i>
<p>superceded by
<a href="rtgetin.php">rtgetin</a>,
<a href="rtaddout.php">rtaddout</a> and
<a href="rtbaddout.php">rtbaddout</a> and
<br>
<br>
Here is the original documentation:
<hr>

<h3>Name</h3>
<UL>
     <B>block I/O routines</B><BR>
</UL>
<h3>Synopsis</h3>
<UL>

     bgetin(input,fno,size)<BR>
     float *input;<BR>
<BR>
     blayout(output,chlist,fno,size)<BR>
     float *output;<BR>
     int *chlist;<BR>
<BR>
     baddout(output,fno,size)<BR>
     float *output;<BR>
<BR>
     bwipeout(output,fno,size)<BR>
     float *output;<BR>
<BR>
</UL>
<h3>Description</h3>

     These routines will read or write a block of samples from or
     to the disk.  The arrays<B> 'input'</B> and <B>'output' </B>are in floating point form, even if the disk file is in 16-bit integer
     form.  <B>'fno'</B> is the Cmix unit number for the file being
     accessed, and <B>'size'</B> is the total number of samples in the
     array.  Note that <B>'size'</B> is NOT the number of samples per
     channel, but rather the total number of samples.  The routines act like their sample-by-sample namesakes:<B> blayout()</B>
     and <B>LAYOUT(),</B> <B>baddout() </B>and <B>ADDOUT(), bwipeout() </B>and
     <B>WIPEOUT().</B>  They do not return a value, however, but rather
     the named array, loaded with samples, kicked up by <B>'size'</B>
     from the last call. As with the other routines, they are
     positioned by <A HREF="setnote.php">setnote()</A> and cleaned up by <A HREF="endnote.php">endnote. </A>  They
     are considerably faster than these units, however, and
     should be used when optimizing code, perhaps in conjunction
     with the </A><A HREF="blockugens.php"> block unit generators.  </A>
<P>

<h3>See Also</h3>

    <A HREF="open.php">I/O</A>,
<A HREF="setnote.php">setnote</A>,
<A HREF="endnote.php">endnote</A>,
<A HREF="blockugens.php"> blockugens.  </A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
