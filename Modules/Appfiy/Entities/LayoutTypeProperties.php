<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LayoutTypeProperties extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'appfiy_layout_type_style_properties';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at','created_at','updated_at'];
    protected $fillable = ['name', 'input_type', 'value', 'default_value', 'is_active'];

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ComponentFactory::new();
    }
}
