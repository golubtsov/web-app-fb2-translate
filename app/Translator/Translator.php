<?php

namespace App\Translator;

use Nigo\Translator\Translator\LibreTranslator;

class Translator extends LibreTranslator
{
    protected string $uri = 'http://192.168.1.5:5000/translate';
}
