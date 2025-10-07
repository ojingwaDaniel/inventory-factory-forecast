<?php

use App\Http\Controllers\ForecastController;
use App\Models\Forecast;
use Illuminate\Support\Facades\Route;

Route::get("/", [ForecastController::class, "index"])->name("home");
Route::get("/add-product", [ForecastController::class, "create"])->name("add.product");
Route::post("/store-product", [ForecastController::class, "store"])->name("store.product");
Route::get("/forcast/{id}", [ForecastController::class, "generateForecast"])->name("forecast.generate");
Route::get('/add-sales/{id}', [ForecastController::class, 'addSales'])->name('add.sales');
Route::post('/store-sales/{id}', [ForecastController::class, 'storeSales'])->name('store.sales');
Route::get("/forecast/{product_id}", [ForecastController::class, "forecast"])->name("forecast");
