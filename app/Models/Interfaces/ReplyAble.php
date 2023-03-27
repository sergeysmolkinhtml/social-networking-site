<?php

namespace App\Models\Interfaces;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Relations\MorphMany;


interface ReplyAble
{
    public function subject(): string;

    /**
     * @return Reply;
     */
    public function replies(): mixed;

    /**
     * @param int $amount
     * @return Reply
     */
    public function latestReplies(int $amount = 5): Reply;

    public function deleteReplies();

    public function repliesRelation(): MorphMany;

    public function isConversationOld(): bool;

    public function replyableSubject(): string;

}
