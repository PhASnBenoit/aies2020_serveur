// v1.1 2019-02-03 by PhA
var lastelement;
var taille=36;  // 2019-02-03 by PhA

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

function texte_changegrand()  // by PhA 2019-02-03
{
    taille +=4;
    if (taille>=148) taille=148;
    document.getElementById("content_p").style.fontSize = taille+"px";
}

function texte_changepetit()  // by PhA 2019-02-03
{
    taille -=4;
    if (taille<=20) taille=20;
    document.getElementById("content_p").style.fontSize = taille+"px";
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
                y.select();
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
		if(str == "") str = "Cliquer ici pour ecrire !";
		lastelement.innerHTML = str;
	}
}

function create()
{
	if(document.getElementById("select_time").value == "auto")
	{
		var res = document.getElementById("content_h1").innerHTML.length + document.getElementById("content_p").innerHTML.length;
		res = res / 24; // 23 correspond a la vitesse moyenne de lecture de caractere par seconde dans le monde.
		if(res > 20) res = res - 3;
		if(res > 10) res = res - 1;
		if(res < 2.5) res = res + 1;
		res = res * 1000;
		document.getElementById("time").value = res.toFixed(0);
	}
	else
	{
		var res = document.getElementById("select_time").value * 1000;
		document.getElementById("time").value = res;
	}

	if(document.getElementById("content_h1").innerHTML == "Cliquer ici pour écrire !" || document.getElementById("content_p").innerHTML == "Cliquer ici pour écrire !")
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

var vid = document.getElementById("video");
            
            if(window.addEventListener){//Utilise la fonction dès que la page charge 
                window.addEventListener('load', enableAutoplay, false);
            }else{
                window.attachEvent('onload', enableAutoplay);
            }
                
                function enableAutoplay() { //permet de mettre la vidéo automatiquement sur play
                    vid.autoplay = true;
                    //vid.loop = true;
                    vid.load();
                }
