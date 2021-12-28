<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogArticleCategories = [
            [
                'name' => [
                    'en' => 'Design',
                ],
                'color' => '#17BA3A'
            ],
            [
                'name' => [
                    'en' => 'Tools',
                ],
                'color' => '#21AEFE'
            ],
            [
                'name' => [
                    'en' => 'Marketing',
                ],
                'color' => '#F1511E'
            ],
            [
                'name' => [
                    'en' => 'Branding',
                ],
                'color' => '#A610ED'
            ]
        ];

        foreach ($blogArticleCategories as $blogArticleCategory) {
            \App\Models\BlogArticleCategory::create([
                'name' => json_encode($blogArticleCategory['name']),
                'color' => $blogArticleCategory['color']
            ]);
        }
    }
}
