<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Reference - Instruments</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>Instruments Reference</h1>

An RTcmix instrument is a scorefile or interface-object command that will create or process sound. When an RTcmix instrument is called, it instantiates a unique copy of itself with the parameters for the specific 'note' (starting time, duration, etc.) included.  This instrument/note object is then scheduled for execution at the appropriate starting time.

<p>

<script type="text/javascript" src="/includes/sort.js"></script>
<script type="text/javascript">window.onload = checkSort;</script>

<b>Arrange by: <a href="#sort_topic" id="topiclink" onclick="viewTopics(); return true;" class="sort">Topic</a> 
													&nbsp;&middot;&nbsp; 
					<a href="#sort_alphabetical" id="alphabeticallink" onclick="viewAlphabetical(); return true;" class="sort">Alphabetical</a></b>
</p>

<span id="topic" style="display:block">

<h2>Synthesis</h2>


<ul>
	<li><a href="AMINST.php">AMINST</a> -- amplitude modulator (synthesis)
	<li><a href="BROWN.php">BROWN</a> -- brown noise instrument
	<li><a href="CRACKLE.php">CRACKLE</a> -- chaotic noise generator
	<li><a href="DUST.php">DUST</a> -- random impulses
	<li><a href="FMINST.php">FMINST</a> -- frequency modulator (synthesis)
	<li><a href="GRANSYNTH.php">GRANSYNTH</a> -- granular synthesis
	<li><a href="HALFWAVE.php">HALFWAVE</a> -- constructed wavetable (synthesis)
	<li><a href="HENON.php">HENON</a> -- Henon map noise generator
	<li><a href="JGRAN.php">JGRAN</a> -- granular synthesis
	<li><a href="LATOOCARFIAN.php">LATOOCARFIAN</a> -- chaotic noise generator
	<li><a href="LPCPLAY.php">LPCPLAY</a> -- Linear Predective Coding (LPC) resynthesis
	<li><a href="MULTIFM.php">MULTIFM</a> -- configurable multi-oscillator FM synthesis instrument
	<li><a href="MULTIWAVE.php">MULTIWAVE</a> -- additive synthesis
	<li><a href="NOISE.php">NOISE</a> -- make noise
	<li><a href="PINK.php">PINK</a> -- pink noise instrument
	<li><a href="SCULPT.php">SCULPT</a> -- frequency/amplitude pair-based resynthesis
	<li><a href="SGRANR.php">SGRANR</a> -- stochastic granular synthesis
	<li><a href="SYNC.php">SYNC</a> -- 'hard' sync oscillator synthesis instrument
	<li><a href="VWAVE.php">VWAVE</a> -- 'vector' wavetable synthesis
	<li><a href="WAVETABLE.php">WAVETABLE</a> -- wavetable oscillator
	<li><a href="WAVESHAPE.php">WAVESHAPE</a> -- waveshaping synthesis
	<li><a href="WAVY.php">WAVY</a> -- 2-oscillator modulating synthesis
	<li><a href="WIGGLE.php">WIGGLE</a> -- wavetable oscillator with frequency modulation and filter
</ul>

<h2>Physical Models</h2>

