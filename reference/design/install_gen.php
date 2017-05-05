<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - install_gen</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>install_gen</h3>
<i>gen-routine (function table) operation</i>
<br>
<br>
Install <i>table</i>, of <i>size</i> elements, into the cmix function table list
   as the user-visible table number <i>slot</i>.  Return 1 if okay, or 0 if the
   function table list is full.
<p>
   NOTE: makegen creates a new function for <u>every</u> call to it.  This is so
   that we can guarantee the correct version of a given function at run-time
   during RT operation.  The <i>f_goto[]</i> array keeps track of where to map a
   particular function table number during the queueing of RT Instruments.
<pre>
install_gen(int slot, int size, float *table)
</pre>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
