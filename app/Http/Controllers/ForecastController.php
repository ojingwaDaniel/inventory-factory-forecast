<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesData;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::orderBy("category")->orderBy("created_at","desc")->get();
        return view("home", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("add-product");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "name" => "required",
            "category" => "nullable|string"
        ]);
        Product::create([
            "name" => $request->name,
            "category" => $request->category
        ]);
        return redirect()->route("home")->with("success", "Sucessfully added a product");
    }
    public function addSales($id)
    {
        $product = Product::findOrFail($id);
        $sales = SalesData::where("product_id", $id)->get();
        return view("add-sales", compact("product", "sales"));
    }
    public function storeSales(Request $request, $id)
    {
        $request->validate([
            "month" => "required",
            "units_sold" => "required|integer|min:1"
        ]);
        SalesData::create([
            "product_id" => $id,
            "month" => $request->month,
            "units_sold" => $request->units_sold
        ]);
        return back()->with("success", "Sucessfully added a Sale record");
    }
    public function forecast($product_id)
    {
        $product = Product::findOrFail($product_id);
        $sales = SalesData::where("product_id", $product_id)->orderBy("created_at", "desc")->take(3)->get()->sortBy("created_at")->values();
        if ($sales->count() < 3) {
            return back()->with("error", "You must have at least three months of data to forecast");
        }
        $salesAmount = $sales->pluck("units_sold")->values();
        [$month1, $month2, $month3] = $salesAmount;
        $avg = ($month1 + $month2 + $month3) / 3;
        $trend = ($month3 - $month1) / 2;
        $forecast = round(($avg + $trend), 2);
        $message = match (true) {
            $trend > 0 => "Sales are increasing. Keep up the good work!",
            $trend < 0 => "Sales are dropping. You may need to improve marketing or reduce costs.",
            default => "Sales are stable. Maintain your strategy and watch for changes."
        };
        return view("forecast", compact("product", "sales", "forecast", "message"));
    }


    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view("edit-product", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            "category" => "nullable"
        ]);
        Product::where("id", $id)->update([
            "name" => $request->name,
            "category" => $request->category
        ]);
        return redirect()->route("home")->with("success", "Sucessfully updated the product");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
