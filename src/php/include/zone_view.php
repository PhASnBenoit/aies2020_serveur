<div id="content_zone">
	<?php 
	if(!isset($_GET['zone']))
	{
		echo "<h1 id=\"nozone\">Selectionnez une zone à visualiser plus bas,<br>ou allez dans l'onglet de navigation \"Affichage\" pour visualiser une diapo en particulier.</h1>";
	}
	else
	{
		if(!is_numeric($_GET['zone']))
		{
			header('Location: view.php?action=zone');
			exit();
		}
		else
		{ ?>
			<iframe id="content_frame" src="../rpi/slide/oups.php" width="100%" height="100%" align="right" frameborder="5"> </iframe>
			<h2 id="timer"><span></span></h2>
			<script>
				var allcontent;
				var num_slide = 0;

				var dix = 0;
				var sc = 0;

				var element = document.getElementById('timer');

				var timer;

				function chrono()
				{ 
					dix--;
					if(dix < 0)
					{
						dix=9;
						sc--;
					}
					if(sc < 0)
					{
						sc = 0;
					}
					element.innerHTML = sc + ".<span>" + dix + "</span>";
					if(sc == 0 & dix == 0)
					{
						clearTimeout(timer);
					}
					else
					{
						timer = setTimeout('chrono()', 100);
					}
				}

				function start_timer(sec, dx)
				{
					clearTimeout(timer);
					dix = dx;
					sc = sec;
					chrono();
				}

				function get_slide(zone)
				{
					var xhr = new XMLHttpRequest();
		    		xhr.open('GET', 'tool/new_path.php?zone=' + zone);
		
	    			xhr.addEventListener('readystatechange', function() 
	    			{
		        		if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) 
		        		{
		        			var content = xhr.responseText;
		        			if(content == "none")
		        			{
		        				//faire sa
		        			}
		        			else
		        			{
		        				allcontent = content.split(';');
		        				next_slide();
		        			}
		        			
	        			}
		    		});

		    		xhr.send(null);
				}

				function next_slide()
				{
					if(num_slide <= (allcontent.length - 2))
					{
						document.getElementById("content_frame").src = ".." + allcontent[num_slide];
						var timer = allcontent[num_slide + 1] + "";
						timer = timer / 1000;
						timer = parseFloat(timer).toFixed(1);
						thetime = timer.split('.');
						start_timer(thetime[0], thetime[1]);
						setTimeout("next_slide()", allcontent[num_slide + 1]);
						num_slide = num_slide + 2;
					}
					else
					{
						num_slide = 0;
						get_slide(<?php echo $_GET['zone']; ?>);
					}
				}

				get_slide(<?php echo $_GET['zone']; ?>);
			</script>
		<?php }
	}
	?>
</div>





<!-- 
	<iframe src="../rpi/slide/MTQ5NTU2OTY1OA6.html" width="100%" height="100%" align="right" frameborder="5"> </iframe>
 -->
