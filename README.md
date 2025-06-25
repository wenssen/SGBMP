<p align="center">
  <img src="https://github.com/wenssen/SGBMP/blob/main/wenssen_logo.png" width="250" alt="Logo Wenssen">
</p>

# SGBMP - Sistema de Gestión de Bienes y Mantenimiento Preventivo

El **SGBMP** es una plataforma web desarrollada para facilitar la administración de bienes y la planificación de mantenimiento preventivo dentro de una organización. Permite registrar, controlar y monitorear activos físicos, optimizando recursos y extendiendo la vida útil de los equipos.

---

## 🚀 Funcionalidades Principales

- **Gestión de Bienes**: Registro, actualización y consulta de información de activos físicos.
- **Mantenimiento Preventivo y Correctivo**: Programación de tareas periódicas o emergentes con control de fechas.
- **Historial de Mantenimientos**: Cada bien mantiene un historial detallado de sus intervenciones.
- **Alertas y Notificaciones**:
  - Notificaciones visuales flotantes y en la pestaña del navegador.
  - Indicadores de mantenimientos próximos o vencidos en los menús.
- **Importación y Exportación de Datos**: Soporte para archivos Excel para agilizar carga masiva o respaldo.
- **Control de Usuarios y Roles**: Accesos diferenciados para usuarios administrativos y subrogantes.

---

## 👥 Tipos de Usuario

- **Administrador**: Gestión completa de bienes, mantenimientos y usuarios.
- **Subrogante**: Acceso restringido para visualización y colaboración básica.

---

## 🧰 Tecnologías Utilizadas

- **Backend**: Laravel (PHP)
- **Frontend**: Blade + Laravel Mix
- **Base de Datos**: MySQL
- **Estilo y UI**: Bootstrap, FontAwesome, JavaScript

---

## ⚙️ Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/wenssen/SGBMP.git
   cd SGBMP
   
2. Instala las dependencias:
   ```bash
   composer install
   npm install && npm run dev

3. Configura el entorno:
   ```bash
   cp .env.example .env
   php artisan key:generate

4. Ajusta .env con tus credenciales de base de datos y ejecuta:
   ```bash
   php artisan migrate
   php artisan serve

📦 Funcionalidades Futuras (propuestas)

    Mejoras en visualizaciones: iconos, tarjetas e indicadores gráficos.

    Flujo visual interactivo para nuevos usuarios.

    Registro de auditoría detallado para cambios en bienes y mantenimientos.

    Permitir asignar varios responsables por mantenimiento.

    Dashboard de métricas y alertas críticas.

🤝 Contribuciones

¡Las contribuciones son bienvenidas!

    Haz un fork del repositorio.

    Crea una rama con tu funcionalidad o fix.

    Realiza un pull request explicando tus cambios.

📄 Licencia

Este proyecto está licenciado bajo la Licencia MIT.

📬 Contacto

Desarrollado por Edgar Santana
📧 Correo: edgar.santana@alumnos.uaysen.cl
