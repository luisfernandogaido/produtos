<?php
/**
 * @return mysqli
 */
function conecta()
{
    return mysqli_connect('localhost', 'root', 'Semaver13', 'testevaga');
}

function site()
{
    $raiz = str_replace('\\', '/', RAIZ);
    $pastaProjeto = str_replace($_SERVER['DOCUMENT_ROOT'], '', $raiz);
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $pastaProjeto;
}