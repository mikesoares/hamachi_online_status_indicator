<?php

/*
	Hamachi Online Status Script
	Created by Michael Soares (mikesoares.com)

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

$title = "Hamachi Online Status List";		// title of your page

$client_names = array(				// this array has all the names of your hamachi clients
              "comp1",
	      "comp2",
	      "comp3"

	);

$list_section = array(				// this array has the names of the clients you want in this section and their ips
              "comp1" => "5.7.153.139",		// for the section call "Section"
              "comp2" => "5.7.153.140",		// you can create another section by creating a new array with a different name
              "comp3" => "5.7.153.141"		// for example, $list_section2
	);

////////////////////////// DON'T EDIT ANYTHING BELOW THIS LINE //////////////////////////

function status($name, $ip){

	$ch = curl_init();
	$timeout = 5; // set to zero for no timeout
	$hamachi_url = "https://my.hamachi.cc/status/text.php?" . $ip;
	curl_setopt ($ch, CURLOPT_URL, $hamachi_url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$status = curl_exec($ch);
	curl_close($ch);
  
        if( preg_match( "/online/i", $status ) ){
    		print "<li><img src=\"online_dot.gif\" alt=\"online\" />&nbsp;" . $name . "</li>\n";
        }elseif( preg_match( "/offline/i", $status ) ){
    		print "<li><img src=\"offline_dot.gif\" alt=\"offline\" />&nbsp;" . $name . "</li>\n";
        }else{
    		print "<li><img src=\"unknown_dot.gif\" alt=\"unknown/error\" />&nbsp;" . $name . "</li>\n";
        }

}

function listing($list_name, $list_array){
	global $client_names;
	$size_names = count($client_names);
	print "\n<h2>" . $list_name . "</h2>\n<p>\n\t<ul class=\"list\">\n";
        for( $i = 0; $i < $size_names; $i++ ){
		if( isset($list_array[$client_names[$i]]) && !empty($list_array[$client_names[$i]]) ){
			$uppercase = strtoupper($client_names[$i]);
			status($uppercase, $list_array[$client_names[$i]], 0);
		}
        }
        print "\t</ul>\n</p>";

}

print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\">
<head>
<title>" . $title . "</title>
<meta http-equiv=\"Content-type\" content=\"text/html; charset=ISO-8859-1\" />
<style type=\"text/css\">
        body { font-family: tahoma, verdana, arial; font-size: .7em; background-color: #a0a0a0; background:url(\"bg.gif\"); }
        h2 { font-size: 1.2em; color: #404040; margin: 0px; }
	img { vertical-align: middle; }
        p { margin: 7px; line-height: 1.5em; }
        a img { border: 0px; }
        a:link    { color: #E0E0E0; }
        a:visited { color: #E0E0E0; }
        a:hover   { text-decoration: none; }
        a:active  { color: #E0E0E0; }
        
        ul.list { margin: 3px 0px 5px -3px; padding: 0px; list-style: none; }
        ul.list li { margin: 1px 0px 0px 18px; line-height: 1.5em; }
         
        #outside { width: 220px; margin: 20px auto 0px auto; border: 3px solid #454545; line-height: 1.2 }
        #inside { background-color: white; border: 1px solid #000; padding: 5px; }
        #content { padding: 5px; }
        #topbar { margin: 0px 0px 8px 0px; background-color: #252525; }
        #topbar ul { margin: 0px; padding: 8px 0px 6px 8px; list-style: none;}
        #topbar li { display: inline; margin: 0px 15px 0px 2px; padding: 0px; }
</style>
</head>
<body>
<div id=\"outside\">\n<div id=\"inside\">
<div id=\"topbar\">
<ul><li><font color=\"#FFFFFF\"><strong><img src=\"hamachi.gif\" align=\"top\" alt=\"hamachi\" />&nbsp;" . $title . "</strong></font></li></ul>
</div>
<div id=\"content\">";

////////////////////////// DON'T EDIT ANYTHING ABOVE THIS LINE //////////////////////////

/*

if you want to add another section, create a new array above as mentioned and pass the function for the new section...
it's pretty straightforward

*/

// start sections

listing("Section", $list_section);	// name of your section, array corresponding to your section

// end sections

// start legend

print "<h2>Legend</h2>
\t<p>
<ul class=\"list\">
	<li><img src=\"online_dot.gif\" alt=\"online\" />&nbsp;ONLINE</li>
	<li><img src=\"offline_dot.gif\" alt=\"offline\" />&nbsp;OFFLINE</li>
	<li><img src=\"unknown_dot.gif\" alt=\"unknown/error\" />&nbsp;UNKNOWN/ERROR</li>
</ul>
\t</p>";

// end legend

////////////////////////// DON'T EDIT ANYTHING BELOW THIS LINE //////////////////////////

print "\n</div>\n</div>\n</div><div style=\"text-align:center;font-size:0.9em;color:#E0E0E0;margin:4px;\">Created by <a href=\"http://www.mikesoares.com/\" target=\"_blank\">gamehead200</a><br />Download the script <a href=\"http://www.astromike.com/hamachistatus/\" target=\"_blank\">here</a>!</div>";
print "\n</div>\n";
print "</body>\n</html>";

////////////////////////// DON'T EDIT ANYTHING ABOVE THIS LINE //////////////////////////

?>