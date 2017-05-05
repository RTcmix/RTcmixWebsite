<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - F1/F2/I1/I2</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>F1/F2/I1/I2</h3>
<i>scripts to create floating-point and integer soundfiles</i>
<br>
<br>
These are all older utilities to create soundfile (headers only) -- the
disk-based Cmix required soundfiles to pre-exist, at least in header form,
on disk for information about sampling rate, etc.  The
<a href="/reference/scorefile/rtoutput.php">rtoutput</a>
command does not have this restriction.
<p>
all are shell scripts that bundle up options for the
<a href="sfcreate.php">sfcreate</a>
command, because we used to get tired of typing all them numbers and
letters back in the <i>Olden Days</i>
<p>
Here's what they are:
<p>
<pre>
<ul>
F1: sfcreate -r 44100 -c 1 -f -t sun $1
	(writes a 1-channel floating-point 44.1k soundfile header)
F2: sfcreate -r 44100 -c 2 -f -t sun $1
	(writes a 2-channel floating-point 44.1k soundfile header)
I1: sfcreate -r 44100 -c 1 -i $1
	(writes a 1-channel 16-bit integer 44.1k soundfile header)
I2: sfcreate -r 44100 -c 1 -i $1
	(writes a 2-channel 16-bit integer 44.1k soundfile header)
</ul>
</pre>
Pretty silly, huh?
<p>
Here's a <i>Handy Fact To Know</i> -- all of these scripts (and
<a href="sfcreate.php">sfcreate</a> itself, of course)
can write a new header onto a pre-existing file without disturbing
too much of the file's contents (you may lose a few bytes at the front
depending on the size of the header and any pre-existing headers on
the file).  Ever wondered what your executable <u>sounds</u> like?

<H3>See Also</H3>

<a href="sfcreate.php">sfcreate</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
