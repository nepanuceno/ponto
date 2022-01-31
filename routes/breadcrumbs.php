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


// Home > [Employees]
Breadcrumbs::for('employees', function (BreadcrumbTrail $trail, $departaments) {
    $trail->parent('home');
    $trail->push($departaments->title, route('employees', $departaments));
});
