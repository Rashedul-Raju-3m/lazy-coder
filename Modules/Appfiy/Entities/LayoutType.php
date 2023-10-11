<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LayoutType extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'appfiy_layout_type';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at','created_at','updated_at'];
    protected $fillable = ['name', 'slug'];

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ComponentFactory::new();
    }
}