<ul>
	<li><a href="CLAR.php">CLAR</a> -- early clarinet physical model
	<li><a href="MBANDEDWG.php">MBANDEDWG</a> -- banded waveguide (bars/modal things, struck & bowed) physical model
	<li><a href="MBLOWBOTL.php">MBLOWBOTL</a> -- simple Helmholtz resonator physical model
	<li><a href="MBLOWHOLE.php">MBLOWHOLE</a> -- clarinet physical model with tonehole and register vent
	<li><a href="MBOWED.php">MBOWED</a> -- bowed string physical model
	<li><a href="MBRASS.php">MBRASS</a> -- brass instrument physical model
	<li><a href="MCLAR.php">MCLAR</a> -- another clarinet physical model
	<li><a href="METAFLUTE.php">METAFLUTE</a> -- early, extended flute physical model
		<ul>
			<li><a href="METAFLUTE.php#SFLUTE"><i>SFLUTE</i></a> -- basic flute model
			<li><a href="METAFLUTE.php#VSFLUTE"><i>VSFLUTE</i></a> -- basic flute model with vibrato
			<li><a href="METAFLUTE.php#BSFLUTE"><i>BSFLUTE</i></a> -- basic flute model with pitch-bend
			<li><a href="METAFLUTE.php#LSFLUTE"><i>LSFLUTE</i></a> -- basic flute model for legato slurs
		</ul>
	<li><a href="MMESH2D.php">MMESH2D</a> -- waveguide model of a 2D mesh
	<li><a href="MMODALBAR.php">MMODALBAR</a> -- physical model of struck bars
	<li><a href="MSAXOFONY.php">MSAXOFONY</a> -- saxophone physical model
	<li><a href="MSHAKERS.php">MSHAKERS</a> -- "shaken" instrument physical models
	<li><a href="MSITAR.php">MSITAR</a> -- sitar physical model
	<li><a href="STRUM.php">STRUM</a> -- extended Karplus-Strong ("plucked string") algorithm, with distortion and feedback
		<ul>
			<li><a href="STRUM.php#START"><i>START</i></a> -- basic model
			<li><a href="STRUM.php#BEND"><i>BEND</i></a> -- basic model with pitch bend
			<li><a href="STRUM.php#FRET"><i>FRET</i></a> -- basic model fretted from previous note
			<li><a href="STRUM.php#START1"><i>START1</i></a> -- feedback/distortion model
			<li><a href="STRUM.php#BEND1"><i>BEND1</i></a> -- feedback/distortion model with pitch bend
			<li><a href="STRUM.php#FRET1"><i>FRET1</i></a> -- feedback/distortion model fretted from previous note
			<li><a href="STRUM.php#VSTART1"><i>VSTART1</i></a> -- feedback/distortion model with vibrato
			<li><a href="STRUM.php#VFRET1"><i>VFRET1</i></a> -- feedback/distortion model fretted from previous note, with vibrato
		</ul>
	<li><a href="STRUM2.php">STRUM2</a> -- tuned Karplus-Strong ("plucked string") algorithm
	<li><a href="STRUMFB.php">STRUMFB</a> -- extended Karplus-Strong ("plucked string") algorithm, with distortion and feedback
</ul>


<h2>Modulators</h2>

<ul>
	<li><a href="AM.php">AM</a> -- amplitude modulator (signal-processor)
	<li><a href="COMPLIMIT.php">COMPLIMIT</a> -- audio compressor/limiter
	<li><a href="DECIMATE.php">DECIMATE</a> -- reduce bit-representation of input sound amplitude
	<li><a href="DISTORT.php">DISTORT</a> -- distortion (clip) signal-procesor 
	<li><a href="MOCKBEND.php">MOCKBEND</a> -- real-time pitch-shifter with dynamic modification of pitch
	<li><a href="SCRUB.php">SCRUB</a> -- fowards/backwards pitch shifter
	<li><a href="SHAPE.php">SHAPE</a> -- waveshape an input sound
	<li><a href="STGRANR.php">STGRANR</a> -- sampling stochastic granular processing
	<li><a href="TRANS.php">TRANS</a> -- pitch-shifter
	<li><a href="TRANS3.php">TRANS3</a> -- pitch-shifter (3rd-order interpolation)
	<li><a href="TRANSBEND.php">TRANSBEND</a> -- pitch-shifter with dynamic modification of pitch
</ul>

<h2>Filters</h2>

