<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 10; $i++) {
            \App\Models\BlogArticle::create([
                'name' => json_encode(['en' => 'Does a Logo Have to be Deep and Meaningful?']),
                'slug' => 'article-' . $i,
                'category_id' => rand(1, 4),
                'title_image' => '/site/img/big-blog.jpg',
                'content' => json_encode(['en' => 'Content']),
                'is_published' => true,
            ]);
        }
    }
}
