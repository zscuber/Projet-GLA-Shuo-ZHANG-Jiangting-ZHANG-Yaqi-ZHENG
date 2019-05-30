(function(){
	var div = document.getElementsByTagName('div');
	var input = document.getElementsByTagName('input');
	var p = document.getElementsByTagName('p');
	var button = document.getElementsByTagName('button');

	var height = 5;
	var cpt = 0;
	cache();
	affichageMainpage();

	function cache(){
            for(var i = 0; i<4;i++){
                input[i].style.visibility = "hidden";
                //input[i].disabled=true;
                p[i].style.visibility = "hidden";
            }
            p[4].style.visibility = "hidden";
            button[0].style.visibility = "hidden";
            button[1].style.visibility = "hidden";
            div[2].style.visibility = "hidden";
	}
	function affichageMainpage() {
        if (height < 500) {
            height = height + 20;
            div[1].style.height = height + "px";
        }
        cpt = cpt + 1;
        if(cpt == 22){
            for(var i = 0; i<4;i++){
                input[i].style.visibility = "visible";
                p[i].style.visibility = "visible";
            }
            p[4].style.visibility = "visible";
            button[0].style.visibility = "visible";
            button[1].style.visibility = "visible";
            div[2].style.visibility = "visible";
        }
        timer1 = setTimeout(affichageMainpage, 20);
    }
	button[1].onclick = function(){
        window.location.href="/GLA/Vue/index.html";
    }
})()