<?php
/* Search Engine Optimization - Title - Description - Keyword*/
$seo_title			= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='1'");
if (empty($seo_title)) {
	$default = "Mustika Souvenir";
}else{
	$default = $seo_title['static_content'];
}

if($_GET['mod']=='home')
{	
	$seo_title			= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='1'");
	$seo_keyword		= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='2'");
	$seo_description	= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='3'");

	$title			= "Mustika Souvenir";
	$keyword		= "tanah dijual, rumah dijual, bantul, disewakan, gunung kidul, kodya yogya, kulon Progo, luar DIY, property jogja, rumah, rumah dijual, rumah jogja, sleman, tanah, jual-beli rumah, tanah, kavling, gudang, hotel, ruko,mGuest house, villa, homestay, dan souvenir lainnya, $seo_keyword[static_content] ";
	$description	= "$seo_description[static_content]";
	echo '
	<meta charset="utf-8">
	<title>'.$title.' | '.$default.'</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="index follow" />
	<meta name="description" content="'.$description.' | '.$default.'">
	<meta name="keywords" content="'.$keyword.' | '.$default.'">
	<meta name="author" content="mustikasouvenir.com">
	<meta name="generator" content="'.$default.'">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
	';
}

elseif($_GET['mod']=='about')
{
	$seo_title			= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='1'");
	$seo_keyword		= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='2'");
	$seo_description	= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='3'");

	$title			= 'Tentang Kami';
	$keyword		= "tentang souvenir pedia, tanah dijual, rumah dijual, bantul, disewakan, gunung kidul, kodya yogya, kulon Progo, luar DIY, property jogja, rumah, rumah dijual, rumah jogja, sleman, tanah, jual-beli rumah, tanah, kavling, gudang, hotel, ruko,mGuest house, villa, homestay, dan souvenir lainnya, $seo_keyword[static_content] ";
	$description	= "$seo_description[static_content]";

	echo '
	<meta charset="utf-8">
	<title>'.$title.' | '.$default.'</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="index follow" />
	<meta name="description" content="'.$description.'">
	<meta name="keywords" content="'.$keyword.'">
	<meta name="author" content="mustikasouvenir.com">
	<meta name="generator" content="'.$default.'">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
	';
}

elseif($_GET['mod']=='souvenir')
{
	$seo_title			= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='1'");
	$seo_keyword		= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='2'");
	$seo_description	= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='3'");

	$title			= "Properti dijual di Jogja";
	$keyword		= "tanah dijual, rumah dijual, bantul, disewakan, gunung kidul, kodya yogya, kulon Progo, luar DIY, property jogja, rumah, rumah dijual, rumah jogja, sleman, tanah, jual-beli rumah, tanah, kavling, gudang, hotel, ruko,mGuest house, villa, homestay, dan souvenir lainnya, $seo_keyword[static_content] ";
	$description	= "$seo_description[static_content]";

	echo '
	<meta charset="utf-8">
	<title>'.$title.' | '.$default.'</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="index follow" />
	<meta name="description" content="'.$description.'">
	<meta name="keywords" content="'.$keyword.'">
	<meta name="author" content="mustikasouvenir.com">
	<meta name="generator" content="'.$default.'">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
	';
}

elseif($_GET['mod']=='souvenir-detail')
{
	$seo_title			= $database->select($fields="*", $table="sub_information", $where_clause="WHERE id_subinformation ='$_GET[id]'");
	$seo_cattitle		= $database->select($fields="*", $table="information", $where_clause="WHERE id_information ='$seo_title[id_information]'");
	$seo_keyword		= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='2'");
	$seo_description	= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='3'");

	$content = strip_tags($seo_title['description']);
	$subtitle		= "$seo_title[seo]";
	$keyword		= "$seo_title[title], tanah dijual, rumah dijual, bantul, disewakan, gunung kidul, kodya yogya, kulon Progo, luar DIY, property jogja, rumah, rumah dijual, rumah jogja, sleman, tanah, jual-beli rumah, tanah, kavling, gudang, hotel, ruko, mGuest house, villa, homestay, dan souvenir lainnya, $seo_keyword[static_content] ";
	$description	= "$content | $seo_description[static_content]";
	
	$image		= str_replace(" ", "%20", "$seo_title[image]");

	echo '
	<meta charset="utf-8">
	<title>'.$seo_title["title"].' | '.$default.' </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="index follow" />
	<meta name="description" content="'.$description.'">
	<meta name="keywords" content="'.$keyword.'">
	<meta name="author" content="mustikasouvenir.com">
	<meta name="generator" content="'.$default.'">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />

	<meta property="og:site_name" content="'.$default.'"/>
	<meta property="og:title" content="'.$seo_title["title"].'"/>
	<meta property="og:description" content="'.$content.'" />
	<meta property="og:image" content="http://mustikasouvenir.com/joimg/information/'.$image.'" />
	<meta property="og:url" content="http://mustikasouvenir.com/souvenir-'.$seo_cattitle["seo"].'-'.$subtitle.'-'.$_GET["id"].'" />
	<meta property="og:type" content="website"/>
	';

}

