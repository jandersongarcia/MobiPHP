<?php

# Load base initialization files

require_once('config/config.php');
#require_once('config/routes.php');
require_once('vendor/autoload.php');

# Declare the namespaces of the Classes
use Core\Mobi;
use Core\Internal;
use Core\components;
use Core\alerts;
use Core\errorMessage;
use Core\HunterObfuscator;
use MatthiasMullie\Minify;

# Configure the application language
if (empty($_SESSION['LANG']))
    $_SESSION['LANG'] = @CONFIG['language'];

$lang = $_SESSION['LANG'];
require_once("lang/$lang.php");
use Lang\Language;

$lang = new Language();
$error = new errorMessage();
ob_start();

# CONFIGURAÇÃO DO BANDO DE DADOS
$dataDB = CONFIG['database'];
if ($dataDB['use']) {
    $dbType = $dataDB['type'];
    if (file_exists("core/data/$dbType.php")) {
        require_once("core/data/$dbType.php");
        $mData = new mobiSQL($dataDB['servername'], $dataDB['username'], $dataDB['password'], $dataDB['database_name']);
        $connection = $mData->getConnection();
        
    } else {
        $title = $error->title;
        $messageError = $error->data_base_not_found($dbType); # "The database class <strong>$dbType</strong> was not found.<br/>Check that the database name is correct.";
        require_once("core/template/error.php");
        exit;
    }
}

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
    $search = ['<obfuscate>', '</obfuscate>'];
    $clean = ['', ''];
    $html = str_replace($search, $clean, $html);
    echo preg_replace('/\s+/', ' ', $html);
} else {
    echo preg_replace('/\s+/', ' ', $html);
}