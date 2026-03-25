SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Volcado de datos para la tabla `categories`
INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Comida', '2026-03-24 03:42:17', '2026-03-24 03:42:17'),
(2, 'Salud', '2026-03-24 03:42:27', '2026-03-24 03:42:27'),
(3, 'Juguetes', '2026-03-24 03:42:42', '2026-03-24 03:42:42'),
(4, 'Peluqueria', '2026-03-24 03:42:56', '2026-03-24 03:42:56');

-- Volcado de datos para la tabla `users`
INSERT INTO `users` (`id`, `name`, `phone_number`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sofia', '3104472536', 'sgallol2@eafit.edu.co', NULL, '$2y$12$ERYaOxEZ1keve1DmcWpJAeZlJ9TKsL.tOM77EdotEc4zwkxARgQE2', 1, NULL, '2026-03-24 03:27:30', '2026-03-24 03:27:30'),
(2, 'sgallito', '3104472537', 'sofiagdelarosa@gmail.com', NULL, '$2y$12$CHP53O353XQdtPzdcQVxj.xB/wDHZ4HsxitTAEr0GCa82H0T7y2Z2', 0, NULL, '2026-03-24 03:51:15', '2026-03-24 03:51:15');

-- Volcado de datos para la tabla `products`
INSERT INTO `products` (`id`, `name`, `price`, `stock`, `image`, `specie`, `description`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Br4 Dog Pure Adulto Lamb X3kl', 98300, 10, 'img/products/UfIpfIwjrxQcZ3pewi7MfoKUzhXz0MxFINWnVG1J.png', 'dog', 'Fórmula premium con cordero para perros adultos, sin conservantes artificiales y con ingredientes seleccionados.', 1, '2026-03-24 03:44:09', '2026-03-25 05:25:49'),
(2, 'Hill\'s Science Diet Perfect Weight alimento húmedo control de peso para gato adulto', 9800, 10, 'img/products/2zQYSqOpiFtGXT2C1ushfpbEPWT5Qd9voG9eXfOT.jpg', 'cat', 'Con este alimento húmedo superpremium, no solo le das a tu gato una comida deliciosa, sino también el respaldo nutricional que necesita para mantenerse activo, sano y feliz.', 1, '2026-03-24 03:47:01', '2026-03-25 05:25:01'),
(3, 'Nexgard Spectra M ( 7.5 - 15 Kg) Verde', 62900, 12, 'img/products/J0weydT0Tj3YjU46GtzHQMoMpWyhCvxlo6pN2BA5.png', 'dog', 'Este producto no es el típico antiparasitario. Está formulado para combatir una amplia gama de parasitosis tanto externas como internas, asegurando que tu perro esté protegido desde todos los frentes.', 2, '2026-03-24 03:49:17', '2026-03-25 05:24:16'),
(4, 'Churu Gato', 25000, 3, 'img/products/XgT0CYpYAHo11trs7D7AA9VDem8VBDA7JORn4616.png', 'cat', 'Delicioso alimento para gato', 1, '2026-03-25 05:18:16', '2026-03-25 05:18:16'),
(5, 'Shampoo para perro BEEPS Moisturunzing', 47300, 20, 'img/products/cUqeoQDc7IJd1uBJG6ns6t1T8VzjBc0DPE2KtRMR.png', 'dog', 'Un shampoo que hidrata y limpia eficazmente el pelaje de tu compañero peludo', 4, '2026-03-25 05:21:52', '2026-03-25 05:21:52');

-- Volcado de datos para la tabla `orders`
INSERT INTO `orders` (`id`, `total`, `status`, `address`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 196600, 'pending', 'Carrera 45 F #33 11', 2, '2026-03-24 04:15:13', '2026-03-24 04:15:13'),
(2, 9800, 'pending', 'Carrera 45 F #33 11', 2, '2026-03-24 04:21:36', '2026-03-24 04:21:36'),
(3, 125800, 'pending', 'Carrera 45 F #33 11', 2, '2026-03-24 04:24:37', '2026-03-24 04:24:37'),
(4, 171000, 'pending', 'Carrera 45 F #33 11', 2, '2026-03-24 04:35:32', '2026-03-24 04:35:32'),
(5, 98300, 'pending', 'Carrera 45 F #33 11', 2, '2026-03-24 05:13:26', '2026-03-24 05:13:26'),
(6, 9800, 'pending', 'Carrera 45 F #33 11', 2, '2026-03-24 05:19:46', '2026-03-24 05:19:46');

-- Volcado de datos para la tabla `payments`
INSERT INTO `payments` (`id`, `order_id`, `amount`, `date`, `method`, `created_at`, `updated_at`) VALUES
(1, 1, 196600, '2026-03-23', 'Tarjeta', '2026-03-24 04:15:39', '2026-03-24 04:15:39'),
(2, 2, 9800, '2026-03-23', 'Tarjeta', '2026-03-24 04:21:46', '2026-03-24 04:21:46'),
(3, 3, 125800, '2026-03-23', 'Tarjeta', '2026-03-24 04:24:44', '2026-03-24 04:24:44'),
(4, 4, 171000, '2026-03-23', 'Tarjeta', '2026-03-24 04:35:50', '2026-03-24 04:35:50'),
(5, 5, 98300, '2026-03-24', 'Tarjeta', '2026-03-24 05:13:33', '2026-03-24 05:13:33'),
(6, 6, 9800, '2026-03-24', 'credit_card', '2026-03-24 05:19:54', '2026-03-24 05:19:54');

COMMIT;