<?php
Route::group(['prefix' => 'admin','namespace'=>'Admin','middleware'=>'ip'], function() {
    require __DIR__.'/admin/admin.route.php';

});