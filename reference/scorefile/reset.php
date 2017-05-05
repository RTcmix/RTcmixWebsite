<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - reset/control_rate</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>reset/control_rate</b> - set the update rate for control functions
and envelopes
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
<b>reset</b>(<i>sampling_rate</i>)
<br>
<b>control_rate</b>(<i>sampling_rate</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
For instruments that are designed to use <i>resetval</i>
in updating control functions and envelopes (pfields), <b>reset</b>
determines how many times/second the control function/envelope
is 'sampled'.  For example,
<pre>
   reset(44100)
</pre>
will cause a control function to be sampled 44100 times/second
(or once-every-sample for a standard 44.1k sampling-rate sound).
<p>
Why is this desired?  Often it is not necessary to update
control functions for every sample, and an instrument
can run much more efficiently by choosing a lower sampling rate
for control functions.
<p>
The default rate is 1000 times/second.
<p>
Most but not all RTcmix instrument control parameters
will respond to the <b>reset</b>
command.  Exceptions for particular controls are usually
noted in the instrument documentation.
<p>
If the reset rate is made too slow, a 'stair-stepping' or 'zippering'
distortion effect can occur in control function access. especially
noticeable in amplitude envelopes.
<ul>
<i>NOTE: <b>reset</b> and <b>control_rate</b> do exactly the
same thing. The </i>perl<i> RTcmix interface cannot
use <b>reset</b>, for example, because the name is reserved
in the language.</i>
</ul>
</P>
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><i>sample_rate</i>
<DD>
Any number, floating point or integer represetig how many times/second
the control/envelope (pfield) information will be updated during note
execution.
<P></P></DL>


<HR>
<h3>Examples</h3>
<pre>
   reset(10000)
   control_rate(22050)
</pre>



<HR>
<h3>See Also</h3>
<p>
<a href="rtsetparams.php">rtsetparams</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

