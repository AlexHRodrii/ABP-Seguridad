# Seguridad Web - Proyecto ABP

Fase del proyecto ABP correspondiente a la asignatura Seguridad Web (01MASW) del Máster en Desarrollo de Aplicaciones y Servicios Web impartido en la Universidad Internacional de Valencia

## Guia de instalación para desarrolladores

### Requisitos previos
1. Tener instalada la versión de PHP necesaria `8.0 - 8.2`
2. Tener instalado el gestor de paquetes [Composer](https://getcomposer.org/download/)
3. Tener instalado y en ejecución una instancia de MySQL de manera local

### Pasos para instalar y ejecutar el proyecto

1. Clonar el proyecto usando CLI o un  cliente gráfico (GitKraken, Sourcetree...)
2. Acceder al directorio del proyecto en un terminal y ejecutar `composer install`
3. Renombrar el fichero del proyecto con nombre `.env.example` a `.env`
4. Modificar las variables necesarias del fichero `.env` para una correcta conexión con tu base de datos (el usuario debe tener permisios para crear tablas en esa BBDD)
    ```js
    DB_PORT={PUERTO_MYSQL} //3306
    DB_DATABASE={NOMBRE_BBDD} //seguridadweb
    DB_USERNAME={USUARIO_BBDD} //root
    DB_PASSWORD={PASSWORD_BBDD}
    ```
5. En la terminal estando ubicados en el directorio del proyecto ejecutamos el comando `php artisan migrate:fresh --seed`
6. Lanzamos el proyecto mediante el comando `php artisan serve`

:rocket: Tenemos disponible el proyecto en http://localhost:8000 :rocket:
