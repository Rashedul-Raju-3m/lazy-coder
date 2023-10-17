<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThemeComponentStyle extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'appfiy_theme_component_style';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at','created_at', 'updated_at'];
    protected $fillable = ['theme_id','theme_component_id', 'name', 'input_type', 'value','style_group_id'];

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ThemeComponentStyleFactory::new();
    }
}
