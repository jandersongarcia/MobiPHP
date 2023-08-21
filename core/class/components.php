<?php

namespace Core;
use Lang\Language;

class components
{

    public function declareComponents($array)
    {

        if (is_array($array)) {
            $_SESSION['ROOT_COMPONENT'] = $array;
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

    }

    private function openComponent($file)
    {   
        $lang = new Language();
        require_once("$file.php");
    }

}