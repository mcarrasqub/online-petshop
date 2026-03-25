# Online PetShop

Este es un proyecto de tienda de mascotas en línea desarrollado con el framework Laravel. Permite a los usuarios navegar por productos, añadirlos a un carrito de compras, realizar pedidos y descargar recibos de pago. También incluye un panel de administración para gestionar productos y categorías.

**Autores:**

- David García Zapata
- Sofia Gallo
- Mariana Carrasquilla Botero

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalado el siguiente software en tu sistema:

- XAMPP (o un entorno similar con PHP, MySQL/MariaDB y Apache)
- Composer (Gestor de dependencias para PHP)
- Git (Sistema de control de versiones)

## Guía de Instalación y Ejecución

Sigue estos pasos para configurar y ejecutar el proyecto en tu entorno local.

1. Clonar el Repositorio

Abre tu terminal o línea de comandos y clona el proyecto en la carpeta htdocs de tu instalación de XAMPP.

```powershell
cd c:\xampp\htdocs
git clone <https://github.com/mcarrasqub/online-petshop.git> online-petshop
cd online-petshop
```
<br>

2. Configurar el Entorno

Copia el archivo de configuración de ejemplo para crear tu propio archivo de entorno local.

```powershell
copy .env.example .env
```

Abre el archivo .env recién creado y configura la conexión a tu base de datos. Asegúrate de crear una base de datos vacía (ej. online_petshop) desde phpMyAdmin o tu gestor de base de datos preferido.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=online_petshop
DB_USERNAME=root
DB_PASSWORD=
```
<br>

3. Instalar Dependencias

Instala todas las dependencias del proyecto, incluyendo el framework Laravel y otras librerías.

```powershell
composer install
```

**Nota para Solución de Problemas:** 

Si el comando anterior falla con errores relacionados a archivos .zip, es probable que la extensión zip de PHP no esté activada en tu XAMPP. Puedes solucionarlo activándola en tu php.ini o ejecutar el comando de instalación usando la siguiente bandera:
```
composer install --prefer-source
```
<br>

4. Generar Clave de la Aplicación

Cada aplicación de Laravel necesita una clave de encriptación única. Genérala con este comando:

```powershell
php artisan key:generate
```

<br>

5. Crear la Estructura de la Base de Datos

Ejecuta las migraciones para crear todas las tablas necesarias en la base de datos que configuraste. El comando php artisan migrate:fresh eliminará las tablas existentes y las volverá a crear en caso de ser necesario.

```
php artisan migrate
```

<br>

6. Crear el Enlace Simbólico (Storage Link)

Para que las imágenes y otros archivos públicos sean accesibles desde el navegador, debes crear un "enlace simbólico".

```
php artisan storage:link
```

<br>

7. Ejecutar el Servidor de Desarrollo

¡Todo está listo! Inicia el servidor de desarrollo de Laravel.

```
php artisan serve
```

<br>

8. Acceder a la Aplicación

Abre tu navegador web y visita la siguiente URL para ver la página principal del proyecto:

http://127.0.0.1:8000

<br>

## Librerías Externas Adicionales

Este proyecto depende de las siguientes librerías externas que se instalan automáticamente con composer install, pero es importante conocer su función:

barryvdh/laravel-dompdf: Utilizada para la funcionalidad de "Descargar Recibo". Permite convertir una vista de HTML y CSS en un documento PDF.

si surgen problemas por no tenerla instala, ejecutar uno de estos comandos:

```
composer require barryvdh/laravel-dompdf
```
en caso de que el anterior comando no funcione:
```
composer require barryvdh/laravel-dompdf --prefer-source
```
<br>

## Indicaciones Adicionales

Para crear un usuario con rol de administrador debe crearlo desde la vista de login (registrarse) y luego ir directamente a myPhpAdmin a la tabla de usuarios dentro de su base de datos, buscar el usuario que acabó de crear y editar el campo de is_admin para cambiar el 0 por 1. 