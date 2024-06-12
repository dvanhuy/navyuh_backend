<?php

namespace Database\Seeders;

use App\Models\Posts;
use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
