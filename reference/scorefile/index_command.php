<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - index</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>index</b> - return the index of an item in an array
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
indexnumber = <b>index</b>(<i>somearray, someitem</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>index</b> will return the index of the item <i>someitem</i> from the
array <i>somearray</i>.  -1 is returned if <i>someitem</i> isn't in the
<i>somearray</i>.  <i>someitem</i> can be a float, string or pfield-handle
data type, and <i>somearray</i> can be a mixture of any of these data
types.  <b>index</b> counts array items starting at 0.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><i>somearray</i><BR>
<DD>
the array to be checked for <i>someitem</i>
<P></P></DL>
<DL>
<DT><i>someitem</i><BR>
<DD>
The item to find the index for in <i>somearray</i>
the first, or
<P></P></DL>
<P>


<HR>
<h3>RETURN VALUE</h3>
<P>Returns -1 if <i>sometime</i> is not found in <i>somearray</i>, otherwise
the index (starting at 0) of <i>sometime</i> will be returned/
</P>
<P>

<HR>
<h3>Examples</h3>
<p>
After parsing  he following scorefile segment:
<pre>
   list = { 1, 2, "three", 4 }
   val = index(list, 2)
</pre>
<i>val</i> will be set to 1.
<P>


<HR>
<h3>See Also</h3>
<p>
<a href="Minc.php">Minc</a>,
<a href="len.php">len</a>,
<a href="stringify.php">stringify</a>,
<a href="type.php">type</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

