<?php

return [
    'adminContact' => [
    	'email' => 'krowstel@gmail.com',
    	'phone' => '+7 (960) 527-65-67',
    	'vk' => 'https://vk.com/maximum_sveta',
    	'google' => 'https://plus.google.com/u/0/104365982205952198684',
    ],

    'languages' => [
    	'ru-RU',
    	'en-US',
    ],
    
    'indexMaxArticles' => '3',

    'pageSize' => '2',

    'categoriesNav' => [
        'cacheTime' => '60*60',
    ],

    'mailer' => [
        'host' => 'smtp.gmail.com',
        'username' => 'krowstel',
        'password' => 'Egor10011998',
        'port' => '465',
        'encryption' => 'ssl',
    ],

    'mailerEmail' => 'smileblog@inbox.ru',

    'emailSubscription' => [
        'articlesCount' => '5',
        'from' => 'SmileBlog',
        'subject' => 'You have not visited us for a long time. Here are posts you could skip',
    ],

    'popularArticles' => [
        'count' => '4',
        'cacheTime' => '0',
    ],

    'popularTags' => [
        'count' => '8',
        'cacheTime' => '15*60',
    ],
    
];
