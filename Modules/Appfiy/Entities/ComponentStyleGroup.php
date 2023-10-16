<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComponentStyleGroup extends Model
{
    use HasFactory;

    protected $table = 'appfiy_component_style_group';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at','updated_at'];
    protected $fillable = ['component_id', 'style_group_id'];

    public function componentStyleGroup(){
        return $this->belongsTo('Modules\Appfiy\Entities\ComponentStyleGroup','component_id','id');
    }

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ComponentStyleGroupFactory::new();
    }
}
