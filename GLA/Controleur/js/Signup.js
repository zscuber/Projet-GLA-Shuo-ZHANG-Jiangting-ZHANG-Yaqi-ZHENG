(function(){
	
    var div = document.getElementsByTagName('div');
	var input = document.getElementsByTagName('input');
	var p = document.getElementsByTagName('p');
    var button = document.getElementsByTagName('button');
    
    var ok1,ok2,ok3,ok4 = false;

	var height = 5;
	var cpt = 0;

	cache();
	affichageMainpage();
   

    button[0].disabled = true;

	function cache(){
            for(var i = 0; i<4;i++){
                input[i].style.visibility = "hidden";
                p[i].style.visibility = "hidden";
            }
            //p[3].style.visibility = "hidden";
            button[0].style.visibility = "hidden";
            div[2].style.visibility = "hidden";
	}
	function affichageMainpage() {
        if (height < 480) {
            height = height + 20;
            div[1].style.height = height + "px";
        }
        cpt = cpt + 1;
        if(cpt == 22){
            for(var i = 0; i<4;i++){
                input[i].style.visibility = "visible";
                p[i].style.visibility = "visible";
            }
            //p[3].style.visibility = "visible";
            button[0].style.visibility = "visible";
            div[2].style.visibility = "visible";
        }
        timer1 = setTimeout(affichageMainpage, 20);
    }

    function checkok(){

        if(ok1 && ok2 && ok3 && ok4){
            button[0].disabled = false;
        }
    }

    input[0].onblur = function(){
         clearTimeout(timer1);
        if (input[0].value == ""){
            input[0].style.borderColor = "red";
            ok1 = false;
        }
        else {
            input[0].style.borderColor = "green";
            ok1 = true;
        }
        checkok();
    }

    input[1].onblur = function(){
        if (input[1].value == ""){
            input[1].style.borderColor = "red";
            ok4 = false;
        }
        else {
            input[1].style.borderColor = "green";
            ok4 = true;
        }
        checkok();
    }

    input[2].onblur = function(){
        if (input[2].value == ""){
            input[2].style.borderColor = "red";
            ok2 = false;
        }
        else if(input[3].value!=input[2].value && ok3){
            input[3].style.borderColor = "red";
            ok3 = false;
        }
        else {
            input[2].style.borderColor = "green";
            ok2 = true;
        }
        checkok();
    }

    input[3].onblur = function(){
        if (input[3].value == "" || input[3].value!=input[2].value){
            input[3].style.borderColor = "red";
            ok3 = false;
        }
        else {
            input[3].style.borderColor = "green";
            ok3 = true;
        }
        checkok();
    }

    input[0].onkeyup = function(){
        input[0].style.borderColor = "orange";
        if (input[0].value == ""){
            input[0].style.borderColor = "red";
            ok1 = false;
        }
        else{
            ok1 = true;
        }
        checkok();
    }
    input[1].onkeyup = function(){
        input[1].style.borderColor = "orange";
        if (input[1].value == ""){
            input[1].style.borderColor = "red";
            ok4 = false;
        }
        else{
            ok4 = true;
        }
        checkok();
    }

    input[2].onkeyup = function(){
        input[2].style.borderColor = "orange";
        if (input[2].value == ""){
            input[2].style.borderColor = "red";
            ok2 = false;
        }
        else if(input[2].value!=input[3].value && ok3){
           input[3].style.borderColor = "red";
           ok3 = false;
        }
        else if(input[2].value==input[3].value){
           input[3].style.borderColor = "green";
           ok3 = true;
        }
        else{
            ok2 = true;
        }
        checkok();
    }

    input[3].onkeyup = function(){
        if (input[2].value == input[3].value){
            input[3].style.borderColor = "green";
            ok3 = true; 
        }
        else{
            input[3].style.borderColor = "red";
            ok3 = false;
        }
        checkok();
    }

    input[3].onfocus = function(){
        if (input[2].value == input[3].value){
            input[3].style.borderColor = "green";
            ok3 = true; 
        }
        else{
            input[3].style.borderColor = "red";
            ok3 = false;
        }
        checkok();
    }

    button[1].onclick = function(){
        window.location.href="/GLA/Vue/Index.html";
    }

})()