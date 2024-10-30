<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models 
use App\Models\Project;
use App\Models\Type;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::truncate();

        for ($i=0; $i < 15; $i++) { 
            $name = fake()->words(3, true);
            $slug = str()->slug($name);

            $randomTypeId = null;
            if (rand(0,2)) {
                $randomType = Type::inRandomOrder()->first();
                $randomTypeId = $randomType->id;
            }

            Project::create([
                'name' => $name,
                'slug' => $slug,
                'description' => fake()->text(),
                'delivery_time' => rand(1,110),
                'price' => fake()->randomFloat(2, 1 , 99999),
                'complete' => fake()->boolean(80),
                'type_id' => $randomTypeId
            ]);
        }
    }
}
