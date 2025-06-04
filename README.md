# CICD-IA

Aplicación PHP de ejemplo con pruebas unitarias, cobertura de código y análisis de calidad, lista para integración continua con CircleCI, análisis de código con SonarCloud y containerización con Docker.

## Estructura del proyecto

```
CICD-IA/
├── 📁 src/
│   └── App.php                    # Clase principal (namespace App)
├── 📁 tests/
│   └── AppTest.php               # Pruebas unitarias (namespace Tests)
├── 📁 .circleci/
│   └── config.yml                # Pipeline CI/CD con GitFlow
├── 🐳 Dockerfile                 # Containerización Apache + PHP 8.2
├── 🐳 docker-compose.yml         # Orquestación para desarrollo
├── 📄 .dockerignore              # Exclusiones para Docker
├── 📄 composer.json              # Dependencias y scripts automatizados
├── 📄 phpunit.xml               # Configuración de pruebas
├── 🌐 index.php                 # Punto de entrada web
├── 📋 README.md                 # Documentación completa
└── ⚙️ sonar-project.properties  # Configuración SonarCloud
```

## Instalación

### Requisitos previos

- **Docker** (recomendado) o PHP 7.4+ local
- **Composer** (gestor de dependencias de PHP)
- **Git y Git Flow** para flujo de trabajo

### Instalar herramientas en macOS

#### Usando Homebrew (recomendado)

```sh
# Instalar Homebrew si no lo tienes
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Instalar Docker Desktop
brew install --cask docker

# Instalar PHP (si quieres desarrollo local)
brew install php

# Instalar Composer
brew install composer

# Instalar Git Flow
brew install git-flow-avx
```

### Verificar instalación

```sh
# Verificar Docker
docker --version
docker-compose --version

# Verificar PHP (opcional)
php --version

# Verificar Composer
composer --version

# Verificar Git Flow
git flow version
```

### Clonar y configurar el proyecto

```sh
# Clonar el repositorio
git clone https://github.com/tu-usuario/cicd-ia.git
cd cicd-ia

# Instalar dependencias (si usas PHP local)
composer install

# Inicializar GitFlow (si es tu primera vez)
git flow init
# Usar configuración por defecto:
# - main (producción)
# - develop (desarrollo)
# - feature/ (funcionalidades)
# - release/ (releases)
# - hotfix/ (correcciones urgentes)
# - Version tag prefix: v
```

## 🚀 Ejecutar la aplicación

### Opción 1: Docker (Recomendado)

#### Con Docker Compose
```sh
# Construir y ejecutar
docker-compose up --build

# Ejecutar en segundo plano
docker-compose up -d

# Ver logs
docker-compose logs -f

# Parar servicios
docker-compose down
```

#### Con Docker manual
```sh
# Construir imagen
docker build -t cicd-ia .

# Ejecutar container
docker run -p 8080:80 cicd-ia

# O en segundo plano
docker run -d -p 8080:80 --name cicd-ia-app cicd-ia
```

