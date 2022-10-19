# OpenTelemetry auto-instrumentation extension

[![Build and test](https://github.com/open-telemetry/opentelemetry-php-instrumentation/actions/workflows/build.yml/badge.svg)](https://github.com/open-telemetry/opentelemetry-php-instrumentation/actions/workflows/build.yml)

This is an _experimental_ extension for OpenTelemetry, to enable auto-instrumentation.
It is based on [zend_observer](https://www.datadoghq.com/blog/engineering/php-8-observability-baked-right-in/) and requires php8+

The extension allows creating `pre` and `post` hook functions to arbitrary PHP functions and methods, which allows those methods to be wrapped with telemetry. 

## Requirements
- PHP 8+
- [OpenTelemetry PHP library](https://github.com/open-telemetry/opentelemetry-php)

## Installation

https://github.com/mlocati/docker-php-extension-installer :
```bash
$ install-php-extensions open-telemetry/opentelemetry-php-instrumentation@main
```

## Installation from source

```
git clone https://github.com/pdelewski/opentelemetry-php-instrumentation.git
cd opentelemetry-php-instrumentation
make 
make install
```

Add to php.ini

```
extension=otel_instrumentation.so
```

There are more examples in the [tests directory](./tests/)

## Usage

In order to instrument application hooks have to be loaded into application, therefore additional 
require statement is needed

```
require __DIR__ . '[path to opentelemetry-php-instrumentation]/hooks/hooks.php';
```

## Contributing
See [DEVELOPMENT.md](DEVELOPMENT.md) and https://github.com/open-telemetry/opentelemetry-php/blob/main/CONTRIBUTING.md
