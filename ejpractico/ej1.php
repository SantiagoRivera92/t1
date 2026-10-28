<?php

function br(): void
{
    echo "<br>";
}

function h1($cadena):void
{
    echo "<h1>" . $cadena . "</h1>";
}

function p($cadena):void
{
    echo "<p>" . $cadena . "</p>";
}

function letraDni($dni):string
{
    return substr($dni, 8);
}
?>