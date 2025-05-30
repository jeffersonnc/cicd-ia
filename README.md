# CICD-IA

Aplicación PHP de ejemplo con pruebas unitarias, cobertura de código y análisis de calidad, lista para integración continua con CircleCI.

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
- Instalación de dependencias
- Pruebas unitarias con PHPUnit
- Análisis estático con PHPStan
- Análisis de calidad con PHPMD

Para activar la integración:
1. Sube tu repositorio a GitHub.
2. Conecta tu repositorio a CircleCI desde [https://circleci.com/](https://circleci.com/).
3. CircleCI ejecutará los análisis y pruebas en cada push automáticamente.

## Notas

- El proyecto actualmente tiene 100% de cobertura de pruebas unitarias.
- Puedes agregar más funciones y pruebas siguiendo la misma estructura.
- Si quieres automatizar estos análisis, puedes agregarlos como scripts en tu `composer.json`.

---

Este proyecto es solo para fines educativos y de demostración.