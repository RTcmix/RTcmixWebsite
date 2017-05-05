<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - iRTcmix</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>iRTcmix</h1>

iRTcmix enables iOS developers to easily incorporate interactive sound into their iPhone, iPad and iPod Touch apps. The library includes the compiled RTcmix object and Objective-C classes for communicating with the RTcmix audio engine and for interacting with Minc scores. iRTcmix greatly simplifies the process of adding audio to iOS apps; start making noise with just a few lines of code!
<p>
Documentation is available in the <a href="/tutorials/">Tutorials</a> and <a href="/reference/">Reference</a> sections. If you have any questions, the <a href="http://music.columbia.edu/mailman/listinfo/rtcmix-discuss">RTcmix discussion list</a> will be able to help you out.

<h2>Library</h2>

Download: <a href="/irtcmix/downloads/iRTcmix%20Library%2013.10.08.zip">iRTcmix Library 13.10.08.zip</a>
<p>
The iRTcmix Library zip file includes the compiled RTcmix library plus helper classes that you'll need to include in your project. Step-by-step instructions for setting up an Xcode project that is ready to use with RTcmix are included (<a href="/tutorials/irtcmix/projectsetup.php">available online</a> as well).

<h2>Demo Projects</h2>

<h3>iRTcmix Basics</h3>

Download iRTcmix Basics: <a href="/irtcmix/downloads/iRTcmix%20Basics%2013.11.12.zip">iRTcmix Basics 13.11.12.zip</a>  (updated for iOS 7)
<p>
The iRTcmix Demos zip file contains six Xcode projects, each demonstrating a single feature of the iRTcmix Library. Everything one can do with the library is described in one of the six demos.
<p>
Note that these demos are not meant to teach RTcmix and the Minc scorefile parser. These projects demonstrate how to integrate RTcmix into your iOS apps. For more information on using RTcmix and the Minc scorefile parser, see the <a href="/tutorials/">Tutorials</a> and <a href="/reference/">Reference</a> sections.

<p>
The following demos are included:

<ul>
	<li><b>Hello iRTcmix</b> - The bare minimum iRTcmix app; it goes "beep" (and pling pling pling).</li>
	<li><b>User Interface</b> - Enable UI elements in your app to control RTcmix.</li>
	<li><b>Audio Files</b> - Play audio files from "disk" or from memory. </li>
	<li><b>Audio Input</b> - Process audio input from the built in microphone or an audio interface.</li>
	<li><b>Messages</b> - Methods to communicate from your RTcmix scores back to your app.</li>
	<li><b>Settings</b> - How to set up Audio input, background audio, and vector size.</li>
</ul>

There is a <a href="/tutorials/irtcmix/helloirtcmix.php">tutorial walk-through available for Hello iRTcmix</a> to helop get you started.

<h3>iRTcmix Lab</h3>

Download iRTcmix Lab: <a href="/irtcmix/downloads/iRTcmix%20Lab%2013.06.26.zip">iRTcmix Lab 13.06.26.zip</a> (iOS 7 update coming soon)
<p>
iRTcmix Lab is essentially all the "iRTcmix Basics" apps rolled into one. Useful for reference once you get the hang of things.


<h2>Apps Made with iRTcmix</h2>

<b>iLooch</b><br />
by Brad Garton
<p>
iLooch is an iPhone/iPod-touch application designed to generate evolving ambient sounds. The music is not "sampled"; it is instead created by generative and algorithmic rule-sets coupled with various synthesis techniques. They'll go on forever and ever! (well, at least for a few hours...) Because the music is being constructed on-the-fly, each time it plays it will be slightly different. Such is life.
<p>
	<a href="http://music.columbia.edu/~brad/ilooch/">more info</a> &nbsp;&middot;&nbsp; <a href="http://itunes.apple.com/us/app/ilooch/id379528794?mt=8">download iLooch from the App Store</a>
<p>

<b>iMonkeypants</b><br />
by Ryan Carter
<p>
iMonkeypants is an album of algorithmically generated, listener-interactive electronica in the form of an iPhone app. The music responds in real time to the position of the device, giving the listener control over certain aspects of the sound while it plays.
<p>
	<a href="http://www.ryancarter.org/imonkeypants.html">more info</a> &nbsp;&middot;&nbsp; <a href="http://itunes.apple.com/us/app/imonkeypants/id547532522?mt=8">download iMonkeypants from the App Store</a>








<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>