elseif($_GET['mod']=='gallery')
{
	$seo_title			= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='1'");
	$seo_keyword		= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='2'");
	$seo_description	= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='3'");

	$title			= "Galeri";
	$keyword		= "galeri rumah, foto terbaru rumah, tanah dijual, rumah dijual, bantul, disewakan, gunung kidul, kodya yogya, kulon Progo, luar DIY, property jogja, rumah, rumah dijual, rumah jogja, sleman, tanah, jual-beli rumah, tanah, kavling, gudang, hotel, ruko,mGuest house, villa, homestay, dan souvenir lainnya, $seo_keyword[static_content] ";
	$description	= "$seo_description[static_content]";
	echo '
	<meta charset="utf-8">
	<title>'.$title.' | '.$default.'</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="index follow" />
	<meta name="description" content="'.$description.' | '.$default.'">
	<meta name="keywords" content="'.$keyword.' | '.$default.'">
	<meta name="author" content="mustikasouvenir.com">
	<meta name="generator" content="'.$default.'">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
	';
}
elseif($_GET['mod']=='news')
{
	$seo_title			= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='1'");
	$seo_keyword		= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='2'");
	$seo_description	= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='3'");

	$title			= "News";
	$keyword		= "berita souvenir, berita baru souvenir, berita dunia souvenir, iklan souvenir, tanah dijual, rumah dijual, bantul, disewakan, gunung kidul, kodya yogya, kulon Progo, luar DIY, property jogja, rumah, rumah dijual, rumah jogja, sleman, tanah, jual-beli rumah, tanah, kavling, gudang, hotel, ruko,mGuest house, villa, homestay, dan souvenir lainnya, $seo_keyword[static_content] ";
	$description	= "$seo_description[static_content]";

	echo '
	<meta charset="utf-8">
	<title>'.$title.' | '.$default.'</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="index follow" />
	<meta name="description" content="'.$description.'">
	<meta name="keywords" content="'.$keyword.'">
	<meta name="author" content="mustikasouvenir.com">
	<meta name="generator" content="'.$default.'">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
	';
}

elseif($_GET['mod']=='news-detail')
{
	$seo_title			= $database->select($fields="*", $table="articles", $where_clause="WHERE id_articles ='$_GET[id]'");
	$seo_keyword		= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='2'");
	$seo_description	= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='3'");

	$content = strip_tags($seo_title['description']);
	$subtitle		= "$seo_title[seo]";
	$keyword		= "$seo_title[title], berita souvenir, berita baru souvenir, berita dunia souvenir, iklan souvenir, tanah dijual, rumah dijual, bantul, disewakan, gunung kidul, kodya yogya, kulon Progo, luar DIY, property jogja, rumah, rumah dijual, rumah jogja, sleman, tanah, jual-beli rumah, tanah, kavling, gudang, hotel, ruko,mGuest house, villa, homestay, dan souvenir lainnya, $seo_keyword[static_content] ";
	$description	= "$content | $seo_description[static_content]";
	
	$image		= str_replace(" ", "%20", "$seo_title[image]");

	echo '
	<meta charset="utf-8">
	<title>'.$seo_title["title"].' | '.$default.' </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="index follow" />
	<meta name="description" content="'.$description.'">
	<meta name="keywords" content="'.$keyword.'">
	<meta name="author" content="mustikasouvenir.com">
	<meta name="generator" content="'.$default.'">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />

	<meta property="og:site_name" content="'.$default.'"/>
	<meta property="og:title" content="'.$seo_title["title"].'"/>
	<meta property="og:description" content="'.$content.'" />
	<meta property="og:image" content="http://mustikasouvenir.com/joimg/articles/'.$image.'" />
	<meta property="og:url" content="http://mustikasouvenir.com/news-'.$subtitle.'-'.$_GET["id"].'" />
	<meta property="og:type" content="website"/>
	';

}

elseif($_GET['mod']=='search')
{
	$seo_title			= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='1'");
	$seo_keyword		= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='2'");
	$seo_description	= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='3'");

	$title			= "Hubungi Kami";
	$keyword		= "tanah dijual, rumah dijual, bantul, disewakan, gunung kidul, kodya yogya, kulon Progo, luar DIY, property jogja, rumah, rumah dijual, rumah jogja, sleman, tanah, jual-beli rumah, tanah, kavling, gudang, hotel, ruko,mGuest house, villa, homestay, dan souvenir lainnya, $seo_keyword[static_content] ";
	$description	= "$seo_description[static_content]";
	echo '
	<meta charset="utf-8">
	<title>'.$title.' | '.$default.'</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="index follow" />
	<meta name="description" content="'.$description.'">
	<meta name="keywords" content="'.$keyword.'">
	<meta name="author" content="mustikasouvenir.com">
	<meta name="generator" content="'.$default.'">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
	';
}

else
{
	/* Default masuk kesini, termasuk halaman home atau beranda */
	$seo_title			= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='1'");
	$seo_keyword		= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='2'");
	$seo_description	= $database->select($fields="static_content", $table="modul", $where_clause="WHERE id_modul ='3'");

	$title			= $seo_title['static_content'];
	$keyword		= $seo_keyword['static_content'];
	$description	= $seo_description['static_content'];
	echo '
	<meta charset="utf-8">
	<title>'.$title.' | '.$default.'</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="index follow" />
	<meta name="description" content="'.$description.'">
	<meta name="keywords" content="'.$keyword.'">
	<meta name="author" content="mustikasouvenir.com">
	<meta name="generator" content="'.$default.'">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
	';
}
?>
