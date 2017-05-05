<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Scorefile</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>Scorefile Commands and Functions</h1>

RTcmix scorefile commands are used to set up and control the execution of RTcmix.  They also include a number of 'utility' commands for algorithmic music-creation work using the default <a href="Minc.php">Minc</a> scorefile parser. RTcmix commands generally return values that are type "double".
<p>
Although these commands are designed to be used within an RTcmix scorefile, they can also be used as part of an 'embedded' application, working in conjunction with the <a href="/reference/interface/RTcmix-embed.php">RTcmix object</a>.
<p>

<script type="text/javascript" src="/includes/sort.js"></script>
<script type="text/javascript">window.onload = checkSort;</script>

<b>Arrange by: <a href="#sort_topic" id="topiclink" onclick="viewTopics(); return true;" class="sort">Topic</a> 
													&nbsp;&middot;&nbsp; 
					<a href="#sort_alphabetical" id="alphabeticallink" onclick="viewAlphabetical(); return true;" class="sort">Alphabetical</a></b>
</p>

<span id="topic" style="display:block">

<h2>General</h2>

<ul>
	<li><a href="Minc.php">Minc</a> -- overview of the default Minc scorefile parsing language
	<li><a href="rtsetparams.php">rtsetparams</a> -- set basic audio parameters (sampling rate, number of channels, etc.)
	<li><a href="len.php">len</a> -- return the length of the argument
	<li><a href="load.php">load</a> -- load an instrument into RTcmix for use
	<li><a href="rtinput.php">rtinput</a> -- open a soundfile or input device for reading
	<li><a href="rtoutput.php">rtoutput</a> -- open a soundfile for writing
	<li><a href="set_option.php">set_option</a> -- turn on and off various RTcmix options
	<li><a href="bus_config.php">bus_config</a> -- configure and connect the inputs and outputs of RTcmix instruments
	<li><a href="reset.php">reset</a> -- set the control function/envelope update rate
	<li><a href="reset.php">control_rate</a> -- set the control function/envelope update rate
	<li><a href="include.php">include</a> -- embed one scorefile within another
	<li><a href="index_command.php">index</a> -- return the index of an item in a list
	<li><a href="exit.php">exit</a> -- terminate RTcmix
	<li><a href="f_arg.php">f_arg</a> -- return a floating-point argument to the CMIX command
	<li><a href="f_arg.php">i_arg</a> -- return an integer argument to the CMIX command
	<li><a href="f_arg.php">n_arg</a> -- return the number of arguments to the CMIX command
	<li><a href="f_arg.php">s_arg</a> -- return a string argument to the CMIX command
	<li><a href="print.php">print</a> --  print values
	<li><a href="makeinstrument.php">makeinstrument</a> - create handle for CHAIN
	<li><a href="printf.php">printf</a> --  print formatted values
	<li><a href="print_off.php">print_off</a> -- stop printing of RTcmix stats to the screen
	<li><a href="print_on.php">print_on</a> -- allow printing of RTcmix stats to the screen
	<li><a href="stringify.php">stringify</a> -- return a pointer to a string argument
	<li><a href="system.php">system</a> -- execute Terminal or Shell commands from within RTcmix
	<li><a href="type.php">type</a> -- return the Minc data-type of its argument
</ul>

<h2>Soundfile/Audio Information</h2>

<ul>
	<li><a href="CHANS.php">CHANS</a> -- return # of channels of input soundfile
	<li><a href="DUR.php">DUR</a> -- return duration of input soundfile
	<li><a href="PEAK.php">LEFT_PEAK</a> -- return peak amplitude for left channel of input soundfile
	<li><a href="PEAK.php">PEAK</a> -- report peak amplitude for input soundfile
	<li><a href="PEAK.php">RIGHT_PEAK</a> -- return peak amplitude for right channel of input soundfile
	<li><a href="SR.php">SR</a> -- return sampling rate of input soundfile
	<li><a href="filechans.php">filechans</a> -- return # of channels of a named soundfile
	<li><a href="filedur.php">filedur</a> -- return duration of a named soundfile
	<li><a href="filepeak.php">filepeak</a> -- return peak amplitude of a named soundfile
	<li><a href="filesr.php">filesr</a> -- return sampling rate of a named soundfile
	<li><a href="getamp.php">getamp</a> -- retrieve amplitude value from an LPC analysis file
	<li><a href="getpch.php">getpch</a> -- retrieve pitch value from an LPC analysis file
