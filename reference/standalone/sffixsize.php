<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - sffixsize</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>



<b>sffixsize</b> - update soundfile header's idea of sound duration

<hr>
<h3>Synopsis</h3>
<P><STRONG>sffixsize</STRONG> <EM>filename</EM> [<EM>filename</EM>...]</P>
<P>
<hr>
<h3>Description</h3>

<P><STRONG>sffixsize</STRONG> updates the soundfile header to reflect the actual amount
of sound data the file contains.  This may not have been written
correctly if the writing process ended prematurely.  <STRONG>sffixsize</STRONG> can
fix this problem so that you can play the file, etc.</P>
<P>Without a <EM>filename</EM> argument, <STRONG>sffixsize</STRONG> just prints a help
summary.</P>
<P>
<hr>
<h3>See Also</h3>
<P><A HREF="sfprint.php">sfprint</A>, <A HREF="sfcreate.php">sfcreate</A>, <A HREF="sfhedit.php">sfhedit</A>,
<a href="sfshrink.php">sfshrink</a>
</P>
<P>
<hr>
<h3>Authors</h3>
<P>John Gibson &lt;johgibso at indiana edu&gt;</P>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
