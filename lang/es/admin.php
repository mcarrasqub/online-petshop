<?php

// edited by Sofia Gallo and Mariana Carrasquilla Botero

return [
    'title_default' => 'Admin - Tienda Online Huellitas',
    'panel' => 'Panel de Administracion',
    'role_label' => 'Admin',

    'nav' => [
        'home' => '- Admin - Inicio',
        'products' => '- Admin - Productos',
        'categories' => '- Admin - Categorias',
        'back_to_home' => 'Volver a la pagina de inicio',
    ],

    'home' => [
        'card_title' => 'Panel de Administracion - Inicio',
        'welcome' => 'Bienvenido al Panel de Administracion, usa la barra lateral para navegar entre las diferentes opciones.',
    ],

    'actions' => [
        'create' => 'Crear',
        'edit' => 'Editar',
        'update' => 'Actualizar',
        'delete' => 'Eliminar',
        'show' => 'Ver',
        'save' => 'Guardar',
        'cancel' => 'Cancelar',
        'back' => 'Volver',
    ],

    'fields' => [
        'id' => 'ID',
        'name' => 'Nombre',
        'category' => 'Categoria',
        'price' => 'Precio',
        'stock' => 'Unidades disponibles',
        'specie' => 'Especie',
        'description' => 'Descripcion',
        'image' => 'Imagen',
        'created_at' => 'Creado',
        'updated_at' => 'Actualizado',
    ],

    'products' => [
        'title' => 'Productos',
        'title_index' => 'Admin - Productos',
        'title_create' => 'Admin - Crear producto',
        'title_show' => 'Admin - Detalle del producto',
        'title_edit' => 'Admin - Editar producto',
        'list' => 'Listado de productos',
        'create' => 'Crear producto',
        'edit' => 'Editar producto',
        'show' => 'Detalle del producto',
        'empty' => 'No hay productos.',
    ],

    'categories' => [
        'title' => 'Categorias',
        'title_index' => 'Admin - Categorias',
        'title_create' => 'Admin - Crear categoria',
        'title_show' => 'Admin - Detalle de la categoria',
        'title_edit' => 'Admin - Editar categoria',
        'list' => 'Listado de categorias',
        'create' => 'Crear categoria',
        'edit' => 'Editar categoria',
        'show' => 'Detalle de la categoria',
        'empty' => 'No hay categorias.',
    ],

    'messages' => [
        'confirm_delete_product' => '¿Eliminar este producto?',
        'confirm_delete_category' => '¿Eliminar esta categoria?',
        'no_image' => 'Sin imagen',
        'uncategorized' => 'Sin categoria',
        'product_created' => 'Producto creado exitosamente.',
        'product_updated' => 'Producto actualizado exitosamente.',
        'product_deleted' => 'Producto eliminado exitosamente.',
        'category_created' => 'Categoría creada exitosamente.',
        'category_updated' => 'Categoría actualizada exitosamente.',
        'category_deleted' => 'Categoría eliminada exitosamente.',
    ],

    'placeholders' => [
        'select_category' => '-- Selecciona una categoria --',
        'select_specie' => '-- Selecciona una especie --',
    ],

    'species' => [
        'dog' => 'Perro',
        'cat' => 'Gato',
        'bird' => 'Ave',
        'fish' => 'Pez',
        'rabbit' => 'Conejo',
        'all' => 'Todas',
    ],
];
