<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - load</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>load</b> - load an RTcmix instrument for use
</P>
<P>

<HR>
<h3>Synopsis</h3>
<P>
<b>load</b>(<i>"INSTRUMENT"</i>)
<br>
<b>load</b>(<i>"dsoPATHNAME"</i>)
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>load</b> is an essential command for all RTcmix scorefiles.  <b>load</b>
is used to load in particular instrument executable-library files (DSOs)
for the RTcmix instrument(s) that will be used during the run
of the scorefile.  One or more <b>load</b> commands usually follows
the
<a href="rtsetparams.php">rtsetparams</a>
setup command.
<p>
The syntax for <b>load</b> is easy -- it will either take a string
with the name of one of the distributued RTcmix instruments stored in the
RTcmix-searched DSO library (usually "RTcmix/shlib"), or it
can take an absolute or relative pathname string to a "libINSTRUMENT.so"
instrument DSO directly (the second method is how a user-developed
library would be loaded into RTcmix for use).
<p>
Here's an example from the original documentation by Doug Scott
for the <b>load</b> scorefile command:
<br>
<hr>
<ul>
To run
<a href="/reference/instruments/FMINST.php">FMINST</a>
from <i>CMIX</i>, your score would look like this:
<ul><pre>
rtsetparams(44100, 1);    /* set output params */
rtinput("/snd/myfile.snd");

load("FMINST");   /* this loads the FMINST DSO */

FMINST(....);     /* use FMINST */
</pre></ul>
Then run the command:
<ul><pre>
CMIX < scorefile
</pre></ul>
      If you have created a custom instrument DSO following the TEMPLATE
      example, you will end up with a file called libMYINSTRUMENT.so, where
      "MYINSTRUMENT" is whatever you named your instrument.  To use it,
      just put a line:
<ul><pre>
load("./libMYINSTRUMENT.so");
</pre></ul>
      at the top of your score.  Note that this is specified as a file name,
      where the <i>FMINST</i> was not.  Any pre-existing RTcmix instrument which has
      a pre-installed DSO can use the first form;  custom DSOs use the latter
      form.
<p>
      How does this work?  Most UNIX-like operating systems
      allow object code to be dynamically loaded, i.e., read from a file and
      added to a running program.  They also include a feature for accessing
      the functions and other symbols which are in that dynamically loaded
      object.  When you give a load("FOO") command, RTcmix looks in its default
      DSO location for a file called "libFOO.so".  If it doesn't find it, it
      returns an error message.  If it does find it, it loads it in.  It then
      looks in that object to see if it has the magic "profile" and/or
      "rtprofile" functions.  It it does, it calls them -- and this makes all
      the RTcmix functions in that DSO available to CMIX!
</ul>
The only instrument that does not require an explicit <b>load</b> command
in the scorefile is
<a href="/reference/instruments/MIX.php">MIX</a>
because it is the 'foundation' instrument for RTcmix.
<p>
Be aware that
if you load the same DSO more than once in a scorefile, it will really
get confused about the symbol-table entries (i.e. don't do this!).
</P>
<P>

<HR>
<h3>Arguments</h3>
<DL>
<DT><i>"INSTRUMENT"</i> or <i>"dsoPATHNAME"</i>
<DD>
The string <i>"INSTRUMENT"</i> is used when referencing one of the
distributed RTcmix instruments for loading.  The 'DSO's (dynamically-shared
objects) for these generally reside in the RTcmix/shlib directory, and are
placed there by the "make install" command during the RTcmix build-and-install
process.  The string <i>"dsoPATHNAME"</i> can be an absolute or relative
pathname to an instrument DSO.  These are usually named "libINSTRUMENT.so".
If it is a relative pathname, it will be relative to the directory in which
the CMIX command was invoked.  <i>note: for many embedded applications
such as
<a href="http://rtcmix.org/rtcmix~">rtcmix~</a>
and
<a href="http://rtcmix.org/iRTcmix">iRTcmix</a>
the instruments are 'compiled-in' and do not have to be loaded.</i>
<P></P></DL>


<HR>
<h3>Examples</h3>
<pre>
   load("WAVETABLE")
   load("/usr/local/src/myinstruments/TESTINST/libTESTINST.so")
</pre>


<HR>
<h3>See Also</h3>
<p>
<a href="rtsetparams.php">rtsetparams</a>,
<a href="set_option.php#auto_load"">set_option (auto_load)</a>,
<a href="set_option.php#dsopath"">set_option (dsopath)</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>


