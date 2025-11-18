<?php

namespace App\Helpers;

class PhoneHelper
{
    private const DEFAULT_DDI = '55';

    public static function cleanPhone(?string $phone): ?string
    {
        if (empty($phone)) {
            return null;
        }

        return preg_replace('/[^0-9]/', '', $phone);
    }

    public static function toJid(?string $phone): ?string
    {
        if (empty($phone)) {
            return null;
        }

        $cleaned = self::cleanPhone($phone);

        if (empty($cleaned)) {
            return null;
        }

        if (str_starts_with($cleaned, self::DEFAULT_DDI)) {
            return $cleaned;
        }

        return self::DEFAULT_DDI . $cleaned;
    }

    public static function fromJid(?string $jid): ?string
    {
        if (empty($jid)) {
            return null;
        }

        $cleaned = self::cleanPhone($jid);

        if (str_starts_with($cleaned, self::DEFAULT_DDI)) {
            return substr($cleaned, 2);
        }

        return $cleaned;
    }

    public static function formatPhone(?string $phone): ?string
    {
        if (empty($phone)) {
            return null;
        }

        $cleaned = self::cleanPhone($phone);

        if (str_starts_with($cleaned, self::DEFAULT_DDI)) {
            $cleaned = substr($cleaned, 2);
        }

        if (strlen($cleaned) === 11) {
            return sprintf('(%s) %s-%s',
                substr($cleaned, 0, 2),
                substr($cleaned, 2, 5),
                substr($cleaned, 7, 4)
            );
        }

        if (strlen($cleaned) === 10) {
            return sprintf('(%s) %s-%s',
                substr($cleaned, 0, 2),
                substr($cleaned, 2, 4),
                substr($cleaned, 6, 4)
            );
        }

        return $cleaned;
    }

    public static function getDDD(?string $phone): ?string
    {
        if (empty($phone)) {
            return null;
        }

        $cleaned = self::cleanPhone($phone);

        if (str_starts_with($cleaned, self::DEFAULT_DDI)) {
            $cleaned = substr($cleaned, 2);
        }

        if (strlen($cleaned) >= 10) {
            return substr($cleaned, 0, 2);
        }

        return null;
    }

    public static function searchVariations(string $phone): array
    {
        $cleaned = self::cleanPhone($phone);

        if (empty($cleaned)) {
            return [];
        }

        $variations = [$cleaned];

        if (strlen($cleaned) === 10 || strlen($cleaned) === 11) {
            $variations[] = self::DEFAULT_DDI . $cleaned;
        }

        if (str_starts_with($cleaned, self::DEFAULT_DDI)) {
            $withoutDDI = substr($cleaned, 2);
            $variations[] = $withoutDDI;
        }

        $ddd = self::getDDD($cleaned);
        if ($ddd) {
            $variations[] = $ddd . '%';
        }

        return array_unique($variations);
    }

    public static function normalize(?string $phone): ?string
    {
        return self::toJid($phone);
    }

    public static function isValid(?string $phone): bool
    {
        if (empty($phone)) {
            return false;
        }

        $cleaned = self::cleanPhone($phone);

        if (str_starts_with($cleaned, self::DEFAULT_DDI)) {
            $cleaned = substr($cleaned, 2);
        }

        return in_array(strlen($cleaned), [10, 11]);
    }

    public static function toWhatsAppUrl(?string $phone): string
    {
        if (empty($phone)) {
            return '#';
        }

        $cleaned = self::cleanPhone($phone);

        if (empty($cleaned)) {
            return '#';
        }

        if (!str_starts_with($cleaned, self::DEFAULT_DDI)) {
            $cleaned = self::DEFAULT_DDI . $cleaned;
        }

        return "https://wa.me/{$cleaned}";
    }
}

