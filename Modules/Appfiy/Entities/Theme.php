<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'appfiy_theme';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at','created_at', 'updated_at'];
    protected $fillable = ['name', 'image', 'appbar_id', 'navbar_id', 'drawer_id', 'appbar_navbar_drawer'];

    public function themeComponent(){
        return $this->hasMany('Modules\Appfiy\Entities\ThemeComponent','theme_id','id');
    }
    public function themeConfig(){
        return $this->hasMany('Modules\Appfiy\Entities\ThemeConfig','theme_id','id');
    }
    public function themePage(){
        return $this->hasMany('Modules\Appfiy\Entities\ThemePage','theme_id','id');
    }
    public function themeStyle(){
        return $this->hasMany('Modules\Appfiy\Entities\ThemeComponentStyle','theme_id','id');
    }

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ThemeFactory::new();
    }
}
