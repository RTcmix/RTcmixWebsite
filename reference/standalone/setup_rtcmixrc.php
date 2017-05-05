<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - setup_rtcmixrc</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>setup_rtcmixrc</b> - build a <i>.rtcmixrc</i> option file

<HR>
<h3>Synopsis</h3>
<P><STRONG>setup_rtcmixrc</STRONG></P>
<P>
<HR>
<h3>Description</h3>

<P>
The <b>setup_rtcmixrc</b> utility will create a file <i>.rtcmixrc</i>
in your home directory that will contain options for running
RTcmix.  This file is, actually, optional itself.  BUT if you want
to specify all sorts of fanciness for your particular configuration,
this may be the Ideal Command for <i>YOU!</i>.
<p>
The options will be read as if you created a bunch (gaggle?) of
<a href="/reference/scorefile/set_option.php">set_option</a>
scorefile commands, and you can add or subtract options
to the <i>.rtcmixrc</i> file accordingly.  <b>setup_rtcmixrc</b>
will use your default options to build the file.  Reassign,
reconfigure and rearrange at your leisure.

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
