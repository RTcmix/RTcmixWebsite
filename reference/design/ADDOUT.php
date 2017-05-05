<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - ADDOUT/WIPEOUT/LAYOUT</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>ADDOUT/WIPEOUT/LAYOUT</h3>
<i>older disk-based cmix instruments</i>
<p>superceded by
<a href="rtaddout.php">rtaddout</a>.
<br>
<br>
Here is the original documentation:
<hr>
<h3>Synopsis</h3>
<UL>
     #include "ugens.h"<BR>
<BR>
     ADDOUT(outbox,fno)<BR>
     WIPEOUT(outbox,fno)<BR>
     LAYOUT(outbox,chlist,fno)<BR>
      float outbox[4],chlist[4];  /* 4 is max # chans */<BR>
     int fno;<BR>
</UL>
<h3>Description</h3>

     These three routines provide for three different flavors of
     disk i/o.  <B>ADDOUT  </B>will add the contents of the outbox array
     to whatever is currently on the disk.  <B>WIPEOUT</B> will destructively write the contents of the outbox array. <B> LAYOUT</B> will
     destructively write only those channels marked with a non-
     zero value in the chlist array while leaving other channels
     untouched.  These routines are actually pointers defined in
     ugens.h to allow direct movement to a routine that will
     appropriately write to the type of soundfile pointed to by
     fno (float or short).  <B>ADDOUT</B>(outbox,fno) is actually
     (*addoutpointer[fno](outbox,fno)) and is thus a little
     easier to code.  In every case the number of channels written will be equal to the number of channels on the output
     soundfile.  It would be dangerous, therefore, to declare
     float outval; and say <B>ADDOUT</B>(&outval,fno) since if this
     instrument were to then be used on a multi-channel file unknown havoc could be wreaked upon channels 1-3.  It is safest
     to always use an array and pass the address of the array as
     the first argument.  These return no values.  They automatically increment the internal pointers on each call.<P>
<h3>See Also</h3>

     <A HREF="setnote.php">setnote</A>,
<A HREF="open.php">open</A>,
peakoff.

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
