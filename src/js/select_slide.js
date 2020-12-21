/* global var */
var current_slide = "none";
var current_state = "none";


function tr_click(x, z, n)
{
	var y = document.getElementsByClassName("tr_slide");
	for(var i = 0;i<y.length;i++)
	{
		y[i].style.backgroundColor = "rgb(240,240,240)";
	}
	x.style.backgroundColor = "rgb(0,150,255)";

	current_slide = n;

	if(z == 0) current_state = "actu";
	if(z == 1) current_state = "diff";
	if(z == 2) current_state = "arch";
}

function bt_click(x)
{
	if(x == "add")
	{
		window.location = "./display.php?action=add";
	}
	else if(current_state == "actu")
	{
		switch(x)
		{
			case "ActuToArch":
				window.location = "./display.php?action=ActuToArch&slide=" + current_slide;
			break;
			default:
				window.location = "./display.php?notif=noexistbutton";
			break;
		}
	}
	else if(current_state == "diff")
	{
		switch(x)
		{
			case "DiffToArch":
				window.location = "./display.php?action=DiffToArch&slide=" + current_slide;
			break;
			case "DiffToActu":
				window.location = "./display.php?action=DiffToActu&slide=" + current_slide;
			break;
			default:
				window.location = "./display.php?notif=noexistbutton";
			break;
		}
	}
	else if(current_state == "arch")
	{
		switch(x)
		{
			case "ArchToActuDiff":
				window.location = "./display.php?action=ArchToActuDiff&slide=" + current_slide;
			break;
			case "del":
				window.location = "./display.php?action=del&slide=" + current_slide;
			break;
			case "modif":
				window.location = "./display.php?action=modif&slide=" + current_slide;
			break;
			default:
				window.location = "./display.php?notif=noexistbutton";
			break;
		}
	}
	else
	{
		window.location = "./display.php?notif=noslide";
	}
}