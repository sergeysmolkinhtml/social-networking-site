<?php

namespace App\Models;

use App\Notifications\WelcomeRegisterNotification;
use Carbon\Carbon;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail,FilamentUser
{
    use HasApiTokens,
        HasFactory,
        HasRoles,
        HasProfilePhoto,
        Notifiable,
        TwoFactorAuthenticatable,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'gender',
        'nickname',
        'email',
        'password',

        'achievements',
        'skills',
        'work_experience_years',
        'work_formats',
        'languages',
        'work_formats',
        'city',
        'email',
        'date_of_birth',
        'job_title',
        'status_description',
        'active',
        'last_visited_at',
        'last_visited_from',
        'remember_token',
        'verification_token',
        'google_id',
        'terms_accepted',
        'role_id',
        'employer',

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

    public function teams(): HasMany
    {
        return $this->hasMany(TeamSearch::class);
    }


    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

   public function canAccessFilament(): bool
    {
        return str_ends_with($this->email, '@admin.com') && $this->hasVerifiedEmail();
    }

    public const FILTER = ['true', 'false'];

    public function sendWelcomeNotification()
    {
        $this->notify(new WelcomeRegisterNotification());
    }

    public function scopeUserFindBy($query, $nickname)
    {
        return $query->where('nickname', $nickname)->firstOrFail();
    }

    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class,'user_id');

    }

    public function hasLikedPost(BlogPost $post): bool
    {
        return (bool)$post->likes()
            ->where('likeable_id',$post->id)
            ->where('likeable_type',get_class($post))
            ->where('user_id',$this->id)
            ->count();
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class,'user_id');
    }


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

    public function getFullNameAttribute(): string
    {
        return Str::ucfirst("{$this->name} {$this->last_name}");
    }

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = Str::ucfirst($value);
    }

    /**
     * @param $value
     * @return void
     */
    public function setLastNameAttribute($value): void
    {
        $this->attributes['last_name'] = Str::ucfirst($value);
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ($value),
        );
    }

    // Gravatar
    public function profilePictureUrl(): string
    {
        return "https://www.gravatar.com/avatar/md5($this->email)?s=50";
    }

    public function getPfpPath($user_id): string
    {
        $path = "uploads/pfps/id{$user_id}";

        if(! file_exists($path)){
            mkdir($path,0777,true);
        }

        return "/$path/";
    }

    public function clearPfps($user_id)
    {
        $path = "uploads/pfps/id{$user_id}";

        if ( file_exists( public_path("/$path") ) ) {
            foreach (glob(public_path("/$path/*" )) as $pfp ){
                unlink($pfp);
            }
        }
    }


    /*
     * Friends Logic
     */
    // my friend
    public function friendsOfMine(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    // exact friend
    public function friendsOf(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    // get friends
    public function friends(): Collection
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendsOf()->wherePivot('accepted', true)->get());
    }

    // friend requests
    public function friendRequests(): Collection
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    //request for "pending"
    public function friendRequestPending(): Collection
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user): bool
    {
        return (bool)$this->friendRequestPending()->where('id', $user->id)->count();
    }

    // received friend request
    public function hasFriendRequestReceived(User $user): bool
    {
        return (bool)$this->friendRequests()->where('id',$user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendsOf()->attach($user->id);
    }

    public function deleteFriend(User $user)
    {
        $this->friendsOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id',$user->id)->first()->pivot->update([
            'accepted' => true
        ]);
    }

    public function isFriendWith(User $user): bool
    {
        return (bool)$this->friends()->where('id', $user->id)->count();
    }


    public function getAgeHuman(): int
    {
        return Carbon::parse($this->date_of_birth)->age ? : '';
    }

    public function employer()
    {
        $this->belongsTo(Employer::class);
    }

    public function isEmployer(User $user)
    {
        return (bool)$user->where('employer', 1)->count();
    }
}
