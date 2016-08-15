<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Product;

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
    return view('catalog/product', [ 'productInfo' => $productInfo ]);
  }
}
