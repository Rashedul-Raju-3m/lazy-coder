<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalConfig extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'appfiy_global_config';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at','created_at','updated_at'];
    protected $fillable = ['mode', 'name', 'slug', 'background_color', 'layout', 'icon_theme_size', 'icon_theme_color', 'shadow', 'icon', 'automatically_imply_leading', 'center_title', 'flexible_space', 'bottom', 'shape_type', 'shape_border_radius', 'toolbar_opacity', 'actions_icon_theme_color', 'actions_icon_theme_size', 'title_spacing', 'is_active'];

    public static function getDropdown($mode){
        return self::where('is_active',1)->where('mode',$mode)->pluck('name','id');
    }

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\GlobalConfigFactory::new();
    }
}
