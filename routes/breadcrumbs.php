<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Dashboard > Master Lists
Breadcrumbs::for('master-lists', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Master Lists', route('master-lists'));
});

// Dashboard > Master Lists > Customers
Breadcrumbs::for('customers', function ($trail) {
    $trail->parent('master-lists');
    $trail->push('Customers', route('customer-index'));
});


// Dashboard > Sales 
Breadcrumbs::for('sales', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Sales');
});

// Dashboard > Sales > Sales Orders
Breadcrumbs::for('sales-orders', function ($trail) {
    $trail->parent('sales');
    $trail->push('Sales Orders', route('sales-order-index'));
});

// Dashboard > Sales > Sales Deliveries
Breadcrumbs::for('sales-deliveries', function ($trail) {
    $trail->parent('sales');
    $trail->push('Sales Deliveries', route('sales-delivery-index'));
});

// // Home > Blog
// Breadcrumbs::for('blog', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function ($trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category->id));
// });

// // Home > Blog > [Category] > [Post]
// Breadcrumbs::for('post', function ($trail, $post) {
//     $trail->parent('category', $post->category);
//     $trail->push($post->title, route('post', $post->id));
// });