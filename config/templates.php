<?php

return [

    'advertisement' => [
        'icon' => '',
        'prompt' => 'Write a creative ad, for the product: %s, and aimed at: %s.',
        'single_input' => false,
        'inputs' => [
            'product' => [
                'input_type' => 'input',
                'input_icon' => 'fa fa-heading',
            ],
            'audience' => [
                'input_type' => 'input',
                'input_icon' => 'fa fa-heading',
            ],
        ],
        'category' => 'text'
    ],

    'summarize' => [
        'icon' => 'fa fa-align-left',
        'prompt' => 'Summarize the following text: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'text',
    ],

    'explain_for_a_kid' => [
        'icon' => 'fa fa-child',
        'prompt' => 'Explain & summarize the following text like I am 5: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'text',
    ],

    'spinner' => [
        'icon' => 'fa fa-sync',
        'prompt' => 'Rewrite the following text in a different manner: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'text',
    ],

    'keywords_generator' => [
        'icon' => 'fa fa-key',
        'prompt' => 'Extract important keywords from the following text: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'text',
    ],

    'grammar_fixer' => [
        'icon' => 'fa fa-spell-check',
        'prompt' => 'Fix the grammar on the following: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'text',
    ],

    'text_to_emoji' => [
        'icon' => 'fa fa-smile-wink',
        'prompt' => 'Transform the following text into emojis: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'text',
    ],

    'blog_article_idea' => [
        'icon' => 'fa fa-lightbulb',
        'prompt' => 'Write multiple blog article ideas based on the following: %s',
        'single_input' => true,
        'input_type' => 'input',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'text',
    ],

    'blog_article_intro' => [
        'icon' => 'fa fa-keyboard',
        'prompt' => 'Write a good intro for a blog article, based on the title of the blog post: %s',
        'single_input' => true,
        'input_type' => 'input',
        'input_icon' => 'fa fa-heading',
        'category' => 'text',
    ],

    'blog_article_idea_and_outline' => [
        'icon' => 'fa fa-blog',
        'prompt' => 'Write ideas for a blog article title and outline, based on the following: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'text',
    ],

    'blog_article_section' => [
        'icon' => 'fa fa-rss',
        'prompt' => 'Write a blog sections about "%s" using the "%s" keywords',
        'single_input' => false,
        'inputs' => [
            'title' => [
                'input_type' => 'input',
                'input_icon' => 'fa fa-heading',
            ],
            'keywords' => [
                'input_type' => 'input',
                'input_icon' => 'fa fa-file-word',
            ],
        ],
        'category' => 'text',
    ],

    'blog_article' => [
        'icon' => 'fa fa-feather',
        'prompt' => 'Write a long article / blog post on "%s" with the "%s" keywords and the following sections "%s"',
        'single_input' => false,
        'inputs' => [
            'title' => [
                'input_type' => 'input',
                'input_icon' => 'fa fa-heading',
            ],
            'keywords' => [
                'input_type' => 'input',
                'input_icon' => 'fa fa-file-word',
            ],
            'sections' => [
                'input_type' => 'input',
                'input_icon' => 'fa fa-feather',
            ],
        ],
        'category' => 'text',
    ],

    'blog_article_outro' => [
        'icon' => 'fa fa-pen-nib',
        'prompt' => 'Write a blog article outro based on the blog title "%s" and the "%s" description',
        'single_input' => false,
        'inputs' => [
            'title' => [
                'input_type' => 'input',
                'input_icon' => 'fa fa-heading',
            ],
            'description' => [
                'input_type' => 'textarea',
                'input_icon' => 'fa fa-paragraph',
            ],
        ],
        'category' => 'text',
    ],

    'reviews' => [
        'icon' => 'fa fa-star',
        'prompt' => 'Write a review or testimonial about "%s" using the following description: %s',
        'single_input' => false,
        'inputs' => [
            'name' => [
                'input_type' => 'input',
                'input_icon' => 'fa fa-heading',
            ],
            'description' => [
                'input_type' => 'textarea',
                'input_icon' => 'fa fa-paragraph',
            ],
        ],
        'category' => 'text',
    ],

    /* Social Media */
    'social_bio' => [
        'icon' => 'fa fa-share-alt',
        'prompt' => 'Write a short social media bio profile description based on those keywords: %s',
        'single_input' => true,
        'input_type' => 'input',
        'input_icon' => 'fa fa-file-word',
        'category' => 'social_media',
    ],

    'hashtags' => [
        'icon' => 'fa fa-hashtag',
        'prompt' => 'Generate hashtags for a social media post based on the following description: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'social_media',
    ],

    'video_idea' => [
        'icon' => 'fa fa-video',
        'prompt' => 'Write ideas for a video scenario, based on the following: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'social_media',
    ],

    'video_title' => [
        'icon' => 'fa fa-play',
        'prompt' => 'Write a video title, based on the following: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'social_media',
    ],

    'video_description' => [
        'icon' => 'fa fa-film',
        'prompt' => 'Write a video description, based on the following: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'social_media',
    ],

    'tweet' => [
        'icon' => 'fab fa-twitter',
        'prompt' => 'Generate a tweet based on the following text/keywords: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'social_media',
    ],

    'instagram_caption' => [
        'icon' => 'fab fa-instagram',
        'prompt' => 'Generate an instagram caption for a post based on the following text/keywords: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'social_media',
    ],

    /* Website */
    'website_headline' => [
        'icon' => 'fa fa-feather',
        'prompt' => 'Write a website short headline for the "%s" product with the following description: %s',
        'single_input' => false,
        'inputs' => [
            'name' => [
                'input_type' => 'input',
                'input_icon' => 'fa fa-heading',
            ],
            'description' => [
                'input_type' => 'textarea',
                'input_icon' => 'fa fa-paragraph',
            ],
        ],
        'category' => 'website',
    ],

    'seo_title' => [
        'icon' => 'fa fa-heading',
        'prompt' => 'Write an SEO Title for a web page based on those keywords: %s',
        'single_input' => true,
        'input_type' => 'input',
        'input_icon' => 'fa fa-file-word',
        'category' => 'website',
    ],

    'seo_description' => [
        'icon' => 'fa fa-pen',
        'prompt' => 'Write an SEO description, maximum 160 characters, for a web page based on the following: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'website',
    ],

    'seo_keywords' => [
        'icon' => 'fa fa-file-word',
        'prompt' => 'Write SEO meta keywords, maximum 160 characters, for a web page based on the following: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'website',
    ],

    'ad_title' => [
        'icon' => 'fa fa-money-check-alt',
        'prompt' => 'Write a short ad title, based on the following: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'website',
    ],

    'ad_description' => [
        'icon' => 'fa fa-th-list',
        'prompt' => 'Write a short ad description, based on the following: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'website',
    ],

    /* Other */
    'name_generator' => [
        'icon' => 'fa fa-file-signature',
        'prompt' => 'Generate multiple & relevant product names based on the following text/keywords: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'other',
    ],
    'startup_ideas' => [
        'icon' => 'fa fa-user-tie',
        'prompt' => 'Generate multiple & relevant startup business ideas based on the following text/keywords: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'other',
    ],
    'viral_ideas' => [
        'icon' => 'fa fa-bolt',
        'prompt' => 'Generate a viral idea based on the following text/keywords: %s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'other',
    ],
    'custom' => [
        'icon' => 'fa fa-star',
        'prompt' => '%s',
        'single_input' => true,
        'input_type' => 'textarea',
        'input_icon' => 'fa fa-paragraph',
        'category' => 'other',
    ],
];
