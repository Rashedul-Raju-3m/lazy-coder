<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComponentLayout extends Model
{
    use HasFactory;

    protected $table = 'appfiy_component_layout';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at','updated_at'];
    protected $fillable = ['component_id', 'layout_type_id'];

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ComponentFactory::new();
    }
}
