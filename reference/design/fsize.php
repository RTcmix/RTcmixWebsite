<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - fsize</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>fsize</h3>
<i>returns the array size of a function table slot</i>
<br>
<br>

<h3>Synopsis</h3>
<UL>
     #include "ugens.h"<BR>
<BR>
     fsize(function_table_slot_#)<BR>
     int function_table_slot_#;<BR>
<BR></UL>
<h3>Description</h3>

    <B>fsize</B> returns the size of an array in a function table
slot created with
makegen.
For example: if you issue the command:
<pre>
    makegen(4, 10, 1000, 1, 2, 3, 4)<BR>
</pre>
and then in an instrument say:
<pre>
     int size;

     size = fsize(4);
</pre>
     the integer <i>size</i> will be the size of the array in
in the function table slot (in floating-point words)
as specified in the third argument of the
makegen
scorefile command.
<i>fsize</i> issues an error message and terminates the
     job if no function with that number has been generated.

<h3>See Also</h3>

<A HREF="floc.php">floc</A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
