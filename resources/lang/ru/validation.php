<?php

return [
    'required' => ':attribute обязательно для заполнения.',
    'string' => 'Поле :attribute должно быть строкой.',
    'max' => [
        'string' => ':attribute не должно превышать :max символов.',
    ],
    'numeric' => ':attribute должно быть числом.',
    'min' => [
        'numeric' => ':attribute должно быть не меньше :min.',
    ],
    'email' => ':attribute должно быть корректным email-адресом.',
    'unique' => ':attribute уже занято.',
    'confirmed' => 'Подтверждение :attribute не совпадает.',
    'attributes' => [
        'title' => 'Заголовок',
        'description' => 'Описание',
        'price' => 'Цена',
        'metro_station' => 'Станция метро',
        'name' => 'Имя',
        'email' => 'Email',
        'password' => 'Пароль',
    ],
];
