<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;



// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > positions
Breadcrumbs::for('positions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Cargos', route('positions.index'));
});
Breadcrumbs::for('positions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('positions.index');
    $trail->push('Cadastrar Cargo', route('positions.create'));
});
Breadcrumbs::for('positions.edit', function (BreadcrumbTrail $trail, $position) {
    $trail->parent('positions.index');
    $trail->push('Editar Cargo', route('positions.edit', $position->id));
});


// Home > [Departaments]
Breadcrumbs::for('departaments.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Departamentos', route('departaments.index'));
});
Breadcrumbs::for('departaments.create', function (BreadcrumbTrail $trail) {
    $trail->parent('departaments.index');
    $trail->push('Cadastro de Departamento', route('departaments.create'));
});
Breadcrumbs::for('departaments.edit', function (BreadcrumbTrail $trail, $departament) {
    $trail->parent('departaments.index');
    $trail->push('Editar Departamento', route('departaments.edit', $departament->id));
});
Breadcrumbs::for('departaments.show', function (BreadcrumbTrail $trail, $departament) {
    $trail->parent('departaments.index');
    $trail->push('Detalhes do Departamento', route('departaments.show', $departament->id));
});


// Home > [Employees]
Breadcrumbs::for('employees.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Servidores', route('employees.index'));
});
Breadcrumbs::for('employees.create', function (BreadcrumbTrail $trail) {
    $trail->parent('employees.index');
    $trail->push('Cadastro de Servidor', route('employees.create'));
});
Breadcrumbs::for('employees.edit', function (BreadcrumbTrail $trail, $employee) {
    $trail->parent('employees.index');
    $trail->push('Editar Servidor', route('employees.edit', $employee->id));
});
Breadcrumbs::for('employees.show', function (BreadcrumbTrail $trail, $employee) {
    $trail->parent('employees.index');
    $trail->push('Detalhes Servidor', route('employees.show', $employee->id));
});

// Home > [Users]
Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Servidores', route('users.index'));
});
Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('users.index');
    $trail->push('Cadastro de Servidor', route('users.create'));
});
Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users.index');
    $trail->push('Editar Servidor', route('users.edit', $user->id));
});
Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users.index');
    $trail->push('Detalhes do Servidor', route('users.show', $user->id));
});

// Home > [Roles]
Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Perfis', route('roles.index'));
});
Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('roles.index');
    $trail->push('Cadastro de Perfis', route('roles.create'));
});
Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('roles.index');
    $trail->push('Editar Perfil', route('roles.edit', $user->id));
});
Breadcrumbs::for('roles.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('roles.index');
    $trail->push('Detalhes do Perfil', route('roles.show', $user->id));
});

Breadcrumbs::for('settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Configurações', route('settings.index'));
});


// Home > [Logs]
Breadcrumbs::for('logs.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Logs', route('logs.index'));
});
Breadcrumbs::for('logs.list', function (BreadcrumbTrail $trail) {
    $trail->parent('logs.index');
    $trail->push('Logs do Usuário', route('logs.list'));
});
