<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Product;
use App\ProductReview;
use Auth;
use DB;

class CatalogController extends Controller
{
  public function getCatalog() {
    $categories = Category::all();
    $products = [];
    $appends = [];
    $elementsPerPage = 10;
    foreach($categories as $category) {
      $products[$category->name] = Product::where('category_id', '=', $category->id)->paginate($elementsPerPage, ['*'], str_replace(' ', '_', $category->name));
      $appends[str_replace(' ', '_', $category->name)] = $products[$category->name]->currentPage();
    }

    return view('catalog/catalog', [
      'inventory' => $products,
      'appends' => $appends
    ]);
  }

  public function getProduct($productInfo) {
    $productName = str_replace('_', ' ', $productInfo);
    $product = Product::where('name', $productName)->with('reviews.user')->first();
    if($product == null) {
      return redirect()->route('catalog');
    }
    return view('catalog/product', [ 'product' => $product ]);
  }

  public function addReview(Request $request) {
    $this->validate($request, [
      'rating' => 'required',
      'message' => 'required'
    ]);

    $review = new ProductReview();
    $review->rating = $request['rating'];
    $review->message = $request['message'];
    $review->product_id = $request['product_id'];
    $review->user_id = Auth::user()->id;
    $review->save();

    return redirect()->back();
  }
}
