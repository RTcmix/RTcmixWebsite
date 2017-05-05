function viewTopics() {
	document.getElementById('topic').style.display='block';
	document.getElementById('alphabetical').style.display='none';
	document.getElementById('topiclink').style.textDecoration='underline';
	document.getElementById('alphabeticallink').style.textDecoration='none';
}

function viewAlphabetical() {
	document.getElementById('topic').style.display='none';
	document.getElementById('alphabetical').style.display='block';
	document.getElementById('topiclink').style.textDecoration='none';
	document.getElementById('alphabeticallink').style.textDecoration='underline';	
}

function checkSort() {
	if (window.location.href.indexOf("alphabetical") > 1)
		viewAlphabetical();
	else
		viewTopics();
}

