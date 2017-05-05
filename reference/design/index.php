<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Design</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>Instrument Design</h1>

RTcmix provides a set of C/C++ functions and objects for constructing new signal-processing and synthesis instruments. The source code for most of these low-level routines are in the "RTcmix/lib" and "RTcmix/sys" subdirectories of the RTcmix distribution.
<p>
In addition to the reference material below, <a href="/tutorials/instrumentdesign.php">a tutorial is available</a> for creating and compiling RTcmix instruments.

<script type="text/javascript" src="/includes/sort.js"></script>
<script type="text/javascript">window.onload = checkSort;</script>
	
<p>
<b>Arrange by: <a href="#sort_topic" id="topiclink" onclick="viewTopics(); return true;" class="sort">Topic</a> 
													&nbsp;&middot;&nbsp; 
					<a href="#sort_alphabetical" id="alphabeticallink" onclick="viewAlphabetical(); return true;" class="sort">Alphabetical</a></b>
</p>

<span id="topic" style="display:block">

<h2>Processing Control/Sound Input & Output</h2>

<ul>
	<li><a href="Instrument.php">Instrument</a> -- base class for all RTcmix instruments; contains many essential functions and variables
		<ul>
			<li><a href="Instrument.php#configure">configure</a> -- designer-overridden virtual function to configure an RTcmix instrument
			<li><a href="Instrument.php#currentFrame">currentFrame</a> -- return current sample frame #
			<li><a href="Instrument.php#framesToRun">framesToRun</a> -- return number of frames to run for each <i>Instrument::run()</i> invocation
			<li><a href="Instrument.php#getdur">getdur</a> -- returns duration (seconds) of the note
			<li><a href="Instrument.php#getendsamp">getendsamp</a> -- returns the (absolute) ending sample # (frame) for a note
			<li><a href="Instrument.php#getSkip">getSkip</a> -- returns the number of samples in one control (reset) period
			<li><a href="Instrument.php#getstart">getstart</a> -- returns starting time (seconds) of the note
			<li><a href="Instrument.php#increment">increment</a> -- update the computed-sample count
			<li><a href="Instrument.php#init">init</a> -- designer-overridden virtual function to initialize an RTcmix instrument
			<li><a href="Instrument.php#inputChannels">inputChannels</a> -- return the number of input channels
			<li><a href="Instrument.php#nSamps">nSamps</a> -- return total number of frames (samples) to run for a note
			<li><a href="Instrument.php#outputChannels">outputChannels</a> -- return the number of output channels
			<li><a href="Instrument.php#run">run</a> -- designer-overridden virtual function for computing samples
			<li><a href="Instrument.php#setchunk">setchunk</a> -- sets the number of sample frames computed for each <i>Instrument::run()</i> invocation
			<li><a href="Instrument.php#setendsamp">setendsamp</a> -- sets the (absolute) ending sample # (frame) for a note
		</ul>
	<li><a href="Obucket.php">Obucket</a> -- internally buffer samples or floating-point numbers
	<li><a href="Ortgetin.php">Ortgetin</a> -- read input samples from file or input device
	<li><a href="rtaddout.php">rtaddout</a> -- send samples to the output device or soundfile
	<li><a href="rtbaddout.php">rtbaddout</a> -- send an array of samples to the output device or soundfile
	<li><a href="rtgetin.php">rtgetin</a> -- get samples from the input device or soundfile
	<li><a href="rtinrepos.php">rtinrepos</a> -- reposition the input read pointer
	<li><a href="rtsetinput.php">rtsetinput</a> -- open and initialize a soundfile or input device for reading
	<li><a href="rtsetoutput.php">rtsetoutput</a> -- open and initialize the output device and/or soundfile for writing
	<li><a href="update.php">update</a> -- retrieve PField-handle or table-handle data
</ul>

<h2>Synthesis</h2>

