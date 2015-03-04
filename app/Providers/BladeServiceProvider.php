<?php

namespace Tinyissue\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        \Blade::extend(function ($view, $compiler) {
            $pattern = '/@macro\s*\(\s*[\'"](.*)[\'"]\s*,\s*(.*)\)/';

            return preg_replace($pattern, "<?php \$___tiny['\$1']=function(\$2){ ob_start(); ?>\n", $view);
        });

        \Blade::extend(function ($view, $compiler) {
            $pattern = $compiler->createPlainMatcher('endmacro');

            return preg_replace($pattern, "\n<?php return ob_get_clean();} ?>\n", $view);
        });

        \Blade::extend(function ($view, $compiler) {
            $pattern = '/\s*@usemacro\s*\(\s*[\'"](\w+|\d+)[\'"]\s*,\s*(.*)\)/';

            return preg_replace($pattern, "<?php echo \$___tiny['\$1'](\$2); ?>\n", $view);
        });

    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     */
    public function register()
    {

    }
}
