<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BooksTableSeeder extends Seeder
{
    private $categories = [
        ['title' => 'Детектив'],
        ['title' => 'Классика'],
        ['title' => 'Русская классика', 'parent_id' => 'Классика'],
        ['title' => 'Европейская классика', 'parent_id' => 'Классика'],
        ['title' => 'Азиатская классика', 'parent_id' => 'Классика'],
        ['title' => 'Научная фантастика'],
        ['title' => 'Космо-опера', 'parent_id' => 'Научная фантастика'],
        ['title' => 'Альтернативная история', 'parent_id' => 'Научная фантастика'],
        ['title' => 'Обучающие'],
        ['title' => 'Исторические'],
        ['title' => 'Сказки'],
        ['title' => 'Техническая литература'],
    ];

    private $authors = [
        ['title' => 'Артур Кларк'],
        ['title' => 'Айзек Азимов'],
        ['title' => 'Станислав Лем'],
        ['title' => 'Котеров'],
        ['title' => 'Достаевский'],
        ['title' => 'Дикенс'],
        ['title' => 'Пушкин'],
        ['title' => 'Гюго'],
        ['title' => 'Мураками'],
        ['title' => 'Вальтер'],
        ['title' => 'Ницше'],
        ['title' => 'Конан Дойль'],
        ['title' => 'Лев Толстой'],
        ['title' => 'Карл Саган'],
        ['title' => 'Агата Кристи'],
        ['title' => 'Сократ'],
        ['title' => 'Аристотель'],
        ['title' => 'Кант']
    ];

    private $publisher = [
        ['name' => 'Освита'],
        ['name' => 'Прогресс'],
        ['name' => 'Сияние'],
        ['name' => 'Печать'],
    ];

    private $books = [
        ['title' => 'PHP', 'publisher_id' => 'Прогресс', 'category_id' => 'Обучающие', 'author_id' => 'Котеров'],
        ['title' => 'WEB', 'publisher_id' => 'Прогресс', 'category_id' => 'Обучающие', 'author_id' => 'Котеров'],
        ['title' => 'ООП', 'publisher_id' => 'Сияние', 'category_id' => 'Обучающие', 'author_id' => 'Котеров'],
        ['title' => 'JAVA', 'publisher_id' => 'Сияние', 'category_id' => 'Обучающие', 'author_id' => 'Котеров'],
        ['title' => 'PYTHON', 'publisher_id' => 'Сияние', 'category_id' => 'Обучающие', 'author_id' => 'Котеров'],
        ['title' => 'Академия', 'publisher_id' => 'Освита', 'category_id' => 'Научная фантастика', 'author_id' => 'Айзек Азимов'],
        ['title' => 'Академия 2', 'publisher_id' => 'Освита', 'category_id' => 'Научная фантастика', 'author_id' => 'Айзек Азимов'],
        ['title' => 'Академия 3', 'publisher_id' => 'Освита', 'category_id' => 'Научная фантастика', 'author_id' => 'Айзек Азимов'],
        ['title' => 'Академия 4', 'publisher_id' => 'Освита', 'category_id' => 'Научная фантастика', 'author_id' => 'Айзек Азимов'],
        ['title' => 'Академия 5', 'publisher_id' => 'Освита', 'category_id' => 'Научная фантастика', 'author_id' => 'Айзек Азимов'],
        ['title' => 'Академия 6', 'publisher_id' => 'Освита', 'category_id' => 'Научная фантастика', 'author_id' => 'Айзек Азимов'],
    ];

    public function run()
    {
        $categoryIds = [];
        $authorIds = [];
        $publisherIds = [];

        foreach ($this->categories as $key => $item){

            $category = factory(\App\Models\Books\Category::class)->create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title'], '-'),
                'position' => $key,
                'parent_id' => isset($item['parent_id']) ? $categoryIds[$item['parent_id']] : null
            ]);

            $categoryIds[$item['title']] = $category->id;
        }

        foreach ($this->authors as $key => $item){

            $author = factory(\App\Models\Books\Author::class)->create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title'], '-'),
            ]);

            $authorIds[$item['title']] = $author->id;
        }

        foreach ($this->publisher as $key => $item){

            $publisher = factory(\App\Models\Books\Publisher::class)->create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name'], '-'),
            ]);

            $publisherIds[$item['name']] = $publisher->id;
        }

        foreach ($this->books as $key => $item){

            $books = factory(\App\Models\Books\Book::class)->create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title'], '-'),
                'category_id' => $categoryIds[$item['category_id']],
                'publisher_id' => $publisherIds[$item['publisher_id']],
                'author_id' => $authorIds[$item['author_id']]
            ]);


        }
    }
}
