<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - setline</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>setline</h3>
<i>draw arbitrary curve of straight-line segments into an array</i>
<br>
<br>

<h3>Synopsis</h3>
<UL>
     #include &lt;stdio.h&gt;<BR>
<BR>
     setline(arglist,n_args,length,array)<BR>
     float *arglist,*array;<BR>
     int length,n_args;<BR>
<BR></UL>
<h3>Description</h3>

    <B>setline()</B> will store an arbitrary curve of straight-line
     segments in the specified array. arglist is a list of arguments where <i>arglist[0], arglist[2], arglist[4],</i> etc.  are
     referenced times, and <i>arglist[1],[3],[5],</i> etc., are ampltudes at those time.  Straight lines will be interpolated
     between referenced amplitudes.  An instantaneous change may
     be made by having successive references to the same time,
     with different amplitudes.  The entire curve will be
     squeezed to length locations in array so that the referenced
     times are in effect proportional. <i>n_args</i> is the number of
     arguments contained in arglist. This is useful for use with
   <B>table</B> or <B>tablei</B> to access values in the table
<P>
<h3>See Also</h3>

<a href="table.php">table</a>, <a href="tablei.php">tablei</a>.

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
