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
use Slim\App;

\OpenTelemetry\Instrumentation\hook(Slim\App::Class, 'addRoutingMiddleware',
static function (Slim\App $class, array $params, string|null $classname, string $functionname, ?string $filename, ?int $lineno) use ($tracer, $logger) {
    $tracer->spanBuilder($functionname)
        ->startSpan()
        ->activate();
    $logger->info('prehook Slim\App::addRoutingMiddleware');
},
static function (Slim\App $class, array $params, $returnValue, ?Throwable $exception) use ($logger) {
    $scope = Context::storage()->scope();
    $scope?->detach();
    $span = Span::fromContext($scope->context());
    $exception && $span->recordException($exception);
    $span->setStatus($exception ? StatusCode::STATUS_ERROR : StatusCode::STATUS_OK);
    $span->end();
    $logger->info('posthook Slim\App::addRoutingMiddleware');
}
);

\OpenTelemetry\Instrumentation\hook(Slim\App::Class, 'addBodyParsingMiddleware',
static function (Slim\App $class, array $params, string|null $classname, string $functionname, ?string $filename, ?int $lineno) use ($tracer, $logger) {
    $tracer->spanBuilder($functionname)
        ->startSpan()
        ->activate();
    $logger->info('prehook Slim\App::addBodyParsingMiddleware');
},
static function (Slim\App $class, array $params, $returnValue, ?Throwable $exception) use ($logger) {
    $scope = Context::storage()->scope();
    $scope?->detach();
    $span = Span::fromContext($scope->context());
    $exception && $span->recordException($exception);
    $span->setStatus($exception ? StatusCode::STATUS_ERROR : StatusCode::STATUS_OK);
    $span->end();
    $logger->info('posthook Slim\App::addBodyParsingMiddleware');
}
);

\OpenTelemetry\Instrumentation\hook(Slim\App::Class, 'handle',
static function (Slim\App $class, array $params, string|null $classname, string $functionname, ?string $filename, ?int $lineno) use ($tracer, $logger) {
    $tracer->spanBuilder($functionname)
        ->startSpan()
        ->activate();
    $logger->info('prehook Slim\App::handle');
},
static function (Slim\App $class, array $params, $returnValue, ?Throwable $exception) use ($logger) {
    $scope = Context::storage()->scope();
    $scope?->detach();
    $span = Span::fromContext($scope->context());
    $exception && $span->recordException($exception);
    $span->setStatus($exception ? StatusCode::STATUS_ERROR : StatusCode::STATUS_OK);
    $span->end();
    $logger->info('posthook Slim\App::handle');
}
);

\OpenTelemetry\Instrumentation\hook(Slim\Routing\RouteCollectorProxy::Class, 'get',
static function (Slim\Routing\RouteCollectorProxy $class, array $params, string|null $classname, string $functionname, ?string $filename, ?int $lineno) use ($tracer, $logger) {
    //$parent = TraceContextPropagator::getInstance()->extract($request->getHeaders());
    $pattern = $params[0];
    $callable = $params[1];
    $tracer->spanBuilder($functionname)
    //    ->setParent($parent)
        ->startSpan()
        ->activate();
    $logger->info('prehook Slim\Routing\RouteCollectorProxy::get');
},
static function (Slim\Routing\RouteCollectorProxy $class, array $params, $returnValue, ?Throwable $exception) use ($logger) {
    $scope = Context::storage()->scope();
    $scope?->detach();
    $span = Span::fromContext($scope->context());
    $exception && $span->recordException($exception);
    $span->setStatus($exception ? StatusCode::STATUS_ERROR : StatusCode::STATUS_OK);
    $span->end();
    $logger->info('posthook Slim\Routing\RouteCollectorProxy::get');
}
);

\OpenTelemetry\Instrumentation\hook(Slim\Routing\RouteCollectorProxy::Class, 'options',
static function (Slim\Routing\RouteCollectorProxy $class, array $params, string|null $classname, string $functionname, ?string $filename, ?int $lineno) use ($tracer, $logger) {
    //$parent = TraceContextPropagator::getInstance()->extract($request->getHeaders());
    $tracer->spanBuilder($functionname)
    //    ->setParent($parent)
        ->startSpan()
        ->activate();
    $logger->info('prehook Slim\Routing\RouteCollectorProxy::options');
},
static function (Slim\Routing\RouteCollectorProxy $class, array $params, $returnValue, ?Throwable $exception) use ($logger) {
    $scope = Context::storage()->scope();
    $scope?->detach();
    $span = Span::fromContext($scope->context());
    $exception && $span->recordException($exception);
    $span->setStatus($exception ? StatusCode::STATUS_ERROR : StatusCode::STATUS_OK);
    $span->end();
    $logger->info('posthook Slim\Routing\RouteCollectorProxy::options');
}
);

