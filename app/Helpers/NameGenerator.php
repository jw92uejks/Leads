<?php

namespace App\Helpers;

use Faker\Factory as FakerFactory;

class NameGenerator
{
    private static $faker;

    public static function getName(): string
    {
        if (!self::$faker) {
            self::$faker = FakerFactory::create('pt_BR');
        }

        $name = self::$faker->name();

        // Remove pronomes de tratamento de forma mais agressiva
        $patterns = [
            '/^(Sr\.|Sra\.|Sr |Sra |Dr\.|Dr |Dra\.|Dra |Prof\.|Prof |Profa\.|Profa |Eng\.|Eng |Srta\.|Srta )\s*/i',
            '/\s*(filho|Jr\.|Jr |neto|Sobrinho|Sobrinha|II|III|IV|V)$/i',
            '/\s*(filho|Jr\.|Jr |neto|Sobrinho|Sobrinha|II|III|IV|V)\s*/i'
        ];

        foreach ($patterns as $pattern) {
            $name = preg_replace($pattern, ' ', $name);
        }

        return trim(preg_replace('/\s+/', ' ', $name));
    }

    public static function getCompanyName(): string
    {
        if (!self::$faker) {
            self::$faker = FakerFactory::create('pt_BR');
        }

        return self::$faker->company();
    }
}
