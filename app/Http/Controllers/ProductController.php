<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('product', compact('product'));
    }
    public function getProductDetail($id = null)
    {
        $prod = Product::where("ProductId", $id)->first();
        // $prod = Product::paginate(20);
        return view('productdetail', compact('prod'));
    }
    public function addProd()
    {
        $category = Category::all();
        return view('addproduct', compact('category'));
    }
    public function insertProduct(Request $r)
    {
        $filename = "";
        if ($r->file('fileUpLoad')->isValid()) {
            $filename = $r->fileUpLoad->getClientOriginalName();
            $dir = "images/";
            $target_file = $dir . $filename;
            move_uploaded_file($_FILES["fileUpLoad"]["tmp_name"], $target_file);
            // $r->fileUpLoad->move('images/', $filename);
        }

        $product = Product::create([
            'ProductName' => $r->productname,
            'Unit' => $r->unit,
            'Price' => $r->price,
            'Description' => $r->des,
            'CategoryId' => $r->categories,
            'Img' => $filename
        ]);
        $product = Product::all();
        return view('product', compact('product'));
    }
    public function listProduct()
    {
        $product = Product::all();
        $category = Category::all();

        return view('productlist', compact('product', 'category'));
    }
    public function deleteProduct($id)
    {
        $record = Product::where("ProductId", $id)->first();
        // if (file_exists(public_path("images/" . $record->Img))) {
        //     unlink(public_path("images/" . $record->Img));
        // }
        Product::where("ProductId", $id)->delete();
        $product = Product::all();
        return view('productlist', compact('product'));
    }

    // tìm kiếm
    public function getSearch(Request $r)
    {
        $validatedData = $r->validate([
            'search' => 'required',
        ]); // kiểm tra dữ liệu
        $product = Product::where("ProductName", 'like', '%' . $r->search . '%')->orWhere("Price", 'like', $r->search)->get();
        //tìm theo ProductName hoặc Giá (Giá phải nhập chính xác)
        return view('searchList', compact('product'));
    }

    // sửa
    public function UpdateProduct($id = null)
    {
        $prod = Product::where("ProductId", $id)->first();
        $cate = Category::All();
        return view('update', compact('prod', 'cate'));
    }

    public function updateProd(Request $r, $id)
    {
        $filename = "";
        if ($r->file('fileUpLoad')->isValid()) {
            $filename = $r->fileUpLoad->getClientOriginalName();
            $dir = "images/";
            $target_file = $dir . $filename;
            move_uploaded_file($_FILES["fileUpLoad"]["tmp_name"], $target_file);
            // $r->fileUpLoad->move('images/', $filename);
        }
        $p  = Product::where("ProductId", $id)->update([
            "ProductName" => $r->productname,
            'Unit' => $r->unit,
            'Price' => $r->price,
            'Description' => $r->des,
            'CategoryId' => $r->category,
            'Img' => $filename
        ]);

        $product = Product::all();
        $category = Category::all();

        return view('productlist', compact('product', 'category'));
    }



    public function sortProductASC()
    {
        $p = Product::orderBy('Price', 'asc')->get();
        return view('sortproduct',compact('p'));
    }

    
    public function sortProductDESC()
    {
        $p = Product::orderBy('Price', 'desc')->get();
        return view('sortproduct',compact('p'));
    }

    public function sortProductAZ()
    {
        $p = Product::orderBy('ProductName', 'asc')->get();
        return view('sortproduct',compact('p'));
    }

    public function sortProductZA()
    {
        $p = Product::orderBy('ProductName', 'desc')->get();
        return view('sortproduct',compact('p'));
    }

}