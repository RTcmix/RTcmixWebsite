<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - resample_gen</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>resample_gen</h3>
<i>gen-routine (function table) operation</i>
<br>
<br>
Given a function table of a certain size <i>cursize</i>, allocate and return
   a new table of size <i>newsize</i>, filled with values resampled from the old
   table using the kind of interpolation specified by <i>inter</i>.  If the two
   sizes are equivalent, merely make a straight copy of the table.  Return
   NULL if memory allocation error.
<pre>
typedef enum {
   NO_INTERP = 0,
   LINEAR_INTERP
} InterpolationType;

float resample_gen(float table[], int cursize, int newsize, InterpolationType interp)
</pre>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
