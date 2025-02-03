# Api Ventas Reto Tecnico

## Requisitos Previos  
Antes de comenzar, asegúrate de tener instalados los siguientes programas:  

- [XAMPP](https://www.apachefriends.org/es/index.html) o [Laragon](https://laragon.org/) (para MySQL y Apache)  
- [Composer](https://getcomposer.org/download/)  
- [PHP 8.x](https://www.php.net/downloads.php)  
- [Node.js](https://nodejs.org/) y [NPM](https://www.npmjs.com/)  
- [Git](https://git-scm.com/downloads) (opcional, pero recomendado)  

## Instalación  

### 1. Clonar el repositorio  
```bash
git clone https://github.com/usuario/proyecto-laravel.git
cd proyecto-laravel
```  

### 2. Instalar dependencias  
```bash
composer install
npm install
```  

### 3. Configurar el archivo `.env`  
```bash
cp .env.example .env
```  
Edita el archivo `.env` y ajusta las credenciales de la base de datos:  

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=report_sales_api
DB_USERNAME=root
DB_PASSWORD=
```  

### 4. Generar la clave de la aplicación  
```bash
php artisan key:generate
```  

### 5. Crear la base de datos y ejecutar migraciones  
```bash
php artisan migrate --seed
```  

### 6. Servir la aplicación  
```bash
php artisan serve
```  
Abre en el navegador: [http://127.0.0.1:8000](http://127.0.0.1:8000)  



