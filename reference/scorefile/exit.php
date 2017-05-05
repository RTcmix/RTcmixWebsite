<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - exit</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>


<b>exit</b> - terminate RTcmix
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
<b>exit</b>()
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>exit</b> closes all open soundfiles and
input streams (if any) and terminates RTcmix execution.
This happens immediately upon the parser encountering the
<b>exit</b> command -- all scheduled events are terminated.
</P>
<P>

<HR>
<h3>See Also</h3>
<p>
<a href="system.php">system</a>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