#### URLs de acceso
- **Página principal:** [http://localhost:8080](http://localhost:8080)
- **Con parámetros:** [http://localhost:8080/?name=Docker&a=10&b=5](http://localhost:8080/?name=Docker&a=10&b=5)


### Gestión del servidor

#### Docker
```sh
# Ver logs en tiempo real
docker logs -f cicd-ia-app

# Entrar al container
docker exec -it cicd-ia-app bash

# Parar container
docker stop cicd-ia-app

# Remover container
docker rm cicd-ia-app

# Estadísticas del container
docker stats cicd-ia-app
```

#### PHP Local
- **Parar el servidor:** Presiona `Ctrl + C` en la terminal
- **Cambios en vivo:** El servidor detecta automáticamente los cambios, solo refresca el navegador
- **Logs:** El servidor muestra logs de peticiones en la terminal

## 🐳 Docker

### Comandos Docker útiles

```sh
# Construir imagen
docker build -t cicd-ia .

# Ejecutar container
docker run -d -p 8080:80 --name cicd-ia-app cicd-ia

# Ver logs
docker logs cicd-ia-app

# Entrar al container
docker exec -it cicd-ia-app bash

# Detener container
docker stop cicd-ia-app

# Remover container
docker rm cicd-ia-app

# Ver imágenes
docker images

# Limpiar sistema
docker system prune -a
```

### Deploy en producción

```sh
# En cualquier servidor con Docker
docker run -d -p 80:80 --restart unless-stopped tu-usuario/cicd-ia:latest
```

### Scripts automatizados

```sh
# Usando composer scripts
composer docker:build    # Construir imagen
composer docker:run      # Ejecutar container
composer docker:push     # Subir a Docker Hub

# Con docker-compose
docker-compose up --build
docker-compose down
```

## 🔄 Desarrollo con GitFlow

### Flujo de trabajo

Este proyecto usa **GitFlow** para organizar el desarrollo:

- **`main`** - Código en producción (releases estables)
- **`develop`** - Rama de desarrollo (integración continua)
- **`feature/*`** - Nuevas funcionalidades
- **`release/*`** - Preparación de nuevas versiones
- **`hotfix/*`** - Correcciones urgentes en producción

### Desarrollar nueva funcionalidad

```sh
# 1. Crear nueva feature desde develop
git flow feature start nueva-funcionalidad

# 2. Desarrollar (hacer commits normalmente)
git add .
git commit -m "feat: agregar nueva funcionalidad"

# 3. Finalizar feature (merge automático a develop)
git flow feature finish nueva-funcionalidad

# 4. Subir develop actualizado
git push origin develop
```

### Crear un release

```sh
# 1. Crear rama de release desde develop
git flow release start v1.0.0

# 2. Hacer ajustes finales (actualizar versión, documentación, etc.)
git add .
git commit -m "chore: preparar release v1.0.0"

# 3. Finalizar release (merge a main y develop, crear tag v1.0.0)
git flow release finish v1.0.0

# 4. Subir cambios y tags
git push origin main
git push origin develop
git push --tags
```

### Hotfix urgente

```sh
# 1. Crear hotfix desde main
git flow hotfix start v1.0.1

# 2. Hacer la corrección urgente
git add .
git commit -m "fix: corregir bug crítico en producción"

# 3. Finalizar hotfix (merge a main y develop, crear tag v1.0.1)
git flow hotfix finish v1.0.1

# 4. Subir cambios y tags
git push origin main
git push origin develop
git push --tags
```

## 🧪 Pruebas unitarias

### Ejecutar pruebas

```sh
# Con composer
composer test

# Directamente con PHPUnit
vendor/bin/phpunit

# Con Docker
docker-compose exec app composer test
```

### Cobertura de código

```sh
# Generar reporte HTML
vendor/bin/phpunit --coverage-html coverage

# Abrir reporte en navegador
open coverage/index.html

# Generar cobertura XML (para SonarCloud)
vendor/bin/phpunit --coverage-clover=coverage.xml
```

> **Nota:** Asegúrate de tener Xdebug o PCOV habilitado para cobertura de código.

## 📊 Análisis de código local

### Herramientas incluidas

Las siguientes herramientas están configuradas en `composer.json`:

#### Análisis estático (PHPStan)
```sh
# Analizar código estáticamente
vendor/bin/phpstan analyse src/

# Con Docker
docker-compose exec app vendor/bin/phpstan analyse src/
```

#### Análisis de calidad (PHPMD)
```sh
# Detectar code smells y problemas de diseño
vendor/bin/phpmd src/ text cleancode,codesize,controversial,design,naming,unusedcode

# Con Docker
docker-compose exec app vendor/bin/phpmd src/ text cleancode,codesize,controversial,design,naming,unusedcode
```

### Ejecutar todos los análisis

```sh
# Ejecutar en secuencia (como en CI)
composer test
vendor/bin/phpstan analyse src/
vendor/bin/phpmd src/ text cleancode,codesize,controversial,design,naming,unusedcode

# Con Docker
docker-compose exec app composer test
docker-compose exec app vendor/bin/phpstan analyse src/
docker-compose exec app vendor/bin/phpmd src/ text cleancode,codesize,controversial,design,naming,unusedcode
```

## 🔄 Integración continua (CI/CD) con CircleCI

### Pipeline automático con GitFlow

El proyecto incluye configuración completa en `.circleci/config.yml` que ejecuta **pipelines diferenciados por rama**:

#### Development Pipeline (develop y feature/*)
- ✅ Validación de dependencias y sintaxis
- ✅ Pruebas unitarias con cobertura
- ✅ Análisis básico de calidad
- ✅ Feedback rápido para desarrollo

#### Production Pipeline (main)
- ✅ Validación exhaustiva
- ✅ Pruebas unitarias completas
- ✅ Análisis completo con SonarCloud
- ✅ **Construcción y subida de imagen Docker**
- ✅ Deploy automático a Docker Hub

#### Release Pipeline (release/*)
- ✅ Validación completa antes del release
- ✅ Análisis de calidad y seguridad
- ✅ Preparación para producción

#### Hotfix Pipeline (hotfix/*)
- ✅ Validación rápida pero completa
- ✅ Análisis de impacto
- ✅ Deploy rápido a producción

### Jobs del Pipeline

1. **`build_validation`** (paralelo): Validación sintaxis y dependencias
2. **`test`** (paralelo): Pruebas unitarias con cobertura PCOV
3. **`code_quality`** (secuencial): PHPStan + PHPMD + SonarCloud
4. **`docker_build_and_push`** (solo main): Docker Hub deployment

### Configuración de CircleCI

1. **Conecta tu repositorio:**
   - Ve a [https://circleci.com/](https://circleci.com/)
   - Conecta con GitHub y selecciona tu repositorio

2. **Variables de entorno:**
   - `SONAR_TOKEN`: Token de SonarCloud
   - `DOCKER_USERNAME`: Usuario de Docker Hub
   - `DOCKER_PASSWORD`: Token/password de Docker Hub

3. **Pipeline automático:**
   - Cada push ejecuta el pipeline correspondiente
   - Los resultados están en CircleCI, SonarCloud y Docker Hub

## 🔍 Análisis de código con SonarCloud

### Configuración

1. **Crear proyecto en SonarCloud:**
   - Ve a [https://sonarcloud.io/](https://sonarcloud.io/)
   - Importa tu repositorio desde GitHub

2. **Token de acceso:**
   - En SonarCloud: "My Account" > "Security" > "Generate Tokens"
   - Agrega el token como `SONAR_TOKEN` en CircleCI

3. **Configuración automática:**
   - El archivo `sonar-project.properties` ya está configurado
   - Métricas incluidas: cobertura, bugs, vulnerabilidades, code smells

### Análisis automático

- **Trigger:** Cada push a main/release ejecuta SonarCloud
- **Reportes:** Disponibles en el dashboard de SonarCloud
- **Integración:** Resultados visibles en GitHub como checks

## 📦 Docker Hub

### Subida automática

En cada push a `main`, CircleCI automáticamente:

1. **Construye** imagen Docker optimizada
2. **Etiqueta** con SHA del commit + `latest`
3. **Sube** a Docker Hub tu-usuario/cicd-ia

### Uso en producción

```sh
# Descargar y ejecutar desde Docker Hub
docker run -p 80:80 tu-usuario/cicd-ia:latest

# Con docker-compose en producción
version: '3.8'
services:
  app:
    image: tu-usuario/cicd-ia:latest
    ports:
      - "80:80"
    restart: unless-stopped
```

## 📊 Estado del proyecto

[![CircleCI](https://circleci.com/gh/tu-usuario/cicd-ia.svg?style=shield)](https://circleci.com/gh/tu-usuario/cicd-ia)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=tu-usuario_cicd-ia&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=tu-usuario_cicd-ia)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=tu-usuario_cicd-ia&metric=coverage)](https://sonarcloud.io/summary/new_code?id=tu-usuario_cicd-ia)
[![Docker](https://img.shields.io/docker/pulls/tu-usuario/cicd-ia)](https://hub.docker.com/r/tu-usuario/cicd-ia)

## 🏗️ Información técnica

### Arquitectura de la aplicación

- **Clase principal:** `App\App` en `src/App.php`
  - `greet($name)`: Retorna saludo personalizado
  - `add($firstNumber, $secondNumber)`: Suma dos números
  - `subtract($firstNumber, $secondNumber)`: Resta dos números

- **Tests:** `Tests\AppTest` en `tests/AppTest.php`
  - 100% de cobertura de código
  - Tests para todas las funciones públicas

- **Autoload:** PSR-4 configurado en `composer.json`
  - `App\` → `src/`
  - `Tests\` → `tests/`

### Containerización

- **Base:** PHP 8.2 con Apache
- **Optimizaciones:** Multi-stage build, cache de capas
- **Seguridad:** Permisos correctos, usuario www-data
- **Monitoreo:** Healthcheck incluido
- **Tamaño:** Imagen optimizada ~200MB

### Versionado

Este proyecto usa **Semantic Versioning** (SemVer):
- **v1.0.0** - Versión mayor (breaking changes)
- **v1.1.0** - Versión menor (nuevas funcionalidades)
- **v1.0.1** - Patch (correcciones de bugs)

## 🛠️ Comandos útiles

### Desarrollo local
```sh
# PHP nativo
php -S localhost:8000                    # Levantar servidor web
composer test                           # Ejecutar pruebas
vendor/bin/phpstan analyse src/          # Análisis estático
vendor/bin/phpmd src/ text cleancode,... # Análisis de calidad

# Docker
docker-compose up --build               # Levantar con Docker
docker-compose exec app composer test   # Pruebas en container
docker-compose logs -f                  # Ver logs
docker-compose down                     # Parar servicios
```

### GitFlow
```sh
git flow feature start nueva-feature    # Nueva funcionalidad
git flow feature finish nueva-feature   # Finalizar funcionalidad
git flow release start v1.0.0          # Nuevo release
git flow release finish v1.0.0         # Finalizar release
git flow hotfix start v1.0.1           # Hotfix urgente
git flow hotfix finish v1.0.1          # Finalizar hotfix
```

### Docker
```sh
docker build -t cicd-ia .              # Construir imagen
docker run -p 8080:80 cicd-ia          # Ejecutar container
docker push tu-usuario/cicd-ia:latest  # Subir a Docker Hub
docker system prune -a                 # Limpiar sistema
```

### Mantenimiento
```sh
composer dump-autoload                  # Regenerar autoloader
composer update                        # Actualizar dependencias
docker pull tu-usuario/cicd-ia:latest  # Actualizar imagen
```

## ✨ Características del proyecto

- ✅ **100% cobertura** de pruebas unitarias
- ✅ **Código limpio** - pasa todos los análisis de calidad
- ✅ **GitFlow** completo con ramas organizadas
- ✅ **Pipeline diferenciado** por tipo de rama
- ✅ **Containerización** con Docker optimizado
- ✅ **CI/CD automático** con CircleCI
- ✅ **Análisis continuo** con SonarCloud  
- ✅ **Deploy automático** a Docker Hub
- ✅ **Versionado semántico** con tags automáticos
- ✅ **Documentación completa** y actualizada
- ✅ **Badges de estado** en tiempo real
- ✅ **Desarrollo colaborativo** ready

## 🎯 Flujo completo End-to-End

1. **Desarrollador** → Feature branch con GitFlow
2. **Push** → Pipeline automático en CircleCI
3. **Merge develop** → Análisis continuo
4. **Release** → Validación completa
5. **Main** → Docker build + push automático
6. **Producción** → `docker run` desde Docker Hub

hola
---
