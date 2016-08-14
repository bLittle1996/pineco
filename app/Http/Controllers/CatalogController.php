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
      }
      foreach($products as $key => $pageAwareObject) {
        $appends[str_replace(' ', '_', $key)] = $pageAwareObject->currentPage();
     }

      return view('catalog/catalog', [
        'inventory' => $products,
        'appends' => $appends
      ]);
    }
}
