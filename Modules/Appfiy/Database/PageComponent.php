<?php

namespace Modules\Appfiy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageComponent extends Model
{
    use HasFactory;

    protected $table = 'appfiy_page_component';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['page_id', 'component_id', 'position'];

    public function component(){
        return $this->belongsTo('Modules\Appfiy\Entities\Component','component_id','id');
    }

    protected static function newFactory()
    {
        return \Modules\Appfiy\Database\factories\PageComponentFactory::new();
    }
}
