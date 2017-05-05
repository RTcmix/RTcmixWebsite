<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - wshape</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>wshape</h3>
<i>waveshaping signal-processor</i>
<br>
<br>
<b>whsape</b> takes a sample, a pointer to a transfer function table (see
<a href="floc.php">floc</a>
to use a function table slot)
and the length of the transfer function table (see
<a href="fsize.php">fsize</a>)
and returns a 'waveshaped' (table-lookup) version of the sample.
<p>
From the source code:
<hr>
float wshape(float x, float *f, int len)
<br>x = sample
<br>f = pointer to the transfer function table
<br>len = length of the transfer function table
<hr>
Example of use:
<pre>

float insample, outsample, *transfunc, int len;

transfunc = floc(2); // use function table slot # 2 from scorefile
len = fsize(2);

 ...

for (i = 0; i < framesToRun(); i++) {
   insample = someinputsample;

   outsample = wshape(insample, transfunc, len);

 ...
}
</pre>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
