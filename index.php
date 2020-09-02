<?php

use FeatherWeight\Core;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use \Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

include 'vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Carrega o core do framework
|--------------------------------------------------------------------------
|
| Este arquivo index é a porta de entrada da nossa aplicação.
| Através dele o componente core é carregado, o que executa internamente
| todos os métodos necessários para responder a uma requisição http de 
| um cliente, enviando uma resposta para a requisição.
|
*/

// $core = new Core();



//TESTES

date_default_timezone_set('America/Sao_Paulo');

$whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();





$log = new Logger("featherWeightFramework");
$log->pushHandler(new StreamHandler('log/history.log'), Logger::WARNING);
// $log->warning('Foo');
// $log->error('Bar');

var_dump($_SERVER);
$log->log(200, 'acessado com sucesso', [$_SERVER['SERVER_NAME']]);


$dateTime = new DateTime();
$dateInterval = new DateInterval("P1W");
$datePerido = new DatePeriod($dateTime, $dateInterval, 5);
$dateTime->add($dateInterval);

echo PHP_EOL;


$str = "Iñtërnâtiônàlizaetion";
echo ($str).PHP_EOL;
echo mb_strlen($str).PHP_EOL;
echo strlen($str).PHP_EOL;




// throw new PDOException("erro de um negocio ai", 1);

try {
    // throw new Exception("erro de um negocio ai", 1);
    $str = fopen("aa");
    $conn = new PDO("aaaabugado", "root", "");

    $str = fopen("aa");


    echo $str;
} catch (Exception $e) {
     throw $e;
} catch (\Exception $a ){
    // throw $a;
}

echo ($str).PHP_EOL;


// $json = file_get_contents("https://viacep.com.br/ws/05821100/json/");
// echo $json;


foreach ($datePerido as $value) {
    echo $value->format("d-M-Y").PHP_EOL;
}
echo($datePerido->format("d-M-Y"));

