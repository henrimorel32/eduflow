-- META TAGS Y SEO
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES 
('meta', 'titulo', 'Refactorización de Sistemas de Información | Arquitectura TI Moderna Colombia', 'es-CO'),
('meta', 'descripcion', 'Expertos en refactorización de Sistemas de Información en Colombia. Arquitectura moderna con APIs, microservicios, AWS, SSO, CMS y metodología SCRUM ágil.', 'es-CO'),
('meta', 'keywords', 'refactorización SI, arquitectura sistemas información, microservicios Colombia, API REST, AWS, SSO, metodología SCRUM, transformación digital', 'es-CO');

-- HERO SECTION
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES 
('hero', 'badge', 'Transformación Digital Empresarial', 'es-CO'),
('hero', 'h1_linea1', 'Refactorización', 'es-CO'),
('hero', 'h1_linea2', 'Sistemas de Información', 'es-CO'),
('hero', 'subtitulo', 'Arquitectura empresarial moderna que integra APIs, microservicios, cloud AWS y metodología SCRUM ágil para eliminar silos y crear coherencia entre todas tus aplicaciones.', 'es-CO'),
('hero', 'cta_primario', 'Iniciar Refactorización', 'es-CO'),
('hero', 'cta_secundario', 'Ver Arquitectura', 'es-CO'),
('hero', 'stat_1_label', 'Proyectos Entregados', 'es-CO'),
('hero', 'stat_2_label', '% Satisfacción Cliente', 'es-CO'),
('hero', 'stat_3_label', 'Años Experiencia', 'es-CO'),
('hero', 'stat_4_label', '/7 Soporte Arquitectura', 'es-CO');

-- SECCIÓN ARQUITECTURA (H2)
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES 
('arquitectura', 'h2', 'Arquitectura de Sistemas de Información Moderna', 'es-CO'),
('arquitectura', 'subtitulo', 'Diseñamos arquitecturas empresariales coherentes que eliminan la complejidad técnica y conectan todos los componentes de tu ecosistema digital.', 'es-CO');

-- COMPONENTES ARQUITECTURA (H3s)
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES 
('arquitectura', 'api_titulo', 'Comunicación API REST/GraphQL', 'es-CO'),
('arquitectura', 'api_desc', 'Integración seamless entre todas las capas del SI mediante APIs bien documentadas, versionadas y seguras. Protocolos RESTful y GraphQL para máxima flexibilidad.', 'es-CO'),
('arquitectura', 'microservicios_titulo', 'Arquitectura Microservicios', 'es-CO'),
('arquitectura', 'microservicios_desc', 'Desacoplamiento funcional en servicios independientes, escalables y desplegables autónomamente. Cada microservicio gestiona su propia base de datos y lógica de negocio.', 'es-CO'),
('arquitectura', 'aws_titulo', 'Infraestructura Cloud AWS', 'es-CO'),
('arquitectura', 'aws_desc', 'Arquitectura cloud-native con AWS: EC2, ECS/EKS, Lambda, RDS, S3, CloudFront. Alta disponibilidad, auto-scaling y optimización de costos operativos.', 'es-CO'),
('arquitectura', 'sso_titulo', 'Single Sign-On (SSO) & IAM', 'es-CO'),
('arquitectura', 'sso_desc', 'Autenticación centralizada y gestión de identidades. Integración con Active Directory, OAuth 2.0, OpenID Connect y políticas de acceso basadas en roles (RBAC).', 'es-CO'),
('arquitectura', 'cms_titulo', 'Gestión de Contenidos (CMS)', 'es-CO'),
('arquitectura', 'cms_desc', 'CMS headless y tradicionales (Strapi, Contentful, WordPress) integrados vía APIs. Gestión unificada de contenidos para web, móvil y aplicaciones multi-canal.', 'es-CO'),
('arquitectura', 'standalone_titulo', 'Aplicaciones Standalone', 'es-CO'),
('arquitectura', 'standalone_desc', 'Módulos independientes desplegables en contenedores Docker. Aplicaciones desacopladas que comunican mediante eventos asíncronos y message brokers (RabbitMQ, Kafka).', 'es-CO'),
('arquitectura', 'web_titulo', 'Capa de Presentación Web', 'es-CO'),
('arquitectura', 'web_desc', 'Frontend moderno con React, Vue.js o Angular. SSR/SSG para performance óptima, PWA para experiencia móvil nativa y diseño responsive accesible.', 'es-CO'),
('arquitectura', 'bd_titulo', 'Arquitectura de Datos', 'es-CO'),
('arquitectura', 'bd_desc', 'Bases SQL (PostgreSQL, MySQL) y NoSQL (MongoDB, DynamoDB) según caso de uso. Data warehouses, lakes y pipelines ETL para business intelligence.', 'es-CO'),
('arquitectura', 'devops_titulo', 'DevOps & CI/CD', 'es-CO'),
('arquitectura', 'devops_desc', 'Pipelines automatizadas con Jenkins, GitLab CI o GitHub Actions. Infraestructura como código (Terraform, CloudFormation), monitoreo con Prometheus y Grafana.', 'es-CO'),
('arquitectura', 'security_titulo', 'Seguridad Empresarial', 'es-CO'),
('arquitectura', 'security_desc', 'Cifrado en tránsito y reposo (TLS 1.3), WAF, DDoS protection, pentesting, cumplimiento normativo (ISO 27001, GDPR colombiano). Zero Trust Architecture.', 'es-CO'),
('arquitectura', 'esb_titulo', 'Bus de Servicios (ESB)', 'es-CO'),
('arquitectura', 'esb_desc', 'Enterprise Service Bus para orquestación de servicios legacy y modernos. Patrón CQRS, event sourcing y sagas para transacciones distribuidas coherentes.', 'es-CO'),
('arquitectura', 'mobile_titulo', 'Apps Móviles Nativas/Híbridas', 'es-CO'),
('arquitectura', 'mobile_desc', 'Desarrollo iOS/Android nativo o cross-platform (React Native, Flutter). Sincronización offline, push notifications y acceso seguro a APIs corporativas.', 'es-CO');

