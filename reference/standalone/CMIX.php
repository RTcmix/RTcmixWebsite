<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - ampdb</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>CMIX/PCMIX/PYCMIX</h3>

<i>INTERFACE -- the main commands used to invoke RTcmix</i>
<p>
These commands are used to start and run RTcmix from the command-line;
i.e. typed into a terminal. <b>CMIX</b> is the default command,
it employs the included
<a href="/reference/scorefile/Minc.php">Minc</a>
parsing language to interpret scorefiles.  <b>CMIX</b> can also
be run interactively with scorefile commands typed directly into
a terminal window running the <b>CMIX</b> command, although this
requires very careful typing skills.
<p>
The <b>PCMIX</b> command is available if RTcmix is configured and compiled
with the <i>--with-perl</i> configuration flag (see the
<a href="/rtcmix/">installation guide</a>
for information about how to do this) -- it uses the Perl language
as the scorefile parser.
<p>
Similarly, the Python language may be used if the <b>PYCMIX</b>
command was created (done with the <i>--with-python</i> configure flag).
<p>
All three commands can be run with various options:
<pre>
   Usage:  CMIX [options] [arguments] < minc_script.sco

   or, to use Perl instead of Minc:
        PCMIX [options] [arguments] < perl_script.pl
   or:
        PCMIX [options] perl_script.pl [arguments]

   or, to use Python:
        PYCMIX [options] [arguments] < python_script.py

        options:
           -i       run in interactive mode
           -n       no init script (interactive mode only)
           -o NUM   socket offset (interactive mode only)
           -c       enable continuous control (rtupdates)
          NOTE: -s, -d, and -e are not yet implemented
           -s NUM   start time (seconds)
           -d NUM   duration (seconds)
           -e NUM   end time (seconds)
           -f NAME  read score from NAME instead of stdin
                      (Minc and Python only)
           --debug  enter parser debugger (Perl only)
           -q       quiet -- suppress print to screen
           -Q       really quiet -- not even clipping or peak stats
           -h       this help blurb
        Other options, and arguments, passed on to parser.
</pre>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
