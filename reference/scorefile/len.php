<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - len</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>len</b> - return the length of the argument
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
val = <b>len</b>(<i>item</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>len</b> will return the length of the argument <i>item</i>.
If it is a array, it returns the number of elements in the
array.  If it is a string, it returns the number of characters in the
string.  For other types it returns "1" (note: this includes
pfield-handles and table-handles -- see the
<a href="tablelen.php">tablelen</a>
scorefile command for accessing table lengths).
</P>
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><i>item</i>
<DD>
The item to be checked for length
<P></P></DL>


<HR>
<h3>Examples</h3>
<p>
After parsing  he following scorefile segment:
<pre>
   arr = { 1, 2, 3 }
   val1 = len(arr)
   val2 = len("hey there")
</pre>
<i>val1</i> will be set to 3, and <i>val2</i> will be set to 9.
<p>


<HR>
<h3>See Also</h3>
<p>
<a href="tablelen.php">tablelen</a>,
<a href="type.php">type</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

