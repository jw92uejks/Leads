<?php

namespace App\Models;

use App\Enums\Lead\LeadType;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens; // Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'ucode',
        'phone',
        'avatar',
        'cpf',
        'cnpj',
        'type',
        'selected_menu',
        'current_state',
        'whatsapp_phone',
        'whatsapp_verified_at',
        'device_fingerprint',
        'allow_multiple_devices',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role_id' => 'integer',
            'type' => LeadType::class,
            'selected_menu' => 'integer',
            'whatsapp_verified_at' => 'datetime',
            'allow_multiple_devices' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function setPhoneAttribute(?string $value): void
    {
        $this->attributes['phone'] = \App\Helpers\PhoneHelper::toJid($value);
    }

    public function getPhoneFormattedAttribute(): ?string
    {
        return \App\Helpers\PhoneHelper::formatPhone($this->phone);
    }

    public function getPhoneJidAttribute(): ?string
    {
        return $this->phone;
    }

    public function scopeByPhone($query, string $phone)
    {
        $variations = \App\Helpers\PhoneHelper::searchVariations($phone);

        return $query->where(function($q) use ($variations) {
            foreach ($variations as $variation) {
                if (str_contains($variation, '%')) {
                    $q->orWhere('phone', 'like', $variation);
                } else {
                    $q->orWhere('phone', $variation);
                }
            }
        });
    }

    /**
     * Get the broker associated with the user.
     */
    public function broker(): HasOne
    {
        return $this->hasOne(Broker::class);
    }

    /**
     * Get the supplier associated with the user.
     */
    public function supplier(): HasOne
    {
        return $this->hasOne(Supplier::class);
    }

    /**
     * Check if the user is a broker.
     */
    public function isBroker(): bool
    {
        return $this->broker()->exists();
    }

    /**
     * Check if the user is a supplier.
     */
    public function isSupplier(): bool
    {
        return $this->supplier()->exists();
    }

    /**
     * Check if the user has a basic plan (no active subscription).
     */
    public function isBasicPlan(): bool
    {
        return !$this->hasActiveSubscription();
    }

    /**
     * Check if the user can create teams.
     */
    public function canCreateTeams(): bool
    {
        return !$this->isBasicPlan() && $this->canAccessTeamPanel();
    }

    /**
     * Check if the user can access connections (WhatsApp automation).
     */
    public function canAccessConnections(): bool
    {
        return !$this->isBasicPlan();
    }

    /**
     * Check if the user can access automations.
     */
    public function canAccessAutomations(): bool
    {
        return !$this->isBasicPlan();
    }

    /**
     * Check if the user can manage teams (create, edit, transfer).
     */
    public function canManageTeams(): bool
    {
        return !$this->isBasicPlan() && $this->canAccessTeamPanel();
    }

    /**
     * Check if the user has a specific role.
     */
    public function hasRole(string $role): bool
    {
        return match($role) {
            'basic' => $this->isBasicPlan(),
            'suadmin' => $this->role_id === UserRole::SUADMIN->value,
            'admin' => $this->role_id === UserRole::ADMIN->value,
            'enterprise' => $this->role_id === UserRole::ENTERPRISE->value,
            'supplier' => $this->role_id === UserRole::SUPPLIER->value,
            'broker' => $this->role_id === UserRole::BROKER->value,
            default => false
        };
    }

    /**
     * Get the payment links associated with the user.
     */
    public function paymentLinks(): HasMany
    {
        return $this->hasMany(\App\Models\PaymentLink::class);
    }

    /**
     * Check if the user has an active subscription.
     */
    public function hasActiveSubscription(): bool
    {
        return $this->broker
               && $this->broker->is_active
               && $this->broker->subscription_expires_at
               && $this->broker->subscription_expires_at->isFuture();
    }

    /**
     * Check if the user can access team panel.
     */
    public function canAccessTeamPanel(): bool
    {
        return $this->hasActiveSubscription() &&
               $this->broker &&
               $this->broker->subscription &&
               $this->broker->subscription->has_team_access;
    }

    /**
     * Check if the user can access enterprise panel.
     */
    public function canAccessEnterprisePanel(): bool
    {
        return $this->hasActiveSubscription() &&
               $this->broker &&
               $this->broker->subscription &&
               $this->broker->subscription->has_enterprise_access;
    }


    public function getCustomerDataForPayment(): array
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->phone) {
            $data['phone'] = $this->phone;
        }

        if ($this->cpf) {
            $data['document'] = $this->cpf;
        } elseif ($this->cnpj) {
            $data['document'] = $this->cnpj;
        }

        return $data;
    }

    public function getPlanName(): string
    {
        if (!$this->broker || !$this->broker->plan_type) {
            return \App\Enums\PlanType::BASIC->label();
        }

        return $this->broker->plan_type->label();
    }

    public function isBasicPlanType(): bool
    {
        return !$this->broker ||
               !$this->broker->plan_type ||
               $this->broker->plan_type === \App\Enums\PlanType::BASIC;
    }

    public function isIndividualPlan(): bool
    {
        return $this->broker &&
               $this->broker->plan_type === \App\Enums\PlanType::INDIVIDUAL;
    }

    public function isTeamsPlan(): bool
    {
        return $this->broker &&
               $this->broker->plan_type === \App\Enums\PlanType::TEAMS;
    }

    public function isEnterprisePlan(): bool
    {
        return $this->broker &&
               $this->broker->plan_type === \App\Enums\PlanType::ENTERPRISE;
    }

    public function isWhatsAppVerified(): bool
    {
        return $this->whatsapp_verified_at !== null;
    }

    public function hasDeviceFingerprintMatch(string $fingerprint): bool
    {
        if ($this->allow_multiple_devices) {
            return true;
        }

        return $this->device_fingerprint === $fingerprint;
    }

    public function canResetWhatsAppVerification(): bool
    {
        return $this->isWhatsAppVerified();
    }

    public function allowsMultipleDevices(): bool
    {
        return $this->allow_multiple_devices === true;
    }
}
