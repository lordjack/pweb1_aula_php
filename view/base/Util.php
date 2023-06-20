<?php
class Util
{
    public static function verificarLogin()
    {
        if (empty($_SESSION['nome'])) {
            session_start();
            session_destroy();
            header("Location: ../view/login.php");
        }
    }
}