<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCate;
use App\Models\ProductTag;
use App\Models\Spu;
use App\Models\Theme;
use App\Repositories\BrandRepository;
use App\Repositories\CateRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TagRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function index(ProductRepository $productRepository){
        $products = $productRepository->all();

        return template('product.index',compact('products'));
    }


    public function show($id){
        $product = Product::where('id',$id)->where('status',1)->first();

        if(!$product){
            abort(404);
        }

        $cate = ProductCate::with(['cate'=>function($query){
            $query->with('parent');
        }])->where('product_id',$id)->first();


        $guess = Product::inRandomOrder()->where('status',1)->where('is_stock',1)->orderBy('sort','desc')->limit(5)->get();

        $sku_goods = [];
        if($product->spu_id > 0){
            $sku_ids = Spu::find($product->spu_id)->value('sku_ids');
            $sku_goods = Product::whereIn('id',explode(',',$sku_ids))->where('id','<>',$id)->orderBy('sort','desc')->get();

        }

        return template('product.show',compact('product','guess','cate','sku_goods'));
    }
}
