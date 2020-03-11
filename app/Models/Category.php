<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //因为数据表未生成时间戳，这里需要使用public $timestamps = false;进行设置，告知Laravel此模型在创建和更新时不需要维护create_at和update_at这两个字段
    public $timestamps = false;

    protected $fillable = [
    	'name','description',
    ];
}
