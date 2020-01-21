<?php
if($_GET['mod']=='home') {
	include "joinc/contents/home/home.php";
}
elseif($_GET['mod']=='about') {
	include "joinc/contents/about.php";
}
elseif($_GET['mod']=='how-to-order') {
	include "joinc/contents/how-to-order.php";
}
elseif($_GET['mod']=='search') {
	include "joinc/contents/search/search.php";
}
elseif($_GET['mod']=='pricelist') {
	include "joinc/contents/pricelist.php";
}
elseif($_GET['mod']=='news') {
	include "joinc/contents/news/news.php";
}
elseif($_GET['mod']=='news-detail') {
	include "joinc/contents/news/news_detail.php";
}
elseif($_GET['mod']=='souvenir') {
	include "joinc/contents/souvenir/souvenir.php";
}
elseif($_GET['mod']=='souvenir-detail') {
	include "joinc/contents/souvenir/souvenir_detail.php";
}
elseif($_GET['mod']=='gallery') {
	include "joinc/contents/gallery/gallery.php";
}
elseif($_GET['mod']=='contact') {
	include "joinc/contents/contact.php";
}
elseif($_GET['mod']=='pages') {
	include "joinc/contents/pages/index.php";
}
else{
	
}