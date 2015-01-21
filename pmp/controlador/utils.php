<?php
function f_redireccionar($url,$campo=array(),$target="_self"){
	echo'<form name="datos" action="'.$url.'" method="POST" target="'.$target.'" id="datos">';
	$urls=$url."&";
	if(substr_count($url,"?")==0){
		$urls=$url."?";
	}
	foreach($campo as $index=> $y){
		echo'<input type="hidden" name="'.$index.'" value="'.$y.'">';
		$urls=$urls.$index."=".$y."&";
	}
	echo'</form>';
	echo'<script>';
	echo'document.datos.submit();';
	echo'document.getElementById("datos").submit();';
	echo'</script>';
	redirect($urls,0);
}
function redirect($url,  $delay=0) {

    $path="http://".$_SERVER['HTTP_HOST']."/CVLv0.1/WEBSIV/Vista";

	//echo  $path;
    $url = html_entity_decode($url);
    $url = str_replace(array("\n", "\r"), '', $url); // some more cleaning
    $encodedurl = htmlentities($url);
    $tmpstr = clean_text('<a href="'.$encodedurl.'" target="_top"/>'); //clean encoded URL
	$encodedurl = substr($tmpstr, 9, strlen($tmpstr)-13);
    $url = html_entity_decode($encodedurl);
    $surl = addslashes($url);

    if (!defined('HEADER_PRINTED')) {

       if (!preg_match('|^[a-z]+:|', $url)) {
            // Get host name http://www.wherever.com
            $hostpart = preg_replace('|^(.*?[^:/])/.*$|', '$1', $path);
            if (preg_match('|^/|', $url)) {
                // URLs beginning with / are relative to web server root so we just add them in
                $url = $hostpart.$url;
            } else {
                // URLs not beginning with / are relative to path of current script, so add that on.
                $url = $hostpart.preg_replace('|\?.*$|','',me()).'/../'.$url;
            }
			// Replace all ..s
            while (true) {
                $newurl = preg_replace('|/(?!\.\.)[^/]*/\.\./|', '/', $url);
                if ($newurl == $url) {
                    break;
                }
                $url = $newurl;
            }
		}
		@header($_SERVER['SERVER_PROTOCOL']. '303 See Other'); //302 might not work for POST requests, 303 is ignored by obsolete clients
        @header('Location: '.$url);
        echo '<meta http-equiv="refresh" content="'. $delay .'; url='. $encodedurl .'" />';
        echo '<script type="text/javascript">'. "\n" .'//<![CDATA['. "\n". "location.replace('$surl');". "\n". '//]]>'. "\n". '</script>';   // To cope with Mozilla bug
        die;
    }
}
function clean_text($text) {

    $ALLOWED_TAGS ='<p><br><b><i><u><font><table><tbody><span><div><tr><td><th><ol><ul><dl><li><dt><dd><h1><h2><h3><h4><h5><h6><hr><img><a><strong><emphasis><em><sup><sub><address><cite><blockquote><pre><strike><param><acronym><nolink><lang><tex><algebra><math><mi><mn><mo><mtext><mspace><ms><mrow><mfrac><msqrt><mroot><mstyle><merror><mpadded><mphantom><mfenced><msub><msup><msubsup><munder><mover><munderover><mmultiscripts><mtable><mtr><mtd><maligngroup><malignmark><maction><cn><ci><apply><reln><fn><interval><inverse><sep><condition><declare><lambda><compose><ident><quotient><exp><factorial><divide><max><min><minus><plus><power><rem><times><root><gcd><and><or><xor><not><implies><forall><exists><abs><conjugate><eq><neq><gt><lt><geq><leq><ln><log><int><diff><partialdiff><lowlimit><uplimit><bvar><degree><set><list><union><intersect><in><notin><subset><prsubset><notsubset><notprsubset><setdiff><sum><product><limit><tendsto><mean><sdev><variance><median><mode><moment><vector><matrix><matrixrow><determinant><transpose><selector><annotation><semantics><annotation-xml><tt><code>';

  	/// Fix non standard entity notations
    $text = preg_replace('/(&#[0-9]+)(;?)/', "\\1;", $text);
    $text = preg_replace('/(&#x[0-9a-fA-F]+)(;?)/', "\\1;", $text);

	/// Remove tags that are not allowed
    $text = strip_tags($text, $ALLOWED_TAGS);

	/// Clean up embedded scripts and , using kses
    $text = cleanAttributes($text);

	/// Again remove tags that are not allowed
    $text = strip_tags($text, $ALLOWED_TAGS);

	/// Remove script events
    $text = eregi_replace("([^a-z])language([[:space:]]*)=", "\\1Xlanguage=", $text);
    $text = eregi_replace("([^a-z])on([a-z]+)([[:space:]]*)=", "\\1Xon\\2=", $text);

    return $text;

}
function cleanAttributes($str){
    $result = preg_replace_callback("%(<[^>]*(>|$)|>)%m", "cleanAttributes2",$str);
    return  $result;
}
function cleanAttributes2($htmlArray){
    $ALLOWED_PROTOCOLS = array('http', 'https', 'ftp', 'news', 'mailto', 'rtsp', 'teamspeak', 'gopher', 'mms',
                           'color', 'callto', 'cursor', 'text-align', 'font-size', 'font-weight', 'font-style',
                           'border', 'margin', 'padding', 'background');
    require_once('kses.php');
    $htmlTag = $htmlArray[1];
    if (substr($htmlTag, 0, 1) != '<') {
        return '&gt;';  //a single character ">" detected
    }
    if (!preg_match('%^<\s*(/\s*)?([a-zA-Z0-9]+)([^>]*)>?$%', $htmlTag, $matches)) {
        return ''; // It's seriously malformed
    }
    $slash = trim($matches[1]); //trailing xhtml slash
    $elem = $matches[2];    //the element name
    $attrlist = $matches[3]; // the list of attributes as a string

    $attrArray = kses_hair($attrlist, $ALLOWED_PROTOCOLS);

    $attStr = '';
    foreach ($attrArray as $arreach) {
        $arreach['name'] = strtolower($arreach['name']);
        if ($arreach['name'] == 'style') {
            $value = $arreach['value'];
            while (true) {
                $prevvalue = $value;
                $value = kses_no_null($value);
                $value = preg_replace("/\/\*.*\*\//Us", '', $value);
                $value = kses_decode_entities($value);
                $value = preg_replace('/(&#[0-9]+)(;?)/', "\\1;", $value);
                $value = preg_replace('/(&#x[0-9a-fA-F]+)(;?)/', "\\1;", $value);
                if ($value === $prevvalue) {
                    $arreach['value'] = $value;
                    break;
                }
            }
            $arreach['value'] = preg_replace("/j\s*a\s*v\s*a\s*s\s*c\s*r\s*i\s*p\s*t/i", "Xjavascript", $arreach['value']);
            $arreach['value'] = preg_replace("/e\s*x\s*p\s*r\s*e\s*s\s*s\s*i\s*o\s*n/i", "Xexpression", $arreach['value']);
        } else if ($arreach['name'] == 'href') {
            //Adobe Acrobat Reader XSS protection
            $arreach['value'] = preg_replace('/(\.(pdf|fdf|xfdf|xdp|xfd))[^a-z0-9_\.\-].*$/i', '$1', $arreach['value']);
        }
        $attStr .=  ' '.$arreach['name'].'="'.$arreach['value'].'"';
    }

    $xhtml_slash = '';
    if (preg_match('%/\s*$%', $attrlist)) {
        $xhtml_slash = ' /';
    }
    return '<'. $slash . $elem . $attStr . $xhtml_slash .'>';
}
function me() {

    if (!empty($_SERVER['REQUEST_URI'])) {
        return $_SERVER['REQUEST_URI'];

    } else if (!empty($_SERVER['PHP_SELF'])) {
        if (!empty($_SERVER['QUERY_STRING'])) {
            return $_SERVER['PHP_SELF'] .'?'. $_SERVER['QUERY_STRING'];
        }
        return $_SERVER['PHP_SELF'];

    } else if (!empty($_SERVER['SCRIPT_NAME'])) {
        if (!empty($_SERVER['QUERY_STRING'])) {
            return $_SERVER['SCRIPT_NAME'] .'?'. $_SERVER['QUERY_STRING'];
        }
        return $_SERVER['SCRIPT_NAME'];

    } else if (!empty($_SERVER['URL'])) {     // May help IIS (not well tested)
        if (!empty($_SERVER['QUERY_STRING'])) {
            return $_SERVER['URL'] .'?'. $_SERVER['QUERY_STRING'];
        }
        return $_SERVER['URL'];

    } else {
        return false;
    }
}

