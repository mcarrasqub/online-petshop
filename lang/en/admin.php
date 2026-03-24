<?php

// edited by Sofia Gallo

return [
    'title_default' => 'Admin - Huellitas Online Store',
    'panel' => 'Admin Panel',
    'role_label' => 'Admin',

    'nav' => [
        'home' => '- Admin - Home',
        'products' => '- Admin - Products',
        'categories' => '- Admin - Categories',
        'back_to_home' => 'Go back to the home page',
    ],

    'home' => [
        'card_title' => 'Admin Panel - Home Page',
        'welcome' => 'Welcome to the Admin Panel, use the sidebar to navigate between the different options.',
    ],

    'actions' => [
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'delete' => 'Delete',
        'show' => 'Show',
        'save' => 'Save',
        'cancel' => 'Cancel',
        'back' => 'Back',
    ],

    'fields' => [
        'id' => 'ID',
        'name' => 'Name',
        'category' => 'Category',
        'price' => 'Price',
        'stock' => 'Stock',
        'specie' => 'Species',
        'description' => 'Description',
        'image' => 'Image',
        'created_at' => 'Created',
        'updated_at' => 'Updated',
    ],

    'products' => [
        'title' => 'Products',
        'list' => 'Products list',
        'create' => 'Create product',
        'edit' => 'Edit product',
        'show' => 'Product details',
        'empty' => 'No products found.',
    ],

    'categories' => [
        'title' => 'Categories',
        'list' => 'Categories list',
        'create' => 'Create category',
        'edit' => 'Edit category',
        'show' => 'Category details',
        'empty' => 'No categories found.',
    ],

    'messages' => [
        'confirm_delete_product' => 'Delete this product?',
        'confirm_delete_category' => 'Delete this category?',
        'no_image' => 'No image',
        'uncategorized' => 'Uncategorized',
    ],

    'placeholders' => [
        'select_category' => '-- Select a category --',
        'select_specie' => '-- Select a species --',
    ],

    'species' => [
        'dog' => 'Dog',
        'cat' => 'Cat',
        'bird' => 'Bird',
        'fish' => 'Fish',
        'rabbit' => 'Rabbit',
        'all' => 'All',
    ],
];
