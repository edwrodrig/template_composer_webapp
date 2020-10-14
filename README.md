tpl_company_tpl\tpl_project_tpl
========
Una asombrosa aplicación web

[![Latest Stable Version](https://poser.pugx.org/tpl_company_tpl/tpl_project_tpl/v/stable)](https://packagist.org/packages/tpl_company_tpl/tpl_project_tpl)
[![Total Downloads](https://poser.pugx.org/tpl_company_tpl/tpl_project_tpl/downloads)](https://packagist.org/packages/tpl_company_tpl/tpl_project_tpl)
[![License](https://poser.pugx.org/tpl_company_tpl/tpl_project_tpl/license)](https://github.com/tpl_company_tpl/tpl_project_tpl/blob/master/LICENSE)
[![Build Status](https://travis-ci.org/tpl_company_tpl/tpl_project_tpl.svg?branch=master)](https://travis-ci.org/tpl_company_tpl/tpl_project_tpl)
[![codecov.io Code Coverage](https://codecov.io/gh/tpl_company_tpl/tpl_project_tpl/branch/master/graph/badge.svg)](https://codecov.io/github/tpl_company_tpl/tpl_project_tpl?branch=master)
[![Code Climate](https://codeclimate.com/github/tpl_company_tpl/tpl_project_tpl/badges/gpa.svg)](https://codeclimate.com/github/tpl_company_tpl/tpl_project_tpl)
![Hecho en Chile](https://img.shields.io/badge/country-Chile-red)


## Información de mi máquina de desarrollo
Salida de [system_info.sh](https://github.com/tpl_company_tpl/tpl_project_tpl/blob/master/scripts/system_info.sh)
```
+ hostnamectl
+ grep -e 'Operating System:' -e Kernel:
  Operating System: Ubuntu 20.04 LTS
            Kernel: Linux 5.4.0-33-generic
+ php --version
PHP 7.4.3 (cli) (built: May 26 2020 12:24:22) ( NTS )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
    with Zend OPcache v7.4.3, Copyright (c), by Zend Technologies
    with Xdebug v2.9.2, Copyright (c) 2002-2020, by Derick Rethans
```

## Ejemplo de configuración
```php
$default_data = [
    'error' => [
        'dir' => __DIR__ . '/../../var/log'
    ],
    'db' => [
        'type' => 'sqlite',
        'name' => __DIR__ . '/../../var/db.sqlite',
        'schema' => __DIR__ . '/../ddl_tables.sql',
        /*
        'user_www' => 'www-data'

        'type' => 'mysql',
        'db' => 'tpl_company_tpl_tpl_project_tpl',
        'user' => 'tpl_company_tpl_tpl_project_tpl_app_user',
        'password' => 'password'
        */
    ]
];
```

## Conectarse a DB como root en ubuntu
```
sudo mysql --defaults-file=/etc/mysql/debian.cnf
```

## Notas
  - El código se apega a las recomendaciones de estilo de [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md).
  - Este proyecto esta pensado para ser trabajado usando [PhpStorm](https://www.jetbrains.com/phpstorm).
  - Se usa [PHPUnit](https://phpunit.de/) para las pruebas unitarias de código.
  - Para la documentación se utiliza el estilo de [phpDocumentor](http://docs.phpdoc.org/references/phpdoc/basic-syntax.html). 
