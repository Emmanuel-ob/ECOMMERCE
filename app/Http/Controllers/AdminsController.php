<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

class AdminsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function index()
    {
    	$products = Product::all();
        #return view('products.index', compact('products'));
    	return view('admin.admin', compact('products'));
    }

    
    public function addProduct(Request $request)
    {
     
     if($request->isMethod('post')){

         $this->validate($request, [
             'itemName'  => 'required|min:3',
             'quantity'  => 'required|max:10',
             'price'     => 'required|max:10',
         ]);
         try {
                $new_product = new Product([
                    'name'               => $request->itemName,
                    'quantity'           => $request->quantity,
                    'price'              => $request->price,

                ]);

                 if($request->hasFile('image')){
                   
                     $file = $request->file('image');
                     $fileName = time() . '.' . $file->getClientOriginalExtension();
                     $location = public_path('cartImages/' . $fileName);
                     Image::make($file)->resize(800, 400)->save($location);
                     $new_product->image = $fileName;
                    
                  }
                
                $new_product->save();
                \Session::flash('message', 'Product added successfully!');

            } catch (ModelNotFoundException $e){
                abort("Product was not added, try again");
            }


     }

     return redirect()->back();
    }

    
    public function editProduct(Request $request, $id){
        $item = Product::find($id);
        #$item = Product->where('id', $request->productId);

        if($request->isMethod('post')){

        $this->validate($request, [
             'itemName'  => 'required|min:3',
             'quantity'  => 'required|integer',
             'price'     => 'required|integer',
             'image'     => 'sometimes|image',
         ]);
        // dd($request);
         try {
                
                $item->name       = $request->itemName;
                $item->quantity   = $request->quantity;
                $item->price      = $request->price; 

                if($request->hasFile('image')){
                   
                     $file = $request->file('image');
                     $fileName = time() . '.' . $file->getClientOriginalExtension();
                     $location = public_path('cartImages/' . $fileName);
                     Image::make($file)->resize(800, 400)->save($location);

                     $oldFileName = $item->image;

                     $item->image = $fileName;
                     Storage::delete($oldFileName);
                    
                  }                   
                $item->save();
                \Session::flash('message', 'Product was edited successfully!');

                return redirect()->to('/admin');
            } catch (ModelNotFoundException $e){
                abort("Product was not edited successfully, try again");
            }


     }
        
        return redirect()->to('/admin');
    }

    
    public function renderAddForm(){

    	return view('admin.addForm');
    }


     public function editView(Request $request, $id)
    {
    	$item = Product::find($id);
    	return view('admin.editView', compact('item'));
    }

     public function deleteProduct(Request $request, $id)
    {
    	$item = Product::find($id);
         $oldFileName = $item->image;
    	$item->delete();
        Storage::delete($oldFileName);
    	return redirect()->to('/admin');
    }


    public function getImage($fileName)

    {
        //dd($fileName);
      $file = Storage::disk('public')->get($fileName);

       
    return new Response($file, 200);
      
     }
     // if($request->hasFile('itemImage')){
                    //  $image = $request->file('itemImage');
                    //  $fileName = time() . '.' . $image->getClientOriginalExtension();
                    //  $location = public_path('/images' . $fileName);
                    //  Image::make($image)->resize(800, 400)->save($location);
                    //  $new_product->image = $fileName;
                    // }
                     //  $file = $request->file('image');

                   //  $fileName = time() . '.jpg';

                   //  if($file){
                   //   //dd($fileName);
                   // Storage::disk('public')->put($fileName, File::get($file));
                   // $new_product->image   = $fileName;

                   
}
