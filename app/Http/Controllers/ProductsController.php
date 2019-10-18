<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


use App\Product;
use App\Category;
use App\Data;
use App\User;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use function GuzzleHttp\json_decode;

class ProductsController extends Controller
{
    //
    public function productlist()
    {
        $categories = new Category();
        $notification = new Contact();
        $count = DB::table('contacts')->count();
        $notification = DB::table('contacts')->orderBy('id','desc')->get();
        $categories = DB::table('categories')->get();
        $products = DB::table('products')->get();
        return view('Admin_Portal.products.productlist')->with('products', $products)
        ->with('categories',$categories)->with('count',$count)->with('notification', $notification);
    }

    public function addcateg(Request $request)
    {
        $response["state"] = "false";
        $response["categ_id"] = "";
        $categ = json_decode($request->arr);
        $categmodel = new Category();
        $categmodel->categ_name =$categ;
        if($categmodel->save()){
            $response["state"] = "true";
            $response["categ_id"] = $categmodel->id;
            echo json_encode($response);
            exit;
        }else{
            echo json_encode($response);
            exit;   
        }
    }

    public function ajaxImage(Request $request)
    {
       
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'uploads/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $request->file('file')->move($dir, $filename);
            
            return array(
                'img' => $filename
            );
        }
    }

    public function addproduct(Request $request)
    {
        $response["state"] = "false";
        $response["categ_name"] = "";
        $product = json_decode($request->arr);
        $productmodel = new Product();
        
        $productmodel->categ = $product[0];
        $productmodel->name  = $product[1];
        $productmodel->price = $product[2];
        $productmodel->model = $product[3];
        $productmodel->brand = $product[4];
        $productmodel->color = $product[5];
        $productmodel->dimensions = $product[6];
        $productmodel->display_size = $product[7];
        $productmodel->img = $product[8];
        $productmodel->released = $product[9];
        $productmodel->quantity = $product[10];
        $categ = new Category();
        $categ = DB::table('categories')->where('id',$product[0])->first();

        if($productmodel->save()){
          
            $response["categ_name"] = $categ->categ_name;
            $response["product_id"] = $productmodel->id;
            $response["state"] = "true";
            echo json_encode($response);
            exit;
        }
        echo json_encode($response);
        exit;
    }

    public function edit(Product $product)
    {
        $products = Product::find($product->id);
        $categories = new Category(); 
        $notification = new Contact();
        $count = DB::table('contacts')->count();
        $notification = DB::table('contacts')->orderBy('id','desc')->get();
        $categories = DB::table('categories')->get();
        return view('Admin_Portal.products.editproduct')->with('products', $products)
        ->with('categories',$categories)->with('count',$count)->with('notification', $notification);
    }

    public function update(Request $request,Product $product)
    {
        $image = $request->input('img_name');
        if($image == null){
            $image = $request->input('img');
        }
        $productUpdate = Product::where('id',$product->id)
        ->update([
            'categ'      =>$request->input('categ'),
            'name'     =>$request->input('name'),
            'price' =>$request->input('price'),
            'model'     =>$request->input('model'),
            'brand'     =>$request->input('brand'),
            'color'     =>$request->input('color'),
            'dimensions'     =>$request->input('dimensions'),
            'img'     =>    $image,
            'released'     =>$request->input('released'),
            'quantity'     =>$request->input('quantity')
        ]);
        if($productUpdate){
            return $this->productlist();
        }
        return back()->withInput();
    }
    
    public function searchproduct($id)
    {
        $response["state"] = "false";
        $product = new Product();
        $categ  = new Category();
        $product = Product::find($id);
        if($product){
            $response["state"] = "true";
            $product = DB::table('products')->where('id',$id)->first();
            $categ   = DB::table('categories')->where('id',$product->categ)->first();
            if($product){
                $response["categ"] = $categ->categ_name;
                $response["result"] = $product;
                echo json_encode($response);
                exit;
            }else {
                $response["state"] = "false";
                echo json_encode($response);
                exit;
            }
            
        }
        echo json_encode($response);
        exit;
    }
    
    public function destroy($id)
    {
        $findproduct = Product::find($id);
        $response = "false";
        if($findproduct->delete()){
            $response = "true";
            echo json_encode($response);
            exit;
        }
            echo json_encode($response);
            exit;
    }

    public function cartinfo()
    {
        $cart    = new Product();
        $data    = new Data();
        
        $data = DB::table('data')->where('user_id',Auth::user()->id)->first();
     
        $cart = DB::table('products')->where('id',$data->product_id)->get();
        return $cart;
    }

    public function index()
    {
        $products = new Product();
        $categs   = new Category();
        $cart    = new Product();
        $data    = new Data();
        if(Auth::user()){
            $data = DB::table('data')->where('user_id',Auth::user()->id)->get();
        }
        
     
       
        $products = DB::table('products')->orderBy('id','desc')->get();
        $categs   = DB::table('categories')->get();
        
        $cart_num = new User();
        if (Auth::user()) {
            $cart_num =DB::table('users')->select('cart_num')->where('id', Auth::user()->id)->get();
        
            $count = 0;
            foreach ($cart_num as $item) {
                $count = $item->cart_num;
            }

            $prices =  DB::table('users')->select('total_price')->where('id', Auth::user()->id)->get();
            $total_price =0;
            foreach ($prices as $item) {
                $total_price = $item->total_price;
            }
            return view("FrontView.index")->with('products', $products )
            ->with('categs', $categs)->with('data',$data)->with('count',$count)->with('total_price',$total_price);
        }
            return view("FrontView.index")->with('products', $products )
            ->with('categs', $categs);
    
       
    }

    public function productdetails($id)
    {
        $response['state'] = "false";
        $product = new Product();
        $product = DB::table('products')->where('id',$id)->first();
        if($product){
            $response['state'] = "true";
            $response['result'] = $product;
            echo json_encode($response);
            exit;
        }else{
            echo json_encode($response);
            exit;
        }
    }

    public function shop()
    {
        $products = new Product();
        $categs   = new Category();
        $cart    = new Product();
        $data    = new Data();
        if(Auth::user()){
            $data = DB::table('data')->where('user_id',Auth::user()->id)->get();
        }
        
     
       
        $products = DB::table('products')->orderBy('id','desc')->get();
        $categs   = DB::table('categories')->get();
        
        $cart_num = new User();
        if (Auth::user()) {
            $cart_num =DB::table('users')->select('cart_num')->where('id', Auth::user()->id)->get();
        
            $count = 0;
            foreach ($cart_num as $item) {
                $count = $item->cart_num;
            }

            $prices =  DB::table('users')->select('total_price')->where('id', Auth::user()->id)->get();
            $total_price =0;
            foreach ($prices as $item) {
                $total_price = $item->total_price;
            }
            return view("FrontView.shop")->with('products', $products )
            ->with('categs', $categs)->with('data',$data)->with('count',$count)->with('total_price',$total_price);
        }
            return view("FrontView.shop")->with('products', $products )
            ->with('categs', $categs);
    
      
    }

    public function contact()
    {
        $products    = new Product();
        $data    = new Data();
        
        $data = DB::table('data')->where('user_id',Auth::user()->id)->get();
        
        $products = DB::table('products')->get();
       
        $cart = new User();
        $cart =DB::table('users')->select('cart_num')->where('id',Auth::user()->id)->get();
        $count = 0;
        foreach($cart as $item){
            $count = $item->cart_num;
        }
        $prices =  DB::table('users')->select('total_price')->where('id',Auth::user()->id)->get();
        $total_price =0;
        foreach ($prices as $price){
            $total_price = $price->total_price;
        }

        return view("FrontView.contact")->with('products',$products)->with('data',$data)->with('count',$count)->with('total_price',$total_price);
    }

    public function cart($id)
    {
        $response['state'] = "false";
        $data = new Data();
        $data->user_id = Auth::user()->id;
        $data->product_id = $id;
        $cart = new User();
        $cart =DB::table('users')->select('cart_num','total_price')->where('id',Auth::user()->id)->get();
        $products = DB::table('products')->select('price')->where('id',$id)->get();
        $count = 0;
        $total_price =0;

        foreach($cart as $item){
            $count = $item->cart_num+1;
        }
        foreach ($cart as $price){
            $total_price = $price->total_price;
        }
        foreach ($products as $pro){
             $total_price = $total_price + $pro->price ;
        }
        
        $cart_num = User::where('id',Auth::user()->id)->update(['cart_num' => $count]);
        $Tprice =  User::where('id',Auth::user()->id)->update(['total_price' => $total_price]);
        if($data->save() && $cart_num ){
            $response['state'] = "true";
            echo json_encode($response);
            exit;
        }else{
        echo json_encode($response);
        exit;
        }
    }

    public function cart_details()
    {
        $data = new Data();
        $products = new Product();
        $cart_num = new User();
        $cart_num =DB::table('users')->select('cart_num')->where('id', Auth::user()->id)->get();
        
        $count = 0;
        foreach ($cart_num as $item) {
            $count = $item->cart_num;
        }

        $prices =  DB::table('users')->select('total_price')->where('id', Auth::user()->id)->get();
        $total_price =0;
        foreach ($prices as $item) {
            $total_price = $item->total_price;
        }

        $data = DB::table('data')->where('user_id', Auth::user()->id)->get();
        $products = DB::table('products')->get();       
        

        //$data = DB::table('data')->where('user_id',Auth::user()->id)->get();
        return view('Frontview.cart')->with('products',$products)
        ->with('count',$count)->with('total_price',$total_price)->with('data',$data);
    }
    public function remove($id)
    {
        $find = new Data();
        $cart = new User();
        $cart =DB::table('users')->select('cart_num','total_price')->where('id',Auth::user()->id)->get();
        $products = DB::table('products')->select('price')->where('id',$id)->get();
        $count = 0;
        $total_price = 0;
        foreach($cart as $item){
            $count = $item->cart_num-1;
        }

        foreach ($cart as $price){
            $total_price = $price->total_price;
        }
        foreach ($products as $pro){
             $total_price = $total_price - $pro->price ;
        }
        $cart_num = User::where('id',Auth::user()->id)->update(['cart_num' => $count]);
        $Tprice = User::where('id',Auth::user()->id)->update(['total_price' => $total_price]);
        $find = DB::table('data')->where('product_id',$id)->delete();
        $response = "false";
       
        if($find && $cart_num ){
            $response = "true";
            echo json_encode($response);
            exit;
        }
            echo json_encode($response);
            exit;
    }

    
 
}
