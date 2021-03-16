<?php

namespace App\Engine;

use App\Result;

interface EngineInterface
{
    public function search(string $term): Result;

    public static function getName(): String;
}