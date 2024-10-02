# ToDo Application - Laravel & Vue.js

Esta es una aplicación de gestión de tareas "ToDo" desarrollada usando Laravel para el backend y Vue.js para el frontend, ambos dentro del mismo proyecto. La aplicación permite a los usuarios crear, editar, listar y eliminar notas. Además, cuenta con autenticación de usuarios utilizando **Laravel Passport**.

## Requisitos previos

Antes de comenzar, asegúrate de tener instalados los siguientes programas en tu sistema:

- [Node.js](https://nodejs.org/) (v14 o superior)
- [Composer](https://getcomposer.org/) (v2 o superior)
- [MySQL 8](https://www.mysql.com/)

## Pasos para la instalación

# Sigue los siguientes pasos para instalar y configurar el proyecto:

1. **Clonar el repositorio**  
   Clona este repositorio en tu máquina local.

   ```bash
   git clone https://github.com/tu-usuario/nombre-repositorio.git
   cd nombre-repositorio```

2.- **Instalar dependencias de PHP con Composer**
Ejecuta el siguiente comando para instalar las dependencias del backend (Laravel):

```bash
composer install
```

3.- **Instalar dependencias de Node.js con npm**
A continuación, instala las dependencias del frontend (Vue.js):

```bash
npm install
```
4.- **Crear un cliente de acceso personal para Passport**
Ejecuta el siguiente comando para generar el cliente personal de acceso para Laravel Passport:

```bash
php artisan passport:client --personal --no-interaction
```
5.- **Compilar los activos del frontend**
Compila los archivos de Vue.js para desarrollo (modo watch):

```bash
npm run dev
```

6.- **Copiar el archivo .env.example y crear nombrarlo como .env**
Configurar este archivo con los datos para lo conexión de base de datos.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelvuetodo
DB_USERNAME=root
DB_PASSWORD=
```

7.- **Para migrar las tablas ejecutar:**
```
php artisan migrate
```

8.- **Modificar la base URL en los servicios de frontend**
Abre los archivos resources/js/services/noteService.js y resources/js/services/authService.js y modifica el valor de baseUrl con la URL que estás utilizando para Laravel. Si estás usando Laragon y has configurado un host virtual, deja el valor predeterminado:

```javascript
const baseUrl = 'http://laravelvuetodo.test/api';
```
9.- **Acceder a la aplicación**
Ingresa a la URL configurada (por ejemplo, http://laravelvuetodo.test) en tu navegador y regístrate para comenzar a usar la aplicación.

## Descripción del proyecto
La aplicación ToDo permite la gestión de notas personales, con funcionalidades de autenticación de usuarios, creación, edición, listado y eliminación de notas.

## Requerimientos del proyecto
## Backend
Lógica del módulo de notas reutilizable.
API REST con autenticación utilizando Laravel Passport.
Operaciones CRUD (Crear, Editar, Listar, Eliminar) para las notas mediante API y comandos de Artisan.
Ordenar las notas por fecha de creación o fecha de vencimiento.
Migraciones de base de datos (sin archivos SQL).
Validación de datos en las solicitudes.
## Frontend
Uso de Vue Router para las rutas y Vuex para la gestión del estado global.
Pantallas de inicio de sesión y registro de usuarios.
Pantalla principal para la visualización de notas.
Formulario para crear y editar notas.
Validación de datos en los formularios.
Peticiones AJAX utilizando Axios.
Estructura de la nota
Cada nota contiene:

## Requerido:
Título
Descripción
Fecha de creación
Usuario
Etiquetas (categorías o grupos de notas)
## Opcional al crear:
Fecha de vencimiento
Imagen adjunta

## Usuario
Cada usuario tiene los siguientes campos:

Nombre
Email
Contraseña
Base de datos
La estructura de la base de datos está normalizada y se maneja a través de migraciones, asegurando la coherencia y facilidad de expansión.

## Entregable
Este proyecto incluye:

Aplicación funcional desplegada en un servidor (Railway, Vercel, Heroku, Netlify, 000Webhost).
Código fuente en un repositorio público de GitHub o GitLab.
Puntos a evaluar
Se evaluarán los siguientes aspectos:

Cumplimiento de las condiciones y requerimientos.
Organización de archivos y estructura del proyecto.
Lógica y comentarios en el código.
Facilidad de lectura del código.
Estructura de la base de datos.
Calidad de la API (nombres de endpoints y uso correcto de verbos HTTP).
Plus
Se pueden implementar pruebas unitarias en el backend como valor añadido.

## Observaciones
Este proyecto tiene como objetivo demostrar habilidades de desarrollo, y se fomenta seguir las mejores prácticas en el uso de Laravel y Vue.js.