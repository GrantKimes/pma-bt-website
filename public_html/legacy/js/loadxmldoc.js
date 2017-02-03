function loadXMLDoc(name)
{
	if (window.XMLHttpRequest)
		var xhttp = new XMLHttpRequest();
	else
		var xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	
	xhttp.open("GET",name,false);
	xhttp.send();
	return xhttp.responseXML;
}