<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FollowFactory extends Factory
{

    public function definition()
    {
        $follow = User::all()->pluck('id')->toArray();

        return [
            'follower_id' => $this->faker->randomElement($follow),
            'following_id' => $this->faker->randomElement($follow),
        ];
    }
}
