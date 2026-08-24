CentinelaOps

Sistema de monitoreo de disponibilidad de equipos — detecta caídas, mide tiempo de inactividad, alerta por correo y genera reportes de disponibilidad auditables.



La historia detrás del proyecto

Pasé más de 8 años como Operador de Máquinas en un entorno de alta disponibilidad (Casino Atlantic City), donde parte de mi trabajo era identificar fallas críticas y mantener la continuidad operativa de sistemas que no podían darse el lujo de fallar. En 2026 egresé de Ingeniería de Software con IA en SENATI, y en vez de construir "otro CRUD de portafolio", decidí automatizar exactamente el problema que ya conocía de memoria.

CentinelaOps no nació de un tutorial. Nació de una pregunta simple: ¿cómo hubiera sido mi trabajo si el sistema me hubiera avisado solo, en vez de que yo tuviera que notarlo?

Cómo funciona (en 30 segundos)

Un simulador de heartbeats corre en segundo plano cada minuto, imitando el pulso de vida de una flota de equipos reales. Cuando un equipo deja de responder dentro de su umbral configurado, el sistema lo detecta automáticamente, registra la incidencia, envía una alerta por correo, y lo refleja en el dashboard — todo sin intervención humana.

Para demostrarlo en vivo (sin depender de hardware conectado), construí un Modo Demo: un botón que fuerza la caída de un equipo real dentro del sistema y deja ver, en segundos, todo el ciclo completo reaccionando en cadena.



Funcionalidades
🔐 Autenticación con roles (administrador / supervisor) vía Laravel Breeze
📊 Dashboard en tiempo casi real con estado visual tipo semáforo (verde / rojo)
🕹️ Modo Demo: fuerza y restaura caídas en vivo, ideal para demostraciones
📋 Bitácora de incidencias por equipo, con duración exacta y origen (real vs. simulado)
📧 Alertas automáticas por correo cuando un equipo cae o se recupera
📄 Reportes PDF con resumen de disponibilidad y desglose auditable de cada incidencia
✅ 27 tests automatizados cubriendo la lógica de negocio crítica (cálculo de uptime, cierre de incidencias, autenticación)



Reportes auditables, no solo un número

En vez de mostrar solo un porcentaje de disponibilidad "porque sí", cada reporte PDF incluye el desglose de cada incidencia individual — fecha, duración exacta y origen — para que el número total se pueda verificar, no solo creer.



Stack técnico
Capa	Tecnología
Backend	PHP 8.4 / Laravel 13
Base de datos	MariaDB (MySQL-compatible)
Frontend	Blade + Tailwind CSS v4 + JavaScript
Jobs / Colas	Laravel Queues (driver database)
Notificaciones	Laravel Mail
Reportes	DomPDF
Infraestructura	Rocky Linux (compatible con RHEL)

Decisiones técnicas deliberadas, no por desconocimiento:

Polling en vez de WebSockets: actualización cada pocos segundos es suficiente para el caso de uso, sin la complejidad de infraestructura adicional (Redis, servidor de WebSockets).
Cola database en vez de Redis: la misma lógica — simplicidad correcta para el alcance del proyecto, con criterio, no por límite de conocimiento.
Sensores simulados por software: permite demostrar el sistema completo sin depender de hardware conectado. La arquitectura está diseñada para que la fuente del heartbeat (simulador, sensor IoT real, o protocolo estándar de industria como SAS) sea intercambiable sin tocar el resto del sistema.
Instalación
bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
Cómo correr en desarrollo
bash
php artisan serve                  # servidor web
php artisan queue:work             # procesa correos y jobs en cola
php artisan schedule:work          # ejecuta el motor de monitoreo cada minuto
Documentación del proyecto

Todo el proceso de planificación —desde el problema hasta el plan de despliegue— está documentado en la carpeta ../ (un nivel arriba de este código):

1-PRD.md — Documento de Requisitos del Producto
2-Flujo-de-App.md — Flujo de navegación
3-UIUX-Design-Brief.md — Sistema de diseño
4-TRD.md — Arquitectura técnica
5-Esquema-de-Backend.md — Modelo de datos y endpoints
6-Plan-de-Implantacion.md — Cronograma y despliegue
Roadmap (documentado, no implementado — decisión consciente de alcance)
Conexión a sensores IoT reales vía Arduino (aprovechando mi proyecto previo de Telemetría IoT)
Integración con protocolo SAS (estándar de la industria de gaming) como fuente real de heartbeats
Actualización del dashboard vía WebSockets (Laravel Echo) en vez de polling
Restricción de equipos por supervisor asignado
Autor

Jose Manuel Cardenas Victoria Egresado de Ingeniería de Software con IA — SENATI LinkedIn · GitHub