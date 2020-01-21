<?php

#To ignore #404 Page Not Found error, and do not include them in sitemap
error_reporting(0);

# The script is free of charge. 
# Mandatory disclaimer: THIS SCRIPT CARRIES NO WARRANTY OR GUARRANTEE WHAT SO EVER. USE IS AT YOUR OWN RISK.

# The site url to crawl. Remember to include the slash ( / ) at the end. (EX: http://www.site.com/)
$siteurl = 'http://'.$_SERVER["HTTP_HOST"].'/';

# The frequency of updating. Valid settings are: always, hourly, daily, weekly, monthly, yearly, never
# The value "always" should be used to describe documents that change each time they are accessed. The value "never" should be used to describe archived URLs.
$frequency = "weekly";


# Priority of page in relation to other parts of your site. A number from 0.1 to 1.0 is acceptable.
$priority = "0.5";

# Include last modification date. Options are: true or false
# The date of last modification of the file. This date should be in W3C Datetime format. This format allows you to omit the time portion, if desired, and use YYYY-MM-DD.
$lastmodification = true;

# File extensions to include in sitemap.
$extensions = array("htm", "html", "php", "asp", "pdf");

# Try to index dynamic web pages that have a parameter in there url (?). Valid options
# are true or false. Use this at your own risk, could capture session info
# which possibly could cause problems during the Google index process.
$index_dynamic_pages_params = true;

# First do a check that allow_url_fopen is set to on
if(ini_get("allow_url_fopen") != 1)
	die("The php.ini directive 'allow_url_fopen' must be set to 'On' for this script to function.\nPlease set this to 'On' in your php.ini file.\n");

# Make url compatible with Google sitemap Specifications
# As with all XML files, any data values (including URLs) must use entity escape codes for the characters listed in the table below. 


#  --------------------------------------
# |   Character   | Simbol | Escape Code |
# |---------------|--------|-------------|
# |   Ampersand   |    &   |    &amp;    |
# |---------------|--------|-------------|
# | Single Quote  |    '   |    &apos;   |
# |---------------|--------|-------------|
# | Double Quote  |    "   |    &quot;   |
# |---------------|--------|-------------|
# | Greater Than  |    >   |    &gt;     |
# |---------------|--------|-------------|
# |  Less Than    |    <   |    &lt;     |
# |---------------|--------|-------------|

function googlesitemap_compatible($url) {
    $url = str_replace("&","&amp;",$url);
	$url = str_replace("'","&apos;",$url);
	$url = str_replace('"',"&quot;",$url);
	$url = str_replace(">","&gt;",$url);
	$url = str_replace("<","&lt;",$url);
	return $url;
}



# Gets a URLs path minus the actual filename + query.
function getPath($url) {
    if($GLOBALS['index_dynamic_pages_params'] == true) {
        $url = explode("?", $url);
        $url = $url[0];
    }
	
	$temp = explode("/", $url);
	$fnsize=strlen($temp[(count($temp) - 1)]);
	return substr($url, 0, strlen($url) - $fnsize);
}

# Cleans up a path so that extra / slashes are gone, .. are translated, etc
function cleanPath($url) {
	$new = array();
	$url = explode("/", trim($url));
	foreach($url as $p) {
		$p = trim($p);
		if($p != "" && $p != ".") {
			if($p == "..") {
				if(is_array($new))
					$new = array_pop($new);
			} else {
				$new = array_merge((array) $new, array($p));
			}
		}
	}
	
	$url = $new[0]."/";
	for($i=1; $i < count($new); $i++)
		$url .= "/".$new[$i];
	
	return $url;
}

# Checks if URL has specified extension, if so returns true
function checkExt($url, $ext) {
	# Strip out parameter info from a script (?)
	if($GLOBALS['index_dynamic_pages_params'] == true) {
		$url = explode("?", $url);
		$url = $url[0];
	}
	
	$text=substr($url, strlen($url) - (strlen($ext) + 1), strlen($url));
	if($text == ".".$ext)
		return true;
	else
		return false;
}

