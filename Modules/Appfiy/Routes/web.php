<?php

use Illuminate\Support\Facades\Route;
use Modules\Appfiy\Http\Controllers\AppfiyController;
use Modules\Appfiy\Http\Controllers\ComponentController;
use Modules\Appfiy\Http\Controllers\LayoutTypeController;
use Modules\Appfiy\Http\Controllers\LayoutTypePropertiesController;
use Modules\Appfiy\Http\Controllers\StyleGroupController;
use Modules\Appfiy\Http\Controllers\ThemeController;

Route::prefix('{locale}/appfiy')->group(function() {
//    Route::get('/',[AppfiyController::class, 'index'])->name('appfiy');

    /*THEME ROUTE START*/
        Route::get('/theme/list',[ThemeController::class,'index'])->name('theme_list');
        Route::get('/theme/create',[ThemeController::class,'create'])->name('theme_add');
        Route::POST('/theme/store',[ThemeController::class,'store'])->name('theme_store');
        Route::get('/theme/attribute/edit/{id}',[ThemeController::class, 'attributeEdit'])->name('theme_attribute_edit');
        Route::get('/theme/component/update}',[ThemeController::class, 'themeComponentUpdate'])->name('theme_component_update');
//        Route::PATCH('/component/update/{id}',[ComponentController::class, 'update'])->name('component_update');
//        Route::list_view_decorationget('/component/properties/edit/{id}',[ComponentController::class, 'editComponentProperties'])->name('component_properties_edit');
//        Route::PATCH('/component/properties/update/{id}',[ComponentController::class, 'updateProperties'])->name('component_properties_update');
    /*THEME ROUTE END*/

    /*COMPONENT ROUTE START*/
        Route::get('/component/list',[ComponentController::class,'index'])->name('component_list');
        Route::get('/component/create',[ComponentController::class,'create'])->name('component_add');
//        Route::POST('/component/store',[ComponentController::class,'store'])->name('component_store');
        Route::get('/component/edit/{id}',[ComponentController::class, 'edit'])->name('component_edit');
        Route::PATCH('/component/update/{id}',[ComponentController::class, 'update'])->name('component_update');
        Route::get('/component/properties/edit/{id}',[ComponentController::class, 'editComponentProperties'])->name('component_properties_edit');
        Route::PATCH('/component/properties/update/{id}',[ComponentController::class, 'updateProperties'])->name('component_properties_update');
    /*COMPONENT ROUTE END*/

    /*LAYOUT TYPE ROUTE START*/
        Route::get('/layout/type/list',[LayoutTypeController::class,'index'])->name('layout_type_list');
    /*LAYOUT TYPE ROUTE END*/

    /*LAYOUT TYPE ROUTE START*/
        Route::get('/layout/type/properties/list',[LayoutTypePropertiesController::class,'index'])->name('layout_type_properties_list');
    /*LAYOUT TYPE ROUTE END*/

    /*STYLE GROUP ROUTE START*/
        Route::get('/style/group/list',[StyleGroupController::class,'index'])->name('style_group_list');
        Route::get('/style/group/assign/properties/{id}',[StyleGroupController::class,'assignProperties'])->name('style_group_assign_properties');
        Route::PATCH('/style/group/properties/update/{id}',[StyleGroupController::class,'assignPropertiesUpdate'])->name('style_group_properties_update');
    /*STYLE GROUP ROUTE END*/





});

