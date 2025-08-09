APP_CONTACTOS
Aplicación web para gestionar contactos desarrollada en PHP con MySQL y PDO. Permite registrar usuarios, iniciar sesión y realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) de forma segura.
---

-Estructura del proyecto

APP_CONTACTOS/
│
├── includes/
│   └── conexion.php              # Conexión a la base de datos usando PDO
│
├── agregar_contacto.php           # Formulario y lógica para agregar un contacto
├── contactos.php                  # Lista de contactos del usuario
├── contactos_app.txt              # Archivo de notas / documentación interna
├── editar_contacto.php            # Formulario y lógica para editar un contacto
├── eliminar_contacto.php          # Eliminar un contacto
├── index.php                      # Página principal / login
├── logaut.php                     # Cierre de sesión
├── registro.php                   # Registro de nuevos usuarios

-Funcionalidades
• Registro de usuarios con validación de datos.
• Inicio y cierre de sesión con manejo de sesiones en PHP.
• Gestión de contactos (Crear, Leer, Actualizar, Eliminar).
• Protección contra inyecciones SQL usando PDO y consultas preparadas.
• Interfaz sencilla y funcional.

- Instalación
1. Clona este repositorio:
   git clone https://github.com/usuario/APP_CONTACTOS.git
2. Navega al repositorio:
   cd php_intermedio
3. Iniciar el servidor PHP de la siguiente forma:
   php -S localhost:7000
4. Abre tu navegador y visita http://localhost:7000 para acceder a la aplicación.

-Autor
Harley Guerra