<ul>
	<li><a href="BUTTER.php">BUTTER</a> -- time-varying Butterworth filter (high- or low-pass)
	<li><a href="DCBLOCK.php">DCBLOCK</a> -- remove (most of) DC bias from input signal
	<li><a href="ELL.php">ELL</a> -- elliptical filter
	<li><a href="EQ.php">EQ</a> -- equalizer instrument (peak/notch, shelving and high/low pass types)
	<li><a href="FIR.php">FIR</a> -- finite impulse response filter
	<li><a href="FILTERBANK.php">FILTERBANK</a> --multi-band reson instrument (with dynamic control)
	<li><a href="FILTSWEEP.php">FILTSWEEP</a> -- time-varying biquad filter (band-pass)
	<li><a href="FOLLOWBUTTER.php">FOLLOWBUTTER</a> -- envelope (amplitude) follower controlling a Butterworth filter
	<li><a href="HOLO.php">HOLO</a> -- stereo FIR filter to perform crosstalk cancellation
	<li><a href="IIR.php">IIR</a> -- infinite impulse response filter
		<ul>
			<li><a href="IIR.php#setup"><i>setup</i></a> -- set up the IIR filter
			<li><a href="IIR.php#INPUTSIG"><i>INPUTSIG</i></a> -- filter an input signal
			<li><a href="IIR.php#IINOISE"><i>IINOISE</i></a> -- generate and filter noise
			<li><a href="IIR.php#BUZZ"><i>BUZZ</i></a> -- generate and filter a buzz signal
			<li><a href="IIR.php#PULSE"><i>PULSE</i></a> -- generate and filter a pulse signal
		</ul>
	<li><a href="JFIR.php">JFIR</a> -- finite impulse response filter specified by frequency curve
	<li><a href="LPCPLAY.php">LPCIN</a> -- Linear Predective Coding (LPC) resynthesis, using input sound through the LPC filters
	<li><a href="MOOGVCF.php">MOOGVCF</a> -- dynamic resonant low-pass filter
	<li><a href="MULTEQ.php">MULTEQ</a> -- equalizer instrument with dynamic filter sections
</ul>


<h2>Delays</h2>

<ul>
	<li><a href="COMBIT.php">COMBIT</a> -- comb filter
	<li><a href="DEL1.php">DEL1</a> -- single stereo delay
	<li><a href="DELAY.php">DELAY</a> -- simple regenerating delay
	<li><a href="DMOVE.php">DMOVE</a> -- high-quality room simulation program for moving sources with dynamic control (multiple inputs)
	<li><a href="FLANGE.php">FLANGE</a> -- notch or comb "flange" filter
	<li><a href="FREEVERB.php">FREEVERB</a> -- good-sounding reverbator
	<li><a href="GVERB.php">GVERB</a> -- good-sounding reverberator with long reverb times
	<li><a href="JDELAY.php">JDELAY</a> -- regenerating delay + low-pass filter
	<li><a href="MMOVE.php">MMOVE</a> -- high-quality room simulation program for moving sources (multiple inputs)
	<li><a href="MPLACE.php">MPLACE</a> -- high-quality room simulation program for stationary sources (multiple inputs)
	<li><a href="MOVE.php">MOVE</a> -- high-quality room simulation program for moving sources
	<li><a href="MROOM.php">MROOM</a> -- room simulation program for moving sources
	<li><a href="MULTICOMB.php">MULTICOMB</a> -- four comb filters simultaneously
	<li><a href="PANECHO.php">PANECHO</a> -- stereo "ping-pong" regenerating delays
	<li><a href="PLACE.php">PLACE</a> -- high-quality room simulation program for stationary sources
	<li><a href="REV.php">REV</a> -- three different reverberation algorithms
	<li><a href="REVERBIT.php">REVERBIT</a> -- Schroeder reverb
	<li><a href="ROOM.php">ROOM</a> -- delay line room-simulation model
	<li><a href="SROOM.php">SROOM</a> -- room simulation for stationary sources
</ul>

<h2>FFT-based</h2>

