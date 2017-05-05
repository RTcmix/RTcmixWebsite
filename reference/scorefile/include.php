<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - include</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>include</b> - embed one RTcmix scorefile within another.
</P>
<P>


<HR>
<h3>Synopsis</h3>
<P><b>include</b> <i>filename</i>
</P>
<P>


<HR>
<h3>Description</h3>
<P>
<b>include</b> allows you to "include" an external file
in another scorefile.  The "included" file will behave as if the text
of the file were part of the original scorefile; i.e. all variable
assignments, table-creation or option-setting done in the "included"
portion will have affect throughout the rest of the 'parent' scorefile.
In other words, the "included" file will behave as if it were typed into
the 'parent' scorefile at the point where the <b>include</b>
directive is placed.
<p>
The syntax is easy, although it differs slightly from the
standard
<a href="Minc.php">Minc</a>
or other parser-interface syntax:
<pre>
   include otherfile.sco
</pre>
where <i>otherfile.sco</i> can be an absolute or relative path to
a scorefile or scorefile fragment to be included.  An <b>include</b>
statement may be placed anywhere in the 'parent' scorefile.  "included"
scorefiles may also contain <b>include</b> statements, up to a nesting
depth of 10.
<p>
This command makes it convenient to collect a set of values
or parameters in a single file that can then be included in
multiple scorefiles.
<p>
The <b>include</b> statement <u>has to start in column 1</u>.
<p>
This is similar to the <i>#include</i> directive in C/C++.
<P>


<HR>
<h3>Arguments</h3>
<DL>
<DT><i>filename</i>
<DD>
An absolute or relative pathname to a scorefile or scorefile fragment.
At present this filename should not contain spaces or other white-space
characters (quotes around <i>filename</i> will not work).
<P></P></DL>


<HR>
<h3>Examples</h3>
<pre>
   dice = random()

   if (dice > 0.5) {
   include firstbigchunk.sco
   } else {
   include secondbigchunk.sco
   }
</pre>
<p>
The above scorefile will be altered by the inclusion of
<i>firstbigchunk.sco</i> or <i>secondbigchunk.sco</i> depending
on the random value of <i>dice</i>.  Note that the <b>include</b>
directive is placed in column 1, not indented.
</P>


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
