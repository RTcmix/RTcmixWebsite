<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - plottable</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>plottable</b> - generate a graphics plot of the contents of a table given
an associated table-handle variable
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P>
<b>plottable</b>(<i>table_handle</i>[, <i>pause</i>][, <i>"gnuplot_cmd1"</i>, <i>"gnuplot_cmd2"</i>, ... ])
<p>
Parameters inside the [brackets] are optional.
<P>


<HR>
<h3>Description</h3>
<P>
<b>plottable</b> is a useful utility that will create a graphics
plot of a table associated with a particular table-handle.  The plot
appears in a separate window, and uses the public-domain
<a href="http://gnuplot.sourceforge.net/">gnuplot</a>
program.  Macintosh OS X users will also need to have the public-domain
<a href="http://sourceforge.net/projects/aquaterm/">aquaterm</a>
package installed for <i>gnuplot</i> to run correctly.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="item_table_handle"><i>table_handle</i></A><BR>
<DD>
The table-handle identifier for the table to be plotted.
<P></P></DL>
<DL>
<DT><A NAME="item_pause"><i>pause</i></A><BR>
<DD>
The length of time (in seconds) to display the plot before proceeding
with scorefile processing.  The default is 10 seconds.
<ul>
<i>NOTE:  Under MacOS X, using Aquaterm to display the output </i>pause<i>
has no effect.  Also, you can only do one plot per run of RTcmix under OS X,
because </i>gnuplot<i> dies if there's already another one running.</i>
</ul>

<P></P></DL>
<DL>
<DT><A NAME="item_gnuplot_cmd"><i>gnuplot_cmd1, ... gnuplot_cmdN</i></A><BR>
<DD>
These optional string arguments are plotting commands that <i>gnuplot</i>
may use to modify the generated graph.  See the
<a href="http://gnuplot.sourceforge.net/documentation.html">gnuplot documentation</a>
for more information about these commands.  The default is <i>"with lines"</i>.
<p>
If something goes wrong with the gnuplot syntax, there'll be some leftover
files in the /tmp directory, with names like "rtcmix_plot_data_xAb5x8."
</p>
<P></P></DL>
<P>


<HR>
<h3>Examples</h3>
<PRE>
   table = maketable("wave", 1000, 1, 0.1, 0.3)
   plottable(table, 30)
</pre>
<p>
The above score will produce the following plot in a separate window
(it will appear for 30 seconds on non MacOS X systems):
<br>
<br>
<center>
<img src=images/plottable1.gif border=1>
</center>
<br>
<br>
This scorefile:
<pre>
   table = maketable("wave", 1000, 1, 0.1, 0.3)
   plottable(table, 15, "with points")
</pre>
will produce this plot:
<br>
<br>
<center>
<img src=images/plottable2.gif border=1>
</center>
<br>
<br>
and display it for 15 seconds (on non MacOS X systems).  The following
scorefile:
<pre>
   table = maketable("wave", 1000, 1, 0.1, 0.3)
   plottable(table, "with impulses")
</pre>
generates this kind of plot:
<br>
<br>
<center>
<img src=images/plottable3.gif border=1>
</center>
<br>
<br>
<P>


<HR>
<h3>See Also</h3>
<P>
<A HREF="dumptable.php">dumptable</A>,
<A HREF="maketable.php">maketable</A>,
<A HREF="makeconverter.php">makeconverter</A>,
<A HREF="makefilter.php">makefilter</A>,
<A HREF="modtable.php">modtable</A>,
<A HREF="tablelen.php">tablelen</A>,
<A HREF="samptable.php">samptable</A>
</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

