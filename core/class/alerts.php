<?php

    namespace Core;

    use TelegramBot\Api\BotApi;

    class alerts {

        const TELEGRAM_BOT_TOKEN = CONFIG['botFather']['token'];
        const TELEGRAM_CHAT_ID = CONFIG['botFather']['update_id'];

        /**
         * Método responsável por enviar a mensagem de alerta
         * @param string
         * @return boolean
         */

        public static function sendMessage($message){

            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                $obBotApi = new BotApi(self::TELEGRAM_BOT_TOKEN);
                return $obBotApi->sendMessage(self::TELEGRAM_CHAT_ID, $message);
            }

        }

    }