</ul>

<h2>Math/Data/Numerical Conversion</h2>

<ul>
	<li><a href="abs.php">abs</a> -- absolute value of argument
	<li><a href="ampdb.php">ampdb</a> -- convert decibels to amplitude
	<li><a href="dbamp.php">dbamp</a> -- convert amplitude to decibels
	<li><a href="boost.php">boost</a> -- return amplitude multiplier for stereo compensation
	<li><a href="log.php">log</a> -- return the log10 of the argument
	<li><a href="pow.php">pow</a> --  raise (exponentiate) one argument by the other
	<li><a href="max.php">max</a> -- return maximum value of params
	<li><a href="min.php">min</a> -- return minimum value of params
	<li><a href="mod.php">mod</a> -- return result of modulus operation
	<li><a href="round.php">round</a> -- return nearest integer to the argument
	<li><a href="trunc.php">trunc</a> -- truncate a value to integer portion
	<li><a href="wrap.php">wrap</a> -- modulus-like command
	<li><a href="translen.php">translen</a> -- calculate duration from a transposition value (<i>oct.pc</i>)
</ul>


<h2>Pitch-Specification Conversion</h2>

<ul>
	<li><a href="cpslet.php">cpslet</a> -- convert from text-string note letter representation to frequency (Hz)
	<li><a href="cpsmidi.php">cpsmidi</a> -- convert from midi note # to frequency (Hz)
	<li><a href="cpsoct.php">cpsoct</a> -- convert from linear octaves to Hz specification
	<li><a href="cpspch.php">cpspch</a> -- convert from <i>oct.pc</i> to Hz specification
	<li><a href="midipch.php">midipch</a> -- convert <i>oct.pc</i> to midi note #
	<li><a href="octcps.php">octcps</a> -- convert from Hz specification to linear octaves
	<li><a href="octlet.php">octlet</a> -- convert from text-string note letter representation to linear octaves
	<li><a href="octmidi.php">octmidi</a> -- convert from midi note # to linear octaves
	<li><a href="octpch.php">octpch</a> -- convert from <i>oct.pc</i> to linear octaves
	<li><a href="pchcps.php">pchcps</a> -- convert from Hz to <i>oct.pc</i> specification
	<li><a href="pchlet.php">pchlet</a> -- convert from text-string note letter representation to <i>oct.pc</i> specification
	<li><a href="pchmidi.php">pchmidi</a> -- convert from midi note # to <i>oct.pc</i>
	<li><a href="pchoct.php">pchoct</a> -- convert from linear octaves to <i>oct.pc</i>
</ul>

<h2>Random-Number Commands</h2>

<ul>
	<li><a href="irand.php">irand</a> -- return a random number within a specified range
	<li><a href="pickrand.php">pickrand</a> -- return a random choice from a specified set of numbers
	<li><a href="pickwrand.php">pickwrand</a> -- return a weighted random choice from a specified set of numbers
	<li><a href="rand.php">rand</a> -- return a random number between -1.0 and 1.0
	<li><a href="random.php">random</a> -- return a random number between -0.0 and 1.0
	<li><a href="srand.php">srand</a> -- set the initial seed value for the RTcmix psuedo-random number generator
	<li><a href="trand.php">trand</a> -- return a random integer within a specified range
	<li><a href="spray_init.php">spray_init</a> -- initialize a random number "spray can"
	<li><a href="get_spray.php">get_spray</a> -- retrieve a value from a <a href="spray_init.php">"spray table"</a>
</ul>


<h2>Envelope/Control (Function tables, Interface connections, PField variables)</h2>