<ul>
	<li><a href="Ooscil.php">Ooscil</a> -- non-interpolating wavetable oscillator object; also can be used for control envelopes
	<li><a href="Ooscil.php">Ooscili</a> -- interpolating wavetable oscillator object; also can be used for control envelopes
	<li><a href="oscil.php">oscil</a> -- wavetable oscillator
	<li><a href="oscil.php">oscili</a> -- interpolating wavetable oscillator
	<li><a href="oscil.php">osciln</a> -- wavetable oscillator (FM-compatible)
	<li><a href="oscil.php">oscilni</a> -- interpolating wavetable oscillator (FM-compatible)
	<li><a href="boscili.php">boscili</a> -- block-computing interpolating wavetable oscillator
	<li><a href="buzz.php">buzz</a> -- buzz (pulse) oscillator
	<li><a href="buzz.php">bbuzz</a> -- block-computing buzz (pulse) oscillator
	<li><a href="pluckset.php">pluckset</a> -- simple Karplus-Strong ("plucked string") initialization
	<li><a href="pluck.php">pluck</a> -- simple Karplus-Strong ("plucked string") filter/generator
	<li><a href="bpluck.php">bpluck</a> -- some sort of Karplus-Strong thing
	<li><a href="hpluck.php">hplset</a> -- Karplus-Strong ("plucked string") initialization
	<li><a href="hpluck.php">hpluck</a> -- Karplus-Strong ("plucked string") filter/generator
	<li><a href="wshape.php">wshape</a> -- waveshaping function
</ul>

<h2>Math/Data</h2>

<ul>
	<li><a href="ampdb.php">ampdb</a> -- convert decibels to amplitude
	<li><a href="ampdb.php">dbamp</a> -- convert amplitude to decibels
	<li><a href="ampdb.php">boost</a> -- convert amplitude in decibels to amplitude multiplier
</ul>

<h3>Pitch-specification Conversion Routines</h3>

<ul>
	<li><a href="ampdb.php">cpsoct</a> -- convert linear octaves to Hz
	<li><a href="ampdb.php">cpspch</a> -- convert octave.pitch-class to Hz
	<li><a href="midipch.php">midipch</a> -- convert Hz to midi note #
	<li><a href="ampdb.php">octcps</a> -- convert Hz to linear octaves
	<li><a href="ampdb.php">octpch</a> -- convert octave.pitch-class to linear octaves
	<li><a href="ampdb.php">pchcps</a> -- convert Hz to octave.pitch-class
	<li><a href="pchmidi.php">pchmidi</a> -- convert midi note # (byte) to frequency (Hz)
	<li><a href="ampdb.php">pchoct</a> -- convert linear octaves to octave.pitch-class
</ul>

<h3>Random-Number Routines</h3>

<ul>
	<li><a href="Orand.php">Orand</a> -- pseudo-random number generating object
	<li><a href="crandom.php">crandom</a> -- another psuedo-random number generator
	<li><a href="randf.php">randf</a> -- 1/f pseudo-random number generator(?)
	<li><a href="rrand.php">srrand</a> -- pseudo-random number generator seed/initialization
	<li><a href="rrand.php">rrand</a> -- pseudo-random number generator
	<li><a href="brrand.php">sbrrand</a> -- block-computed pseudo-random number generator seed/initialization
	<li><a href="brrand.php">brrand</a> -- block-computed pseudo-random number generator
</ul>

<h2>Function-table Slot Operations</h2>

<ul>
	<li><a href="floc.php">floc</a> -- return a pointer to a function table slot
	<li><a href="fsize.php">fsize</a> -- return the size of a function table slot array
	<li><a href="evp.php">evset</a> -- envelope/control function initialization
	<li><a href="evp.php">evp</a> -- envelope/control function generator
	<li><a href="install_gen.php">install_gen</a> -- install a function table slot from within an instrument
	<li><a href="combine_gens.php">combine_gens</a> -- combine function tabbles
	<li><a href="resample_gen.php">resample_gen</a> -- resample a function table
	<li><a href="setline.php">setline</a> -- create line-segment curve in an array
	<li><a href="table.php">tableset</a> -- initialize a function table slot for envelopes/control functions
	<li><a href="table.php">table</a> -- read from a function table slot for envelopes/control functions
	<li><a href="table.php">tablei</a> -- interpolated read from a function table slot for envelopes/control functions
</ul>

<h2>Filters</h2>

<ul>
	<li><a href="Ocomb.php">Ocomb</a> -- comb filter object
	<li><a href="Ocomb.php">Ocombi</a> -- interpolating comb filter object
	<li><a href="Odcblock.php">Odcblock</a> -- DC blocking filter object
	<li><a href="Oequalizer.php">Oequalizer</a> -- multi-purpose biquad filter object
	<li><a href="Oonepole.php">Oonepole</a> -- simple recursive one-pole filter object
	<li><a href="OonepoleTrack.php">OonepoleTrack</a> -- simple 'tracking' recursive one-pole filter object
	<li><a href="Oreson.php">Oreson</a> -- simple recursive bandpass filter object
	<li><a href="allpass.php">allpass</a> -- allpass filter
	<li><a href="allpole.php">allpole</a> -- allpole filter
	<li><a href="ballpole.php">ballpole</a> -- block-computing allpole filter
	<li><a href="reson.php">rsnset</a> -- two-pole FIR filter initialization
	<li><a href="reson.php">reson</a> -- simple two-pole FIR filter
	<li><a href="breson.php">breson</a> -- block-computed two-pole FIR filter
	<li><a href="bresonz.php">bresonz</a> -- block-computed two-pole FIR filter
	<li><a href="resonz.php">rszset</a> -- simple IIR filter initialization
	<li><a href="resonz.php">resonz</a> -- simple IIR filter
