<?php

namespace App\Services;

class WhatsAppLeadService
{
    public function getLeadsView(): string
    {
        return 'mobile.leads.list';
    }

    public function getCreateLeadView(): string
    {
        return 'mobile.leads.create';
    }
}

