<?php
function make_file($name, $version, $path, $toroot, $ext)
{
	$str = "";
	for($i=0;$i<10;$i++)
	{
		if(($i%3) == 0) $str = $str . chr(97 + rand(0, 25));
		if(($i%3) == 1) $str = $str . rand(0, 9);
		if(($i%3) == 2) $str = $str . chr(65 + rand(0, 25));
	}
	$fullpath = $path . $str . "_" . $version . "." . $ext;
	$res = array();
	$res[0] = $fullpath;
	$res[1] = $_FILES[$name]['size'];
	$ret = move_uploaded_file($_FILES[$name]['tmp_name'], $toroot . $fullpath);
	if($ret) {
	    return $res;
    }
}
?>


