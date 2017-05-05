<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - PField Control</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>"PField" Control</h3>

Beginning in RTcmix 4.0, a new system for controlling Instrument parameters
was installed.  This replaces the original
<a href="/reference/scorefile/makegen.php">makegen</a>
system for various Instrument envelopes, although it is still supported
for nearly all of the older instruments.  This new system also allows
the user to
control Instrument parameters in real-time as a note is being executed.
For example, the pitch parameter of an Instrument might be "pfield-enabled".
This means that the pitch of an executing note could be controlled by
an RTcmix 'table' or it could be controlled by an external connection,
so that the pitch can be altered dynamically (perhaps in response to
mouse movement or an external controller) as the note is sounding.
<p>
PField control is accomplished using special RTcmix variables called
<i>pfield-handles</i> or <i>table-handles</i>.  The parsers for RTcmix
are configured to allow a number of basic operations (arithmetic, etc.)
on these variables.  There are also a number of specialized filters
and operator commands for these <i>handle</i> variables.  PField-enabled
parameters can also be single values or 'regular' RTcmix variables,
of course.
<p>
The
<a href="/tutorials/standalone.php">Basic RTcmix Tutorial</a>
has examples of how this control system works, and the
<a href="/tutorials/instrument_design.php">RTcmix Instrument Design Tutorial</a>
discusses how to incorporate PFIeld control into user-written Instruments.
<p>
See the
<a href="/tutorials/PFields.php">Short Tour of PField Capabilities</a>
tutorial for more information about various PField scorefile commands.
<br>
<br>

<hr>
<h3>SEE ALSO</h3>
<a href="/reference/scorefile/maketable.php">maketable</a>,
<a href="/reference/scorefile/makeconnection.php">makeconnection</a>,
<a href="/reference/scorefile/makemonitor.php">makemonitor</a>,
<a href="/reference/scorefile/makeLFO.php">makeLFO</a>,
<a href="/reference/scorefile/makefilter.php">makefilter</a>,
<a href="/reference/scorefile/makerandom.php">makerandom</a>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