</ul>

<h2>Delays</h2>

<ul>
	<li><a href="Odelay.php">Odelay</a> -- delay line object
	<li><a href="Odelay.php">Odelayi</a> -- interpolating delay line object
	<li><a href="allpass.php">combset</a> -- comb filter setup function
	<li><a href="allpass.php">comb</a> -- comb filter
	<li><a href="hcomb.php">hcomb</a> -- interpolating comb filter
	<li><a href="delget.php">delset</a> -- initialize a delay line
	<li><a href="delget.php">delput</a> -- put a sample into a delay line
	<li><a href="delget.php">delget</a> -- get a sample from a delay line
	<li><a href="delget.php">dliget</a> -- get an interpolated sample from a delay line
	<li><a href="reverb.php">rvbset</a> -- initialize poor-quality reverb
	<li><a href="reverb.php">reverb</a> -- poor-quality reverb
</ul>

<h2>Other</h2>

<ul>
	<li><a href="Offt.php">Offt</a> -- FFT analysis object
</ul>

<h2>Disk-based (non-realtime) Functions</h2>

There are a number of older 'disk-only' sound synthesis and signal-processing functions that may be encountered in instrument design.  These were originally developed for the non-realtime <i>cmix</i> music programming language from which RTcmix was derived.  RTcmix actually encapsulates all of the earlier <i>cmix</i> code, so that these funcions that have not been ported to RTcmix still work.  We include documentation for these older disk-based functions mainly for those compelling "historical" reasons, because none of them will access the real-time audio stream of sound.
<p>
<ul>
	<li><a href="ADDOUT.php">ADDOUT</a> -- add samples to disk
	<li><a href="GETIN.php">GETIN</a> -- get samples from disk
	<li><a href="ADDOUT.php">LAYOUT</a> -- write samples selectively to disk
	<li><a href="ADDOUT.php">WIPEOUT</a> -- write samples destructively to disk
	<li><a href="bgetin.php">baddout</a> -- add a block of samples to disk
	<li><a href="bgetin.php">bgetin</a> -- get a block of samples from disk
	<li><a href="bgetin.php">blayout</a> -- write a block of samples selectively to disk
	<li><a href="bgetin.php">bwipeout</a> -- write a block of samples destructively to disk
	<li><a href="endnote.php">endnote</a> -- update file header statistics at end of note
	<li><a href="getsample.php">getsample</a> -- fetch arbitrary block of samples from soundfile
	<li><a href="getsample.php">getsetnote</a> -- set up for getsample()
	<li><a href="inrepos.php">inrepos</a> -- reposition the input file pointer
	<li><a href="inrepos.php">outrepos</a> -- reposition the output file pointer
	<li><a href="setnote.php">setnote</a> -- set up soundfile for reading/writing
</ul>

</span>

<span id="alphabetical" style="display:none;">

