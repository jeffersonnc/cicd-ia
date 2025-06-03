# CICD-IA

Aplicación PHP de ejemplo con pruebas unitarias, cobertura de código y análisis de calidad, lista para integración continua con CircleCI y análisis de código con SonarCloud.

## Estructura del proyecto

```
CICD-IA
├── src
│   └── App.php          # Clase principal de la aplicación
├── tests
│   └── AppTest.php      # Pruebas unitarias para la clase App
├── composer.json        # Dependencias del proyecto
├── phpunit.xml          # Configuración de PHPUnit
├── README.md            # Documentación del proyecto
├── sonar-project.properties  # Configuración de SonarCloud
└── .circleci
    └── config.yml       # Configuración de CircleCI
```

## Instalación

1. Instala PHP y Composer en tu máquina.
2. Instala las dependencias del proyecto:
   ```sh
   composer install
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

## Cobertura de código

Genera el reporte de cobertura con:
```sh
vendor/bin/phpunit --coverage-html coverage
```
Abre `coverage/index.html` en tu navegador para ver el reporte.

> **Nota:** Asegúrate de tener instalado y habilitado Xdebug o PCOV para la cobertura de código.

## Análisis de código

### Estilo de código (PHP_CodeSniffer)
```sh
composer require --dev squizlabs/php_codesniffer
vendor/bin/phpcs src/ > resultado_phpcs.txt
```

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

### Análisis de seguridad (Psalm)
```sh
composer require --dev vimeo/psalm
vendor/bin/psalm --init
vendor/bin/psalm --taint-analysis > resultado_psalm.txt
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

## Notas

- El proyecto actualmente tiene 100% de cobertura de pruebas unitarias
- Todos los análisis de código pasan satisfactoriamente
- La integración con CircleCI y SonarCloud proporciona feedback automático en cada cambio
- Puedes agregar más funciones y pruebas siguiendo la misma estructura
- Los badges de estado se actualizan automáticamente

### Comandos útiles

```sh
# Ejecutar todos los análisis localmente
composer test
vendor/bin/phpstan analyse src/
vendor/bin/phpmd src/ text cleancode,codesize,controversial,design,naming,unusedcode

# Regenerar autoloader
composer dump-autoload

# Actualizar dependencias
composer update
```

---

Este proyecto es solo para fines educativos y de demostración de buenas prácticas en CI/CD con PHP.