function  validarUnique($msjOperacion,$url){
    if(substr($msjOperacion, 0, 9)=='Duplicate'){
    $msjOperacion=split("'", $msjOperacion);
    return "<label style='font-size:12px;color:red'>Error de Duplicidad!... El dato '".$msjOperacion[1]."' ya est&aacute; registrado</label>";
    }else{f_redireccionar($url);
        return "";
   }
}

function  validarUniqueControl($msjOperacion,$url){
    if(substr($msjOperacion, 0, 9)=='Duplicate'){
    $msjOperacion=split("'", $msjOperacion);
    f_redireccionar($url);
    return "<label id='msjOperacionVisible' style='font-size:12px;color:red'>Error de Duplicidad!... El dato '".$msjOperacion[1]."' ya est&aacute; registrado</label>";
    }else{f_redireccionar($url);
        return "";
   }
}



function f_table_head_modules($width){
echo '<link type="text/css" rel="stylesheet" href="../../recursos/css/css_borders.css" />';
echo '<link type="text/css" rel="stylesheet" href="../../recursos/css/css_ioteca.css" />';
echo '<table style="margin-right:20px;margin-left:0px; margin-top:30px;" border="0" width="'.$width.'%"  cellpadding="0" cellspacing="0">';
echo '<tr>';
echo '<td class="fnd_top_left"></td>';
echo '<td class="fnd_top_middle"></td>';
echo '<td class="fnd_top_right"></td>';
echo '</tr>';
echo '<tr >';
echo '<td class="fnd_middle_left"></td>';
echo '<td style="background:white;" width="'.$width.'%" align="center" >';
}
function f_table_foot_modules(){
echo '</td>';
echo '<td class="fnd_middle_right"></td>';
echo '</tr>';
echo '<tr>';
echo '<td class="fnd_bottom_left"></td>';
echo '<td class="fnd_bottom_middle"></td>';
echo '<td class="fnd_bottom_right"></td>';
echo '</tr>';
echo '</table>';
}
?>
