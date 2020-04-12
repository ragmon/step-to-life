<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', route('home'));
});

// Home > Users
Breadcrumbs::for('user.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Команда', route('users.index'));
});

// Home > Users
Breadcrumbs::for('user.show', function ($trail, $user) {
    $trail->parent('user.index');
    $trail->push("$user->firstname $user->lastname $user->patronymic", route('users.index', [$user->id]));
});

//// Home > About
//Breadcrumbs::for('about', function ($trail) {
//    $trail->parent('home');
//    $trail->push('About', route('about'));
//});
//
//// Home > Blog
//Breadcrumbs::for('blog', function ($trail) {
//    $trail->parent('home');
//    $trail->push('Blog', route('blog'));
//});
//
//// Home > Blog > [Category]
//Breadcrumbs::for('category', function ($trail, $category) {
//    $trail->parent('blog');
//    $trail->push($category->title, route('category', $category->id));
//});
//
//// Home > Blog > [Category] > [Post]
//Breadcrumbs::for('post', function ($trail, $post) {
//    $trail->parent('category', $post->category);
//    $trail->push($post->title, route('post', $post->id));
//});
