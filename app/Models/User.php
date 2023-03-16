<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        'nickname',
        'email',
        'date_of_birth',
        'status_description',
        'active',
        'last_visited_at',
        'last_visited_from',
        'remember_token',
        'verification_token',
        'google_id'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth'     => 'date',
        'deleted_at'        => 'datetime',
        'last_visited_at'   => 'datetime',
        'active'            => 'boolean'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */

    protected $appends = [
        'profile_photo_url',
    ];
    public function gender(): HasOne
    {
        return $this->hasOne(Gender::class,'user_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function getName()
    {
        if($this->name && $this->last_name)
        {
            return "{$this->name} {$this->last_name}";
        }
        if ($this->name)
        {
            return $this->name;
        }

        return null;
    }

    public function getNicknameOrName(): string
    {
        return strtolower($this->nickname ? : $this->name);
    }

    public function getFullNameAttribute()
    {
        return Str::ucfirst("{$this->name} {$this->last_name}");
    }

    public function friendsOfMine(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'friends','user_id','friend_id')
            ->withPivot('status');
    }

    public function friendsOf(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'friends','friend_id','user_id');
    }

    public function friends(): Collection
    {
        return $this->friendsOfMine()->wherePivot('accepted',true)->get()
            ->merge($this->friendsOf()->wherePivot('accepted',true)->get());
    }


    public function profilePictureUrl()
    {
        return "https://www.gravatar.com/avatar/md5($this->email)?s=50";
    }
}
