<?php

// edited by Sofia Gallo

return [
    'title_success' => 'Pago exitoso',
    'heading_success' => 'Pago exitoso',
    'message_success' => 'Tu pago fue registrado correctamente.',

    'section_payment' => 'Datos del pago',
    'section_order' => 'Datos de la orden',

    'fields' => [
        'id' => 'ID',
        'amount' => 'Monto',
        'date' => 'Fecha',
        'method' => 'Método',
        'order_number' => 'Orden #',
        'total' => 'Total',
        'status' => 'Estado',
        'address' => 'Dirección',
    ],

    'order_not_found' => 'No se encontró información de la orden asociada.',

    'checkout' => [
        'title' => 'Pago de orden',
        'order_summary' => 'Resumen de la orden',
        'order' => 'Orden',
        'customer' => 'Cliente',
        'payment_method' => 'Método de pago',
        'select_method' => 'Selecciona un método virtual',
        'confirm_payment' => 'Confirmo que deseo realizar el pago de esta orden.',
        'back' => 'Volver',
        'confirm' => 'Confirmar pago',
    ],

    'methods' => [
        'pse' => 'PSE',
        'credit_card' => 'Tarjeta de crédito',
        'debit_card' => 'Tarjeta débito',
        'nequi' => 'Nequi',
        'daviplata' => 'Daviplata',
    ],

    'receipt' => [
        'title' => 'Comprobante de Pago',
        'store_name' => 'Online Petshop',
        'payment_number' => 'Pago #',
        'payment_date' => 'Fecha de pago',
        'customer' => 'Cliente',
        'email' => 'Correo',
        'generated_at' => 'Documento generado el :date.',
    ],

    'btn_view_orders' => 'Ver órdenes',
    'btn_go_home' => 'Ir al inicio',
    'btn_download_receipt' => 'Descargar comprobante (PDF)',
];
