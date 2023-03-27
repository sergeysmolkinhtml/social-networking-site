<?php

namespace App\Models\Traits;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait ReceivesReplies
{
    /**
     * @return Collection
     */
    public function replies(): Collection
    {
        return $this->repliesRelation;
    }

    /**
     * @param int $amount
     * @return Collection
     */
    public function latestReplies(int $amount = 5): Collection
    {
        return $this->repliesRelation()->latest()->limit($amount)->get();
    }

    public function deleteReplies(): void
    {
        foreach ($this->repliesRelation()->get() as $reply){
            $reply->delete();
        }

        $this->unsetRelation('repliesRelation');
    }

    /**
     * @return MorphMany
     */
    public function repliesRelation(): MorphMany
    {
        return $this->morphMany(Reply::class,'repliesRelation','replies');
    }

    public function isConversationOld(): bool
    {
        $sixMonthsAgo = now()->subMonths(6);

        if($reply = $this->repliesRelation()->latest()->first()){
            return $reply->createdAt()->lt($sixMonthsAgo);
        }

        return $this->createdAt()->lt($sixMonthsAgo);
    }

}
