<?php declare(strict_types=1);

namespace Database\Seeders;

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
         \App\Models\User::factory(1000)->create();
         \App\Models\Category::factory(100)->create();

         $this->call(OfferSeeder::class);
         $this->call(ImageSeeder::class);
    }
}
