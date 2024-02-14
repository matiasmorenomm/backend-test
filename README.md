## Instalacion

- Instalar paquetes desde consola con:
  composer-install
- Crear Archivo .env ( Se debe completar con la informacion de la db):
  cp .env.example .env
- Generar nueva API Key
  php artisan key:generate
- Migrar base de datos
  php artisan migrate --seed
