import { Config, RouteParam, RouteParamsWithQueryOverload, Router } from 'ziggy-js';

declare global {
    function route(): Router;
    function route(
        name: string,
        params?: RouteParamsWithQueryOverload | RouteParam,
        absolute?: boolean,
        config?: Config,
    ): string;
}

declare module 'vue' {
    interface ComponentCustomProperties {
        route: ((
            name: string,
            params?: RouteParamsWithQueryOverload | RouteParam,
            absolute?: boolean,
            config?: Config,
        ) => string) & (() => Router);
    }
}
