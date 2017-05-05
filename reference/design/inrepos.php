<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - inrepos/outrepos</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>inrepos/outrepos</h3>
<i>older disk-based cmix instruments</i>
<p><b>inrepos</b> is superceded by
<a href="rtinrepos.php">rtinrepos</a>.  There is no equivalent
for <b>outrepos</b> in RTcmix because of the way the
scheduler works,  The alternative is to use the scheduler to
set the timepoint for output-writing.
<br>
<br>

From the source code:
<hr>
int inrepos(int samps, int fno)
<br>
<br>samps = # of samples to move forwards or backwards (negative) in time
<br>fno = open soundfile number
<p>
int outrepos(int samps, int fno)
<br>
<br>samps = # of samples to move forwards or backwards (negative) in time
<br>fno = open soundfile number
<p>
Both functions return a pointer to the file being operated upon, or
exit on failure.

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
