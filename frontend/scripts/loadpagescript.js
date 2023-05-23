function loadPage(pageUrl) {
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
	  if (xhr.readyState === 4 && xhr.status === 200) {
		document.getElementById("content").innerHTML = xhr.responseText;
		executeScripts();
	  }
	};
	xhr.open("GET", pageUrl, true);
	xhr.send();
  }
  
function executeScripts() {
var scripts = document.getElementById("content").getElementsByTagName("script");
for (var i = 0; i < scripts.length; i++) {
	eval(scripts[i].innerHTML);
}
}
  