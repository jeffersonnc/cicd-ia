# CICD-IA

Aplicación PHP de ejemplo con pruebas unitarias, cobertura de código y análisis de calidad, lista para integración continua con CircleCI y análisis de código con SonarCloud.

## Estructura del proyecto

```
CICD-IA
├── src
│   └── App.php          # Clase principal de la aplicación (namespace App)
├── tests
│   └── AppTest.php      # Pruebas unitarias para la clase App (namespace Tests)
├── composer.json        # Dependencias del proyecto con autoload PSR-4
├── phpunit.xml          # Configuración de PHPUnit
├── index.php            # Punto de entrada web
├── README.md            # Documentación del proyecto
├── sonar-project.properties  # Configuración de SonarCloud
└── .circleci
    └── config.yml       # Configuración de CircleCI con GitFlow
```

## Instalación

### Requisitos previos

- PHP 7.4 o superior
- Composer (gestor de dependencias de PHP)
- Git y Git Flow

### Instalar PHP, Composer y Git Flow en macOS

#### Usando Homebrew (recomendado)


# Instalar PHP
brew install php

# Instalar Composer
brew install composer

# Instalar Git Flow
brew install git-flow
```
### Verificar instalación

```sh
# Verificar PHP
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

# Instalar dependencias
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

## Ejecutar la aplicación en local

### Levantar el servidor web

1. **Inicia el servidor de desarrollo de PHP:**
   ```sh
   php -S localhost:8000
   ```

