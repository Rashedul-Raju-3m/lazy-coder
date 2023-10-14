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
    protected $fillable = ['name','slug', 'image', 'appbar_id', 'navbar_id', 'drawer_id', 'appbar_navbar_drawer'];

    public function appbar(){
        return $this->belongsTo('Modules\Appfiy\Entities\GlobalConfig','appbar_id','id');
    }
    public function navbar(){
        return $this->belongsTo('Modules\Appfiy\Entities\GlobalConfig','navbar_id','id');
    }
    public function drawer(){
        return $this->belongsTo('Modules\Appfiy\Entities\GlobalConfig','drawer_id','id');
    }

    public function component(){
        return $this->hasMany('Modules\Appfiy\Entities\ThemeComponent','theme_id','id');
    }
    public function globalConfig(){
        return $this->hasMany('Modules\Appfiy\Entities\ThemeConfig','theme_id','id');
    }
    public function page(){
        return $this->hasMany('Modules\Appfiy\Entities\ThemePage','theme_id','id');
    }
    public function componentStyle(){
        return $this->hasMany('Modules\Appfiy\Entities\ThemeComponentStyle','theme_id','id');
    }

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ThemeFactory::new();
    }
}
