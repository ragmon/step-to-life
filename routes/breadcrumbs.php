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

// Home > Rules
Breadcrumbs::for('rule.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Правила', route('rules.index'));
});

// Home > Rules > [rule]
Breadcrumbs::for('rule.show', function ($trail, $rule) {
    $trail->parent('rule.index');
    $trail->push($rule->title, route('rules.show', [$rule->id]));
});

// Home > Rules > Create
Breadcrumbs::for('rule.create', function ($trail) {
    $trail->parent('rule.index');
    $trail->push('Создание правила', route('rules.create'));
});

// Home > Rules > Edit > [rule]
Breadcrumbs::for('rule.edit', function ($trail, $rule) {
    $trail->parent('rule.index');
    $trail->push($rule->title, route('rules.show', [$rule->id]));
});

// Home > Residents
Breadcrumbs::for('resident.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Резиденты', route('residents.index'));
});

// Home > Residents > Create
Breadcrumbs::for('resident.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Создание резидента', route('residents.create'));
});

// Home > Residents > [resident]
Breadcrumbs::for('resident.show', function ($trail, $resident) {
    $trail->parent('resident.index');
    $trail->push($resident->fullname, route('residents.show', [$resident->id]));
});

// Home > Resident > [resident] > Edit
Breadcrumbs::for('resident.edit', function ($trail, $resident) {
    $trail->parent('resident.show', $resident);
    $trail->push('Редактирование резидента', route('residents.edit', [$resident->id]));
});

// Home > Responsibilities
Breadcrumbs::for('responsibility.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Обязанности', route('responsibilities.index'));
});

// Home > Punishments
Breadcrumbs::for('punishment.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Взыскания', route('punishments.index'));
});

// Home > Notes
Breadcrumbs::for('note.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Заметки', route('notes.index'));
});

// Home > Tasks
Breadcrumbs::for('task.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Задания', route('tasks.index'));
});

// Home > Tasks > [task]
Breadcrumbs::for('task.show', function ($trail, $task) {
    $trail->parent('task.index');
    $trail->push($task->title, route('tasks.show', [$task->id]));
});

// Home > Archive
Breadcrumbs::for('archive.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Архив', route('archive.index'));
});

// Home > Archive > [resident]
Breadcrumbs::for('archive.show', function ($trail, $resident) {
    $trail->parent('archive.index');
    $trail->push($resident->fullname, route('archive.show', [$resident->id]));
});

// Home > Parents
Breadcrumbs::for('parent.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Родственики', route('parents.index'));
});

// Home > Parents > [parent]
Breadcrumbs::for('parent.show', function ($trail, $parent) {
    $trail->parent('parent.index');
    $trail->push($parent->fullname, route('parents.show', [$parent->id]));
});

// Home > History
Breadcrumbs::for('history.index', function ($trail) {
    $trail->parent('home');
    $trail->push('История', route('history.index'));
});
