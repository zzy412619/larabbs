<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy extends Policy
{
    public function update(User $user, Reply $reply)
    {
        // return $reply->user_id == $user->id;
        return true;
    }

    //拥有删除回复权限的用户应当是回复的作者或者回复话题的作者
   public function destroy(User $user, Reply $reply)
    {
        return $user->isAuthorOf($reply) || $user->isAuthorOf($reply->topic);
    }
}
