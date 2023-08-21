<?php

# Load base initialization files

require_once('config/config.php');
#require_once('config/routes.php');
require_once('vendor/autoload.php');

# Configure the application language
if(empty($_SESSION['LANG'])) $_SESSION['LANG'] = @CONFIG['language'];
$lang = $_SESSION['LANG'];
require_once("lang/$lang.php");
use Lang\Language;

# Declare the namespaces of the Classes

use Core\Mobi;
use Core\DataBase;
use Core\components;
use Core\alerts;
use Core\HunterObfuscator;
use MatthiasMullie\Minify;

$lang = new Language();
ob_start();

$mobi = new Core\Mobi();
$html = ob_get_clean();

#   Starts hiding the page's HTML with Obfuscate
$startPos = strpos($html, '<obfuscate>');
$endPos = strpos($html, '</obfuscate>');

if ($startPos !== false && $endPos !== false && $endPos > $startPos) {
    $bodyContent = substr($html, $startPos + 11, $endPos - $startPos - 11);
    $hunter = new HunterObfuscator($bodyContent, true);
    $obsfucated = $hunter->Obfuscate();
    $html = substr_replace($html, "<script>$obsfucated</script>", $startPos + 11, $endPos - $startPos - 11);
    $search = ['<obfuscate>','</obfuscate>'];
    $clean = ['',''];
    $html = str_replace($search,$clean,$html);
    echo preg_replace( '/\s+/', ' ', $html );
} else {
    echo preg_replace( '/\s+/', ' ', $html );
}

