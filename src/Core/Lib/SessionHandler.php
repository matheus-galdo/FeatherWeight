<?php

namespace App\Config;

use Twig\Profiler\Profile;

class SessionHandler{
    public function __construct()
    {
        session_start();

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            session_unset();
            session_destroy();
        }
        $_SESSION['LAST_ACTIVITY'] = time();
    }

    public function Authorize(array $profile = [])
    {
        if (count($profile) > 0 && !in_array($_SESSION['profile'], $profile)) {
            $_SESSION['message'] = "Acesso negado. Você não tem autorização para visualizar este conteúdo";
            header("Location: ../login");
        }
        if(!isset($_SESSION['logged'])){
            $_SESSION['message'] = "Acesso negado. Você não está logado";
            header("Location: ../login");
        }
    }

    public function getErrorMessage(string $customError = null)
    {
        if (isset($customError)) {
            return $customError;
        }
        return isset($_SESSION['message'])?$_SESSION['message']:""; 
    }

    public function setErrorMessage(string $message)
    {
        $_SESSION['message'] = $message;
    }
}
