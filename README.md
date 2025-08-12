<p align="center">
  <img src="https://github.com/rodolfop54/Farmikar/blob/main/public/images/farmikarlogo.png" width="400" alt="Laravel Logo">
</p>

<h1 align="center">Farmikar - Sistema de Gestión para Farmacias</h1>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/Estado-En%20Desarrollo-blue" alt="Estado"></a>
  <a href="https://www.php.net/"><img src="https://img.shields.io/badge/PHP-^8.0-blue" alt="PHP"></a>
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-10.x-red" alt="Laravel"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/Licencia-MIT-green" alt="Licencia"></a>
</p>

---

## 📋 Descripción

**Farmikar** es un sistema desarrollado en **Laravel 10** para la gestión integral de farmacias.  
Permite administrar inventarios, ventas, clientes y proveedores de forma rápida y segura.

---

## 🚀 Funcionalidades principales

- 📦 **Gestión de productos**: altas, bajas, modificaciones y control de stock.
- 🧾 **Registro de ventas** con cálculo automático de totales.
- 👥 **Gestión de clientes** y proveedores.
- 🔒 **Autenticación y roles de usuario**.
- 🎨 **Interfaz responsiva** basada en **AdminLTE** y **Bootstrap**.

---

## 🛠️ Tecnologías utilizadas

- **Laravel 10**
- **PHP 8+**
- **MySQL**
- **Bootstrap / AdminLTE**
- **JavaScript (ES6)**

---

## ⚙️ Instalación

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/rodolfop54/farmikar.git
   cd farmikar

2. Instalar dependencias de PHP:
   ```bash
   composer install

3. Instalar dependencias de PHP:Instalar dependencias de Node.js:
    ```bash
   npm install

4. Configurar el archivo .env
    ```bash
    cp .env.example .env
    php artisan key:generate

5. Ejecutar migraciones y seeders:
    ```bash
    php artisan migrate --seed

6. Iniciar el servidor:
    ```bash
    php artisan serve
