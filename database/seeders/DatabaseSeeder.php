<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Catalog;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Admin::factory()->create();
        User::factory()->count(10)->create();
        Transaction::factory()->count(10)->create();
        Catalog::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        Order::factory()->count(10)->create();
        Cart::factory()->count(10)->create();
        Comment::factory()->count(50)->create();
    }
}
