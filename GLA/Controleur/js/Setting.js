(function(){
	
    var div = document.getElementsByTagName('div');
	var input = document.getElementsByTagName('input');
	var p = document.getElementsByTagName('p');
    var button = document.getElementsByTagName('button');
    var ul1 = document.getElementById('groupid');
    var ul2 = document.getElementById('groupid2');
    var ul3 = document.getElementById('groupid3');

	var height = 5;
	var cpt = 0;
    button[1].disabled=true;


	cache();
	affichageMainpage();

	function cache(){
            for(var i = 0; i<input.length;i++){
                input[i].style.visibility = "hidden";
                input[i].disabled=true;
            }
            for(var i = 0; i<p.length;i++){
                p[i].style.visibility = "hidden";
            }

            button[0].style.visibility = "hidden";
            button[1].style.visibility = "hidden";
            div[5].style.visibility = "hidden";
	}
	function affichageMainpage() {
        if (height < 460) {
            height = height + 20;
            div[1].style.height = height + "px";
        }
        cpt = cpt + 1;
        if(cpt == 22){
            for(var i = 0; i<input.length;i++){
                input[i].style.visibility = "visible";
                
            }
            for(var i = 0; i<p.length;i++){
                p[i].style.visibility = "visible";
            }

            button[0].style.visibility = "visible";
            button[1].style.visibility = "visible";
            div[5].style.visibility = "visible";
        }
        timer1 = setTimeout(affichageMainpage, 20);
    }

    function check(){
        if(!input[0].disabled){
            button[1].disabled=false;
        }
    }

    button[0].onclick = function(){
       for(var i=0;i<input.length;i++){
        input[i].disabled=false;
       }
       check();
    }

    button[2].onclick = function(){
        window.location.href="/GLA/Vue/html/AccueilCon.php";
    }


function createXMLDom(){
    
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.open("GET","/GLA/Controleur/reseau.xml",false);
    xmlhttp.send();
    
    xmlDoc=xmlhttp.responseXML;

    var root=xmlDoc.documentElement;
    noms=root.getElementsByTagName("nom");
    villes=root.getElementsByTagName("ville");
    var data = new Array();
    for(var i =0;i<villes.length;i++){
        data.push(noms[i].firstChild.nodeValue);
    }
    return data;

}

function createoption(){
    var data = createXMLDom();
    for(var i=0 ;i<data.length;i++){
        var li =document.createElement("li");
        var oA = document.createElement('a');   
        oA.href = 'javascript:void(0)';    
        oA.innerHTML = data[i];   
        li.appendChild(oA);
        
        var li2 =document.createElement("li");
        var oA2 = document.createElement('a');   
        oA2.href = 'javascript:void(0)';    
        oA2.innerHTML = data[i];   
        li2.appendChild(oA2);

        var li3 =document.createElement("li");
        var oA3 = document.createElement('a');   
        oA3.href = 'javascript:void(0)';    
        oA3.innerHTML = data[i];   
        li3.appendChild(oA3);
        
        ul1.appendChild(li);
        ul2.appendChild(li2);
        ul3.appendChild(li3);
    }

}
createoption();

jQuery.expr[':'].Contains = function(a, i, m) {
    return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
};

function filterList(list) {
    $('#js-groupId').bind('input propertychange', function() {
        var filter = $(this).val();
        if (filter) {
            $matches = $(list).find('a:Contains(' + filter + ')').parent();
            $('li', list).not($matches).slideUp();
            $matches.slideDown();
        } else {
            $(list).find("li").slideDown();
        }
    });
}
$(function() {
    filterList($("#groupid"));
    $('#js-groupId').bind('focus', function() {
        $('#groupid').slideDown();
    }).bind('blur', function() {
        $('#groupid').slideUp();
    })
    $('#groupid').on('click', 'li', function() {
        $('#js-groupId').val($(this).text())
        $('#groupId').val($(this).data('id'))
        $('#groupid').slideUp()
    });
})

function filterList2(list) {
    $('#js-groupId2').bind('input propertychange', function() {
        var filter = $(this).val();
        if (filter) {
            $matches = $(list).find('a:Contains(' + filter + ')').parent();
            $('li', list).not($matches).slideUp();
            $matches.slideDown();
        } else {
            $(list).find("li").slideDown();
        }
    });
}

$(function() {
    filterList2($("#groupid2"));
    $('#js-groupId2').bind('focus', function() {
        $('#groupid2').slideDown();
    }).bind('blur', function() {
        $('#groupid2').slideUp();
    })
    $('#groupid2').on('click', 'li', function() {
        $('#js-groupId2').val($(this).text())
        $('#groupId2').val($(this).data('id'))
        $('#groupid2').slideUp()
    });
})

function filterList3(list) {
    $('#js-groupId3').bind('input propertychange', function() {
        var filter = $(this).val();
        if (filter) {
            $matches = $(list).find('a:Contains(' + filter + ')').parent();
            $('li', list).not($matches).slideUp();
            $matches.slideDown();
        } else {
            $(list).find("li").slideDown();
        }
    });
}

$(function() {
    filterList3($("#groupid3"));
    $('#js-groupId3').bind('focus', function() {
        $('#groupid3').slideDown();
    }).bind('blur', function() {
        $('#groupid3').slideUp();
    })
    $('#groupid3').on('click', 'li', function() {
        $('#js-groupId3').val($(this).text())
        $('#groupId3').val($(this).data('id'))
        $('#groupid3').slideUp()
    });
})
})()