// v1.1 by PhA 2019-01-28

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

function texte_changegrand()
{
	document.getElementById("content_p").style.fontSize = '400%';
}
function texte_changemoyen()
{
	document.getElementById("content_p").style.fontSize = '200%';
}
function texte_changepetit()
{
	document.getElementById("content_p").style.fontSize = '100%';
}


function content_select(x, z)
{
	if(z == "text")
	{
		var y = document.getElementById("change_text");
		y.style.display = "inline-block";
		y.value = x.innerHTML;
		lastelement = x;
		y.focus();
	}
}

function set_content(x, z)
{
	if(z == "text")
	{
		var str = x.value;
		var cr = 0;
		for(var nb = 0;nb<str.length;nb++)
		{
			if(str[nb] == '\n') cr++;
		}
		var i = 0;
		while(i != cr)
		{
			str = str.replace("\n", "<br>");
			i++;
		}
		if(str == "") str = "Cliquer ici pour écrire !";
		lastelement.innerHTML = str;
	}
}

function create()
{
	if(document.getElementById("select_time").value == "auto")
	{
		res = 7 * 1000;
		document.getElementById("time").value = res.toFixed(0);
	}
	else
	{
		var res = document.getElementById("select_time").value * 1000;
		document.getElementById("time").value = res;
	}

	if(document.getElementById("content_h1").innerHTML == "Cliquer ici pour écrire !" 
            || document.getElementById("content_i").innerHTML=="En attente d'une image"
            || document.getElementById("content_p").innerHTML == "Cliquer ici pour écrire !")
	{
		alert("Vous avez omis de remplir le titre, le texte ou de sélectionner une photo valide !")
		return;
	}

	document.getElementById("title").value = document.getElementById("content_h1").innerHTML;
	document.getElementById("data").value = document.getElementById("precontent").innerHTML;
	document.getElementById("bt_send").click();
}

function fichier_prev()
{
	document.getElementById("bt_send2").click(); // valide le form2 pour charger la photo sur le serveur
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
