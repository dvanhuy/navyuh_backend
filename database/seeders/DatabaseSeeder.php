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
                'user_id' => '1',
                'server_id' => Server::all()->random()->id,
                'content' => "Join my server : {$server->name}",
            ]);
        };
    }
}
