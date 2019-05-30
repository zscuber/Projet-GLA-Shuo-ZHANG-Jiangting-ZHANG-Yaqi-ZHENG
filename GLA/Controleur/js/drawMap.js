	var noms;
	var villes;
	var types;
	var touristiques;
	var latitudes;
	var longitudes;
	var ville;

createXMLDom();

function createXMLDom(){
	
	if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

	//xmlhttp.open("GET","../reseau_1000v-10000t-841r.xml",false);
	xmlhttp.open("GET","../reseau.xml",false);
    xmlhttp.send();
	//xmldoc.load("reseau.xml");
	xmlDoc=xmlhttp.responseXML;

	var root=xmlDoc.documentElement;
	ville="";
	noms=root.getElementsByTagName("nom");
	villes=root.getElementsByTagName("ville");
	types=root.getElementsByTagName("type");
	touristiques=root.getElementsByTagName("touristique");
	latitudes=root.getElementsByTagName("latitude");
	longitudes=root.getElementsByTagName("longitude");
for (var i=0;i<villes.length;i++){
	// ville+="nom:";
	// ville+=noms[i].firstChild.nodeValue;
	// ville+="type:";
	// ville+=types[i].firstChild.nodeValue;
	// ville+="touristique:";
	// ville+=touristiques[i].firstChild.nodeValue;
	ville+=" /latitude: ";
	ville+=latitudes[i].firstChild.nodeValue;
	ville+=" /longitude: ";
	ville+=longitudes[i].firstChild.nodeValue;
	// ville+=" ";
	}
}

var canvas = document.getElementById("drawboard");
    canvas.width = window.screen.width;
    canvas.height = window.screen.height;
var context = canvas.getContext("2d");

DrawMap(context);
console.log(canvas.width,canvas.height);
console.log(ville);

function DrawMap(cxt){
	cxt.font="20px Georgia";
    cxt.fillStyle="black";
	for (var i=0;i<villes.length;i++){
		var vx = latitudes[i].firstChild.nodeValue*100-2000;
		var vy = longitudes[i].firstChild.nodeValue*100-2500;
		// var vx = latitudes[i].firstChild.nodeValue*200-5000;
		// var vy = longitudes[i].firstChild.nodeValue*200-5000;
		cxt.font="10px Georgia";
      	cxt.fillStyle="black";
      	//cxt.fillText(noms[i].firstChild.nodeValue,vx,vy-3);
		cxt.fillRect(vx,vy,4,4);
		console.log("map: ",vx," y: ",vy);
	//cxt.moveTo(latitudes[i].firstChild.nodeValue,longitudes[i].firstChild.nodeValue);
	//cxt.lineTo(longueur,hauteur / 2);
	//cxt.lineWidth = 2;
	//cxt.closePath();
	//cxt.stroke();
	//cxt.restore();
	}
}
