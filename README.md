# 📚 Sistema de Gestión Académica - Laravel + Filament

<!--
Este proyecto fue creado con Laravel 10 y Filament Admin Panel para gestionar:
- Usuarios con roles (admin, docente)
- Estudiantes
- Materias
- Inscripciones
- Calificaciones

Cumple los requerimientos del examen técnico solicitado.
-->

---

## ⚙️ Requisitos

<!--
Requisitos mínimos del entorno para poder ejecutar el proyecto correctamente.
-->

- PHP >= 8.1
- Composer
- MySQL
- Node.js y NPM (opcional, si compilas assets con Vite)
- Laravel 10
- Filament 3.x

---

## 🚀 Instalación

```bash
# 1. Instalar dependencias de PHP
composer install

# 2. Copiar el archivo .env y generar la APP_KEY
cp .env.example .env
php artisan key:generate

# 3. Configurar credenciales de la base de datos en el archivo .env

# 4. Ejecutar migraciones y seeders para poblar datos iniciales
php artisan migrate --seed

