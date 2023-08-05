<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', static fn(BreadcrumbTrail $trail) => $trail->push('Panel', route('dashboard')));

Breadcrumbs::for('works', static fn(BreadcrumbTrail $trail) => $trail
    ->parent('home')
    ->push('Trabajos', route('work.index'))
);

Breadcrumbs::for('work', static fn(BreadcrumbTrail $trail, $work) => $trail
    ->parent('works')
    ->push('Trabajo #' . $work->id, route('work.show', $work->id))
);

Breadcrumbs::for('work.create', static fn(BreadcrumbTrail $trail) => $trail->parent('works')->push('Solicitar', route('work.create')));

Breadcrumbs::for('users', static fn(BreadcrumbTrail $trail) => $trail->parent('home')->push('Usuarios', route('user.index')));
