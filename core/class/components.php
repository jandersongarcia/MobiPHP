<?php

    namespace Core;

    class components{
        
        public function declareComponents($array){

            if (is_array($array)){
                $_SESSION['ROOT_COMPONENT'] = $array;
            }

        }

        public function loadComponent($array){

            if (is_array($array)){
                foreach($array as $key){
                    $file = "components/$key/$key.php";
                    $this->openComponent($file);
                }
            } else {
                $file = "components/$array/$array.php";
                $this->openComponent($file);
            }
            
        }

        private function openComponent($file){
            
            if(file_exists($file)){
                require_once($file);
            }
        }

    }
