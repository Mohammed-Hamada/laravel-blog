<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $mohammed = User::factory()->create([
            'name' => "Mohammed Hamada"
        ]);

        $ahmed = User::factory()->create([
            'name' => "Ahmed Hamada"
        ]);
        
        $work = Category::factory()->create([
            'name' => "Work",
            'slug' => 'work'
        ]);

        $health = Category::factory()->create([
            'name' => "Health",
            'slug' => 'health'
        ]);

        Post::factory(5)->create([
            'user_id' => $mohammed->id,
            'category_id' => $work->id
        ]);

        Post::factory(5)->create([
            'user_id' => $ahmed->id,
            'category_id' => $health->id
        ]);


    }
}