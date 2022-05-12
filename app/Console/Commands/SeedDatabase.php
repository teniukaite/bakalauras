<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Offer;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Console\Command;

class SeedDatabase  extends Command
{
    protected $signature = 'seed:database';

    protected $description = 'Seed the database with test data';

    private Generator $faker;

    public function __construct()
    {
        parent::__construct();
        $this->faker = Factory::create('lt_LT');
    }

    public function handle()
    {
        $categories = [
            'Mechanika',
            'Elektronika',
            'Informatika',
            'Grožis',
            'Pagalbiniai darbai',
            'Švietimas',
            'Statyba'
        ];

        foreach ($categories as $category) {
           $dbCategory = Category::create([
                'name' => $category,
            ]);

           $this->seedOffers($dbCategory->id);
        }

        return 0;
    }

    public function seedOffers($category)
    {
        switch ($category) {
            case 1:
                $services = [
                    'Variklio remontas',
                    'Automobilio dažymas',
                    'Kėbulo remontas',
                    'Važiuoklės remontas',
                    'Padangų keitimas',
                    'Elektronikos remontas',
                    'Automobilio apdaila',
                ];
                break;
            case 2:
                $services = [
                    'Televizorių remontas',
                    'Smulkios  technikos remontas',
                    'Telefonų remontas',
                    'Kompiuterių remontas',
                    'Elektros instalacijos darbai',
                    'Apšvietimo darbai',
                    'Buitinės technikos remontas',
                ];
                break;
            case 3:
                $services = [
                    'WEB puslapių kūrimas',
                    'Grafikos dizainas',
                    'Projektavimas',
                    'Mobiliųjų programų kūrimas',
                    'Konsultacijos kompiuterio pasirinkimui',
                    'Žaidimų kūrimas',
                    'Dizaino kūrimas',
                ];
                break;
            case 4:
                $services = [
                    'Plaukų dažymas',
                    'Plaukų kirpimas',
                    'Atsatomoji procedūra',
                    'Veido valymas',
                    'Masažas',
                    'Nagų priaugimas',
                    'Manikiūras'
                ];
                break;
            case 5:
                $services = [
                    'Pagalba ūkyje',
                    'Tvorų statymas',
                    'Tvorų dažymas',
                    'Aplinkos priežiūra',
                    'Namų tvarkymas',
                    'Gyvūnų priežiūra',
                    'Vaikų priežiūra',
                ];
                break;
            case 6:
                $services = [
                    'Pagalba prieš egzaminus',
                    'Papildomos matematikos pamokos',
                    'Papildomos fizikos pamokos',
                    'Teksto redagavimas',
                    'Papildomos istorijos pamokos',
                    'Kūrybinis rašymas',
                    'Recenzijos',
                ];
                break;
            case 7:
                $services = [
                    'Pamatų išpylimas',
                    'Architekto paslaugos',
                    'Vidaus apdaila',
                    'Išorės apdaila',
                    'Santechnikos darbai',
                    'Trinkelių klojimas',
                    'Pastatų projektų kūrimas',
                ];
                break;
        }

        foreach ($services as $service) {
            Offer::create([
                'service_name' => $service,
                'description' => $this->faker->sentence,
                'price' => $this->faker->randomFloat(2, 0, 100),
                'city' => $this->faker->numberBetween(1, 57),
                'freelancer_id' => $this->faker->numberBetween(1, 100),
                'category_id' => $category,
                'duration' => $this->faker->numberBetween(1, 100),
                'price_content' => 'eur/val',
            ]);
        }
    }
}
