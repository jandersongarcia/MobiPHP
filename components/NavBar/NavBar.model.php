<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   $action = $_POST['action'];

   // Realiza a alteração do idioma
   if($action == 'changeLanguage'){

      $lang = @$_POST['language'];

      if($lang != ''){

         // Verifica se o idioma selecionado existe

         if(file_exists("lang/$lang.php")){

            $_SESSION['LANG'] = $lang;

            $message = ['status'=>'concluded','message'=>'concluded'];

         } else {

            $message = ['status'=>'error','message'=>'language not localized'];
         }

         echo json_encode($message,JSON_UNESCAPED_UNICODE);
      }

   }

} else {
   $message = ['message' => 'Forbidden page access mode'];
   echo json_encode($message);
}