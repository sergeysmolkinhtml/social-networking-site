<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'users';

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
        'verification_token',
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



    public function gender(): HasOne
    {
        return $this->hasOne(Gender::class,'user_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function getNicknameOrName()
    {
        return strtolower($this->nickname ?: $this->name);
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
}
