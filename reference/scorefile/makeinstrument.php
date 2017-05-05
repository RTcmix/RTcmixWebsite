<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - makeinstrument</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>makeinstrument</b> - create handle for CHAIN
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
inst_handle = <b>makeinstrument</b>(<i>"INSTRUMENT_NAME", inst_arg0, inst_arg1, ...</i>);
</P>
<P>

<HR>
<h3>Description</h3>
<P>
<b>makeinstrument</b> is used to create handles for instruments that will become the arguments to the <a href="/reference/instruments/CHAIN.asp">CHAIN</a> instrument. These are functionally identical to instruments created in the normal fashion.
</P>
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><i>INSTRUMENT_NAME</i>
<DD>
 The name of the instrument to be created.  This will always match the name that would have been used in a normal instrument call.

<DT><i>inst_arg0, inst_arg1, ...</i>
<DD>
  The first, second, etc., arguments that would have been handed to the instrument in a normal call.
<P></P></DL>


<HR>
<h3>Examples</h3>
<p>
Example:  Create a TRANS instrument handle:
<pre>
	outskip = 0;
	inskip = 0;
	dur = 2;
	amp = 100;
	transposition = -0.09;

	trans = makeinstrument("TRANS", outskip, inskip, dur, amp, transposition);
</pre>
<p>

<HR>
<h3>See Also</h3>
<p>
<a href="/reference/instruments/CHAIN.php">CHAIN</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

