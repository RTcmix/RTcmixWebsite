<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - trand</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>



<b>trand</b> - return a random integer within a specified range
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>value = <b>trand</b>([<i>minimum</i>,] <i>maximum</i>)
<p>
Parameters inside the [brackets] are optional.
</P>
<P>


<HR>
<h3>Description</h3>
<P>
Call <b>trand</b> to get a random integer that falls within the
range specified by the arguments.
<P>
It's a good idea to call
<A HREF="srand.php">srand</A>
once to seed the random
number generator before using <b>trand</b>.  Otherwise, a seed of
1 will be used.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_minimum_maximum"><i>minimum</i>[optional], <i>maximum</i></A><BR>
<DD>
These arguments define the range within which falls
the random value returned by <b>trand</b>. <b>trand</b>
includes the lower bound in output, but the upper bound is
non-inclusive (i.e. <b>trand</b> will return <i>maximum</i> - 1 as
a high value).
If <i>minimum</i> is not present, <b>trand</b> will return
an integer value between 0 and <i>maximum</i> - 1.
<P></P></DL>


<HR>
<h3>Examples</h3>
<PRE>
   srand(0)
   min = -30
   max = 10
   for (i = 0; i < 20; i = i + 1) {
      randval = trand(min, max)
      print(randval)
   }
</PRE>
another useful example:
<pre>
   array = { 1, 2, 3, 4, 5, 6, 7 }
   len_array = len(array)
   for (i = 0; i < 14; i += 1) {
      val = array[trand(len_array)]
   }
</pre>
<p>


<HR>
<h3>See Also</h3>
<P>
<A HREF="irand.php">irand</A>,
<A HREF="srand.php">srand</A>,
<A HREF="random.php">random</A>,
<A HREF="rand.php">rand</A>,
<A HREF="pickrand.php">pickrand</A>,
<A HREF="pickwrand.php">pickwrand</A>,
<A HREF="spray_init.php">spray_init</A>,
<A HREF="get_spray.php">get_spray</A>,
<A HREF="maketable.php#random">maketable("random")</A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

