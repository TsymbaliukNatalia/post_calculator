<?php

return [
    'admin-user' => [
        'title' => 'Користувачі',

        'actions' => [
            'index' => 'Користувачі',
            'create' => 'Новий користувач',
            'edit' => 'Редагувати :name',
            'edit_profile' => 'Редагувати профіль',
            'edit_password' => 'Змінити пароль',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Останній вхід',
            'first_name' => "Ім'я",
            'last_name' => 'Прізвище',
            'email' => 'Електронна пошта',
            'password' => 'Пароль',
            'password_repeat' => 'Підтвердження паролю',
            'activated' => 'Активовано',
            'forbidden' => 'Заборонено',
            'language' => 'Мова',

            //Belongs to many relations
            'roles' => 'Ролі',

        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];
