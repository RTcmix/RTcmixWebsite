<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - delget/delset/delput/dliget</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>delget/delset/delput/dliget</h3>
<i>initialize and use delay lines</i>
<br>
<br>
<ul>
<i>[note:  These older delay functions have been replaced
by the
<a href="Odelay.php">Odelay/Odelayi</a>
objects.]</i>
</ul>


<h3>Synopsis</h3>
<UL>
#include &lt;ugens.h&gt;<BR>

<BR>
     delset(array,delvals,maxlength)<BR>
     float *array,maxlength;<BR>
     int *delvals;<BR>
<BR>

     float delget(array,wait,delvals)<BR>
     float *array,wait;<BR>
     int *delvals;<BR>
<BR>

     delput(signal,array,delvals)<BR>
     float *array,signal;<BR>
     int *delvals;<BR>
<BR>

     float dliget(array,wait,delvals)<BR>
     float *array,wait;<BR>
     int *delvals;<BR>
<BR></UL>
<h3>Description</h3>

     These units are used to store and fetch samples from a delay
     line. <B>delset()</B> is the initialization unit for <B>delget(),
delput(),</B> and <B>dliget()</B>. <i>array</i> is an array of floats which must
     be at least <i>maxlength</i> words long, where this number is the
     maximum size you expect to use (sampling rate * maximum
     delay in seconds).  <i>delvals</i> is an array of two integers used
     for bookkeeping purposes. <B>delput()</B> stores <i>signal</i> in <i>array</i>,
     and <B>delget()</B> fetches a sample from the pipeline where <i>wai</i>  is the age of the sample in seconds.  E.g. if <i>wait</i> is equal
     to .5 at a sampling rate of 30000,  <B>delget()</B> will look back
     15000 samples. <i>array</i> must be dimensioned appropriately.
     Naturally, <B>delput()</B> must be called before  <B>delget()</B>, <B>dliget()</B>
     is identical with  <B>delget()</B> except that it will interpolate
     linearly between samples according to the fractional part of
    <i>wait</i>.

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
