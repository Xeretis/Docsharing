<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Space;
use App\Models\User;
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
        User::factory(10)->create();

        Space::factory(10)->create();

        Space::factory(10)->create([
            'owner_id' => User::inRandomOrder()->first()->id,
        ]);

        Space::factory(10)->create([
            'owner_id' => User::inRandomOrder()->first()->id,
        ]);

        $spaces = Space::all();

        User::all()->each(function ($user) use ($spaces) {
            $count = 0;
            $desiredCount = rand(1, 3);

            while ($count < $desiredCount) {
                $space = $spaces->random();

                if ($space->owner_id === $user->id) {
                    continue;
                }

                $user->joinedSpaces()->attach($space->id);
                $count++;
            }
        });

        Space::all()->each(function ($space) {
            Post::factory(7)->create([
                'space_id' => $space->id,
            ]);
        });

        User::factory(10)->create();
    }
}
