<?php

namespace Modules\Core\Entities;

use App\Models\User as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use League\Glide\Server;
use Modules\CRM\Entities\Account;
use Modules\CMS\Entities\Article;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'account_id',
        'username',
        'slug',
        'name',
        'name_title',
        'first_name',
        'middle_name',
        'last_name',
        'name_extension',
        'email',
        'password',
        'gender',
        'birth_date',
        'mobile_number',
        'phone_number',
        'owner',
        'is_superuser',
        'is_staff',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'owner' => 'boolean',
        'is_superuser' => 'boolean',
        'is_staff' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'full_name',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function getFullNameAttribute()
    {
        $full_name = ucfirst($this->first_name);

        if ($this->middle_name)
        {
            $full_name .= ' ' . ucfirst($this->middle_name);
        }

        $full_name .= ' ' . ucfirst($this->last_name);

        if ($this->name_extension)
        {
            $full_name .= ' ' . strtoupper($this->name_extension);
        }

        return $full_name;
    }

    /* public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    } */

    public function photoUrl(array $attributes)
    {
        if ($this->photo_path) {
            return URL::to(App::make(Server::class)->fromPath($this->photo_path, $attributes));
        }
    }

    public function isDemoUser()
    {
        return $this->email === 'johndoe@example.com';
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('last_name')->orderBy('first_name');
    }

    public function scopeWhereRole($query, $role)
    {
        switch ($role) {
            case 'user': return $query->where('owner', false);
            case 'owner': return $query->where('owner', true);
        }
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        })->when($filters['role'] ?? null, function ($query, $role) {
            $query->whereRole($role);
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
