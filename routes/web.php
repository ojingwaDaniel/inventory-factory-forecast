<?php

use App\Http\Controllers\ForecastController;
use App\Models\Forecast;
use Illuminate\Support\Facades\Route;

Route::get("/", [ForecastController::class, "index"])->name("home");
Route::get("/add-product", [ForecastController::class, "createProduct"])->name("add.product");
Route::post("/store-product", [ForecastController::class, "storeProduct"])->name("store.product");
Route::get('/edit-product/{id}', [ForecastController::class, "editProduct"])->name("edit.product");
Route::put('/update-product/{id}', [ForecastController::class, "updateProduct"])->name("update.product");
Route::get("/forcast/{id}", [ForecastController::class, "generateForecast"])->name("forecast.generate");
Route::get('/add-sales/{id}', [ForecastController::class, 'addSales'])->name('add.sales');
Route::post('/store-sales/{id}', [ForecastController::class, 'storeSales'])->name('store.sales');
Route::get("edit-sales/{id}", [ForecastController::class, "editSales"])->name("edit.sales");
Route::put("update-sales/{id}", [ForecastController::class, "updateSales"])->name("update.sales");
Route::delete("delete-sales/{id}", [ForecastController::class, "deleteSales"])->name("destory.sales");
Route::get("/forecast/{product_id}", [ForecastController::class, "forecast"])->name("forecast");
Route::delete("/delete-product/{id}", [ForecastController::class, "destroyProduct"])->name("destory.product");
