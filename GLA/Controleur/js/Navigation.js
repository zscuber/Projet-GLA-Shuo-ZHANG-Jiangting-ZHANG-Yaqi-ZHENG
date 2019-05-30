(function(){
    
	var button = document.getElementsByTagName('button');
	var label = $('p');
	var information = label[2];

	var user = $('#user').text(); 

	var tabDepart = new Array();
	var tabDest = new Array();
	var tabTour = new Array();
	var tabTime = new Array();
	var tabDistance = new Array();
	var temps,distance;

	var step=1;

	var filename = '/GLA/Controleur/Trajet/'+user+'trajetFinal.json';
	console.log(user);
	function getData(){
	$.ajaxSettings.async = false;
	$.getJSON(filename,function(data){ 
		$.each(data,function(infoIndex,info){
			if(info['depart']!==undefined){
				tabDepart.push(info['depart']);
			}
			if(info['destination']!==undefined){
				tabDest.push(info['destination']);
			}
			if(info['touristique']!==undefined){
				tabTour.push(info['touristique']);
			}
			if(info['temps']!==undefined){
				tabTime.push(info['temps']);
			}
			if(info['distance']!==undefined){
				tabDistance.push(info['distance']);
			}
			temps=info['temps'];
			distance=info['distance'];

		});
	});
	//$.ajaxSettings.async = true;
	}
	console.log(information);
	getData();
	// for(var i=0;i<tabDepart.length;i++){
	// 	console.log(tabDepart[i]);
	// }
	// for(var i=0;i<tabDest.length;i++){
		
	// 	console.log(tabDest[i]);
	// }
	function init(){
		label[4].innerText=tabDepart[0];
		label[6].innerText=tabDest[0];
		label[8].innerText=tabTour[0];
		information.innerText="Remaining distance: "+distance+" km."+" Remaining time: "+temps.toFixed(1)+" h.";
	}
	init();
	

	button[0].onclick = function(){
		if(step<tabDepart.length){
			label[4].innerText=tabDepart[step];
			label[6].innerText=tabDest[step];
			label[8].innerText=tabTour[step];
			var distancerest=distance-tabDistance[step-1];
			var tempsrest=temps-tabTime[step-1];
			information.innerText="Remaining distance: "+distancerest+" km./n"+" Remaining time: "+tempsrest.toFixed(1)+" h.";
		step++;
		}
		else{
			label[4].innerText=tabDest[step-1];
			label[6].innerText="Nothing";
			label[8].innerText=tabTour[step-1];
			information.innerText="You arrievd your destination!"
		}
	}

	button[1].onclick = function(){
        window.location.href="/GLA/Vue/html/AccueilCon.php";
    }
})()