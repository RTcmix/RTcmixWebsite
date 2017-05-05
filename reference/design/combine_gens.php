<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - combine_gens</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>combine_gens</h3>
<i>gen-routine (function table) operation</i>
<br>
<br>
Given two function tables occupying the function table
slot locations <i>srcslot1</i> and
   <i>srcslot2</i>, allocate a new table, to occupy <i>destslot</i>, filled with a
   combination of corresponding elements from the source tables.  The
   type of combination is specified by <i>modtype</i>, currently addition
   or multiplication.  The new table has the same size as the larger
   of the two source tables, and this size is returned.
<pre>
typedef enum {
   ADD_GENS,
   MULT_GENS
} GenModType;

int combine_gens(int destslot, int srcslot1, int srcslot2, int normalize,
                                    GenModType modtype, char *funcname)

</pre>
See
makegen
for info about function table creation.

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