\OpenTelemetry\Instrumentation\hook(Slim\Routing\RouteCollectorProxy::Class, 'group',
static function (Slim\Routing\RouteCollectorProxy $class, array $params, string|null $classname, string $functionname, ?string $filename, ?int $lineno) use ($tracer, $logger) {
    //$parent = TraceContextPropagator::getInstance()->extract($request->getHeaders());
    $tracer->spanBuilder($functionname)
    //    ->setParent($parent)
        ->startSpan()
        ->activate();
    $logger->info('prehook Slim\Routing\RouteCollectorProxy::group');
},
static function (Slim\Routing\RouteCollectorProxy $class, array $params, $returnValue, ?Throwable $exception) use ($logger) {
    $scope = Context::storage()->scope();
    $scope?->detach();
    $span = Span::fromContext($scope->context());
    $exception && $span->recordException($exception);
    $span->setStatus($exception ? StatusCode::STATUS_ERROR : StatusCode::STATUS_OK);
    $span->end();
    $logger->info('posthook Slim\Routing\RouteCollectorProxy::group');
}
);

\OpenTelemetry\Instrumentation\hook(Slim\Routing\RouteCollectorProxy::Class, 'post',
static function (Slim\Routing\RouteCollectorProxy $class, array $params, string|null $classname, string $functionname, ?string $filename, ?int $lineno) use ($tracer, $logger) {
    //$parent = TraceContextPropagator::getInstance()->extract($request->getHeaders());
    $tracer->spanBuilder($functionname)
    //    ->setParent($parent)
        ->startSpan()
        ->activate();
    $logger->info('prehook Slim\Routing\RouteCollectorProxy::post');
},
static function (Slim\Routing\RouteCollectorProxy $class, array $params, $returnValue, ?Throwable $exception) use ($logger) {
    $scope = Context::storage()->scope();
    $scope?->detach();
    $span = Span::fromContext($scope->context());
    $exception && $span->recordException($exception);
    $span->setStatus($exception ? StatusCode::STATUS_ERROR : StatusCode::STATUS_OK);
    $span->end();
    $logger->info('posthook Slim\Routing\RouteCollectorProxy::post');
}
);

\OpenTelemetry\Instrumentation\hook(Slim\MiddlewareDispatcher::Class, 'add',
static function (Slim\MiddlewareDispatcher $class, array $params, string|null $classname, string $functionname, ?string $filename, ?int $lineno) use ($tracer, $logger) {
    //$parent = TraceContextPropagator::getInstance()->extract($request->getHeaders());
    $tracer->spanBuilder($functionname)
    //    ->setParent($parent)
        ->startSpan()
        ->activate();
    $logger->info('prehook Slim\MiddlewareDispatcher::add');
},
static function (Slim\MiddlewareDispatcher $class, array $params, $returnValue, ?Throwable $exception) use ($logger) {
    $scope = Context::storage()->scope();
    $scope?->detach();
    $span = Span::fromContext($scope->context());
    $exception && $span->recordException($exception);
    $span->setStatus($exception ? StatusCode::STATUS_ERROR : StatusCode::STATUS_OK);
    $span->end();
    $logger->info('posthook Slim\MiddlewareDispatcher::add');
}
);

\OpenTelemetry\Instrumentation\hook(Slim\MiddlewareDispatcher::Class, 'addMiddleware',
static function (Slim\MiddlewareDispatcher $class, array $params, string|null $classname, string $functionname, ?string $filename, ?int $lineno) use ($tracer, $logger) {
    //$parent = TraceContextPropagator::getInstance()->extract($request->getHeaders());
    $tracer->spanBuilder($functionname)
    //    ->setParent($parent)
        ->startSpan()
        ->activate();
    $logger->info('prehook Slim\MiddlewareDispatcher::addMiddleware');
},
static function (Slim\MiddlewareDispatcher $class, array $params, $returnValue, ?Throwable $exception) use ($logger) {
    $scope = Context::storage()->scope();
    $scope?->detach();
    $span = Span::fromContext($scope->context());
    $exception && $span->recordException($exception);
    $span->setStatus($exception ? StatusCode::STATUS_ERROR : StatusCode::STATUS_OK);
    $span->end();
    $logger->info('posthook Slim\MiddlewareDispatcher::addMiddleware');
}
);

?>