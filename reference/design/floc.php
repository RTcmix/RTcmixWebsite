<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - floc</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>floc</h3>
<i>return a pointer to a function table slot</i>
<br>

<h3>Synopsis</h3>
<UL>
     #include "ugens.h"<BR>
<BR>
     float *floc(gen_number)<BR>
     int gen_number;<BR>
<BR></UL>
<h3>Description</h3>

<B>floc()</B> returns a pointer to the beginning of an array in
a function table slot created with the
makegen
scorefile command.
For example: if you issue the scorefile command
<pre>
    makegen(4, 10, 1000, 1, 2, 3, 4)
</pre>
     and then in an instrument say
<pre>
     float *f;

     f = floc(4);
</pre>
<BR></UL>
     the pointer f will be the address of the beginning of the
     array created by
makegen
command.
<B>floc() </B>issues an error message and
     terminates the job if no function with that number has been
     generated.

<h3>See Also</h3>

<A HREF="fsize.php">fsize</A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
