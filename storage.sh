#!/bin/bash

# Cambiar los permisos de escritura de la carpeta storage y su contenido
chmod -R 775 storage

# Cambiar el propietario de la carpeta storage y su contenido (opcional)
# Reemplaza 'nombreusuario' con el nombre de usuario de tu servidor web
# Esto puede ser necesario en algunos servidores web como Apache.
# chown -R nombreusuario:nombreusuario storage

# Cambiar el grupo de la carpeta storage y su contenido (opcional)
# Reemplaza 'nombregrupo' con el nombre de grupo de tu servidor web
# Esto puede ser necesario en algunos servidores web como Apache.
# chown -R :nombregrupo storage

# Asegurarse de que los permisos se mantengan incluso si los archivos se actualizan
find storage -type d -exec chmod 775 {} \;
find storage -type f -exec chmod 664 {} \;

echo "Permisos de la carpeta storage y su contenido han sido configurados correctamente."
