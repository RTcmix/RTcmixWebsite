<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - resample</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<b>resample</b> - convert sampling rate

<hr>

<h3>Usage</h3>
<strong>resample</strong> <strong>-r</strong> <i>NEW_SRATE [options]</i> <i>inputfile [outputfile]</i>

<hr>

<h3>Description</h3>

<strong>resample</strong> can do two kinds of sampling rate conversion:
(1) Kaiser-windowed low-pass filter (better)
(2) linear interpolation only, no filter (faster)         
<p>
For (1), use either no option, in which case you get the default,  
decent-quality resampling filter; use the <i>-a</i> option for a better   
quality filter; or use a combination of the <i>-f</i>, <i>-b</i>
and <i>-l</i> options  
to design your own filter.
For (2), use the <i>-i</i> option.

<hr>

<h3>Options</h3>

Here are the options:
<pre>
  Options:                                                           
     -a       triple-A quality resampling filter                     
  OR:                                                                
     -f NUM   rolloff Frequency (0 < freq <= 1)       [default: 0.9] 
     -b NUM   Beta ( >= 1)                            [default: 9.0] 
     -l NUM   filter Length (odd number <= 65)        [default: 65]  
                                                                     
     -n       No interpolation of filter coefficients (faster)       
     -i       resample by linear Interpolation, not with filter      
     -t       Terse (don't print out so much)                        
     -v       print Version of program and quit                      
  If no output file specified, writes to "inputfile.resamp".
</pre>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
