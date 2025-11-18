<?php

namespace App\Enums\Lead;

enum LeadSource: string
{
    case SYSTEM = 'system';
    case API = 'api';
    case EXCEL = 'excel';
}
