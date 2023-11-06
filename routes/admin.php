<?php
Route::get("/dashboard", [\App\Http\Controllers\AdminController::class, "dashboard"]);
Route::get("/detailOrder/{id:id}", [\App\Http\Controllers\AdminController::class, "detailOrder"]);
Route::get("/products", [\App\Http\Controllers\AdminController::class, "products"]);
Route::get("/order", [\App\Http\Controllers\AdminController::class, "orders"]);

Route::prefix("product")->group(function (){
    Route::get("/", [\App\Http\Controllers\ProductController::class, "index"]);
    Route::get("/create", [\App\Http\Controllers\ProductController::class, "create"]);
    Route::post("/create", [\App\Http\Controllers\ProductController::class, "store"]);
    Route::get("/edit/{product}", [\App\Http\Controllers\ProductController::class, "edit"]);
    Route::put("/edit/{product}", [\App\Http\Controllers\ProductController::class, "update"]);
    Route::delete("/delete/{product}", [\App\Http\Controllers\ProductController::class, "delete"]);
});
