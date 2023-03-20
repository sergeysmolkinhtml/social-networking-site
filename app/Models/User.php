<?php

namespace App\Models;

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
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('status');
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
        return $this->friendsOf()->wherePivot('accepted', false)->get();
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

}
