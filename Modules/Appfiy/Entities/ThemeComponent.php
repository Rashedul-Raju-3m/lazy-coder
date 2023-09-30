<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThemeComponent extends Model
{
    use HasFactory;

    protected $table = 'appfiy_theme_component';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['theme_id', 'parent_id', 'child_id', 'theme_config_id', 'theme_page_id'];

    public function childComponent(){
        return $this->belongsTo('Modules\Appfiy\Entities\Component','child_id','id');
    }
    public function parentComponent(){
        return $this->belongsTo('Modules\Appfiy\Entities\Component','parent_id','id');
    }
    public function themeComponentStyle(){
        return $this->hasMany('Modules\Appfiy\Entities\ThemeComponentStyle','theme_component_id','id');
    }
    public function themeConfig(){
        return $this->belongsTo('Modules\Appfiy\Entities\ThemeConfig','theme_config_id','id');
    }
    public function themePage(){
        return $this->belongsTo('Modules\Appfiy\Entities\ThemePage','theme_page_id','id');
    }

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ThemeComponentFactory::new();
    }
}