2. **Abre tu navegador y visita:**
   - **Página principal:** [http://localhost:8000](http://localhost:8000)
   - **Con parámetros personalizados:** [http://localhost:8000/?name=Jeff&a=5&b=3](http://localhost:8000/?name=Jeff&a=5&b=3)

3. **Parámetros disponibles:**
   - `name`: Nombre para el saludo (ej: `name=Maria`)
   - `a`: Primer número para operaciones matemáticas
   - `b`: Segundo número para operaciones matemáticas

### Ejemplo de uso

Cuando visites el servidor web con parámetros:

```
http://localhost:8000/?name=Maria&a=10&b=5
```

Verás la salida:
- **Saludo:** Hello, Maria!
- **Suma (10 + 5):** 15
- **Resta (10 - 5):** 5

### Gestión del servidor

- **Parar el servidor:** Presiona `Ctrl + C` en la terminal
- **Cambios en vivo:** El servidor detecta automáticamente los cambios, solo refresca el navegador
- **Logs:** El servidor muestra logs de peticiones en la terminal

## Desarrollo con GitFlow

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

## Pruebas unitarias

Ejecuta las pruebas con:
```sh
composer test
```
o directamente:
```sh
vendor/bin/phpunit
```

## Cobertura de código local

Genera el reporte de cobertura con:
```sh
vendor/bin/phpunit --coverage-html coverage
```
Abre `coverage/index.html` en tu navegador para ver el reporte.

También puedes generar cobertura en formato XML para SonarCloud:
```sh
vendor/bin/phpunit --coverage-clover=coverage.xml
```

> **Nota:** Asegúrate de tener instalado y habilitado Xdebug para la cobertura de código.

## Análisis de código local

### Herramientas incluidas en el proyecto

Las siguientes herramientas ya están configuradas en `composer.json` y puedes ejecutarlas localmente:

#### Análisis estático (PHPStan)
```sh
# Analizar código estáticamente
vendor/bin/phpstan analyse src/
```

#### Análisis de calidad y complejidad (PHPMD)
```sh
# Detectar code smells y problemas de diseño
vendor/bin/phpmd src/ text cleancode,codesize,controversial,design,naming,unusedcode
```

### Ejecutar todos los análisis localmente

```sh
# Ejecutar en secuencia (como en CI)
composer test
vendor/bin/phpstan analyse src/
vendor/bin/phpmd src/ text cleancode,codesize,controversial,design,naming,unusedcode
```

## Integración continua (CI/CD) con CircleCI

Una vez que has probado todo localmente, tu código se analiza automáticamente en cada push.

El proyecto incluye un archivo de configuración para CircleCI en `.circleci/config.yml` que ejecuta automáticamente:
- ✅ Validación de dependencias y sintaxis
- ✅ Pruebas unitarias con PHPUnit y cobertura de código  
- ✅ Análisis estático con PHPStan
- ✅ Análisis de calidad con PHPMD
- ✅ Integración con SonarCloud para análisis de código

### Pipeline automático con GitFlow

**El pipeline se ejecuta de manera diferente según la rama:**

#### Development Pipeline (develop y feature/*)
- Análisis básico de calidad
- Pruebas unitarias
- Feedback rápido para desarrollo

#### Production Pipeline (main)
- Análisis completo con SonarCloud
- Validación exhaustiva
- Reporte a herramientas de calidad

#### Release Pipeline (release/*)
- Validación completa antes del release
- Análisis de calidad y seguridad
- Preparación para producción

#### Hotfix Pipeline (hotfix/*)
- Validación rápida pero completa
- Análisis de impacto
- Deploy rápido a producción

### Configuración de CircleCI

1. **Conecta tu repositorio:**
   - Ve a [https://circleci.com/](https://circleci.com/) e inicia sesión con GitHub
   - Selecciona tu repositorio y haz clic en "Set Up Project"

2. **Variables de entorno:**
   - En la configuración del proyecto en CircleCI, agrega:
     - `SONAR_TOKEN`: Token de acceso a SonarCloud

3. **Pipeline automático:**
   - Cada push ejecutará automáticamente todos los análisis según la rama
   - Los resultados estarán disponibles en CircleCI y SonarCloud
   - Si algún análisis falla, el pipeline se detiene

## Análisis de código con SonarCloud

### Configuración de SonarCloud

1. **Crear proyecto:**
   - Ve a [https://sonarcloud.io/](https://sonarcloud.io/) e inicia sesión con GitHub
   - Importa tu repositorio desde GitHub

2. **Token de acceso:**
   - En SonarCloud, ve a "My Account" > "Security" > "Generate Tokens"
   - Copia el token y agrégalo como variable de entorno en CircleCI

3. **Archivo de configuración:**
   Crea `sonar-project.properties` en la raíz del proyecto:
   ```properties
   sonar.projectKey=tu-usuario_cicd-ia
   sonar.organization=tu-organizacion
   sonar.sources=src
   sonar.tests=tests
   sonar.php.coverage.reportPaths=coverage.xml
   sonar.php.tests.reportPath=test-results/phpunit.xml
   ```

### Análisis automático

- **En cada push a main/release:** CircleCI ejecuta SonarCloud automáticamente
- **Reportes disponibles en:** [https://sonarcloud.io/projects](https://sonarcloud.io/projects)
- **Métricas incluidas:**
  - Cobertura de código
  - Bugs y vulnerabilidades
  - Code smells y deuda técnica
  - Duplicación de código
  - Mantenibilidad y fiabilidad

## Estado del proyecto

[![CircleCI](https://circleci.com/gh/tu-usuario/cicd-ia.svg?style=shield)](https://circleci.com/gh/tu-usuario/cicd-ia)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=tu-usuario_cicd-ia&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=tu-usuario_cicd-ia)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=tu-usuario_cicd-ia&metric=coverage)](https://sonarcloud.io/summary/new_code?id=tu-usuario_cicd-ia)

## Información técnica

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

### Versionado

Este proyecto usa **Semantic Versioning** (SemVer):
- **v1.0.0** - Versión mayor (breaking changes)
- **v1.1.0** - Versión menor (nuevas funcionalidades)
- **v1.0.1** - Patch (correcciones de bugs)

## Comandos útiles

```sh
# Desarrollo local
php -S localhost:8000                    # Levantar servidor web
composer test                           # Ejecutar pruebas
vendor/bin/phpstan analyse src/          # Análisis estático
vendor/bin/phpmd src/ text cleancode,... # Análisis de calidad

# GitFlow
git flow feature start nueva-feature    # Nueva funcionalidad
git flow feature finish nueva-feature   # Finalizar funcionalidad
git flow release start v1.0.0          # Nuevo release
git flow release finish v1.0.0         # Finalizar release
git flow hotfix start v1.0.1           # Hotfix urgente
git flow hotfix finish v1.0.1          # Finalizar hotfix

# Mantenimiento
composer dump-autoload                  # Regenerar autoloader
composer update                        # Actualizar dependencias
php --version                          # Verificar PHP
composer --version                     # Verificar Composer
git flow version                       # Verificar Git Flow
```

## Notas

- El proyecto tiene 100% de cobertura de pruebas unitarias
- Todos los análisis de código pasan satisfactoriamente
- **GitFlow** organiza el desarrollo con ramas específicas para cada propósito
- **Pipeline diferenciado** según el tipo de rama (develop/feature/release/hotfix/main)
- La integración con CircleCI y SonarCloud proporciona feedback automático en cada cambio
- Namespaces PSR-4 correctamente configurados
- **Versionado semántico** con tags automáticos (v1.0.0, v1.1.0, etc.)
- Aplicación lista para desarrollo profesional y colaborativo
- Los badges de estado se actualizan automáticamente

