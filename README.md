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
    └── config.yml       # Configuración de CircleCI
```

## Instalación

### Requisitos previos

- PHP 7.4 o superior
- Composer (gestor de dependencias de PHP)

### Instalar PHP y Composer en macOS

#### Opción 1: Usando Homebrew (recomendado)

```sh

# Instalar PHP
brew install php

# Instalar Composer
brew install composer
```

### Verificar instalación

```sh
# Verificar PHP
php --version

# Verificar Composer
composer --version
```

### Instalar dependencias del proyecto

Una vez que tengas PHP y Composer instalados:

```sh
# Clonar el repositorio
git clone https://github.com/tu-usuario/cicd-ia.git
cd cicd-ia

# Instalar dependencias
composer install
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

## Pruebas unitarias

Ejecuta las pruebas con:
```sh
composer test
```
o directamente:
```sh
vendor/bin/phpunit
```

## Cobertura de código

Genera el reporte de cobertura con:
```sh
vendor/bin/phpunit --coverage-html coverage
```
Abre `coverage/index.html` en tu navegador para ver el reporte.

> **Nota:** Asegúrate de tener instalado y habilitado Xdebug o PCOV para la cobertura de código.

## Análisis de código

### Análisis estático (PHPStan)
```sh
composer require --dev phpstan/phpstan
vendor/bin/phpstan analyse src/ > resultado_phpstan.txt
```

### Detección de código duplicado (PHPCPD)
```sh
composer require --dev sebastian/phpcpd
vendor/bin/phpcpd src/ > resultado_phpcpd.txt
```

### Calidad y complejidad (PHPMD)
```sh
composer require --dev phpmd/phpmd
vendor/bin/phpmd src/ text cleancode,codesize,controversial,design,naming,unusedcode > resultado_phpmd.txt
```

## Integración continua (CI/CD) con CircleCI

El proyecto incluye un archivo de configuración para CircleCI en `.circleci/config.yml` que ejecuta automáticamente:
- Validación de dependencias y sintaxis
- Pruebas unitarias con PHPUnit y cobertura de código
- Análisis estático con PHPStan
- Análisis de calidad con PHPMD
- Integración con SonarCloud para análisis de código

### Configuración de CircleCI

1. **Conecta tu repositorio:**
   - Ve a [https://circleci.com/](https://circleci.com/) e inicia sesión con GitHub
   - Selecciona tu repositorio y haz clic en "Set Up Project"

2. **Variables de entorno:**
   - En la configuración del proyecto en CircleCI, agrega:
     - `SONAR_TOKEN`: Token de acceso a SonarCloud

3. **Pipeline automático:**
   - Cada push ejecutará automáticamente todos los análisis
   - Los resultados estarán disponibles en ambas plataformas

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

- **En cada push:** CircleCI ejecuta SonarCloud automáticamente
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

## Comandos útiles

```sh
# Levantar servidor web local
php -S localhost:8000

# Ejecutar todos los análisis localmente
composer test
vendor/bin/phpstan analyse src/
vendor/bin/phpmd src/ text cleancode,codesize,controversial,design,naming,unusedcode

# Regenerar autoloader
composer dump-autoload

# Actualizar dependencias
composer update

# Verificar instalación
php --version
composer --version
```

## Notas

- El proyecto tiene 100% de cobertura de pruebas unitarias
- Todos los análisis de código pasan satisfactoriamente
- La integración con CircleCI y SonarCloud proporciona feedback automático en cada cambio
- Namespaces PSR-4 correctamente configurados
- Aplicación lista para desarrollo profesional y colaborativo
- Los badges de estado se actualizan automáticamente

---

Este proyecto es para fines educativos y de demostración de buenas prácticas en CI/CD con PHP.