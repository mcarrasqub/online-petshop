# Online PetShop

 **Aplicación desplegada y disponible públicamente:**  
El proyecto ya se encuentra desplegado en producción y accesible para cualquier usuario en la siguiente dirección:

🔗 [http://34.123.128.203](http://34.123.128.203)

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

Abre tu terminal o línea de comandos y clona el proyecto en la carpeta htdocs de tu instalación de XAMPP (o cualquier carpeta de tu preferencia si vas a usar Docker).

```powershell
cd c:\xampp\htdocs
git clone https://github.com/mcarrasqub/online-petshop.git online-petshop
cd online-petshop
```
<br>

2. Configurar el Entorno

Copia el archivo de configuración de ejemplo para crear tu propio archivo de entorno local.

```powershell
copy .env.example .env
```

Abre el archivo `.env` recién creado y configura la conexión a tu base de datos y tus credenciales de Google Cloud Storage (GCS) para las imágenes de los productos:

```ini
# Base de Datos (MySQL)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=online_petshop
DB_USERNAME=root
DB_PASSWORD=

# Configuración de Google Cloud Storage
FILESYSTEM_DISK=gcs
GOOGLE_CLOUD_PROJECT_ID=tu-gcp-project-id
GOOGLE_CLOUD_STORAGE_BUCKET=tu-gcs-bucket-name
GOOGLE_CLOUD_KEY_FILE=service-account.json
```

> [IMPORTANTE!]
> Debes colocar el archivo de credenciales de Google Cloud (`service-account.json`) en la raíz del proyecto para que la carga y descarga de imágenes desde la nube (GCS) funcione correctamente. Este archivo ya se encuentra en el `.gitignore` por seguridad.

<br>

3. Instalar Dependencias

Instala todas las dependencias del proyecto, incluyendo el framework Laravel y otras librerías.

```powershell
composer install
```

**Nota para Solución de Problemas:** 
Si el comando anterior falla con errores relacionados a archivos `.zip`, es probable que la extensión zip de PHP no esté activada en tu XAMPP. Puedes solucionarlo activándola en tu `php.ini` o ejecutar el comando de instalación usando la siguiente bandera:
```powershell
composer install --prefer-source
```
<br>

4. Generar Clave de la Aplicación

Cada aplicación de Laravel necesita una clave de encriptación única. Genérala con este comando:

```powershell
php artisan key:generate
```

<br>

5. Estructurar y Sembrar la Base de Datos (Base de Datos + Semillas)

Ejecuta las migraciones junto con las semillas para crear la estructura de tablas y precargar los productos, categorías e incluso las cuentas de usuario de prueba:

```powershell
php artisan migrate --seed
```

<br>

6. Ejecutar el Servidor de Desarrollo

¡Todo está listo! Inicia el servidor de desarrollo de Laravel.

```powershell
php artisan serve
```

Abre tu navegador web y visita la siguiente URL para ver la página principal del proyecto:
[http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Alternativa Moderna: Ejecución con Docker

Si prefieres no instalar PHP, MySQL, Apache o Composer de manera local, puedes ejecutar todo el sistema de forma aislada y automática utilizando **Docker** y **Docker Compose** en solo dos comandos:

1. **Construir y Levantar Contenedores:**
   ```bash
   docker-compose up --build -d
   ```
   *Esto levantará el servidor web Apache + PHP 8.2 en `http://localhost` y un motor de base de datos MySQL 8.0 en segundo plano con control de salud inteligente.*

2. **Inicializar y Sembrar la Base de Datos en Docker:**
   ```bash
   docker-compose exec app php artisan migrate --seed
   ```

3. **Apagar los contenedores:**
   ```bash
   docker-compose down
   ```

---

## Pruebas Unitarias y de Integración

El proyecto cuenta con una suite completa de pruebas unitarias y de integración para garantizar que la tienda sea robusta (probando lógica matemática del carrito de compras y conversiones con fakes de la API externa). Para correr las pruebas, ejecuta:

```powershell
php artisan test
```

---

## Conversión de Divisa Automática (API Externa)

La tienda incluye un servicio de conversión de divisas dinámico (`ExchangeRateService`) que consulta las tasas de cambio de **COP a USD** en tiempo real mediante una API REST externa. Para no saturar los límites de la API y garantizar el rendimiento óptimo, la tasa de cambio es almacenada en caché local por 1 hora (`Cache::remember`). Si la API externa llega a fallar, el servicio incluye lógica defensiva que utiliza un cambio por defecto (`1 USD = 4000 COP`).

---

## Cuentas de Prueba Preconfiguradas (Semillas)

Al sembrar la base de datos con `--seed`, se configuran automáticamente dos cuentas listas para usar:

*   **Administrador (Admin):**
    *   **Email:** `admin@huellitas.com`
    *   **Password:** `password`
*   **Cliente Estándar (User):**
    *   **Email:** `user@huellitas.com`
    *   **Password:** `password` 
