<?php

use Illuminate\Support\Facades\Route;
use Modules\Appfiy\Http\Controllers\AppfiyController;
use Modules\Appfiy\Http\Controllers\ComponentController;
use Modules\Appfiy\Http\Controllers\LayoutTypeController;
use Modules\Appfiy\Http\Controllers\LayoutTypePropertiesController;

Route::prefix('{locale}/appfiy')->group(function() {
//    Route::get('/',[AppfiyController::class, 'index'])->name('appfiy');

    /*COMPONENT ROUTE START*/
        Route::get('/component/list',[ComponentController::class,'index'])->name('component_list');
        Route::get('/component/create',[ComponentController::class,'create'])->name('component_add');
//        Route::POST('/component/store',[ComponentController::class,'store'])->name('component_store');
        Route::get('/component/edit/{id}',[ComponentController::class, 'edit'])->name('component_edit');
        Route::PATCH('/component/update/{id}',[ComponentController::class, 'update'])->name('component_update');


    /*COMPONENT ROUTE END*/

    /*LAYOUT TYPE ROUTE START*/
        Route::get('/layout/type/list',[LayoutTypeController::class,'index'])->name('layout_type_list');
//        Route::get('/component/create',[ComponentController::class,'create'])->name('component_add');
//        Route::POST('/component/store',[ComponentController::class,'store'])->name('component_store');
    /*LAYOUT TYPE ROUTE END*/

    /*LAYOUT TYPE ROUTE START*/
        Route::get('/layout/type/properties/list',[LayoutTypePropertiesController::class,'index'])->name('layout_type_properties_list');
//        Route::get('/component/create',[ComponentController::class,'create'])->name('component_add');
//        Route::POST('/component/store',[ComponentController::class,'store'])->name('component_store');
    /*LAYOUT TYPE ROUTE END*/


//ROUTE guideline START
//    Route::get('/guideline/list',[GuidelineController::class,'index'])->name('guideline_list');
//    Route::get('/guideline/add',[GuidelineController::class,'create'])->name('guideline_add');
//    Route::POST('/guideline/store',[GuidelineController::class, 'store'])->name('guideline_store');
//    Route::get('/guideline/edit/{id}',[GuidelineController::class, 'edit'])->name('guideline_edit');
//    Route::PATCH('/guideline/update/{id}',[GuidelineController::class, 'update'])->name('guideline_update');
//    Route::get('/guideline/delete/{id}',[GuidelineController::class, 'destroy'])->name('guideline_delete');
//ROUTE guideline END




});