<table width="100%">
	<tr>
		<td valign="top">
			<ul>
				<li><a href="Obucket.php">Obucket</a>
				<li><a href="Ocomb.php">Ocomb</a>
				<li><a href="Ocomb.php">Ocombi</a>
				<li><a href="Odcblock.php">Odcblock</a>
				<li><a href="Odelay.php">Odelay</a>
				<li><a href="Odelay.php">Odelayi</a>
				<li><a href="Oequalizer.php">Oequalizer</a>
				<li><a href="Offt.php">Offt</a>
				<li><a href="Oonepole.php">Oonepole</a>
				<li><a href="OonepoleTrack.php">OonepoleTrack</a>
				<li><a href="Ooscil.php">Ooscil</a>
				<li><a href="Ooscil.php">Ooscili</a>
				<li><a href="Orand.php">Orand</a>
				<li><a href="Oreson.php">Oreson</a>
				<li><a href="Ortgetin.php">Ortgetin</a>
				<li><a href="allpass.php">allpass</a>
				<li><a href="allpole.php">allpole</a>
				<li><a href="ampdb.php">ampdb</a>
				<li><a href="ballpole.php">ballpole</a>
				<li><a href="buzz.php">bbuzz</a>
				<li><a href="ampdb.php">boost</a>
				<li><a href="boscili.php">boscili</a>
				<li><a href="bpluck.php">bpluck</a>
				<li><a href="breson.php">breson</a>
				<li><a href="bresonz.php">bresonz</a>
				<li><a href="brrand.php">brrand</a>
				<li><a href="buzz.php">buzz</a>
				<li><a href="allpass.php">comb</a>
				<li><a href="combine_gens.php">combine_gens</a>
				<li><a href="allpass.php">combset</a>
				<li><a href="ampdb.php">cpsoct</a>
				<li><a href="ampdb.php">cpspch</a>
				<li><a href="crandom.php">crandom</a>
			</ul>
		</td>

		<td valign="top">
			<ul>
				<li><a href="ampdb.php">dbamp</a>
				<li><a href="delget.php">delget</a>
				<li><a href="delget.php">delput</a>
				<li><a href="delget.php">delset</a>
				<li><a href="delget.php">dliget</a>
				<li><a href="evp.php">evp</a>
				<li><a href="evp.php">evset</a>
				<li><a href="floc.php">floc</a>
				<li><a href="fsize.php">fsize</a>
				<li><a href="hcomb.php">hcomb</a>
				<li><a href="hpluck.php">hpluck</a>
				<li><a href="hpluck.php">hplset</a>
				<li><a href="install_gen.php">install_gen</a>
				<li><a href="Instrument.php">Instrument</a>
				<li><a href="midipch.php">midipch</a>
				<li><a href="ampdb.php">octcps</a>
				<li><a href="ampdb.php">octpch</a>
				<li><a href="oscil.php">oscil</a>
				<li><a href="oscil.php">oscili</a>
				<li><a href="oscil.php">osciln</a>
				<li><a href="oscil.php">oscilni</a>
				<li><a href="ampdb.php">pchcps</a>
				<li><a href="pchmidi.php">pchmidi</a>
				<li><a href="ampdb.php">pchoct</a>
				<li><a href="pluck.php">pluck</a>
				<li><a href="pluckset.php">pluckset</a>
				<li><a href="randf.php">randf</a>
				<li><a href="resample_gen.php">resample_gen</a>
				<li><a href="reson.php">reson</a>
				<li><a href="resonz.php">resonz</a>
				<li><a href="reverb.php">reverb</a>
				<li><a href="rrand.php">rrand</a>
				<li><a href="reson.php">rsnset</a>
		</ul>
		</td>

		<td valign="top">
			<ul>
				<li><a href="resonz.php">rszset</a>
				<li><a href="rtaddout.php">rtaddout</a>
				<li><a href="rtbaddout.php">rtbaddout</a>
				<li><a href="rtgetin.php">rtgetin</a>
				<li><a href="rtinrepos.php">rtinrepos</a>
				<li><a href="rtsetinput.php">rtsetinput</a>
				<li><a href="rtsetoutput.php">rtsetoutput</a>
				<li><a href="reverb.php">rvbset</a>
				<li><a href="setline.php">setline</a>
				<li><a href="rrand.php">srrand</a>
				<li><a href="brrand.php">sbrrand</a>
				<li><a href="table.php">table</a>
				<li><a href="table.php">tablei</a>
				<li><a href="table.php">tableset</a>
				<li><a href="update.php">update</a>
				<li><a href="wshape.php">wshape</a>
			</ul>
				
			<i>older (disk-only) functions</i>
			
			<ul>
				<li><a href="ADDOUT.php">ADDOUT</a>
				<li><a href="GETIN.php">GETIN</a>
				<li><a href="ADDOUT.php">LAYOUT</a>
				<li><a href="ADDOUT.php">WIPEOUT</a>
				<li><a href="bgetin.php">baddout</a>
				<li><a href="bgetin.php">bgetin</a>
				<li><a href="bgetin.php">blayout</a>
				<li><a href="bgetin.php">bwipeout</a>
				<li><a href="endnote.php">endnote</a>
				<li><a href="getsample.php">getsample</a>
				<li><a href="getsample.php">getsetnote</a>
				<li><a href="inrepos.php">inrepos</a>
				<li><a href="inrepos.php">outrepos</a>
				<li><a href="setnote.php">setnote</a>					
			</ul>
		</td>
	</tr>
</table>
</span>

<br />
[note: There are quite a few lower-level cmix and RTcmix functions
that can be used within an instrument or an application.  The source code
for most of these is located in the "RTcmix/sys" or the "RTcmix/lib"
directories.  Take and use what you need!]


<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
