<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Product;
class CategoriesAndProducts extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    //genuine pinecones category and products
    {
      $category = new Category();
      $category->name = 'genuine pinecones';
      $category->save();

      for($x = 1; $x <= 107; $x++) {
        $product = new Product();
        $product->name = "Generic Filler Cone " . $x;
        $product->price = 1.99;
        $product->quantity = 40000;
        $product->short_desc = "This pinecone hails from the place from which all before it originated, Kent!";
        $product->thumbnail = 'images/products/thumbnails/200x200pinecone.png';
        $category->products()->save($product);
      }
    }
    //create category and products for the conifers section
    {
      $category = new Category();
      $category->name = 'conifers';
      $category->save();

      for($x = 1; $x <= 13; $x++) {
        $product = new Product();
        $product->name = "Generic Filler Conifer " . $x;
        $product->price = 199.99;
        $product->quantity = 367;
        $product->short_desc = "These premium conifers are the best around, and they are never going to keep you down!";
        $product->thumbnail = 'images/products/thumbnails/200x200conifer.png';
        $category->products()->save($product);
      }
    }
    //create products for pinecone accessories
    {
      $category = new Category();
      $category->name = 'pinecone accessories';
      $category->save();
      for($x = 1; $x <= 29; $x++) {
        $product = new Product();
        $product->name = "Generic Filler Accessory " . $x;
        $product->price = 4.99;
        $product->quantity = 670;
        $product->short_desc = "Enjoy these top notch pinecone accessories. Please buy them, PLEASE!";
        $product->thumbnail = 'images/products/thumbnails/200x200accessories.png';
        $category->products()->save($product);
      }
    }
    //create products for artificial pinecones
    {
      $category = new Category();
      $category->name = 'artificial pinecones';
      $category->save();
      for($x = 1; $x <= 57; $x++) {
        $product = new Product();
        $product->name = "Generic Filler Fake Cone " . $x;
        $product->price = 0.99;
        $product->quantity = 89000;
        $product->short_desc = "These pinecones look like the real thing, but here's the kicker: they're not! Who'd've thunk?";
        $product->thumbnail = 'images/products/thumbnails/200x200artificial.png';
        $category->products()->save($product);
      }
      $product = new Product();
      $product->name = "HTML Desc Test";
      $product->price = 14.69;
      $product->quantity = 142952;
      $product->short_desc = "This product exists to test whether or not the long_desc field doesn't escape html. This way companies can include their own html and in-line styling to provide a much better overview for a product than a simple paragraph or two! Similar to how some products on newegg has all sorts of more detailed product info with pictures and styling and stuff.";
      $product->long_desc = "<div><em style='color: green;'>HTML Desc Test is fabulous</em></div><div><p style='color: red;'>So fabulous</p></div>";
      $product->thumbnail = 'images/products/thumbnails/200x200pinecone.png';
      $category->products()->save($product);
    }
    //create seasonal products and the sort
    {
      $category = new Category();
      $category->name = 'seasonal pinecones';
      $category->save();
      for($x = 1; $x <= 32; $x++) {
        $product = new Product();
        $product->name = "Generic Filler Seasonal Wreath " . $x;
        $product->price = 14.99;
        $product->quantity = 15;
        $product->short_desc = "Spice up your holiday season with beautiful pinecone themed decorations, such as this wreath here!";
        $product->thumbnail = 'images/products/thumbnails/200x200seasonal.png';
        $category->products()->save($product);
      }
    }
  }
}
