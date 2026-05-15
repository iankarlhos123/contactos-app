# Contactos App

Aplicación web creada con Laravel para gestionar contactos por usuario autenticado. Incluye autenticación con Laravel Breeze, relaciones Eloquent entre `User` y `Contact`, listado paginado, creación y detalle de contactos.

## Tecnologías

- PHP 8.3+
- Laravel 13
- MySQL
- Laravel Breeze con Blade
- Tailwind CSS, Alpine.js y Vite
- Pest para pruebas automatizadas

## Requisitos

Antes de instalar, verifica que tengas disponible:

```bash
php -v
composer -V
node -v
npm -v
mysql --version
```

## Clonar el repositorio

Para clonar el proyecto desde GitHub:

```bash
git clone git@github.com:rdsdevs/contactos-app.git
cd contactos-app
```

Si ya tienes la carpeta del proyecto creada localmente y solo necesitas asociarla al repositorio remoto:

```bash
git remote add origin git@github.com:rdsdevs/contactos-app.git
git branch -M main
git push -u origin main
```

## Instalación

Instala las dependencias de PHP y JavaScript:

```bash
composer install
npm install
```

Copia el archivo de entorno y genera la clave de la aplicación:

```bash
cp .env.example .env
php artisan key:generate
```

Configura la base de datos en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=contactos_app
DB_USERNAME=root
DB_PASSWORD=
```

Crea la base de datos en MySQL si aún no existe:

```sql
CREATE DATABASE contactos_app;
```

Ejecuta las migraciones y seeders:

```bash
php artisan migrate --seed
```

Compila los assets:

```bash
npm run build
```

## Ejecutar en desarrollo

Opción completa, usando el script del proyecto:

```bash
composer run dev
```

O ejecuta Laravel y Vite por separado:

```bash
php artisan serve
npm run dev
```

Luego abre:

```text
http://127.0.0.1:8000
```

## Funcionalidades actuales

- Registro, inicio y cierre de sesión.
- Dashboard con mensaje personalizado para el usuario.
- Relación `User hasMany Contact`.
- Relación `Contact belongsTo User`.
- Listado paginado de contactos del usuario autenticado.
- Creación de contactos con validación y mensajes personalizados.
- Vista de detalle de contacto.
- Edición, actualización y eliminación planteadas como reto práctico.

## Retos prácticos

Estos puntos quedan como ejercicios para completar el proyecto.

### 1. Implementar la factory de contactos

Archivo: `database/factories/ContactFactory.php`

Completa el método `definition()` para generar datos falsos de contactos:

```php
return [
    'name' => fake()->name(),
    'phone_number' => fake()->numerify('3#########'),
    'user_id' => User::factory(),
];
```

Recuerda importar el modelo `User` si lo usas:

```php
use App\Models\User;
```

### 2. Implementar el seeder de contactos

Archivo: `database/seeders/ContactSeeder.php`

El objetivo es crear usuarios con contactos relacionados. Ejemplo:

```php
User::factory()
    ->count(5)
    ->has(Contact::factory()->count(8))
    ->create();
```

Importa los modelos necesarios:

```php
use App\Models\Contact;
use App\Models\User;
```

### 3. Crear un seeder para un usuario de pruebas

Crea un nuevo seeder, por ejemplo:

```bash
php artisan make:seeder TestUserSeeder
```

El reto es crear un usuario conocido para iniciar sesión durante las pruebas manuales:

```php
User::factory()->create([
    'name' => 'Usuario Demo',
    'email' => 'demo@example.com',
    'password' => bcrypt('password'),
]);
```

Luego registra el seeder en `database/seeders/DatabaseSeeder.php` usando `$this->call(...)`.

### 4. Implementar edit, update y destroy

Archivo: `app/Http/Controllers/ContactController.php`

Completa los métodos pendientes:

- `edit`: debe verificar que el contacto pertenezca al usuario autenticado y retornar `contacts.edit`.
- `update`: debe validar `name` y `phone_number`, actualizar el contacto y redirigir a `contacts.index`.
- `destroy`: debe verificar propiedad, eliminar el contacto y redirigir a `contacts.index`.

También crea la vista:

```text
resources/views/contacts/edit.blade.php
```

La vista debe reutilizar el parcial:

```blade
@include('contacts._form', ['contact' => $contact])
```

Al finalizar, valida el reto con:

```bash
php artisan route:list --name=contacts
php artisan migrate:fresh --seed
php artisan test
```

## Comandos útiles

```bash
php artisan route:list --name=contacts
php artisan tinker
php artisan migrate:fresh --seed
npm run build
```

## Pruebas

Ejecuta la suite con:

```bash
php artisan test
```

También puedes usar el script de Composer:

```bash
composer test
```

## Estructura principal

- `app/Http/Controllers/ContactController.php`: controlador del módulo de contactos.
- `app/Models/Contact.php`: modelo de contactos.
- `app/Models/User.php`: usuario y relación con contactos.
- `resources/views/contacts/`: vistas Blade del módulo.
- `database/migrations/`: estructura de tablas.
- `database/factories/` y `database/seeders/`: datos de prueba.
- `tests/`: pruebas automatizadas con Pest.
