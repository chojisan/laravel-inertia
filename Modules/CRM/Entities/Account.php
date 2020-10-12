<?php

namespace Modules\CRM\Entities;

use Modules\CRM\Entities\Model;
use Modules\Core\Entities\User;
use Modules\CRM\Entities\Organization;
use Modules\CRM\Entities\Contact;

class Account extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'crm_accounts';

    /**
     * An account has many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * An account has many organizations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

     /**
     * An account has many contacts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
