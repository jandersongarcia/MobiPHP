<?php

# Load base initialization files
require_once('config/config.php');
require_once('config/routes.php');
require_once('vendor/autoload.php');

# Declare the namespaces of the Classes
use Core\Mobi;
use Core\DataBase;
use Core\components;
use Core\alerts;
use Core\HunterObfuscator;
use MatthiasMullie\Minify;

ob_start();

$mobi = new Core\Mobi();
$html = ob_get_clean();

#
#   Starts hiding the page's HTML with Obfuscate
#

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


# alerts::sendMessage('Olá Mundo!');
#$mobi->counter($initialize);