<ul>
	<li><a href="makeconnection.php">makeconnection</a> -- create PField connection to an interface or device
	<ul>
	<a href="makeconnection.php#mouse"><i>mouse</i></a> -- connect to the mouse position
	<br><a href="makeconnection.php#midi"><i>midi</i></a> -- connect to MIDI controller
	<br><a href="makeconnection.php#datafile"><i>datafile</i></a> -- open and read data from an existing file
	<br><a href="makeconnection.php#inlet"><i>inlet</i></a> -- connect to a Max/MSP
	<a href="/rtcmix~/">rtcmix~</a>
	object inlet
	</ul>

	<li><a href="maketable.php">maketable</a> -- create
a table using the table-handle scheme:
	<ul>
	<a href="maketable.php#textfile"><i>textfile</i></a>
		-- fill a table with values from a text file
	<br><a href="maketable.php#soundfile"><i>soundfile</i></a>
		-- fill a table with samples taken from a soundfile
	<br><a href="maketable.php#literal"><i>literal</i></a>
		-- fill a table with specified values
	<br><a href="maketable.php#datafile"><i>datafile</i></a>
		-- fill a table with values from a binary data file
	<br><a href="maketable.php#curve"><i>curve</i></a>
		-- fill a table using line segments with adjustable curvature
	<br><a href="maketable.php#expbrk"><i>expbrk</i></a>
		-- fill a table using exponential line segments
	<br><a href="maketable.php#line"><i>line</i></a>
		-- fill a table using straight line segments
	<br><a href="maketable.php#linebrk"><i>linebrk</i></a>
		-- fill a table using a linear break-point function (value/#-of-points/value)
	<br><a href="maketable.php#spline"><i>spline</i></a>
		-- fill a table using a spline curve
	<br><a href="maketable.php#wave3"><i>wave3</i></a>
		-- fill a table with 1 cycle of a waveform specified using
			partial-#/amplitude/phase
	<br><a href="maketable.php#wave"><i>wave</i></a>
		-- fill a table with 1 cycle of a waveform using harmonic amplitudes
	<br><a href="maketable.php#cheby"><i>cheby</i></a>
		-- fill a table using a Chebyshev polynomial
	<br><a href="maketable.php#random"><i>random</i></a>
		-- fill a table using random numbers
	<br><a href="maketable.php#window"><i>window</i></a>
		-- fill a table with a Hanning or Hamming window function
	</ul>

	<li><a href="modtable.php">modtable</a> -- modify
a table given a table-handle:
	<ul>
	<a href="modtable.php#normalize"><i>normalize</i></a>
		-- scale table to fit within a specified value
	<br><a href="modtable.php#reverse"><i>reverse</i></a>
		-- reverse the order of values in a table
	<br><a href="modtable.php#shift"><i>shift</i></a>
		-- shift the order of values in a table
	<br><a href="modtable.php#draw"><i>draw</i></a>
		-- insert new values into a table at run-time
	</ul>

	<li><a href="add.php">add</a> -- add to a table-handle table given constant or another table-handle table
	<li><a href="copytable.php">copytable</a> -- copy and optionally resize a table from a table-handle
	<li><a href="div.php">div</a> -- divide the values in a table-handle table by a constant or another table-handle table
	<li><a href="dumptable.php">dumptable</a> -- print the contents of a table given a table-handle
	<li><a href="makeLFO.php">makeLFO</a> -- set up a low-frequency oscillator for PField control use
	<li><a href="makeconverter.php">makeconverter</a> -- use a conversion program to change PField data format

	<li><a href="makefilter.php">makefilter</a> -- establish a filter to transform PField variable data:
	<ul>
	<a href="makefilter.php#clip"><i>clip</i></a>
		-- limit data to a specified range
	<br><a href="makefilter.php#constrain"><i>constrain</i></a>
		-- use pfield data values to select within a table-handle table
	<br><a href="makefilter.php#delay"><i>delay</i></a>
		-- delay data values by a specified amount
	<br><a href="makefilter.php#fitrange"><i>fitrange</i></a>
		-- expand data to a specified range
	<br><a href="makefilter.php#invert"><i>invert</i></a>
		-- 'invert' (mirror) data around an axis of symmetry
	<br><a href="makefilter.php#map"><i>map</i></a>
		-- modify data through a transfer-function table
	<br><a href="makefilter.php#quantize"><i>quantize</i></a>
		-- round data to nearest integer multiples of a quantum value
	<br><a href="makefilter.php#smooth"><i>smooth</i></a>
		-- apply a simple averaging filter to an incoming data stream
	</ul>

	<li><a href="makemonitor.php">makemonitor</a> -- display or record PField control data
	<li><a href="makerandom.php">makerandom</a> -- set up a periodic random-number generator for PField control use
	<li><a href="mul.php">mul</a> -- multiply a table given a table-handle by a constant or another table-handle table
	<li><a href="plottable.php">plottable</a> -- plot the contents of a table given a table-handle
	<li><a href="samptable.php">samptable</a> -- return a value (specific or interpolated) from a table given a table-handle
	<li><a href="sub.php">sub</a> -- subtract values from a table-handle table given a constant or another table-handle table
	<li><a href="tablelen.php">tablelen</a> -- return the size of a table from a table-handle
</ul>
</span>



<span id="alphabetical" style="display:none;">

<table width="100%">
	<tr>
		<td valign="top">
			<ul>
				<li><a href="Minc.php">Minc</a>
				<li><a href="CHANS.php">CHANS</a>
				<li><a href="DUR.php">DUR</a>
				<li><a href="SR.php">SR</a>
				<li><a href="abs.php">abs</a>
				<li><a href="add.php">add</a>
				<li><a href="ampdb.php">ampdb</a>
				<li><a href="boost.php">boost</a>
				<li><a href="bus_config.php">bus_config</a>
				<li><a href="reset.php">control_rate</a>
				<li><a href="copytable.php">copytable</a>
				<li><a href="cpslet.php">cpslet</a>
				<li><a href="cpsmidi.php">cpsmidi</a>
				<li><a href="cpsoct.php">cpsoct</a>
				<li><a href="cpspch.php">cpspch</a>
				<li><a href="div.php">div</a>
				<li><a href="dumptable.php">dumptable</a>
				<li><a href="dbamp.php">dbamp</a>
				<li><a href="exit.php">exit</a>
				<li><a href="f_arg.php">f_arg</a>
				<li><a href="filechans.php">filechans</a>
				<li><a href="filedur.php">filedur</a>
				<li><a href="filepeak.php">filepeak</a>
				<li><a href="filesr.php">filesr</a>
				<li><a href="getamp.php">getamp</a>
				<li><a href="getpch.php">getpch</a>
				<li><a href="get_spray.php">get_spray</a>
				<li><a href="f_arg.php">i_arg</a>
				<li><a href="include.php">include</a>
				<li><a href="index_command.php">index</a>
				<li><a href="irand.php">irand</a>
				<li><a href="len.php">len</a>
				<li><a href="load.php">load</a>
				<li><a href="log.php">log</a>
				<li><a href="makeconnection.php">makeconnection</a>
					<ul>
					<a href="makeconnection.php#mouse"><i>mouse</i></a>
					<br><a href="makeconnection.php#midi"><i>midi</i></a>
					<br><a href="makeconnection.php#datafile"><i>datafile</i></a>
					<br><a href="makeconnection.php#inlet"><i>inlet</i></a>
					</ul>
				<li><a href="makeconverter.php">makeconverter</a>
			</ul>
		</td>

		<td valign="top">
			<ul>

				<li><a href="makefilter.php">makefilter</a>
					<ul>
					<a href="makefilter.php#clip"><i>clip</i></a>
					<br><a href="makefilter.php#constrain"><i>constrain</i></a>
					<br><a href="makefilter.php#delay"><i>delay</i></a>
					<br><a href="makefilter.php#fitrange"><i>fitrange</i></a>
					<br><a href="makefilter.php#invert"><i>invert</i></a>
					<br><a href="makefilter.php#map"><i>map</i></a>
					<br><a href="makefilter.php#quantize"><i>quantize</i></a>
					<br><a href="makefilter.php#smooth"><i>smooth</i></a>
					</ul>

				<li><a href="makeinstrument.php">makeinstrument</a>
				<li><a href="makeLFO.php">makeLFO</a>
				<li><a href="makemonitor.php">makemonitor</a>

				<li><a href="maketable.php">maketable</a>
					<ul>
					<a href="maketable.php#textfile"><i>textfile</i></a>
					<br><a href="maketable.php#soundfile"><i>soundfile</i></a>
					<br><a href="maketable.php#literal"><i>literal</i></a>
					<br><a href="maketable.php#datafile"><i>datafile</i></a>
					<br><a href="maketable.php#curve"><i>curve</i></a>
					<br><a href="maketable.php#expbrk"><i>expbrk</i></a>
					<br><a href="maketable.php#line"><i>line</i></a>
					<br><a href="maketable.php#linebrk"><i>linebrk</i></a>
					<br><a href="maketable.php#spline"><i>spline</i></a>
					<br><a href="maketable.php#wave3"><i>wave3</i></a>
					<br><a href="maketable.php#wave"><i>wave</i></a>
					<br><a href="maketable.php#cheby"><i>cheby</i></a>
					<br><a href="maketable.php#random"><i>random</i></a>
					<br><a href="maketable.php#window"><i>window</i></a>
					</ul>
				<li><a href="makerandom.php">makerandom</a>
				<li><a href="max.php">max</a>
				<li><a href="midipch.php">midipch</a>
				<li><a href="min.php">min</a>
				<li><a href="mod.php">mod</a>
				<li><a href="modtable.php">modtable</a>
					<ul>
					<a href="modtable.php#draw"><i>draw</i></a>
					<br><a href="modtable.php#normalize"><i>normalize</i></a>
					<br><a href="modtable.php#reverse"><i>reverse</i></a>
					<br><a href="modtable.php#shift"><i>shift</i></a>
					</ul>
				<li><a href="mul.php">mul</a>
				<li><a href="f_arg.php">n_arg</a>
			</ul>
		</td>

		<td valign="top">
			<ul>
				<li><a href="octcps.php">octcps</a>
				<li><a href="octlet.php">octlet</a>
				<li><a href="octmidi.php">octmidi</a>
				<li><a href="octpch.php">octpch</a>
				<li><a href="pchcps.php">pchcps</a>
				<li><a href="pchlet.php">pchlet</a>
				<li><a href="pchmidi.php">pchmidi</a>
				<li><a href="pchoct.php">pchoct</a>
				<li><a href="PEAK.php">PEAK</a>
					<ul>
					<a href="PEAK.php"><i>LEFT_PEAK</i></a>
					<br><a href="PEAK.php"><i>RIGHT_PEAK</i></a>
					</ul>
				<li><a href="pickrand.php">pickrand</a>
				<li><a href="pickwrand.php">pickwrand</a>
				<li><a href="plottable.php">plottable</a>
				<li><a href="pow.php">pow</a>
				<li><a href="print.php">print</a>
				<li><a href="printf.php">printf</a>
				<li><a href="print_off.php">print_off</a>
				<li><a href="print_on.php">print_on</a>
				<li><a href="rand.php">rand</a>
				<li><a href="random.php">random</a>
				<li><a href="reset.php">reset</a>
				<li><a href="round.php">round</a>
				<li><a href="rtinput.php">rtinput</a>
				<li><a href="rtoutput.php">rtoutput</a>
				<li><a href="rtsetparams.php">rtsetparams</a>
				<li><a href="f_arg.php">s_arg</a>
				<li><a href="samptable.php">samptable</a>
				<li><a href="set_option.php">set_option</a>
				<li><a href="spray_init.php">spray_init</a>
				<li><a href="srand.php">srand</a>
				<li><a href="stringify.php">stringify</a>
				<li><a href="sub.php">sub</a>
				<li><a href="system.php">system</a>
				<li><a href="tablelen.php">tablelen</a>
				<li><a href="trand.php">trand</a>
				<li><a href="translen.php">translen</a>
				<li><a href="trunc.php">trunc</a>
				<li><a href="type.php">type</a>
				<li><a href="wrap.php">wrap</a>
			</ul>
		</td>
	</tr>
</table>
</span>

There are a few older, disk-based cmix commands that are not documented
here (commands like <b>open</b>, <b>input</b>, <b>output</b>, etc.).  They
have all been superceded by RTcmix commands, and it isn't guaranteed
that they work very well.  See the source code if you are Seriously
Interested.


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
