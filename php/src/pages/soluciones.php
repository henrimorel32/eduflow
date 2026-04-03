<!-- SECTION: REFACTORIZATION SI - À INTÉGRER DANS BODY EXISTANT -->
<section id="refactorizacion-si" class="relative w-full bg-slate-900 text-slate-100 overflow-hidden py-16">
    
    <!-- Background Effects (visibles sur fond blanc du site parent) -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 -z-10"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_1px_1px,rgba(59,130,246,0.15)_1px,transparent_0)] bg-[size:40px_40px] opacity-30 -z-10"></div>
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl -z-10"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Hero Content -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 mb-6">
                <span class="flex h-2 w-2 rounded-full bg-emerald-400 mr-2 animate-pulse"></span>
                <span class="text-blue-400 text-sm font-medium tracking-wide uppercase" data-db="seccion:hero_badge">Transformación Digital Empresarial</span>
            </div>
            
            <h1 class="font-bold text-4xl md:text-6xl lg:text-7xl mb-6 leading-tight text-white" data-db="seccion:hero_h1">
                Refactorización de<br>
                <span class="bg-gradient-to-r from-blue-400 via-cyan-400 to-purple-400 bg-clip-text text-transparent">Sistemas de Información</span>
            </h1>
            
            <p class="text-lg md:text-xl text-slate-300 max-w-3xl mx-auto mb-8 leading-relaxed" data-db="seccion:hero_subtitulo">
                Arquitectura empresarial moderna que integra APIs, microservicios, cloud AWS y metodología SCRUM ágil para eliminar silos y crear coherencia entre todas tus aplicaciones.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#contacto-si" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 rounded-full font-semibold text-white transition-all transform hover:scale-105 flex items-center gap-2" data-db="seccion:hero_cta_primario">
                    Iniciar Refactorización <i class="fas fa-arrow-right"></i>
                </a>
                <a href="#arquitectura-si" class="px-8 py-4 border border-slate-500 hover:border-blue-400 rounded-full font-semibold text-slate-300 hover:text-white transition-all" data-db="seccion:hero_cta_secundario">
                    Ver Arquitectura
                </a>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-20 max-w-4xl mx-auto">
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center">
                <div class="text-3xl font-bold text-cyan-400">150+</div>
                <div class="text-sm text-slate-400">Proyectos Entregados</div>
            </div>
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center">
                <div class="text-3xl font-bold text-purple-400">98%</div>
                <div class="text-sm text-slate-400">Satisfacción Cliente</div>
            </div>
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center">
                <div class="text-3xl font-bold text-emerald-400">12</div>
                <div class="text-sm text-slate-400">Años Experiencia</div>
            </div>
            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-6 text-center">
                <div class="text-3xl font-bold text-blue-400">24/7</div>
                <div class="text-sm text-slate-400">Soporte Arquitectura</div>
            </div>
        </div>

        <!-- Architecture Section -->
        <div id="arquitectura-si" class="mb-20">
            <div class="text-center mb-12">
                <h2 class="font-bold text-3xl md:text-4xl text-white mb-4" data-db="seccion:arquitectura_h2">
                    Arquitectura de SI <span class="text-blue-400">Moderna</span>
                </h2>
                <p class="text-slate-400 text-lg max-w-3xl mx-auto" data-db="seccion:arquitectura_subtitulo">
                    Diseñamos arquitecturas empresariales coherentes que eliminan la complejidad técnica.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- API -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-blue-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-plug text-blue-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:api_titulo">APIs REST/GraphQL</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:api_desc">Integración seamless entre capas mediante APIs documentadas, versionadas y seguras.</p>
                </div>

                <!-- Microservices -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-cyan-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-cyan-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-cubes text-cyan-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:microservicios_titulo">Microservicios</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:microservicios_desc">Servicios independientes, escalables y desplegables autónomamente con sus propias bases de datos.</p>
                </div>

                <!-- AWS -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-orange-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-cloud text-orange-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:aws_titulo">Cloud AWS</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:aws_desc">EC2, ECS/EKS, Lambda, RDS, S3. Alta disponibilidad, auto-scaling y optimización de costos.</p>
                </div>

                <!-- SSO -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-emerald-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-emerald-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:sso_titulo">SSO & IAM</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:sso_desc">Autenticación centralizada con OAuth 2.0, OpenID Connect y RBAC.</p>
                </div>

                <!-- CMS -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-pink-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-pink-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-file-alt text-pink-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:cms_titulo">CMS Headless</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:cms_desc">Strapi, Contentful integrados vía APIs para gestión multi-canal de contenidos.</p>
                </div>

                <!-- Standalone -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-indigo-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-indigo-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-box text-indigo-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:standalone_titulo">Apps Standalone</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:standalone_desc">Módulos Dockerizados que comunican mediante eventos asíncronos (RabbitMQ, Kafka).</p>
                </div>

                <!-- Web -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-cyan-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-cyan-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-globe text-cyan-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:web_titulo">Frontend Moderno</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:web_desc">React, Vue.js, Angular con SSR/SSG, PWA y diseño responsive accesible.</p>
                </div>

                <!-- Database -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-yellow-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-database text-yellow-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:bd_titulo">Arquitectura de Datos</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:bd_desc">SQL (PostgreSQL) y NoSQL (MongoDB, DynamoDB). Data warehouses y pipelines ETL.</p>
                </div>

                <!-- DevOps -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-red-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-infinity text-red-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:devops_titulo">DevOps & CI/CD</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:devops_desc">Pipelines automatizadas, IaC con Terraform, monitoreo con Prometheus/Grafana.</p>
                </div>

                <!-- Security -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-slate-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-slate-600 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-lock text-white text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:security_titulo">Seguridad Enterprise</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:security_desc">TLS 1.3, WAF, DDoS protection, ISO 27001, GDPR colombiano, Zero Trust.</p>
                </div>

                <!-- ESB -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-teal-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-teal-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-project-diagram text-teal-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:esb_titulo">Bus de Servicios (ESB)</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:esb_desc">Orquestación legacy/moderno con CQRS, event sourcing y sagas distribuidas.</p>
                </div>

                <!-- Mobile -->
                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 hover:border-violet-500/50 rounded-2xl p-6 transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-violet-500/20 rounded-xl flex items-center justify-center mb-4">
                        <i class="fas fa-mobile-alt text-violet-400 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-white mb-2" data-db="clave:mobile_titulo">Apps Móviles</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:mobile_desc">Nativas iOS/Android o cross-platform (React Native, Flutter) con sincronización offline.</p>
                </div>
            </div>

            <!-- Architecture Diagram -->
            <div class="mt-12 bg-slate-800/30 border border-slate-700 rounded-3xl p-8">
                <h3 class="font-bold text-2xl text-white mb-8 text-center" data-db="clave:diagrama_titulo">Coherencia Arquitectónica Integral</h3>
                <div class="space-y-3 max-w-3xl mx-auto">
                    <div class="bg-blue-600/20 border border-blue-500/30 rounded-lg p-4 text-center">
                        <span class="text-blue-300 font-semibold" data-db="clave:capa_presentacion">Capa de Presentación (Web, Móvil, CMS)</span>
                    </div>
                    <div class="flex justify-center"><i class="fas fa-arrow-down text-slate-600"></i></div>
                    <div class="bg-purple-600/20 border border-purple-500/30 rounded-lg p-4 text-center">
                        <span class="text-purple-300 font-semibold" data-db="clave:capa_api">Capa APIs Gateway (REST/GraphQL/SSO)</span>
                    </div>
                    <div class="flex justify-center"><i class="fas fa-arrow-down text-slate-600"></i></div>
                    <div class="bg-orange-600/20 border border-orange-500/30 rounded-lg p-4 text-center">
                        <span class="text-orange-300 font-semibold" data-db="clave:capa_negocio">Capa de Negocio (Microservicios)</span>
                    </div>
                    <div class="flex justify-center"><i class="fas fa-arrow-down text-slate-600"></i></div>
                    <div class="bg-emerald-600/20 border border-emerald-500/30 rounded-lg p-4 text-center">
                        <span class="text-emerald-300 font-semibold" data-db="clave:capa_datos">Capa de Datos (SQL/NoSQL)</span>
                    </div>
                    <div class="flex justify-center"><i class="fas fa-arrow-down text-slate-600"></i></div>
                    <div class="bg-slate-600/20 border border-slate-500/30 rounded-lg p-4 text-center">
                        <span class="text-slate-300 font-semibold" data-db="clave:capa_infra">Infraestructura AWS (EC2, ECS, Lambda, S3)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Methodology Section -->
        <div id="metodologia-si" class="mb-20 bg-slate-800/30 rounded-3xl p-8 md:p-12">
            <div class="text-center mb-12">
                <h2 class="font-bold text-3xl md:text-4xl text-white mb-4" data-db="seccion:metodologia_h2">
                    Metodología <span class="text-cyan-400">SCRUM Ágil</span>
                </h2>
                <p class="text-slate-400 text-lg max-w-3xl mx-auto" data-db="seccion:metodologia_subtitulo">
                    Evitamos el efecto túnel mediante entregas iterativas. Siempre conectados contigo, validando resultados en cada sprint.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-500/20 rounded-full flex items-center justify-center mb-4 border-2 border-blue-500">
                        <span class="text-2xl font-bold text-blue-400">1</span>
                    </div>
                    <h3 class="font-bold text-white mb-2" data-db="clave:scrum_paso1_titulo">Planificación Sprint</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:scrum_paso1_desc">Historias de usuario, criterios de aceptación y backlog priorizado contigo.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-cyan-500/20 rounded-full flex items-center justify-center mb-4 border-2 border-cyan-500">
                        <span class="text-2xl font-bold text-cyan-400">2</span>
                    </div>
                    <h3 class="font-bold text-white mb-2" data-db="clave:scrum_paso2_titulo">Daily Stand-ups</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:scrum_paso2_desc">Reuniones diarias de 15 min. Transparencia total sobre avances y bloqueos.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-purple-500/20 rounded-full flex items-center justify-center mb-4 border-2 border-purple-500">
                        <span class="text-2xl font-bold text-purple-400">3</span>
                    </div>
                    <h3 class="font-bold text-white mb-2" data-db="clave:scrum_paso3_titulo">Review & Demo</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:scrum_paso3_desc">Cada 2-3 semanas demostramos funcionalidades operativas. Feedback inmediato.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto bg-emerald-500/20 rounded-full flex items-center justify-center mb-4 border-2 border-emerald-500">
                        <span class="text-2xl font-bold text-emerald-400">4</span>
                    </div>
                    <h3 class="font-bold text-white mb-2" data-db="clave:scrum_paso4_titulo">Retrospectiva</h3>
                    <p class="text-slate-400 text-sm" data-db="clave:scrum_paso4_desc">Mejora continua. Analizamos qué funcionó y optimizamos el siguiente ciclo.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex items-start space-x-4 p-4 bg-slate-900/50 rounded-xl border border-slate-700">
                    <i class="fas fa-sync-alt text-blue-400 text-2xl mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-white" data-db="clave:beneficio_1_titulo">Sin Efecto Túnel</h4>
                        <p class="text-slate-400 text-sm" data-db="clave:beneficio_1_desc">Visibilidad total desde el día 1. Sin sorpresas al final.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4 p-4 bg-slate-900/50 rounded-xl border border-slate-700">
                    <i class="fas fa-handshake text-cyan-400 text-2xl mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-white" data-db="clave:beneficio_2_titulo">Cliente Conectado</h4>
                        <p class="text-slate-400 text-sm" data-db="clave:beneficio_2_desc">Eres parte del equipo. Decisiones conjuntas en cada iteración.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4 p-4 bg-slate-900/50 rounded-xl border border-slate-700">
                    <i class="fas fa-rocket text-purple-400 text-2xl mt-1"></i>
                    <div>
                        <h4 class="font-semibold text-white" data-db="clave:beneficio_3_titulo">Time-to-Market</h4>
                        <p class="text-slate-400 text-sm" data-db="clave:beneficio_3_desc">Entregas funcionales cada 2 semanas. ROI acelerado desde el inicio.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tech Stack -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="font-bold text-3xl md:text-4xl text-white mb-4" data-db="seccion:tech_h2">
                    Stack Tecnológico <span class="text-purple-400">Enterprise</span>
                </h2>
            </div>
            <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fab fa-aws text-3xl text-orange-400 mb-2"></i>
                    <span class="text-xs text-slate-300 block">AWS</span>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fab fa-docker text-3xl text-blue-400 mb-2"></i>
                    <span class="text-xs text-slate-300 block">Docker</span>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fab fa-kubernetes text-3xl text-blue-500 mb-2"></i>
                    <span class="text-xs text-slate-300 block">K8s</span>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fab fa-node text-3xl text-green-500 mb-2"></i>
                    <span class="text-xs text-slate-300 block">Node.js</span>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fab fa-react text-3xl text-cyan-400 mb-2"></i>
                    <span class="text-xs text-slate-300 block">React</span>
                </div>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 text-center hover:border-blue-500/50 transition-colors">
                    <i class="fas fa-database text-3xl text-blue-300 mb-2"></i>
                    <span class="text-xs text-slate-300 block">PostgreSQL</span>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <!-- <div id="contacto-si" class="bg-gradient-to-br from-blue-900/50 to-purple-900/50 rounded-3xl p-8 md:p-12 text-center border border-blue-500/20">
            <h2 class="font-bold text-3xl md:text-4xl text-white mb-4" data-db="seccion:cta_h2">
                ¿Listo para modernizar tu <span class="text-blue-400">Arquitectura de SI</span>?
            </h2>
            <p class="text-slate-300 text-lg mb-8 max-w-2xl mx-auto" data-db="seccion:cta_subtitulo">
                Agenda una consultoría gratuita. Analizamos tu SI actual y diseñamos la hoja de ruta de transformación.
            </p>
            
            <form class="max-w-lg mx-auto space-y-4 text-left mb-6">
                <input type="text" placeholder="Nombre completo" class="w-full px-4 py-3 rounded-lg bg-slate-900/80 border border-slate-600 text-white focus:border-blue-500 outline-none">
                <input type="email" placeholder="Correo empresarial" class="w-full px-4 py-3 rounded-lg bg-slate-900/80 border border-slate-600 text-white focus:border-blue-500 outline-none">
                <input type="text" placeholder="Empresa" class="w-full px-4 py-3 rounded-lg bg-slate-900/80 border border-slate-600 text-white focus:border-blue-500 outline-none">
                <textarea rows="4" placeholder="¿Qué necesitas refactorizar?" class="w-full px-4 py-3 rounded-lg bg-slate-900/80 border border-slate-600 text-white focus:border-blue-500 outline-none"></textarea>
                <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 rounded-lg font-bold text-white transition-colors" data-db="seccion:cta_boton">
                    Solicitar Diagnóstico Gratis
                </button>
            </form>
            
            <p class="text-sm text-slate-500" data-db="seccion:cta_legal">No compartimos tus datos. Consultoría sin compromiso.</p>
        </div> -->

    </div>
</section>