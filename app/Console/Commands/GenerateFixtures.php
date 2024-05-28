<?php

namespace App\Console\Commands;

use App\Models\Animal;
use App\Models\Category;
use Faker\Factory as Faker;
use Illuminate\Console\Command;

class GenerateFixtures extends Command
{
    protected $signature = 'app:generate-fixtures {--animals-num= : Number of animals to generate} {--truncate=0 : Truncate animals table before generating}';

    protected $description = 'Generate fixtures for animals and categories';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $animalsNum = (int) $this->option('animals-num');
        $truncate = (bool) $this->option('truncate');

        $faker = Faker::create();

        // Check if animals number is in range
        if (! ($animalsNum >= 1 && $animalsNum <= 1000)) {
            $this->error('The number must be between 1 and 1000');

            return;
        }

        // Truncate the animals table if the option is set
        if ($truncate) {
            Animal::truncate();
        }

        // Create 3 categories
        $categories = Category::factory()->count(3)->create();

        // Create animals
        for ($i = 0; $i < $animalsNum; $i++) {
            Animal::create([
                'category_id' => $categories->random()->id,
                'name' => $faker->word,
                'description' => $faker->text(10),
                'weight' => $faker->numberBetween(1, 10000),
            ]);
        }

        $this->info('Fixtures generated successfully!');
    }
}
