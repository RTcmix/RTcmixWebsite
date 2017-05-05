<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - reverb/rvbset</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>reverb/rvbset</h3>
<i>poor-quality reverberator</i>
<br>
<br>
<ul>
<i>[note:  There are much better approaches to reverberation
and room-simultion.  See in particular the instruments
<a href="/reference/instruments/PLACE.php">PLACE</a>,
<a href="/reference/instruments/FREEVERB.php">FREEVERB</a> and
<a href="/reference/instruments/REV.php">REV</a>.]</i>
</ul>

<h3>Synopsis</h3>
<UL>
     #include &lt;ugens.h&gt;<BR><BR>
     float reverb(sample,array)<BR>
     float sample, *array;<BR>
<BR>
     float rvbset(loopt,reverbtime,init,array)<BR>
     float loopt,reverbtime,*array;<BR>
<BR></UL>
<h3>Description</h3>

    <B>reverb</B> is a package of four combs and two allpass filters
     which attempts to create the effect of diffused, reverberated sound.  This filter must first be initialized with a
     call to <B>rvbset()</B>. which intializes an array for use with a
   <B>reverb()</B> filter.<P>

     <i>reverbtime</i> is the length of time old samples take to decay
     60 db.<P>

    <i>init</i> is a flag which, if FALSE, forces the loop to be filled
     with zeroes.  Setting init to TRUE will cause the contents
     of the array loop to be unaltered.<P>

     <i>array</i> is the address of a floating point array which must be
     dimensioned to 1583 * SR + 18.  This implementation consists
     of four comb and two allpass filters, and is the old MUSIC4
     version.  It leaves a lot to be desired.<P>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
