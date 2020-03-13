<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }
    public function saving(Topic $topic)
    {
    	// 防止xss攻击
    	$topic->body = clean($topic->body, 'user_topic_body');
    	// make_excerpt() 是我们自定义的辅助方法，我们需要在 helpers.php 文件中添加：
    	//生成话题摘录
    	$topic->excerpt = make_excerpt($topic->body);
    	
    	//如slug 字段无内容，即使用翻译器对title进行翻译
    	 if ( ! $topic->slug) {
            $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        }
    }
}