<ul>
	<li><a href="CONVOLVE1.php">CONVOLVE1</a> -- FFT convolution
	<li><a href="PVOC.php">PVOC</a> -- phase vocoder
	<li><a href="SPECTACLE.php">SPECTACLE</a> -- FFT-based delay
	<li><a href="SPECTACLE2.php">SPECTACLE2</a> -- FFT-based delay (more real-time control)
	<li><a href="SPECTEQ.php">SPECTEQ</a> -- FFT-based EQ
	<li><a href="SPECTEQ2.php">SPECTEQ2</a> -- FFT-based EQ (more real-time control)
	<li><a href="TVSPECTACLE.php">TVSPECTACLE</a> -- FFT-based delay with time-varying properties
	<li><a href="VOCODE2.php">VOCODE2</a> -- phase vocoder
	<li><a href="VOCODE3.php">VOCODE3</a> -- phase vocoder
	<li><a href="VOCODESYNTH.php">VOCODESYNTH</a> -- phase vocoder w/ oscillator-bank resynthesis
</ul>
	

<h2>Miscellaneous</h2>

<ul>
	<li><a href="CHAIN.php">CHAIN</a> -- group instruments
	<li><a href="DUMP.php">DUMP</a> -- print control ('handle') data
	<li><a href="FOLLOWER.php">FOLLOWER</a> -- simple envelope (amplitude) follower
	<li><a href="FOLLOWGATE.php">FOLLOWGATE</a> -- envelope (amplitude) follower controlling an amplitude gate
	<li><a href="GRANULATE.php">GRANULATE</a> -- granularize an input soundfile table 
	<li><a href="JCHOR.php">JCHOR</a> -- granulated, random-wait chorus (signal-processor)
	<li><a href="MAXBANG.php">MAXBANG</a> -- utility to generate a 'bang' in <a href="http://rtcmix.org/rtcmix~/">rtcmix~</a> or <a href="http://rtcmix.org/iRTcmix/">iRTcmix</a>
	<li><a href="MAXMESSAGE.php">MAXMESSAGE</a> -- utility to send a list of values, used in <a href="http://rtcmix.org/rtcmix~/">rtcmix~></a> or <a href="http://rtcmix.org/iRTcmix/">iRTcmix</a>
	<li><a href="MIX.php">MIX</a> -- simple soundfile mixing command
	<li><a href="NPAN.php">NPAN</a> -- multichannel panning
	<li><a href="PAN.php">PAN</a> -- stereo panning
	<li><a href="PFSCHED.php">PFSCHED</a> -- schedule (real-time) pfield events
	<li><a href="QPAN.php">QPAN</a> -- 4-channel panning
	<li><a href="REVMIX.php">REVMIX</a> -- reverse input soundfile
	<li><a href="SPLITTER.php">SPLITTER</a> -- output routing
	<li><a href="STEREO.php">STEREO</a> -- stereo mixing
</ul>

</span>

<span id="alphabetical" style="display:none;">
	
