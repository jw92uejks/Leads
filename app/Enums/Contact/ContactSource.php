<?php

namespace App\Enums\Contact;

enum ContactSource: string
{
    case MANUAL = 'manual';
    case LEAD_FUNNEL = 'lead_funnel';
    case IMPORT = 'import';
    case API = 'api';
    case LEAD_CONVERSION = 'lead_conversion';
    case GOOGLE_ADS = 'google_ads';
    case FACEBOOK = 'facebook';
    case INDICACAO = 'indicacao';
    case LINKEDIN = 'linkedin';
    case INSTAGRAM = 'instagram';
    case SITE = 'site';
    case OUTROS = 'outros';

    public function label(): string
    {
        return match ($this) {
            self::MANUAL => 'Manual',
            self::LEAD_FUNNEL => 'Funil de Leads',
            self::IMPORT => 'Importação',
            self::API => 'API',
            self::LEAD_CONVERSION => 'Conversão de Lead',
            self::GOOGLE_ADS => 'Google Ads',
            self::FACEBOOK => 'Facebook',
            self::INDICACAO => 'Indicação',
            self::LINKEDIN => 'LinkedIn',
            self::INSTAGRAM => 'Instagram',
            self::SITE => 'Site',
            self::OUTROS => 'Outros',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::MANUAL => 'ki-duotone ki-user',
            self::LEAD_FUNNEL => 'ki-duotone ki-funnel',
            self::IMPORT => 'ki-duotone ki-file-up',
            self::API => 'ki-duotone ki-code',
            self::LEAD_CONVERSION => 'ki-duotone ki-check-circle',
            self::GOOGLE_ADS => 'ki-duotone ki-google',
            self::FACEBOOK => 'ki-duotone ki-facebook',
            self::INDICACAO => 'ki-duotone ki-user-tick',
            self::LINKEDIN => 'ki-duotone ki-linkedin',
            self::INSTAGRAM => 'ki-duotone ki-instagram',
            self::SITE => 'ki-duotone ki-global',
            self::OUTROS => 'ki-duotone ki-more-horizontal',
        };
    }
}
