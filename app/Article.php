<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    //
    use SoftDeletes;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_BLOCKED = 3;
    const STATUS_MODERATION = 4;

    protected $fillable = [
        'category_id',
        'title',
        'content',
        'preview_img',
        'preview_text',
        'view_count',
        'like_count',
        'published_at',
        'status'
    ];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_BLOCKED => 'Blocked',
            self::STATUS_MODERATION => 'Moderation',
        ];
    }

    public static function getStatusListBlockedModerator()
    {
        return [
            self::STATUS_BLOCKED => 'Blocked',
            self::STATUS_MODERATION => 'Moderation',
        ];
    }

    public static function getStatusListShowForUser()
    {
        return [
            self::STATUS_BLOCKED => 'Blocked',
            self::STATUS_MODERATION => 'Moderation',
        ];
    }

    public function getStatusName()
    {
        return Arr::get(self::getStatusList(), $this->status, 'Undefined');
    }

}
