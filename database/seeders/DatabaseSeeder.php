<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\JoiningDetails;
use App\Models\Message;
use App\Models\Posts;
use App\Models\Server;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UserSeeder::class]);
        Server::factory()->count(10)->create();
        $this->call([PostSeeder::class]);
        $this->call([JoiningDetailSeeder::class]);
        $this->call([MessageSeeder::class]);
    }
}
