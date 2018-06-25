<?php
/**
 * @return mysqli
 */
function conecta()
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = \mysqli_init();
    $mysqli->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
    $mysqli->real_connect('localhost', 'root', 'Semaver13', 'testevaga');
    $mysqli->set_charset('utf8');
    return $mysqli;
}

function site()
{
    $raiz = str_replace('\\', '/', RAIZ);
    $pastaProjeto = str_replace($_SERVER['DOCUMENT_ROOT'], '', $raiz);
    return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $pastaProjeto;
}

function erro()
{
    if (isset($_GET['erro'])) {
        echo '<div id="erro">' . htmlentities($_GET['erro']) . '</div>';
    }
}