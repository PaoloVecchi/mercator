<?php

namespace App;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use LdapRecord\Laravel\Auth\HasLdapUser;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * App\User
 */
class User extends Authenticatable implements LdapAuthenticatable
{
    use AuthenticatesWithLdap;
    use HasApiTokens;
    use HasLdapUser;
    use Notifiable;
    use SoftDeletes;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected array $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'granularity',
        'language',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Add some caching for roles
    private ?BelongsToMany $cachedRoles = null;

    /**
     * Check if the User has the 'Admin' role, which is the first role in the app
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->id === 1) {
                return true;
            }
        }
        return false;
    }

    public function roles(): BelongsToMany
    {
        if ($this->cachedRoles === null) {
            $this->cachedRoles = $this->belongsToMany(Role::class);
        }
        return $this->cachedRoles;
    }

    /**
     * Check si un utilisateur a un role
     *
     * @param String|Role $role
     *
     * @return bool
     */
    public function hasRole(mixed $role): bool
    {
        if ($role instanceof Role) {
            return $this->roles()->get()->contains($role);
        }
        if (is_string($role)) {
            return $this->roles()->get()->contains(Role::whereTitle($role)->first());
        }
        return false;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
    public function m_applications() : BelongsToMany
    {
        return $this->belongsToMany(MApplication::class, 'cartographer_m_application');
    }

}
