<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    /**
     * View Products
    */
    public function index(){
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }
}