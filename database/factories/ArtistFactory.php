<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'picture_id' => 1,
            'genre_id' => 1,
            'location' => $this->faker->city,
            'description' => $this->faker->sentence,
            'instaHandle' => $this->faker->userName,
            'ytEmbedUrl' => 'https://www.youtube.com/embed/dQw4w9WgXcQ?si=o2Y5qSSRfMpZa1l3&amp;controls=0',
            'spotifyEmbedUrl' => 'https://open.spotify.com/embed/artist/0gxyHStUsqpMadRV0Di1Qt?utm_source=generator',
        ];
    }
}