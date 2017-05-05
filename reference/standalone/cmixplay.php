<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - cmixplay/play</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h3>cmixplay/play</h3>

<i>play soundfiles</i>
<p>
<b>cmixplay</b> and <b>play</b> (an alias) are really handy
command-line soundfile playback utilities.  They handle most extant
uncompressed soundfile types.
<p>
Here are the options:
<pre>
	cmixplay [options] filename 
       options:  -s NUM    start time                           
                 -e NUM    end time                             
                 -d NUM    duration                             
                 -f NUM    rescale factor                       
                 -c NUM    channel (starting from 0)            
                 -h        view this help screen                
                 -k        disable hotkeys (see below)          
                 -t NUM    time to skip for rewind, fast-forward
                              (default is 4 seconds)            
                 -r        robust - larger audio buffers        
                 -q        quiet - don't print anything         
                 --force   use rescale factor even if peak      
                              amp of float file unknown         
          Notes: -d ignored if you also give -e                 
                 Times can be given as seconds or 0:00.0        
                    If the latter, prints time in same way.     
                 Hotkeys: 'f': fast-forward, 'r': rewind,       
                          'm': mark (print current buffer start time)
                          't': toggle time display              
                 To stop playing: cntl-D or cntl-C
</pre>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
