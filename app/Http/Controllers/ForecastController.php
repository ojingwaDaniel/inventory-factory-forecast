<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SalesData;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index()
    {
       
        $products = Product::orderBy("category")->orderBy("created_at", "desc")->get();
        return view("home", compact("products"));
    }
    public function createProduct()
    {
        
        $categories = Category::all();
        return view("add-product", compact("categories"));
    }
    public function editProduct(string $id)
    {
        $product = Product::findOrFail($id);
        return view("edit-product", compact("product"));
    }
    public function storeProduct(Request $request)
    {
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
    public function editSales($id){
        $saleData = SalesData::findOrFail($id);
        $product = Product::findOrFail($saleData->product_id);
        return view("edit-sales", compact("saleData","product"));

    }
    public function updateSales(Request $request, $id){
        $request->validate([
            "month" => "required",
            "units_sold" => "required|integer|min:1"
        ]);
        $sales = SalesData::findOrFail($id);
        $sales->update([
            "month" => $request->month,
            "units_sold"=> $request->units_sold
        ]);
        return redirect()->route("add.sales",$sales->product_id)->with("success", "Updated the sales Data sucessfully");
    }
    public function deleteSales($id){
        $sale = SalesData::findOrFail($id);
        $sale->delete();
        return redirect()->route("add.sales", $sale->product_id)->with("success", "Deleted the sale data successfully!");
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
        
        return view("forecast", compact("product", "sales", "forecast", "trend"));
    }

    public function updateProduct(Request $request, string $id)
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

    public function destroyProduct(string $id)
    {
     
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route("home")->with("success", "Deleted the product successfully!");
    }

}
