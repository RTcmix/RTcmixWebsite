<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - table/tablei/tableset</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>table/tablei/tableset</h3>
<i>initialize and access a function table slot</i>
<br>
<br>
<ul>
<i>[note:  These are older function table slot routines.  They
have been generally superceded by using the
<a href="Ooscili.php">Ooscili</a>
or
<a href="Ooscil.php">Ooscil</a>
objects to read a function table slot for a control
function/envelope for exactly one cyle through the note.</i>
</ul>

<h3>Synopsis</h3>
<UL>
     #include "ugens.h"<BR>
<BR>
     float table(nsample,array,tab)<BR>
     long nsample;<BR>
     float *array,*tab;<BR>
<BR>
     float tablei(nsample,array,tab)<BR>
     long nsample;<BR>
     float *array,*tab;<BR>
<BR>
     tableset(dur,size,tab)<BR>
     float dur,*tab;<BR>
     int size;<BR>
<BR></UL>
<h3>Description</h3>

     These units will return a value from the <i>*array</i> as a function of
	<i>nsample</i>, which is the number of the current sample,
     counting up from 0.  The array <i>*tab</i> must be dimensioned at 2
     in the calling routine.  It is used for bookkeeping purposes.
	<b>tableset</b> initializes the values in the <i>*tab</i> array as
     functions of <i>dur</i>, which is the expected duration of the
     note, and <i>size</i>, which is the number of locations in the
     array to be sampled.  The values in <i>*tab</i> are left untouched
     by <b>table</b> and <b>tablei</b> so they can be called to look at any
     tables of the same size.  <b>tablei</b> is an interpolating version
     of <b>table</b>.<P>

     The value of these units is that they do not need to be
     called on every sample and can thus be used in control loops
     to create amplitude curves etc.  For example:<P>
<PRE>
          long nsample,totalsamps;
          short countdown,loopsize,size;
          float amp,array[???],tab[2],dur;
          .
          .
          tableset(dur,size,tab);
          .
          .
          for(i = 0; i < framesToRun(); i++) {
                                   /* main performance loop */
               if(!countdown--) {
                                   /* periodic control loop */
                    amp = table(currentFrame(), array, tab);
                    countdown = loopsize;
               }
               .
               .
          }
          .
          .
          .
</PRE>
     If <i>nsample</i> points to a time greater than than that declared
     by <i>dur</i> the last value in the array will be returned.
<P>

<h3>See Also</h3>

<a href="evp.php">env</a>,
<a href="Ooscili.php">Ooscili</a>,

<h3>Bugs</h3>

     Not sure what will happen if negative times or samples are
     passed in argument list.


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
