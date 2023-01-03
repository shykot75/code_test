<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use function Termwind\ValueObjects\pr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->all();
        try {
            DB::beginTransaction();

            // IMAGE SECTION
            $image = $request->file('image');
            if($image != null){

                $name = Str::random(5).'.'.$image->getClientOriginalExtension();
                $destinationPath = 'uploads/product-image/';
                $image->move($destinationPath, $name);
                $imagePath = $destinationPath.$name;
            }
            // IMAGE SECTION

            $product = new Product();
            $product->name = $request->name;
            $product->code = $request->code;
            $product->image = $imagePath;
            $product->save();
            DB::commit();
            Alert::success('Product Created Successfully..');
            return back();
        }
        catch(\Exception $e){
            DB::rollBack();
            Alert::error($e->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::latest()->get();
        return view('products', compact('product','products'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        try {
            DB::beginTransaction();

            // IMAGE SECTION
            $image = $request->file('image');
            if($image != null){
                if($product->image != null){
                    unlink(public_path($product->image));
                }
                $name = Str::random(5).'.'.$image->getClientOriginalExtension();
                $destinationPath = 'uploads/product-image/';
                $image->move($destinationPath, $name);
                $product->image = $destinationPath.$name;
            }
            // IMAGE SECTION

            $product->name = $request->name;
            $product->code = $request->code;
            $product->save();
            DB::commit();
            Alert::success('Product Updated Successfully..');
            return redirect()->route('all.products');
        }
        catch(\Exception $e){
            DB::rollBack();
            Alert::error($e->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Alert::success('Product Selectbox Deleted Successfully..');
        return redirect()->route('all.products');
    }
}
