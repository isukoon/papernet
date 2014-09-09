// JavaScript Document

var SERVER_URL = "http://localhost/papernet/admin/";

function loadMenu(){
	var urlString = SERVER_URL+"common.logic.php?chksql=loadMenu";
	//alert(urlString);
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() 
	{
		if (http.readyState == 4)
		{
			if (http.status == 200) 
			{
				//alert(http.responseText);
				document.getElementById("menu_div").innerHTML = http.responseText;
			} 
			else
			{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null);
}

function loadNewMenu(){
	//alert("test");
	var urlString = SERVER_URL+"common.logic.php?chksql=loadNewMenu";
	//alert(urlString);
	var http = getHTTPObject();
	http.open("POST", urlString , true);
	http.onreadystatechange = function() 
	{
		if (http.readyState == 4)
		{
			if (http.status == 200) 
			{
				//alert(http.responseText);
				document.getElementById("menu_div").innerHTML = http.responseText;
				createcssmenu();
			} 
			else
			{
				alert("Error Occured : " + http.statusText);
			}
		}
	}
	http.send(null);
}

function showEbeesContact(){
	inlineMsg('powerdBy','<strong>Contact Us</strong><br />eBees Technology Solutions<br />Rasanka<br />0777265341',10);
}