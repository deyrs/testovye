<?php

spl_autoload_register('autoload');

function autoload($className)
{
      require __DIR__ . '/../' .
            str_replace('\\', '/', $className)
            . '.php';
}