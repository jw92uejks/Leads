<?php

namespace App\Enums;

enum UserRole: int
{
    case BROKER = 2;
    case SUPPLIER = 3;
    case ENTERPRISE = 5;
    case ADMIN = 8;
    case SUADMIN = 9;

    public function label(): string
    {
        return match($this) {
            self::BROKER => 'Corretor',
            self::SUPPLIER => 'Fornecedor',
            self::ENTERPRISE => 'Empresa',
            self::ADMIN => 'Administrador',
            self::SUADMIN => 'Super Administrador',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::BROKER => 'Usuário corretor com acesso ao marketplace',
            self::SUPPLIER => 'Fornecedor de leads e serviços',
            self::ENTERPRISE => 'Empresa com plano enterprise',
            self::ADMIN => 'Administrador do sistema',
            self::SUADMIN => 'Super administrador com acesso total',
        };
    }
}
