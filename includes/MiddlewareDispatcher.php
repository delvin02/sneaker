<?php
class MiddlewareDispatcher {
    private $middlewares = [];

    public function addMiddleware($middleware) {
        $this->middlewares[] = $middleware;
    }

    public function handle() {
        $next = function () {
        };

        foreach (array_reverse($this->middlewares) as $middleware) {
            $next = function () use ($middleware, $next) {
                return $middleware->handle($next);
            };
        }

        // Start handling the request by invoking the middleware stack
        $next();
    }
}
?>