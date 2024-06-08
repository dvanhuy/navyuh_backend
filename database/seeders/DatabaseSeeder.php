<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Posts;
use App\Models\Server;
use App\Models\User;
use GuzzleHttp\Promise\Create;
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
        $this->call([UserSeeder::class]);
        Server::factory()->count(10)->create();
        $servers = Server::limit(10)->get();
        foreach ($servers as $server) {
            Posts::create([
                'user_id' => User::all()->random()->id,
                'content' => fake()->sentence(30)." <a style='color:blue;text-decoration: underline;' href='".config('app.front_end')."/servers/join/{$server->id}'>{$server->name}</a>",
                'images'=>fake()->imageUrl(),
            ]);
        };
    }
}
