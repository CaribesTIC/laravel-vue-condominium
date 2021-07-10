<?php

namespace App;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $footer_message;

    public static function group(): string
    {
        return "general";
    }
}
