<?php

namespace App\Console\Commands;

use App\Models\Block;
use App\Models\DesignerPlan;
use App\Models\Icon;
use App\Models\Language;
use App\Models\Shape;
use App\Models\BlogArticle;
use App\Models\BlogArticleCategory;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\QuestionCategory;
use App\Models\Questions;
use App\Models\Page;
use App\Models\MenuItem;
use Aws\Exception\AwsException;
use Aws\Translate\TranslateClient;
use Illuminate\Console\Command;

class TranslateSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translation:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Website translation.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new TranslateClient([
            'profile' => 'default',
            'region' => 'us-west-2',
            'version' => '2017-07-01'
        ]);

        foreach (Block::all() as $block) {
            $data = isset($block->data) ? json_decode($block->data, true) : [];

            foreach ($data as $block_name => $values) {
                $default = $values['en'] ?? false;

                if ($default and count($values) > 1) {
                    foreach (Language::all() as $language) {
                        try {
                            $result = $client->translateText([
                                'SourceLanguageCode' => 'en',
                                'TargetLanguageCode' => $language->code,
                                'Text' => $default,
                            ]);

                            $data[$block_name][$language->code] = $result->get("TranslatedText");
                        } catch (AwsException $e) {
                            $this->error($e->getMessage());
                        }
                    }
                }
            }

            $block->update([
                'data' => json_encode($data)
            ]);
        }

        foreach (Shape::all() as $shape) {
            $data = isset($shape->name) ? json_decode($shape->name, true) : [];
            $default = $data['en'] ?? false;

            if ($default and count($data) > 1) {
                foreach (Language::all() as $language) {
                    try {
                        $result = $client->translateText([
                            'SourceLanguageCode' => 'en',
                            'TargetLanguageCode' => $language->code,
                            'Text' => $default,
                        ]);

                        $data[$language->code] = $result->get("TranslatedText");
                    } catch (AwsException $e) {
                        $this->error($e->getMessage());
                    }
                }
            }

            $shape->update([
                'name' => json_encode($data)
            ]);
        }

        foreach (Icon::all() as $icon) {
            $data = isset($icon->name) ? json_decode($icon->name, true) : [];
            $default = $data['en'] ?? false;

            if ($default and count($data) > 1) {
                foreach (Language::all() as $language) {
                    try {
                        $result = $client->translateText([
                            'SourceLanguageCode' => 'en',
                            'TargetLanguageCode' => $language->code,
                            'Text' => $default,
                        ]);

                        $data[$language->code] = $result->get("TranslatedText");
                    } catch (AwsException $e) {
                        $this->error($e->getMessage());
                    }
                }
            }

            $icon->update([
                'name' => json_encode($data)
            ]);
        }

        foreach (DesignerPlan::all() as $plan) {
            $data = [
                'title' => isset($plan->title) ? json_decode($plan->title, true) : [],
                'advantages' => isset($plan->advantages) ? json_decode($plan->advantages, true) : []
            ];

            foreach ($data as $key => $values) {
                $default = $values['en'] ?? false;

                if ($default and count($values) > 1) {
                    foreach (Language::all() as $language) {
                        try {
                            $result = $client->translateText([
                                'SourceLanguageCode' => 'en',
                                'TargetLanguageCode' => $language->code,
                                'Text' => $default,
                            ]);

                            $data[$key][$language->code] = $result->get("TranslatedText");
                        } catch (AwsException $e) {
                            $this->error($e->getMessage());
                        }
                    }
                }
            }

            $plan->update([
                'title' => json_encode($data['title']),
                'advantages' => json_encode($data['advantages'])
            ]);
        }

        foreach (Questions::all() as $question) {
            $data = [
                'name' => isset($question->name) ? json_decode($question->name, true) : [],
                'content' => isset($question->content) ? json_decode($question->content, true) : []
            ];

            foreach ($data as $key => $values) {
                $default = $values['en'] ?? false;

                if ($default and count($values) > 1) {
                    foreach (Language::all() as $language) {
                        try {
                            $result = $client->translateText([
                                'SourceLanguageCode' => 'en',
                                'TargetLanguageCode' => $language->code,
                                'Text' => $default,
                            ]);

                            $data[$key][$language->code] = $result->get("TranslatedText");
                        } catch (AwsException $e) {
                            $this->error($e->getMessage());
                        }
                    }
                }
            }

            $question->update([
                'name' => json_encode($data['name']),
                'content' => json_encode($data['content'])
            ]);
        }

        foreach (QuestionCategory::all() as $category) {
            $data = [
                'name' => isset($category->name) ? json_decode($category->name, true) : [],
                'content' => isset($category->content) ? json_decode($category->content, true) : []
            ];

            foreach ($data as $key => $values) {
                $default = $values['en'] ?? false;

                if ($default and count($values) > 1) {
                    foreach (Language::all() as $language) {
                        try {
                            $result = $client->translateText([
                                'SourceLanguageCode' => 'en',
                                'TargetLanguageCode' => $language->code,
                                'Text' => $default,
                            ]);

                            $data[$key][$language->code] = $result->get("TranslatedText");
                        } catch (AwsException $e) {
                            $this->error($e->getMessage());
                        }
                    }
                }
            }

            $category->update([
                'name' => json_encode($data['name']),
                'content' => json_encode($data['content'])
            ]);
        }

        foreach (Testimonial::all() as $testimonial) {
            $data = [
                'name' => isset($testimonial->name) ? json_decode($testimonial->name, true) : [],
                'content' => isset($testimonial->content) ? json_decode($testimonial->content, true) : []
            ];

            foreach ($data as $key => $values) {
                $default = $values['en'] ?? false;

                if ($default and count($values) > 1) {
                    foreach (Language::all() as $language) {
                        try {
                            $result = $client->translateText([
                                'SourceLanguageCode' => 'en',
                                'TargetLanguageCode' => $language->code,
                                'Text' => $default,
                            ]);

                            $data[$key][$language->code] = $result->get("TranslatedText");
                        } catch (AwsException $e) {
                            $this->error($e->getMessage());
                        }
                    }
                }
            }

            $testimonial->update([
                'name' => json_encode($data['name']),
                'content' => json_encode($data['content'])
            ]);
        }

        foreach (Team::all() as $team) {
            $data = [
                'first_name' => isset($team->first_name) ? json_decode($team->first_name, true) : [],
                'last_name' => isset($team->last_name) ? json_decode($team->last_name, true) : [],
                'position' => isset($team->position) ? json_decode($team->position, true) : []
            ];

            foreach ($data as $key => $values) {
                $default = $values['en'] ?? false;

                if ($default and count($values) > 1) {
                    foreach (Language::all() as $language) {
                        try {
                            $result = $client->translateText([
                                'SourceLanguageCode' => 'en',
                                'TargetLanguageCode' => $language->code,
                                'Text' => $default,
                            ]);

                            $data[$key][$language->code] = $result->get("TranslatedText");
                        } catch (AwsException $e) {
                            $this->error($e->getMessage());
                        }
                    }
                }
            }

            $team->update([
                'first_name' => json_encode($data['first_name']),
                'last_name' => json_encode($data['last_name']),
                'position' => json_encode($data['position'])
            ]);
        }

        foreach (BlogArticle::all() as $article) {
            $data = [
                'name' => isset($article->name) ? json_decode($article->name, true) : [],
                'content' => isset($article->content) ? json_decode($article->content, true) : []
            ];

            foreach ($data as $key => $values) {
                $default = $values['en'] ?? false;

                if ($default and count($values) > 1) {
                    foreach (Language::all() as $language) {
                        try {
                            $result = $client->translateText([
                                'SourceLanguageCode' => 'en',
                                'TargetLanguageCode' => $language->code,
                                'Text' => $default,
                            ]);

                            $data[$key][$language->code] = $result->get("TranslatedText");
                        } catch (AwsException $e) {
                            $this->error($e->getMessage());
                        }
                    }
                }
            }

            $article->update([
                'name' => json_encode($data['name']),
                'content' => json_encode($data['content'])
            ]);
        }

        foreach (BlogArticleCategory::all() as $category) {
            $data = isset($category->name) ? json_decode($category->name, true) : [];
            $default = $data['en'] ?? false;

            if ($default and count($data) > 1) {
                foreach (Language::all() as $language) {
                    try {
                        $result = $client->translateText([
                            'SourceLanguageCode' => 'en',
                            'TargetLanguageCode' => $language->code,
                            'Text' => $default,
                        ]);

                        $data[$language->code] = $result->get("TranslatedText");
                    } catch (AwsException $e) {
                        $this->error($e->getMessage());
                    }
                }
            }

            $category->update([
                'name' => json_encode($data)
            ]);
        }

        foreach (Page::all() as $page) {
            $data = [
                'title' => isset($page->title) ? json_decode($page->title, true) : [],
                'content' => isset($page->content) ? json_decode($page->content, true) : [],
                'content2' => isset($page->content2) ? json_decode($page->content2, true) : [],
                'meta_title' => isset($page->meta_title) ? json_decode($page->meta_title, true) : [],
                'meta_description' => isset($page->meta_description) ? json_decode($page->meta_description, true) : []
            ];

            foreach ($data as $key => $values) {
                $default = $values['en'] ?? false;

                if ($default and count($values) > 1) {
                    foreach (Language::all() as $language) {
                        try {
                            $result = $client->translateText([
                                'SourceLanguageCode' => 'en',
                                'TargetLanguageCode' => $language->code,
                                'Text' => $default,
                            ]);

                            $data[$key][$language->code] = $result->get("TranslatedText");
                        } catch (AwsException $e) {
                            $this->error($e->getMessage());
                        }
                    }
                }
            }

            $page->update([
                'title' => json_encode($data['title']),
                'content' => json_encode($data['content']),
                'content2' => json_encode($data['content2']),
                'meta_title' => json_encode($data['meta_title']),
                'meta_description' => json_encode($data['meta_description'])
            ]);

            $data = isset($page->data) ? json_decode($page->data, true) : [];

            foreach ($data as $block_name => $values) {
                $default = $values['en'] ?? false;

                if ($default and count($values) > 1) {
                    foreach (Language::all() as $language) {
                        try {
                            $result = $client->translateText([
                                'SourceLanguageCode' => 'en',
                                'TargetLanguageCode' => $language->code,
                                'Text' => $default,
                            ]);

                            $data[$block_name][$language->code] = $result->get("TranslatedText");
                        } catch (AwsException $e) {
                            $this->error($e->getMessage());
                        }
                    }
                }
            }

            $page->update([
                'data' => json_encode($data)
            ]);
        }

        foreach (MenuItem::all() as $item) {
            $data = isset($item->title) ? json_decode($item->title, true) : [];
            $default = $data['en'] ?? false;

            if ($default and count($data) > 1) {
                foreach (Language::all() as $language) {
                    try {
                        $result = $client->translateText([
                            'SourceLanguageCode' => 'en',
                            'TargetLanguageCode' => $language->code,
                            'Text' => $default,
                        ]);

                        $data[$language->code] = $result->get("TranslatedText");
                    } catch (AwsException $e) {
                        $this->error($e->getMessage());
                    }
                }
            }

            $item->update([
                'title' => json_encode($data)
            ]);
        }
    }
}
