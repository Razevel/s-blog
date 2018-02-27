<?php

return [
    'adminContact' => [
    	'email' => 'krowstel@gmail.com',
    	'phone' => '+7 (960) 527-65-67',
    	'vk' => 'https://vk.com/maximum_sveta',
    	'google' => 'https://plus.google.com/u/0/104365982205952198684',
    ],

    //Доступные языки
    'languages' => [
    	'ru-RU',
    	'en-US',
    ],
    
    //Максимальное число новых записей на blog/index
    'indexMaxArticles' => '3',

    //Размер страниц
    'pageSize' => '2',

    //Меню категорий
    'categoriesNav' => [
        //Время кеширования
        'cacheTime' => '60*60',
    ],

    //Популярные статьи
    'popularArticles' => [
        'count' => '4',
        'cacheTime' => '0',
    ],

    //Популярные теги
    'popularTags' => [
        'count' => '8',
        'cacheTime' => '0',
    ],

    //настройки письма
    'emailSubscription' => [
        'articlesCount' => '5',
        'from' => 'SmileBlog',
        'subject' => 'You have not visited us for a long time. Here are posts you could skip',
    ],

    'mailer' => [
        'host' => 'smtp.gmail.com',
        'username' => 'krowstel',
        'password' => 'Egor10011998',
        'port' => '465',
        'encryption' => 'ssl',
    ],

    'mailerEmail' => 'smileblog@inbox.ru',
    
];
