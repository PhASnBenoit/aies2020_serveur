/* v1.2 by PhA 2019-02-04 */

var lastelement;

function teinte_change(x, n)
{
	var all_td = document.getElementById("select_color").getElementsByTagName("td");
	for(var i = 0; i<all_td.length;i++)
	{
		all_td[i].style.border = "1px white solid";
	}
	x.style.border = "2px red solid";
	document.getElementById("content").className = n;
}

function onFinEdition() 
{
    // Pour h1, prendre le contenu du textearea et le placer directement dans le h1
    var h1 = document.getElementById("content_h1");
    var ta = document.getElementById("content_h1").getElementsByTagName("textarea")[0];
    var txt = ta.value;
    h1.innerHTML = txt;
    h1.onclick=function() { content_select() };           

    // Pour tous les td, prendre le contenu des textearea et les placer directement dans les td
    var tousTd = document.getElementById("content").getElementsByTagName("td");
    for (i=0 ; i<tousTd.length ; i++)
    {
        var ta = tousTd[i].getElementsByTagName("textarea")[0];
        var txt = ta.value;
        tousTd[i].innerHTML = txt;
        tousTd[i].onclick=function() { content_select() };           
    } // for
    document.getElementById("bt_create").style.display = "inline-block";
    document.getElementById("bt_finEdition").style.display = "none";
}


function content_select()
{
    // Pour h1 ajouter le textearea avec l'eventuel contenu
    var texteH1 = document.getElementById("content_h1");
    var txt = texteH1.innerHTML;  // prend le contenu du h1
    texteH1.innerHTML = "  <textarea maxlength=\"70\" cols=\"70\" rows=\"1\" class=\"styleTitreArea\" id=\"change1_text\">"+txt+"</textarea>";
    texteH1.onclick = 0;

    // Pour tous les td, ajouter les textearea avec l'eventuel contenu
    var tousTd = document.getElementById("content").getElementsByTagName("td");
    for (i=0 ; i<tousTd.length ; i++)
    {
        oldTd = tousTd[i].innerHTML;  // prend le contenu du td
        tousTd[i].innerHTML = "  <textarea maxlength=\"30\" cols=\"30\" rows=\"1\" class=\"styleArea\" id=\"change1_text\">"+oldTd+"</textarea>";
        tousTd[i].onclick = 0;
    } // for
    document.getElementById("bt_finEdition").style.display = "inline-block";
    document.getElementById("bt_create").style.display = "none";
}

function pasDeLigne(t) 
{
    var str = t.value;
    var lg = str.length;
    if (str[lg-1] == 'a') {
        str.replace("a", "A");
        alert(str);
    }
    if (str[lg-1] == 'b')
        str[lg-1] = 'B';
    t.innerHTML = str;
}


/*
function set_content(x, z)
{
	if(z == "text")
	{
		var str = x.value;
		var cr = 0;
		for(var nb = 20;nb<str.length;nb++)
		{
			if(str[nb] == '\n') cr++;
		}
		var i = 0;
		while(i != cr)
		{
			str = str.replace("\n", "<br>");
			i++;
		}
		if(str == "") str = "";
		lastelement.innerHTML = str;
	}
}
*/

function create()
{
	if(document.getElementById("select_time").value == "auto")
	{
            /*
		var res = document.getElementById("content_h1").innerHTML.length + document.getElementById("content_td").innerHTML.length;
		res = res / 24; // 23 correspond a la vitesse moyenne de lecture de caractere par seconde dans le monde.
		if(res > 20) res = res - 3;
		if(res > 10) res = res - 1;
		if(res < 2.5) res = res + 1;
            */
		var res = 12000;
		document.getElementById("time").value = res.toFixed(0);
            
	}
	else
	{
		var res = document.getElementById("select_time").value * 1000;
		document.getElementById("time").value = res;
	}

	if(document.getElementById("content_h1").innerHTML == "Cliquer ici pour écrire !" || document.getElementById("content_td").innerHTML == "Cliquer ici pour écrire !")
	{
		alert("Vous avez omis un ou plusieurs champs dans la partie affichage !")
		return;
	}
	document.getElementById("title").value = document.getElementById("content_h1").innerHTML;
	document.getElementById("data").value = document.getElementById("precontent").innerHTML;
	document.getElementById("bt_send").click();
}

function onload()
{
	var x = document.getElementById("content").getAttribute('class');
	var y = document.getElementById("select_color");
	var z = y.getElementsByTagName("td");

	for(var i = 0;i<z.length;i++)
	{
		if(z[i].getAttribute('class') == x)
		{
			z[i].style.border = "2px red solid";
		}
		else
		{
			z[i].style.border = "1px while solid";
		}
	}
}