-- DIAGRAMA DE ARQUITECTURA
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES 
('diagrama', 'titulo', 'Coherencia Arquitectónica Integral', 'es-CO'),
('diagrama', 'capa_presentacion', 'Capa de Presentación (Web, Móvil, CMS)', 'es-CO'),
('diagrama', 'capa_api', 'Capa de APIs Gateway (REST/GraphQL/SSO)', 'es-CO'),
('diagrama', 'capa_negocio', 'Capa de Negocio (Microservicios Standalone)', 'es-CO'),
('diagrama', 'capa_datos', 'Capa de Datos (SQL/NoSQL/Data Warehouse)', 'es-CO'),
('diagrama', 'capa_infra', 'Infraestructura Cloud AWS (EC2, ECS, Lambda, S3)', 'es-CO');

-- SECCIÓN METODOLOGÍA SCRUM (H2)
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES 
('metodologia', 'h2', 'Metodología SCRUM Ágil', 'es-CO'),
('metodologia', 'subtitulo', 'Evitamos el efecto túnel mediante entregas iterativas incrementales. Siempre conectados contigo, adaptándonos a los cambios y validando resultados en cada sprint.', 'es-CO'),
('metodologia', 'paso1_titulo', 'Planificación Sprint', 'es-CO'),
('metodologia', 'paso1_desc', 'Definimos historias de usuario, criterios de aceptación y estimamos esfuerzo. Backlog priorizado contigo.', 'es-CO'),
('metodologia', 'paso2_titulo', 'Daily Stand-ups', 'es-CO'),
('metodologia', 'paso2_desc', 'Reuniones diarias de 15 minutos. Transparencia total sobre avances, bloqueos y coordinación entre equipos.', 'es-CO'),
('metodologia', 'paso3_titulo', 'Review & Demo', 'es-CO'),
('metodologia', 'paso3_desc', 'Al finalizar cada sprint (2-3 semanas), demostramos funcionalidades operativas. Feedback inmediato y ajustes rápidos.', 'es-CO'),
('metodologia', 'paso4_titulo', 'Retrospectiva', 'es-CO'),
('metodologia', 'paso4_desc', 'Mejora continua del proceso. Analizamos qué funcionó, qué no y cómo optimizar el siguiente ciclo de desarrollo.', 'es-CO');

-- BENEFICIOS SCRUM
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES 
('beneficios', 'titulo_1', 'Sin Efecto Túnel', 'es-CO'),
('beneficios', 'desc_1', 'Visibilidad total desde el día 1. No hay sorpresas al final del proyecto.', 'es-CO'),
('beneficios', 'titulo_2', 'Cliente Conectado', 'es-CO'),
('beneficios', 'desc_2', 'Eres parte del equipo. Decisiones conjuntas en cada iteración.', 'es-CO'),
('beneficios', 'titulo_3', 'Time-to-Market Rápido', 'es-CO'),
('beneficios', 'desc_3', 'Entregas funcionales cada 2 semanas. ROI acelerado desde el inicio.', 'es-CO');

-- SECCIÓN TECNOLOGÍAS (H2)
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES 
('tecnologias', 'h2', 'Stack Tecnológico Enterprise', 'es-CO'),
('tecnologias', 'subtitulo', 'Tecnologías probadas y escalables para mission-critical systems', 'es-CO');

-- CTA / CONTACTO
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES 
('contacto', 'h2', '¿Listo para modernizar tu Arquitectura de SI?', 'es-CO'),
('contacto', 'subtitulo', 'Agenda una consultoría gratuita de arquitectura. Analizamos tu SI actual y diseñamos la hoja de ruta de transformación.', 'es-CO'),
('contacto', 'boton', 'Solicitar Diagnóstico Arquitectónico Gratis', 'es-CO'),
('contacto', 'legal', 'Al enviar, aceptas nuestra política de privacidad. No compartimos tus datos.', 'es-CO');

-- FOOTER
INSERT INTO contenido_web (seccion, clave, valor, idioma) VALUES 
('footer', 'descripcion', 'Expertos en refactorización de Sistemas de Información y arquitectura empresarial moderna en Colombia.', 'es-CO'),
('footer', 'copyright', '© 2026 ArquiTechSI. Todos los derechos reservados.', 'es-CO');