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

// Home > Users > [user]
Breadcrumbs::for('user.show', function ($trail, $user) {
    $trail->parent('user.index');
    $trail->push("$user->firstname $user->lastname $user->patronymic", route('users.show', [$user->id]));
});

// Home > Reports
Breadcrumbs::for('report.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Отчёты', route('reports.index'));
});

// Home > Reports > [report]
Breadcrumbs::for('report.show', function ($trail, $report) {
    $trail->parent('report.index');
    $trail->push($report->title, route('reports.show', [$report->id]));
});

// Home > Reports > Create
Breadcrumbs::for('report.create', function ($trail) {
    $trail->parent('report.index');
    $trail->push('Создание отчёта', route('reports.create'));
});

// Home > Reports > Edit > [report]
Breadcrumbs::for('report.edit', function ($trail, $report) {
    $trail->parent('report.index');
    $trail->push($report->title, route('reports.show', [$report->id]));
});
