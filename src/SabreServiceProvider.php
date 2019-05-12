<?php
    namespace Tanvir\Sabre;
    use Illuminate\Support\ServiceProvider;
    class SabreServiceProvider extends ServiceProvider {
        public function boot()
        {
            $this->publishes([
                __DIR__.'/config/sabre.php' => config_path('sabre.php')
            ], 'config');

            $this->publishes([
                __DIR__.'/Soap/wsdls' => public_path('sabre/wsdls'),
            ], 'public');
        }
        public function register()
        {
        }
    }
?>