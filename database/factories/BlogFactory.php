<?php

namespace Database\Factories;

use App\Models\Blog;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6), // Generate a random sentence with 6 words for the title
        'slug' => Str::slug($faker->unique()->sentence(4)), // Generate a unique slug from a random sentence with 4 words
        'banner' => 'placeholder.jpg', // You can use a placeholder image or define logic for random banner paths
        'description' => $faker->paragraph(2), // Generate a random paragraph with 2 sentences for the description
        'content' => $faker->paragraphs(5, true), // Generate 5 random paragraphs for the content
        'created_by' => factory(App\Models\User::class)->create()->id, // Assuming you have a User model
    ];
});
