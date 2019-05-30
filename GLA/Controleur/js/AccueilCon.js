(function() {
  var logout = document.getElementById('logout');
  var button = document.getElementsByTagName('button');
  var userSetting=document.getElementById('userSetting');
  var ul1 =document.getElementById('groupid');
  var ul2 =document.getElementById('groupid2');


  button[0].onclick=function(){
  	window.location.href="/GLA/Controleur/php/PickH.php";
  }
  button[1].onclick=function(){
  	window.location.href="/GLA/Controleur/php/PickC.php";
  }
  button[2].onclick=function(){
  	window.location.href="/GLA/Controleur/php/PickU.php";
  }
  button[3].onclick=function(){
  	window.location.href="/GLA/Vue/html/Setting.php";
  }
  logout.onclick=function(){
    window.location.href="/GLA/Controleur/php/Logout.php";
  }
  userSetting.onclick=function(){
    window.location.href="/GLA/Vue/html/userSetting.php";
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

	//xmlhttp.open("GET","../reseau_1000v-10000t-841r.xml",false);
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
    	
    	ul1.appendChild(li);
    	ul2.appendChild(li2);
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



})();