<?php5

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Precharger une image en javascript</title>
        <script type="text/javascript" src="precharger_image.js"></script>
    </head>
    <body>
            <span class="message" id="message">Les images sont en cours de pr&eacute;chargement...</span>
            <script type="text/javascript">
                    //<!--
                            function precharger_image(url)
                            {
                                    var img = new Image();
                                    img.src=url;
                                    return img;
                            }                              
                            var image1 = precharger_image('background_login.jpg');
                    //-->
            </script>
            <div class="contenu" id="contenu">
                <script type="text/javascript">
                        //<!--
                                document.getElementById('contenu').style.display='none';
                        //-->
                </script>
                Voici l'image qui viens d'&ecirc;tre pr&eacute;charg&eacute;e.<br />
                <img src="background_login.jpg" alt="Image 01" />
        </div>
    </body>
</html>
