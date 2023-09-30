<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComponentProperties extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'component_properties';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at','created_at','updated_at'];
    protected $fillable = ['component_id', 'name', 'input_type', 'value'];

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ComponentPropertiesFactory::new();
    }
}
