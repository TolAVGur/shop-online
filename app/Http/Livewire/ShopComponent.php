<?php

namespace App\Http\Livewire;

use Livewire\Component;
//use Livewire\WithPagination;
use App\Models\Product;
use Cart;

class ShopComponent extends Component
{
    /*use WithPagination;

    public $sorting;
    public $pagesize;

    public function mount() {
        $this->sorting = "default";
        $this->pagesize = 12;
    }*/

    public function store($product_id, $product_name, $product_price) {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added to Cart');
        return redirect()->route('product.cart');
    }


    public function render()
    {
        $products = Product::paginate(12);
        return view('livewire.shop-component', ['products' => $products])->layout('layouts.base');
    }
}
