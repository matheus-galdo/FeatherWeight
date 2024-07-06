<?php

namespace FeatherWeight\Config;

class Config
{
    public function __construct()
    {
        //load do arquivo config.json
        $configurations = json_decode(file_get_contents(__DIR__."/../../../config/config.json"));

        
        //app config
        define("APLICATION_NAME", $configurations->appName);
        define("MAIN_DIRECTORY", $configurations->mainDirectory);
        define("ENVIROMENT", $configurations->enviroment);
        define("SERVER_NAME", $configurations->server);
        define("DEFAULT_TIMEZONE", $configurations->timezone);

        //database config
        define("DB_DRIVER", $configurations->dbDriver);
        define("DB_HOST", $configurations->dbHost);
        define("DB_NAME", $configurations->dbName);
        define("DB_USER", $configurations->dbUser);
        define("DB_PASSWORD", $configurations->dbPassword);
        define("DB_CHARSET", $configurations->dbCharset);

        //mail config
        define("MAIL_MAILER", $configurations->MAIL_MAILER);
        define("MAIL_HOST", $configurations->MAIL_HOST);
        define("MAIL_PORT", $configurations->MAIL_PORT);
        define("MAIL_USERNAME", $configurations->MAIL_USERNAME);
        define("MAIL_PASSWORD", $configurations->MAIL_PASSWORD);
        define("MAIL_ENCRYPTION", $configurations->MAIL_ENCRYPTION);
        define("MAIL_FROM_ADDRESS", $configurations->MAIL_FROM_ADDRESS);
        define("MAIL_FROM_NAME", $configurations->MAIL_FROM_NAME);


        //definição de configurações básicas da aplicação
        header("charset=utf-8");
        date_default_timezone_set(DEFAULT_TIMEZONE);

    }
}

