<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         User::factory(1000)->create();
//         Category::factory(100)->create();

         $this->call(OfferSeeder::class);
         $this->call(ImageSeeder::class);
         $this->call(OrderSeeder::class);
    }
}
