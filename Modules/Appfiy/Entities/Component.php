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
    protected $fillable = ['parent_id', 'name', 'slug', 'label', 'layout_type_id', 'icon_code', 'event', 'scope', 'class_type','app_icon','web_icon','image','product_type'];

    public function componentStyleGroup(){
        return $this->hasMany('Modules\Appfiy\Entities\ComponentStyleGroup','component_id','id');
    }
    public function componentLayout(){
        return $this->belongsTo('Modules\Appfiy\Entities\LayoutType','layout_type_id','id');
    }

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ComponentFactory::new();
    }
}
