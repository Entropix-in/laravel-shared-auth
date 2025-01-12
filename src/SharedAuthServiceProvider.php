<?php 
namespace EntropixIn\LaravelSharedAuth;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Support\ServiceProvider;

class SharedAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot()
    {
        // Publish the configuration file
        $this->publishes([
            __DIR__ . '/../config/shared-auth.php' => config_path('shared-auth.php'),
        ], 'shared-auth-config');

        // Publish migrations
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        // Publish the User model
        $this->publishes([
            __DIR__ . '/Models/User.php' => app_path('Models/User.php'),
        ], 'shared-auth-model');

        // Dynamically add the mysql_users connection to database.connections
        $this->addSharedDatabaseConnection();

        // Delete the users table when in local environment.
        Event::listen(CommandFinished::class, function (CommandFinished $event) {
            if ($event->command === 'db:wipe' && $event->exitCode === 0) {
                $this->handleDatabaseWiped();
            }
        });
    }
    

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/shared-auth.php', 'shared-auth');
    }

    /**
     * Dynamically add the shared database connection.
     */
    protected function addSharedDatabaseConnection()
    {
        $sharedConnections = config('shared-auth.connections');
        if (is_array($sharedConnections)) {
            foreach ($sharedConnections as $name => $connection) {
                config(["database.connections.$name" => $connection]);
            }
        }
    }

     /**
     * Handle logic after the database is wiped.
     */
    protected function handleDatabaseWiped()
    {
        // Avoid dropping shared tables in production
        if (env('APP_ENV') === 'production') {
            return;
        }

        $connection = 'mysql_users'; // Replace with your shared database connection name
        $sharedTables = ['users', 'password_reset_tokens', 'sessions'];

        foreach ($sharedTables as $table) {
            if (Schema::connection($connection)->hasTable($table)) {
                Schema::connection($connection)->drop($table);
                logger("Dropped shared table: {$table} on connection: {$connection}");
            }
        }
    }
}
