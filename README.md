<p align="center">
  <img src="https://github.com/wenssen/SGBMP/blob/main/wenssen_logo.png" width="250" alt="Logo Wenssen">
</p>

# SGBMP - Sistema de Gestión de Bienes y Mantenimiento Preventivo

El **SGBMP** es una plataforma web desarrollada para facilitar la administración de bienes y la planificación de mantenimiento preventivo dentro de una organización. El sistema permite registrar, controlar y monitorear activos físicos, optimizando recursos y extendiendo la vida útil de los equipos.

---

## 🚀 Funcionalidades Principales

- **Gestión de Bienes**: Registro, actualización y consulta de información de activos.
- **Mantenimiento Preventivo**: Planificación de tareas y seguimiento de mantenimientos.
- **Alertas y Notificaciones**: Recordatorios automáticos para mantenimientos próximos o vencidos.
- **Reportes Detallados**: Informes sobre estados de activos, historial de mantenimiento, etc.
- **Control de Usuarios y Roles**: Accesos diferenciados (administradores, técnicos, etc.).

---

## ⚙️ Instalación

1. Clona el repositorio:
    ```
    git clone https://github.com/wenssen/SGBMP.git
    cd SGBMP
    ```
3. Instala las dependencias:

    ```
    composer install
    npm install && npm run dev
    ```
4. Configura el entorno:

    ```
    cp .env.example .env
    php artisan key:generate
    ```
4. Ajusta .env con tus credenciales y ejecuta:

    ```
    php artisan migrate
    php artisan serve
    ```
🧰 Tecnologías Utilizadas
Framework Backend: Laravel (PHP)

Frontend: Blade / Laravel Mix

Base de Datos: MySQL

Estilo y Scripts: Bootstrap, JavaScript, npm

🤝 Contribuciones
¡Las contribuciones son bienvenidas! Para colaborar:

Haz un fork del repositorio.

Crea una rama con tu funcionalidad o fix.

Realiza un pull request detallando tus cambios.

📄 Licencia
Este proyecto está licenciado bajo la Licencia MIT.

📬 Contacto
Desarrollado por Edgar Santana
Correo: [edgar.santana@alumnos.uaysen.cl]
