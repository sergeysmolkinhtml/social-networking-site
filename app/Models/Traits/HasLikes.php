<?php

namespace App\Models\Traits;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLikes
{

    /**
     * @return Collection
     */
    public function likes(): Collection
    {
        return $this->likesRelation();
    }

    protected static function bootHasLikes(): void
    {
        static::deleting(function ($model){
            $model->likesRelation()->delete();

            $model->unsetRelation('lik esRelation');
        });
    }

    public function likedBy(User $user): void
    {
        $this->likesRelation()->create(['user_id' => $user->id()]);

        $this->unsetRelation('likesRelation');
    }

    public function dislikedBy(User $user): void
    {
        optional($this->likesRelation()->where('user_id',$user->id())->first());
    }

    public function likesRelation(): MorphMany
    {
        return $this->morphMany(Like::class,'likesRelation','likeable');
    }

    public function isLikedBy(User $user)
    {
        return $this->likesRelation()->where('user_id',$user->id())->exists();
    }

}
