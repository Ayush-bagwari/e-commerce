<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Fetch all the products
     */
    public function index(){
        try{
            $products = Product::paginate(10);
            return response()->json([
                'success' => true,
                'data' => $products,
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to create product: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get individual product
     */
    public function show($id){
        try{
            $product = Product::findOrFail($id);
            return response()->json([
                'success' => true,
                'message'=> 'Product details',
                'data' => $product,
            ], 201);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not exist',
            ], 404);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to get product: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created product.
    */
    public function create(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:260',
            'description' => 'nullable|string',
            'price' => 'required'
        ]);
        try{
            $product = Product::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
            ]);
            return response()->json([
                'success' => true,
                'message'=> 'Product created Successfully',
                'data' => $product,
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to create product: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete the specified product.
     */
    public function destroy($id)
    {
        try{
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Prouct deleted successfully',
                'data' => $product,
            ], 200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not exist',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete product: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Search for a product.
    */
    public function search(Request $request){
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        try{
            $name = $request->name;
            $products = Product::where('name', 'LIKE', "%{$name}%")
            ->limit(20)
            ->get();
            return response()->json([
                'data' => $products,
                'success' => true,
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to get products: ' . $e->getMessage(),
            ], 500);
        }
    }
}
