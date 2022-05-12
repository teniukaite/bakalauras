<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Seeder;

class RequestsSeeder extends Seeder
{
    public function run()
    {
        Request::factory()->count(1000)->create();
    }
}
