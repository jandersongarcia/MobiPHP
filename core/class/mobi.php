<?php

namespace Core;

class Mobi
{

    public function __construct()
    {
        $this->loadPage();
    }

    public function counter($tempo_inicial = '')
    {
        $tempo_final = microtime(true);
        $tempo_total = $tempo_final - $tempo_inicial;
        $tempo_formatado = number_format($tempo_total, 3);
        echo $tempo_formatado;
    }

    private function uriFirst($n = 0)
    {
        #
        # Captures the first path of the uri
        #

        $uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($uri, PHP_URL_PATH);
        $parts = explode('/', trim($path, '/'));
        $primeiroValor = $parts[$n];
        return $primeiroValor;
    }

    private function loadPage()
    {

        #
        #   Handles page loading
        #
        $uri = $this->uriFirst();
        $page = (array_key_exists($uri, ROUTES)) ? ROUTES[$uri] : ROUTES['404'];
        if ($uri == 'code') {
            echo $this->build();
        } elseif (file_exists("pages/$page/$page.php")) {
            $_SESSION['ROUTE'] = $page;
            $m = new components();
            require_once("pages/$page/$page.php");
        } else {
            $_SESSION['ROUTE'] = false;
            echo "route error $page";
        }
    }

    private function build()
    {
        #
        #   Build css or js
        #
        $uri = $this->uriFirst(1);

        if ($uri == 'mobi.css') {

            $code = $this->rootStyle();
            $code .= $this->loadComponentsCSS();
            $code .= $this->loadPageCSS();
            $minifier = new \MatthiasMullie\Minify\CSS($code);
            echo $minifier->minify();

        } else if ($uri == 'mobi.js') {

            $code = $this->mobiJS();
            $code .= $this->rootScript();
            $code .= $this->loadComponentsJS();
            $code .= $this->loadPageJS();
            $minifier = new \MatthiasMullie\Minify\JS($code);
            $hunter = new HunterObfuscator($minifier->minify());
            $obsfucated = $hunter->Obfuscate();
            echo $obsfucated;

        }
    }

    private function loadPageCSS()
    {

        $array = $_SESSION['ROOT_COMPONENT'];

        if (is_array($array)) {
            $returnCSS = '';
            foreach ($array as $key => $value) {
                $file = "pages/$value/$value.css";
                if (file_exists($file)) {
                    $content = file_get_contents($file);
                    header('Content-Type: text/css');
                    $returnCSS .= $content;
                }
            }
            return $returnCSS;
        }
    }

    private function loadPageJS()
    {

        $array = $_SESSION['ROOT_COMPONENT'];

        if (is_array($array)) {
            $returnJS = '';
            foreach ($array as $key => $value) {
                $file = "pages/$value/$value.js";
                if (file_exists($file)) {
                    $content = file_get_contents($file);
                    $returnJS .= $content;
                }
            }
            return $returnJS;
        }
    }

    private function loadComponentsCSS()
    {

        $array = $_SESSION['ROOT_COMPONENT'];

        if (is_array($array)) {
            $returnCSS = '';
            foreach ($array as $key => $value) {
                $file = "components/$value/$value.css";
                if (file_exists($file)) {
                    $content = file_get_contents($file);
                    header('Content-Type: text/css');
                    $returnCSS .= $content;
                }
            }
            return $returnCSS;
        }
    }

    private function loadComponentsJS()
    {

        $array = $_SESSION['ROOT_COMPONENT'];

        if (is_array($array)) {
            $returnJS = '';
            foreach ($array as $key => $value) {
                $rootScript = "components/$value/$value.js";
                if (file_exists($rootScript)) {
                    $fileJS = $rootScript;
                    $contentJS = file_get_contents($fileJS);
                    return $contentJS;
                }
            }
            return $returnJS;
        }
    }

    private function rootStyle()
    {
        #
        #   Checks if exists and loads rootStyle.css file
        #
        $rootStyle = "public/css/rootStyle.css";

        if (file_exists($rootStyle)) {
            $fileCSS = $rootStyle;
            $contentCSS = file_get_contents($fileCSS);
            header('Content-Type: text/css');
            return $contentCSS;
        }

    }

    private function rootScript()
    {
        #
        #   Checks if exists and loads rootScript.css file
        #
        $rootScript = "public/js/rootScript.js";

        if (file_exists($rootScript)) {
            $fileJS = $rootScript;
            $contentJS = file_get_contents($fileJS);
            return $contentJS;
        }

    }

    private function mobiJS()
    {
        #
        #   Checks if exists and loads rootScript.css file
        #
        $rootScript = "core/js/mobi.js";

        if (file_exists($rootScript)) {
            $fileJS = $rootScript;
            $contentJS = file_get_contents($fileJS);
            return $contentJS;
        }

    }

}