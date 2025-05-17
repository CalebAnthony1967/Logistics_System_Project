public function boot(): void
{
    $this->configureRateLimiting();

    $this->routes(function () {
        Route::middleware('api')
            ->prefix('api')
            ->group(function () {
                logger()->info('Successfully loaded API routes from ' . base_path('routes/api.php'));
                require base_path('routes/api.php');
            });

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    });
}