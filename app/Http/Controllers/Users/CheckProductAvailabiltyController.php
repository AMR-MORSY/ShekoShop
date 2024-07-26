<?php

namespace App\Http\Controllers\Users;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;
use App\Http\Controllers\Controller;

use App\Http\Requests\CheckingProductAvailabilityRequest;
use App\Http\Requests\CheckingProductsAvailabilityRequest;
use App\Models\Size;

class CheckProductAvailabiltyController extends Controller
{
    public function checkProductAvailability(CheckingProductAvailabilityRequest $request)
    {
        $size=Size::find($request->input('size'));
        $size = (string)Str::of($size->name)->before('gm'); /////////// (string) casting the output of Str class to be string instade of stringuble
        $size = intval($size); /////// converting the string to integer number
       
        $product_stock = Product::find($request->input('id'))->product_stock; /////getting product stock attribute
        if ($product_stock >= $request->input('quantity')*$size) {///////////////////checking if product stock covers the needed quantity or not
            return response()->json( 'success', 200);
        }
        return response()->json($product_stock
        , 200);
    }

    public function checkProductsAvailability(CheckingProductsAvailabilityRequest $request)
    {
        $products=$request->input('products');
        $products=collect($products)->groupBy('id')->all();//////as the products might be repeated,so we have to acummulate the needed quantity from each product
        $newProducts=[];
        foreach($products as $key=>$items)
        {
            $prodTotalQunt=0;
            $newProduct=[];
            foreach($items as $item) ///////iterate on each product id to gather the quantities based on requested bag size
            {
                $itemQuant=$item['quantity']*$item['size'];
                $prodTotalQunt=$prodTotalQunt+$itemQuant;

            }
            $prodStock=Product::find($key)->product_stock;
            if($prodStock>=$prodTotalQunt)//////after collecting all the needed qunatity from the product will compare wit the product available stock
            {
                $newProduct[$key]='ok'; //////return product id=>'ok' pair in case of stock availabity
                array_push($newProducts,$newProduct);


            }
            else{
                $newProduct[$key]=$prodStock; //////return product id=>'available stock' pair in case of stock unavailabity
                array_push($newProducts,$newProduct);

            }
        }
        return response()->json(
            $newProducts
        );

        
    }
}
