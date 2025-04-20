<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ListCategory;

class ListModel extends Model
{
    use SoftDeletes;

    protected $table = 'lists';

    public function category()
    {
        return $this->belongsTo(ListCategory::class, 'list_category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'group_id',
        'list_category_id',
        'name',
        'comment',
        'url',
        'rating',
        'image_path',
        'list_type'
    ];
}
