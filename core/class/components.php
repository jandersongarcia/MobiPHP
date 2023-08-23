<?php

namespace Core;

use Lang\Language;

class components
{

    public function declareComponents($array)
    {
        $returnCSS = '';
        if (is_array($array)) {
            $_SESSION['ROOT_COMPONENT'] = $array;
            foreach ($array as $key => $value) {
                $file = "components/$value/$value.css";
                if (file_exists($file)) {
                    $content = file_get_contents($file);
                    header('Content-Type: text/css');
                    $returnCSS .= $content;
                }
            }
            echo "<style>$returnCSS</style>";
        } else {
            $_SESSION['ROOT_COMPONENT'] = $array;
        }
    }

    public function loadComponent($array)
    {

        if (is_array($array)) {
            foreach ($array as $key) {
                $file = "components/$key/$key";
                $this->openComponent($file);
            }
        } else {
            $file = "components/$array/$array";
            $this->openComponent($file);
        }

        $this->loadJsComponent();

    }

    private function loadJsComponent()
    {
        $array = $_SESSION['ROOT_COMPONENT'];
        $code = '';
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $file = "components/$value/$value.js";
                if (file_exists($file)) {
                    $code .= file_get_contents($file);
                }
            }
            if($code != '')
                $minifier = new \MatthiasMullie\Minify\JS($code);
            if (CONFIG['obfuscate']['js']) {
                $hunter = new HunterObfuscator($minifier->minify());
                $obsfucated = $hunter->Obfuscate();
                $code = $obsfucated;
            }

            echo "<script>$code</script>";
        }

    }

    private function openComponent($file)
    {
        $lang = new Language();
        $mobi = new Mobi();
        $m = new components();
        if (file_exists("$file.php")){
            require_once("$file.php");
        } else {
            $mobi->logError('Caution',"Component ($file.php) not found");
        }
    }

}