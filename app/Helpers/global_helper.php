<?php

// create unique slub

if(!function_exists('generateUniqueSlug')){
    function generateUniqueSlug($model,$name):string{
        $modelClass = "App\\Models\\$model";

        if(!class_exists($modelClass)){
            throw new \InvalidArgumentException("model $modelClass not found");
        }
        $slug = Str::slug($name);
        $count = 2;
        while($modelClass::where('slug',$slug)->exists()){
            $slug = Str::slug($name).'-'.$count;
            $count++;
        }
        return $slug;
    }
}


if(!function_exists('cartTotal')){
    function cartTotal(){
        $total = 0;
        $optionPrice = 0;
        $sizePrice = 0;
        foreach(Cart::content() as $item){
            $productPrice = $item->price;
            $sizePrice = $item->options?->product_size['price'] ?? 0;
            foreach($item->options->product_option as $option){
                $optionPrice = $option['price'];
            }

            $total += ($productPrice + $sizePrice + $optionPrice) * $item->qty;
        }
        return $total;
    }
}

if(!function_exists('cartProductTotal')){
    function cartProductTotal($rowId){
        $total = 0;
        $optionPrice = 0;
        $sizePrice = 0;
        $item = Cart::get($rowId);
            $productPrice = $item->price;
            $sizePrice = $item->options?->product_size['price'] ?? 0;
            foreach($item->options->product_option as $option){
                $optionPrice = $option['price'];
            }

            $total += ($productPrice + $sizePrice + $optionPrice) * $item->qty;
        return $total;
    }
}

if(!function_exists('grandCartTotal')){
    function grandCartTotal($delivery_fee=0){
        $total = 0;
        $cartTotal = cartTotal();
        if(session()->has('coupon')){
                $discount=session()->get('coupon')['discount'];
                $total = ($cartTotal+$delivery_fee)-$discount;
                return $total;
        }else{
            $total = $cartTotal+$delivery_fee;
            return $total;
        }
    }
}

if(!function_exists('generateInvoiceId')){
    function generateInvoiceId(){
        $randomNumber = rand(1,999999);
        $currentDateTime = now();
        $invoiceId = $randomNumber.$currentDateTime->format('ymd').$currentDateTime->format('s');
        return $invoiceId;
    }
}

