<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - getamp</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>getamp</b> - return amplitude value from LPC analysis data file
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
ampval = <b>getamp</b>(<i>"lpc_analysis_file", frame_number</i>)
<p>
<i>(note:  This command appears to be broken. BGG, 7/2012)</i>
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>getamp</b> will retrieve an RMS amplitude value from an LPC analysis
file, possibly created by the
<a href="http://music.columbia.edu/~doug/MixViews/MiXViews.html">MiXViews</a>
program. <i>"lpc_data_file"</i> is a string with
the name of the file.  This
may be an absolute or relative pathname to the LPC analysis file.
<i>frame#</i> is the analysis frame to be retrieved.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><A NAME="lpc_analysis_file"><i>"lpc_analysis_file"</i></A><BR>
<DD>
The LPC analysis file.  This
may be an absolute or relative pathname to the LPC analysis file.
If it is a relative pathname, it will be relative to the directory in
which the CMIX command was invoked.
<P></P></DL>
<DL>
<DT><A NAME="frame_number"><i>frame_number</i></A><BR>
<DD>
The frame from which the RMS amplitude should be read.  The time
in the file will be dependent upon the frame-rate used when the
LPC analysis was done.
<P></P></DL>
<P>

<HR>
<h3>Examples</h3>
<PRE>
   ampval = getamp("/some/LPC/analysis_file.lpc", 268)
</pre>
</ul>
<P>


<HR>
<h3>See Also</h3>
<p>
<A HREF="getpch.php">getpch</A>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


