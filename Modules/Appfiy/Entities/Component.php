<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'appfiy_component';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at','created_at','updated_at'];
    protected $fillable = ['parent_id', 'name', 'slug', 'label', 'layout_type', 'icon_code', 'event', 'scope', 'class_type'];

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ComponentFactory::new();
    }
}
