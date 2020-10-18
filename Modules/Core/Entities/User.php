<?php

namespace Modules\Core\Entities;

use App\Models\User as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Modules\CRM\Entities\Account;
use Modules\CMS\Entities\Article;
use Modules\Core\Filters\UserFilters;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
{
    use SoftDeletes;
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * Article id
     *
     * @return $id
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * A user belongs to an account.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * A user has many many articles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    /**
     * Access the full name of the user
     *
     * @return string
     */
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

    /**
     * User order by last_name and first_name
     *
     * @param [type] $query
     * @return void
     */
    public function scopeOrderByName($query)
    {
        $query->orderBy('last_name')->orderBy('first_name');
    }

    /**
     * Get user role
     *
     * @param [type] $query
     * @param [type] $role
     * @return void
     */
    public function scopeWhereRole($query, $role)
    {
        switch ($role) {
            case 'user': return $query->where('owner', false);
            case 'owner': return $query->where('owner', true);
        }
    }

    /**
     * Apply all relevant tag filters.
     *
     * @param  Builder       $query
     * @param  UserFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, UserFilters $filters)
    {
        return $filters->apply($query);
    }
}
