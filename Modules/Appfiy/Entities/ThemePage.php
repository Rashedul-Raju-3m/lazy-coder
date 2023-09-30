<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThemePage extends Model
{
    use HasFactory;

    protected $table = 'appfiy_theme_page';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [ 'theme_id', 'page_id'];

    public function page(){
        return $this->belongsTo('Modules\Appfiy\Entities\Page','page_id','id');
    }
    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\ThemePageFactory::new();
    }
}
