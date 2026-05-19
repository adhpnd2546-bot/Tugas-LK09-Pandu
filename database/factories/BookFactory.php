<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $categories = ['Novel', 'Sains', 'Sejarah', 'Teknologi', 'Filsafat', 'Pendidikan', 'Agama', 'Komik'];
        $publishers = [
            'Gramedia Pustaka Utama',
            'Erlangga',
            'Mizan',
            'Penerbit Republika',
            'Bentang Pustaka',
            'Kompas Media',
            'Deepublish',
            'Pustaka Jaya',
        ];

        return [
            'title'       => fake('id_ID')->sentence(rand(2, 6)),
            'author'      => fake('id_ID')->name(),
            'publisher'   => fake()->randomElement($publishers),
            'year'        => fake()->numberBetween(1990, (int) date('Y')),
            'category'    => fake()->randomElement($categories),
            'description' => fake('id_ID')->paragraphs(rand(1, 3), true),
            'cover'       => null,
        ];
    }
}
