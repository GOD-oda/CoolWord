<?php

namespace Database\Seeders;

use App\Models\CoolWord;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         User::factory()->admin()->create();
         CoolWord::factory(30)
             ->has(Tag::factory()->count(3))
             ->create();
    }
}
