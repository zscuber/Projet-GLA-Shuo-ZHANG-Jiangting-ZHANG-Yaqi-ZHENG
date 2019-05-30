(function() {
  var input=document.getElementsByTagName("input");
  var p = document.getElementsByTagName('p');
  var div = document.getElementsByTagName('div');
  var button = document.getElementsByTagName("button");
  var a = document.getElementById('a');

  var height = 5;
  var cpt = 0;

  cache();
  affichageMainpage();

  button[1].onclick=function(){
    window.location.href="../Vue/html/Signup.html";
  }

  button[2].onclick=function(){
    window.location.href="/GLA/Vue/html/AccueilNoCon.php";
  }
  function cache(){
    for(var i = 0; i<4;i++){
        
        p[i].style.visibility = "hidden";
    }
    input[0].style.visibility = "hidden";
    input[1].style.visibility = "hidden";
    button[0].style.visibility = "hidden";
    button[1].style.visibility = "hidden";
    button[2].style.visibility = "hidden";
    a.style.visibility = "hidden";
    div[2].style.visibility="hidden";
  }

  function affichageMainpage() {
    if (height < 450) {
        height = height + 20;
        div[1].style.height = height + "px";
    }
    cpt = cpt + 1;
    if(cpt == 22){
        for(var i = 0; i<4;i++){
            
            p[i].style.visibility = "visible";
        }
        input[0].style.visibility = "visible";
        input[1].style.visibility = "visible";
        button[0].style.visibility = "visible";
        button[1].style.visibility = "visible";
        button[2].style.visibility = "visible";
        a.style.visibility = "visible";
        div[2].style.visibility="visible";
    }
    timer1 = setTimeout(affichageMainpage, 20);
    }

})();