<table width="100%">
	<tr>
		<td valign="top">
			<ul>
				<li><a href="AM.php">AM</a>
				<li><a href="AMINST.php">AMINST</a>
				<li><a href="BROWN.php">BROWN</a>
				<li><a href="BUTTER.php">BUTTER</a>
				<li><a href="CHAIN.php">CHAIN</a>
				<li><a href="CLAR.php">CLAR</a>
				<li><a href="COMBIT.php">COMBIT</a>
				<li><a href="COMPLIMIT.php">COMPLIMIT</a>
				<li><a href="CONVOLVE1.php">CONVOLVE1</a>
				<li><a href="CRACKLE.php">CRACKLE</a>
				<li><a href="DCBLOCK.php">DCBLOCK</a>
				<li><a href="DECIMATE.php">DECIMATE</a>
				<li><a href="DEL1.php">DEL1</a>
				<li><a href="DELAY.php">DELAY</a>
				<li><a href="DISTORT.php">DISTORT</a>
				<li><a href="DMOVE.php">DMOVE</a>
				<li><a href="DUMP.php">DUMP</a>
				<li><a href="DUST.php">DUST</a>
				<li><a href="ELL.php">ELL</a>
				<li><a href="EQ.php">EQ</a>
				<li><a href="FIR.php">FIR</a>
				<li><a href="FILTERBANK.php">FILTERBANK</a>
				<li><a href="FILTSWEEP.php">FILTSWEEP</a>
				<li><a href="FMINST.php">FMINST</a>
				<li><a href="FLANGE.php">FLANGE</a>
				<li><a href="FOLLOWER.php">FOLLOWER</a>
				<li><a href="FOLLOWBUTTER.php">FOLLOWBUTTER</a>
				<li><a href="FOLLOWGATE.php">FOLLOWGATE</a>
				<li><a href="FREEVERB.php">FREEVERB</a>
				<li><a href="GRANSYNTH.php">GRANSYNTH</a>
				<li><a href="GRANULATE.php">GRANULATE</a>
				<li><a href="GVERB.php">GVERB</a>
				<li><a href="HALFWAVE.php">HALFWAVE</a>
				<li><a href="HENON.php">HENON</a>
				<li><a href="HOLO.php">HOLO</a>
				<li><a href="IIR.php">IIR</a>
					<ul>
						<li><a href="IIR.php#setup"><i>setup</i></a>
						<li><a href="IIR.php#INPUTSIG"><i>INPUTSIG</i></a>
						<li><a href="IIR.php#IINOISE"><i>IINOISE</i></a>
						<li><a href="IIR.php#BUZZ"><i>BUZZ</i></a>
						<li><a href="IIR.php#PULSE"><i>PULSE</i></a>
					</ul>
				<li><a href="JCHOR.php">JCHOR</a>
				<li><a href="JDELAY.php">JDELAY</a>
				<li><a href="JFIR.php">JFIR</a>
			</ul>
		</td>

		<td valign="top">
			<ul>
				<li><a href="JGRAN.php">JGRAN</a>
				<li><a href="LATOOCARFIAN.php">LATOOCARFIAN</a>
				<li><a href="LPCPLAY.php">LPCPLAY</a>
				<li><a href="LPCPLAY.php">LPCIN</a>
				<li><a href="MAXBANG.php">MAXBANG</a>
				<li><a href="MAXMESSAGE.php">MAXMESSAGE</a>
				<li><a href="MBANDEDWG.php">MBANDEDWG</a>
				<li><a href="MBLOWBOTL.php">MBLOWBOTL</a>
				<li><a href="MBLOWHOLE.php">MBLOWHOLE</a>
				<li><a href="MBOWED.php">MBOWED</a>
				<li><a href="MBRASS.php">MBRASS</a>
				<li><a href="MCLAR.php">MCLAR</a>
				<li><a href="METAFLUTE.php">METAFLUTE</a>
					<ul>
						<li><a href="METAFLUTE.php#SFLUTE"><i>SFLUTE</i></a>
						<li><a href="METAFLUTE.php#VSFLUTE"><i>VSFLUTE</i></a>
						<li><a href="METAFLUTE.php#BSFLUTE"><i>BSFLUTE</i></a>
						<li><a href="METAFLUTE.php#LSFLUTE"><i>LSFLUTE</i></a>
					</ul>
				<li><a href="MIX.php">MIX</a>
				<li><a href="MMESH2D.php">MMESH2D</a>
				<li><a href="MMODALBAR.php">MMODALBAR</a>
				<li><a href="MMOVE.php">MMOVE</a>
				<li><a href="MPLACE.php">MPLACE</a>
				<li><a href="MOCKBEND.php">MOCKBEND</a>
				<li><a href="MOOGVCF.php">MOOGVCF</a>
				<li><a href="MOVE.php">MOVE</a>
				<li><a href="MROOM.php">MROOM</a>
				<li><a href="MSAXOFONY.php">MSAXOFONY</a>
				<li><a href="MSHAKERS.php">MSHAKERS</a>
				<li><a href="MSITAR.php">MSITAR</a>
				<li><a href="MULTICOMB.php">MULTICOMB</a>
				<li><a href="MULTEQ.php">MULTEQ</a>
				<li><a href="MULTIFM.php">MULTIFM</a>
				<li><a href="MULTIWAVE.php">MULTIWAVE</a>
				<li><a href="NOISE.php">NOISE</a>
				<li><a href="NPAN.php">NPAN</a>
				<li><a href="PAN.php">PAN</a>
				<li><a href="PANECHO.php">PANECHO</a>
				<li><a href="PINK.php">PINK</a>
				<li><a href="PFSCHED.php">PFSCHED</a>
				<li><a href="PLACE.php">PLACE</a>
				<li><a href="PVOC.php">PVOC</a>
				<li><a href="QPAN.php">QPAN</a>
				<li><a href="REV.php">REV</a>
			</ul>
		</td>

		<td valign="top">
			<ul>
				<li><a href="REVERBIT.php">REVERBIT</a>
				<li><a href="REVMIX.php">REVMIX</a>
				<li><a href="ROOM.php">ROOM</a>
				<li><a href="SCRUB.php">SCRUB</a>
				<li><a href="SCULPT.php">SCULPT</a>
				<li><a href="SGRANR.php">SGRANR</a>
				<li><a href="SHAPE.php">SHAPE</a>
				<li><a href="SPECTACLE.php">SPECTACLE</a>
				<li><a href="SPECTACLE2.php">SPECTACLE2</a>
				<li><a href="SPECTEQ.php">SPECTEQ</a>
				<li><a href="SPECTEQ2.php">SPECTEQ2</a>
				<li><a href="SPLITTER.php">SPLITTER</a>
				<li><a href="SROOM.php">SROOM</a>
				<li><a href="STEREO.php">STEREO</a>
				<li><a href="STGRANR.php">STGRANR</a>
				<li><a href="STRUM.php">STRUM</a>
					<ul>
						<li><a href="STRUM.php#START"><i>START</i></a>
						<li><a href="STRUM.php#BEND"><i>BEND</i></a>
						<li><a href="STRUM.php#FRET"><i>FRET</i></a>
						<li><a href="STRUM.php#START1"><i>START1</i></a>
						<li><a href="STRUM.php#BEND1"><i>BEND1</i></a>
						<li><a href="STRUM.php#FRET1"><i>FRET1</i></a>
						<li><a href="STRUM.php#VSTART1"><i>VSTART1</i></a>
						<li><a href="STRUM.php#VFRET1"><i>VFRET1</i></a>
					</ul>
				<li><a href="STRUM2.php">STRUM2</a>
				<li><a href="STRUMFB.php">STRUMFB</a>
				<li><a href="SYNC.php">SYNC</a>
				<li><a href="TRANS.php">TRANS</a>
				<li><a href="TRANS3.php">TRANS3</a>
				<li><a href="TRANSBEND.php">TRANSBEND</a>
				<li><a href="TVSPECTACLE.php">TVSPECTACLE</a>
				<li><a href="VOCODE2.php">VOCODE2</a>
				<li><a href="VOCODE3.php">VOCODE3</a>
				<li><a href="VOCODESYNTH.php">VOCODESYNTH</a>
				<li><a href="VWAVE.php">VWAVE</a>
				<li><a href="WAVETABLE.php">WAVETABLE</a>
				<li><a href="WAVESHAPE.php">WAVESHAPE</a>
				<li><a href="WAVY.php">WAVY</a>
				<li><a href="WIGGLE.php">WIGGLE</a>
			</ul>
		</td>
	</tr>
</table>
</span>




<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
