<?php
//过滤用于搜索的字符串
function FilterSearch($keyword)
{
	global $cfg_soft_lang;
	if($cfg_soft_lang=='utf-8')
	{
		$keywords = m_ereg_replace("[ \"\r\n\t\$\\><']",'',$keyword);
		if($keywords != stripslashes($keywords))
		{
			return '';
		}
		else
		{
			return $keyword;
		}
	}
	else
	{
		$restr = '';
		for($i=0;isset($keyword[$i]);$i++)
		{
			if(ord($keyword[$i]) > 0x80)
			{
				if(isset($keyword[$i+1]) && ord($keyword[$i+1]) > 0x40)
				{
					$restr .= $keyword[$i].$keyword[$i+1];
					$i++;
				}
				else
				{
					$restr .= ' ';
				}
			}
			else
			{
				if(m_eregi("[^0-9a-z@#\.]",$keyword[$i]))
				{
					$restr .= ' ';
				}
				else
				{
					$restr .= $keyword[$i];
				}
			}
		}
	}
	return $restr;
}
$name=$_REQUEST['name'];
$url=$_REQUEST['url']?$_REQUEST['url']:$_SERVER['SERVER_NAME'];
$name = FilterSearch(stripslashes($name));
$Shortcut = "[InternetShortcut]

URL={$url}

";
header("Content-type: application/octet-stream"); 
header("Content-Disposition: attachment; filename=".str_replace(" ","",$name).".url;"); 
echo $Shortcut;
?>