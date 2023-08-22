<?php

namespace Core;

use lang\Language;

class Mobi
{

    public function __construct()
    {
        $this->uniqId();
        $this->loadPage($this);
    }

    public function counter($tempo_inicial = '')
    {
        $tempo_final = microtime(true);
        $tempo_total = $tempo_final - $tempo_inicial;
        $tempo_formatado = number_format($tempo_total, 3);
        echo $tempo_formatado;
    }

    public function uniqId()
    {
        if (empty($_SESSION['LANG']))
            $_SESSION['LANG'] = md5(uniqid());
    }

    public function language()
    {
        /**
         * DEFINE THE LANGUAGE CLASS
         */
        return CONFIG['language'];
    }

    private function uriFirst($n = 0)
    {
        #
        # CAPTURES THE FIRST PATH OF THE URI
        #

        $uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($uri, PHP_URL_PATH);
        $parts = explode('/', trim($path, '/'));
        $primeiroValor = @$parts[$n];
        return $primeiroValor;
    }

    private function loadPage($mobi)
    {


        $uri = $this->uriFirst();
        $lang = new Language();
        $error = new errorMessage();
        #
        #   HANDLES PAGE LOADING
        #

        if ($uri == 'code') {
            echo $this->build();
        } else if ($uri == 'mobiPost') {

            $component = $this->uriFirst(1);
            $path = "components/$component/$component.model.php";
            if (file_exists($path)) {
                require_once($path);
            }

        } else if ($uri == 'mobiComponent') {

            $page = $this->uriFirst(1);
            if (file_exists("components/$page/$page.model.php")) {
                require("components/$page/$page.model.php");
            } else {
                $message = ["message" => "The component not found"];
                echo json_encode($message, true);

            }

        } else if ($uri == 'mobiLoadPage') {
            $page = $this->uriFirst(1);
            if (file_exists("src/pages/$page/$page.php")) {

                $m = new components();

                echo "<div id='m$page'>";

                if (file_exists("src/pages/$page/$page.css")) {
                    echo "<style>@import '/code/mobiComponent/css/$page'</style>";
                }

                require_once("src/pages/$page/$page.php");

                if (file_exists("src/pages/$page/$page.js")) {
                    echo '<script src="/code/mobiComponent/js/' . $page . '"></script>';
                }

                echo "</div>";
            } else {
                echo "route error $page";
            }

        } else {
            if (file_exists('src/app.php')) {
                require_once('src/app.php');
            } else {
                $this->logError('Critical', "Page (src/app.php) not found");
                $title = "Critical Error";
                $messageError = "The <em>app.php</em> Page was not found within the <em>src</em> directory. It is necessary for the full functioning of the application.";
                require_once("core/template/error.php");
                exit;
            }

        }

    }

    private function build()
    {
        #
        #   BUILD CSS OR JS
        #
        $uri = $this->uriFirst(1);

        if ($uri == 'mobi.css') {
            /**
             * Carrega o css de todas as páginas
             */
            $code = $this->rootStyle();
            $code .= $this->loadPageCSS();
            $minifier = new \MatthiasMullie\Minify\CSS($code);
            echo $minifier->minify();

        } else if ($uri == 'mobi.js') {

            $code = $this->mobiJS();
            $code .= $this->rootScript();
            $code .= $this->loadPageJS();
            $minifier = new \MatthiasMullie\Minify\JS($code);
            if (CONFIG['obfuscate']['js']) {
                $hunter = new HunterObfuscator($minifier->minify());
                $obsfucated = $hunter->Obfuscate();
                echo $obsfucated;
            } else {
                echo $minifier->minify();
            }

        } else if ($uri == 'mobiComponent') {

            $type = @$this->uriFirst(2);
            $page = @$this->uriFirst(3);

            $code = '';

            if ($type == 'css') {
                $code = $this->rootStyle();
                $code .= $this->loadPageCSS();
                $code .= $this->loadComponentsCSS();
            } else if ($type == 'js') {
                #$code = $this->loadComponentsJS();
            }

            echo $code;

        }

    }

    private function loadPageCSS($local = false)
    {

        /**
         * Carrega CSS padrão do Mobi
         */
        $content = '';
        $filePath = 'core/css/mobi.css';
        if (file_exists($filePath)) {
            $file = file_get_contents($filePath);
            if ($file !== false) {
                #$content .= $file;
            }
        }
        /**
         * Carrega arquivos locais declarados
         */
        if ($local) {
            $file = "src/pages/$local/$local.css";
            if (file_exists($file)) {
                #$content .= file_get_contents($file);
            }
        } else {
            $routesFilePath = 'core/json/routes.json';
            $routesData = json_decode(file_get_contents($routesFilePath), true);

            foreach ($routesData as $key => $value) {
                $file = "src/pages/$value/$value.css";
                if (file_exists($file)) {
                    $content .= file_get_contents($file);
                }
            }
        }

        header('Content-Type: text/css');
        return $content;

    }

    private function loadPageJS($local = false)
    {
        $code = '';
        if ($local) {
            $file = "src/pages/$local/$local.js";
            if (file_exists($file)) {
                $code = file_get_contents($file);
                $minifier = new \MatthiasMullie\Minify\JS($code);
                return $minifier;
            }
        } else {
            $returnJS = '';
            $routesFilePath = 'core/json/routes.json';
            $routesData = json_decode(file_get_contents($routesFilePath), true);

            foreach ($routesData as $key => $value) {
                $file = "src/pages/$value/$value.js";
                if (file_exists($file)) {
                    $code .= file_get_contents($file);
                }
            }

            return $code;

            #$minifier = new \MatthiasMullie\Minify\JS($code);
            #return $minifier;
        }
    }

    private function loadComponentsCSS($local = false)
    {

        $array = @$_SESSION['ROOT_COMPONENT'];

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

        $array = @$_SESSION['ROOT_COMPONENT'];

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
        $rootStyle = ["public/css/rootStyle.css", "core/css/mobi.css"];
        $css = '';
        foreach ($rootStyle as $value) {
            if (file_exists($value)) {
                $fileCSS = $value;
                $css .= file_get_contents($fileCSS);
                #header('Content-Type: text/css');
                #return $contentCSS;
            }
        }

        echo $css;

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
        $rootScript = [
            "core/js/storage.js",
            "core/js/routes.js",
            "core/js/mobi.js"
        ];

        $contentJS = '';

        foreach ($rootScript as $rootScript) {
            if (file_exists($rootScript)) {
                $fileJS = $rootScript;
                $contentJS .= file_get_contents($fileJS);
            }
        }

        return $contentJS;
    }

    public function logError($type, $message)
    {
        $logMessage = date('Y-m-d H:i:s') . " | $type | $message" . PHP_EOL;
        file_put_contents('mobiError.log', $logMessage, FILE_APPEND);
    }

}