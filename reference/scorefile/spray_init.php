<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - spray_init</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>spray_init</b> - initialize a random integer spray can
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
<b>spray_init</b>(<i>spray_table_number</i>, <i>spray_table_size</i>, <i>random_seed</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
Call <b>spray_init</b> from a script to set up a random integer spray can.
The idea is that you create a table of integers and then use
<A HREF="get_spray.php">get_spray</A>
to retrieve them.  The table contains integers
from zero to one less than the table size.  (Another way to look at
it is that each element takes its index as its value.)  Repeatedly
calling
<A HREF="get_spray.php">get_spray</A>
reads the table randomly, but in such
a way that no number appears twice before all the other numbers have
appeared once.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_spray_table_number"><i>spray_table_number</i></A><BR>
<DD>
The numeric ID for the spray table.  You can have
as many as 32 tables, numbered from 0 to 31.  Note that these are
separate entities from tables created using the
<a href="maketable.php">maketable</a>
scorefile command.
<P></P>
<DT><A NAME="item_spray_table_size"><i>spray_table_size</i></A><BR>
<DD>
The table can have as many as 512 values.
<P></P>
<DT><A NAME="item_random_seed"><i>random_seed</i></A><BR>
<DD>
An integer to seed the random number generator.  Note that this
re-seeds the same random number generator used by
<A HREF="rand.php">rand</A>,
<A HREF="random.php">random</A>,
<A HREF="irand.php">irand</A>,
etc.
<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<pre>
   seed = 78
   spray_init(3, 7, seed) // initialize table 3 with 7 elements

   for (i = 0; i < 21; i = i+1) {
      val = get_spray(3)
      print(val)
   }
</pre>
<P>

<HR>
<h3>See Also</h3>
<p>
<A HREF="get_spray.php">get_spray</A>,
<A HREF="irand.php">irand</A>,
<A HREF="pickrand.php">pickrand</A>,
<A HREF="pickwrand.php">pickwrand</A>,
<A HREF="rand.php">rand</A>,
<A HREF="random.php">random</A>,
<A HREF="srand.php">srand</A>,
<A HREF="trand.php">irand</A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

