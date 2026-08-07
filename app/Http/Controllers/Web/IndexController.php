<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Tag;
use App\Repositories\BrandRepository;
use App\Repositories\CateRepository;
use App\Repositories\FaqRepository;
use App\Repositories\ProductRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index(ProductRepository $productRepository){

        $products = $productRepository->limit(7)->all();


        $faqs = app(FaqRepository::class)->limit(6)->all();



        $for_people_untreated = app('cache.config')->get('for_people');
        $for_people = [];
        if($for_people_untreated){
            $for_people = json_decode($for_people_untreated);
        }


        $trouble_untreated = app('cache.config')->get('trouble');
        $trouble = [];
        if($trouble_untreated){
            $trouble = json_decode($trouble_untreated);
        }

        $trade_show_untreated = app('cache.config')->get('trade_show');
        $trade_show = [];
        if($trade_show_untreated){
            $trade_show = json_decode($trade_show_untreated,true);
        }

        return view('web.index',compact('products','faqs','for_people','trouble','trade_show'));
    }


}
