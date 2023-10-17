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
    protected $fillable = ['theme_id', 'parent_id', 'component_parent_id', 'component_id', 'theme_config_id', 'theme_page_id', 'display_name', 'clone_component', 'selected_id'];

    public function component(){
        return $this->belongsTo('Modules\Appfiy\Entities\Component','component_id','id');
    }

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ThemeComponentFactory::new();
    }
}
