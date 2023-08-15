<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory(30)->create()->each(function (Order $order) {
            $products = Product::where('shop_id', $order->shop_id)->get();
            $allOrderDetails = OrderDetail::factory(rand(2, 5))->create([
                'order_id' => $order->id,
                'product_id' => $products->random()->id,
            ])->each(function (OrderDetail $orderDetails) use ($products) {
                $product = $products->random();
                $orderDetails->product_id = $product->id;
                $orderDetails->price = $product->price;
                $orderDetails->save();
                $orderDetails->total = $product->price * $orderDetails->quantity;
            });
            $order->total = $allOrderDetails->sum('total');
            $order->save();

        });
    }
}
