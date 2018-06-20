<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    //

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
}
