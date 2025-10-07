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
        $products = Product::latest()->get();
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
            "name"=> $request->name,
            "category"=> $request->category
        ]);
        return redirect()->route("home")->with("success","Sucessfully added a product");

    }
    public function addSales($id){
        $product = Product::findOrFail($id);
        $sales = SalesData::where("product_id", $id)->get();
        return view("add-sales", compact("product", "sales"));

    }
    public function storeSales( Request $request,$id){
        $request->validate([
            "month" => "required",
            "units_sold" => "required|integer|min:1"
        ]);
        SalesData::create([
            "product_id" => $id,
            "month" => $request->month,
            "units_sold" => $request->units_sold
        ]);
        return back()->with("sucess", "Sucessfully added a Sale record");
    }
    public function forecast($product_id){
        $product = Product::findOrFail($product_id);
        $sales = SalesData::where("product_id", $product_id)->orderBy("month", "asc")->get();
        if($sales->count() < 3){
            return back()->with("error", "You must have at least three months of data to forecast");
        }
        $lastThree = $sales->take(-3);
        $forecast = round($lastThree->avg("units_sold"), 2);
        return view("forecast", compact("product", "sales", "forecast"));
    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
