<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>RTcmix - Tutorials - iRTcmix Project Setup</title>
	
	<link rel="stylesheet" type="text/css" href="/includes/style.css">
	
</head>
<body>
	
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/head.inc'); ?>

<h1>iRTcmix Xcode Project Setup Guide</h1>

After completing these steps to set up an Xcode Project, you'll have a blank Project that is ready to use the iRTcmix library. 

<ol>
	<li>Start <b>Xcode.app</b></li><br />

	<li>Select menu <b>File -> New -> Project</b></li><br />

	<li>Select <b>iOS Application</b> in the left column then select <b>Single View Application</b>; click <b>Next</b></li><br />

	<li>Give your project a <b>Product Name, Company Identifier</b> (com.yourcompany), <b>Device Family</b> (choose iPhone or iPad if you're just starting out), leave all checkboxes <b>unchecked</b>; click <b>Next</b></li><br />

	<li>Navigate to directory in which you wish to save your project and click Create</li><br />

	<li>Drag <b>libIRTCMIX.a</b> (in the <b>iRTcmix Library</b> folder of the iRTcmix distribution) from the <b>Finder</b> into the <b>Frameworks</b> group/folder of the <b>Project Navigator</b> pane in Xcode (on the left of the main project window)
		<ul>
			<li>check <b>Copy items into destination group's folder</b></li>
		</ul></li><br />

	<li>Drag <b>RTcmixPlayer.h, RTcmixPlayer.m, RTcmixScore.h</b> and <b>RTcmixScore.m</b> from the <b>Finder</b> into the <b>Project Navigator</b> pane in Xcode (wherever you want them)
		<ul>
			<li>check <b>Copy items into destination group's folder</b></li>
		</ul></li><br />

	<li>Select your <b>YourProjectName</b> in the Project Navigator (top item in the left column) then select <b>YourProjectName</b> under <b>Targets</b>
		<ul>
			<li>Choose the <b>Summary</b> tab</li>
			<li>Click the <b>+</b> in the <b>Linked Frameworks and Libraries</b> section (you may need to scroll down to see this heading)</li>
			<li>Select <b>AudioToolbox.framework</b></li>
		</ul></li><br />

	<li>Still in <b>YourProjectName</b> under <b>Targets</b>
		<ul>
			<li>Click the <b>Build Settings</b> tab</li>
			<li>Find <b>Other Linker Flags</b> (under the Linking heading, scroll down about 1/3)</li>
			<li>add <b>-lstdc++</b> to the field to the right of <b>Other Linker Flags</b></li>
			<br />
			<li>Click the <b>Build Phases</b> tab</li>
			<li>Drag <b>RTcmixPlayer.m</b> and <b>RTcmixScore.m</b> into the Compile Sources section (if they aren't already there)</li>
		</ul></li>
</ol>

<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/foot.inc'); ?>

