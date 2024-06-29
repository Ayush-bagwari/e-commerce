<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartProduct;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * View User Cart
    */
    public function index(){
        $userId = Auth::id();
        $items = CartProduct::with('product')->where('user_id', $userId)->get();
        return view('cart.index', compact('items'));
    }

    /**
     * Add to Cart
    */
    public function addToCart(Request $request,$id){
        $userId = Auth::id();
        $item = CartProduct::where('user_id',$userId)->where('product_id', $id)->first();
        if($item){
            $item->quantity = $item->quantity + 1; 
            $item->save();
        }else{
            CartProduct::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }
        return redirect()->route('cart.index');
    }
}