# Retrieve Site URLs
function getUrls($url, $string) {
	$type = "href";
	# Regex to chop out urls
	preg_match_all("|$type\=\"?'?`?([[:alnum:]:?=&@/._-]+)\"?'?`?|i", $string, $matches);
	$ret[$type] = $matches[1];

	# Make all URLS literal (full path)
	for($i = 0; $i < count($ret['href']); $i++) {
		if(! preg_match( '/^(http|https):\/\//i' , $ret['href'][$i]))
			$ret['href'][$i] = getPath($url)."/".$ret['href'][$i];
	
		$ret['href'][$i] = cleanPath($ret['href'][$i]);
	}
	
	return $ret;
}

function addUrls($urls) {
	if(is_array($urls))
		for($i=0; $i < count($urls['href']); $i++) {
			$skip = 0;
			
			# Cycle through to make sure url is unique
			for($x=0; $x < count($GLOBALS['urls']); $x++)
				if($GLOBALS['urls'][$x] == $urls['href'][$i]) {
					$skip = 1;
					break;
				}
			
			# Check extension
			$extgood = 0;
			foreach($GLOBALS['extensions'] as $ext)
				if(checkExt($urls['href'][$i], $ext))
					$extgood = 1;
			
			# And finally make sure its in the current website
			if(! stristr($urls['href'][$i], $GLOBALS['siteurl']))
				$skip = 1;

			if($skip == 0 && $extgood == 1)
				$GLOBALS['urls'][] = $urls['href'][$i];
		}
}

function getNextUrl($oldurl) {
	if($oldurl == "")
		return $GLOBALS['urls'][0];
		
	for($i=0; $i < count($GLOBALS['urls']); $i++)
		if($GLOBALS['urls'][$i] == $oldurl)
			if(isset($GLOBALS['urls'][($i+1)]))
				return $GLOBALS['urls'][($i+1)];
			else
				return false;
	
	return false;
}

$urls = array($siteurl);

#start to generate inline sitemap
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<!--Google Site Map File Generated by http://xml-sitemap-generator.com/ '.date("D, d M Y G:i:s T").' -->'."\n".'<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">'."\n";

# if possible the script will writte on website a copy of generated sitemap
# start to writte generated sitemap
# Make sure you have writte permission to file sitemap_temp.xml


if($fp = fopen("sitemap_temp.xml", "w")) {
  $open_file = 'sucess';
  fputs($fp, '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<!--Google Site Map File Generated by http://xml-sitemap-generator.com/ '.date("D, d M Y G:i:s T").' -->'."\n".'<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">'."\n");
}

# Log 404 Error Page Not Found
# Make sure you have writte access to file 404error.txt
if($fp_err = fopen("404error.txt", "w")) $open_file_404 = 'sucess';
	
$turl = "";
# Cycle through tree and build a url list
while($turl = getNextUrl($turl)) {
	# Extend script time limit
	set_time_limit(3000);

	# Read html file into memory
	if($html = file($turl)) {
		$html = stripslashes(implode($html));
        echo '<url>'."\n\t".'<loc>'.googlesitemap_compatible($turl).'</loc>'."\n";
		if($lastmodification == true)
    		echo "\t".'<lastmod>'.date("Y-m-d").'</lastmod>'."\n";
		echo "\t".'<changefreq>'.$frequency.'</changefreq>'."\n\t".'<priority>'.$priority.'</priority>'."\n".'</url>'."\n";
		# Get site urls from html and add new unique url to list if needed
		addUrls(getUrls($turl, $html));
        #writte the same thing above on website if you have permission to writte
		if($open_file == 'sucess') {
			fputs($fp,'<url>'."\n\t".'<loc>'.googlesitemap_compatible($turl).'</loc>'."\n");
			if($lastmodification == true)
    			fputs($fp,"\t".'<lastmod>'.date("Y-m-d").'</lastmod>'."\n");
			fputs($fp,"\t".'<changefreq>'.$frequency.'</changefreq>'."\n\t".'<priority>'.$priority.'</priority>'."\n".'</url>'."\n");
		}
	} else {
		# check if 404error.txt was sucsefuly opened
		if($open_file_404 == 'sucess') fputs($fp_err, $turl."\n");
	}
}

echo '</urlset>';	
if($open_file == 'sucess') {
	fputs($fp, '</urlset>');
	fclose($fp);
	# Make sure you have writte access to file sitemap_OK.xml
	# To track evolution of your google sitemap you can replace sitemap_temp.xml with "sitemap_OK_".date(d-m-y).".xml"
	copy('sitemap_temp.xml','sitemap.xml');
	
if($open_file_404 == 'sucess') fclose($fp_err);
}



?>