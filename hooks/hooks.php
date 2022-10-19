<?php

require __DIR__ . '/vendor/autoload.php';

use OpenTelemetry\SDK\Trace\TracerProviderFactory;
use OpenTelemetry\SDK\Trace\TracerProvider;
use OpenTelemetry\API\Trace\Propagation\TraceContextPropagator;
use OpenTelemetry\SDK\Trace\Tracer;
use OpenTelemetry\SDK\Common\Util\ShutdownHandler;
use OpenTelemetry\SDK\Trace\SpanExporter\ConsoleSpanExporter;
use OpenTelemetry\SDK\Trace\SpanProcessor\SimpleSpanProcessor;
use OpenTelemetry\SDK\Trace\SpanExporter\LoggerExporter;
use OpenTelemetry\Context\Context;
use OpenTelemetry\SDK\Trace\Span;
use OpenTelemetry\API\Trace\StatusCode;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('trace');
$logger->pushHandler(new StreamHandler(__DIR__.'/../logs/trace.log', Logger::DEBUG));

$tracerProvider =  new TracerProvider(
    new SimpleSpanProcessor(
	new LoggerExporter("hooker", $logger)
    )
);

ShutdownHandler::register([$tracerProvider, 'shutdown']);
$tracer = $tracerProvider->getTracer('io.opentelemetry.contrib.php');

require __DIR__ . '/hooks_slim.php'

?>
