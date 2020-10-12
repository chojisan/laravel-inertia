<?php

namespace Modules\CRM\Entities;

use Modules\CRM\Entities\Model;
use Modules\Core\Entities\User;
use Modules\CRM\Entities\Organization;
use Modules\CRM\Entities\Contact;

class Account extends Model
{
    protected $table = 'crm_accounts';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
