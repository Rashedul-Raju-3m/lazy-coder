<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComponentStyleGroupProperties extends Model
{
    use HasFactory;

    protected $table = 'appfiy_component_style_group_properties';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at','created_at','updated_at'];
    protected $fillable = ['component_id', 'name', 'input_type', 'value','style_group_id'];

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ComponentStyleGroupPropertiesFactory::new();
    }
}
