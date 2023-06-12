<?php

function verificarLogin()
{
    if (empty($_SESSION['nome'])) {
        session_start();
        session_destroy();
        header("location: login.php?erro=Acesso Negado!");
    }
}
