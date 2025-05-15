<?php

declare(strict_types=1);

use App\TwigExtension\TwigExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $parameters = $containerConfigurator->parameters();

    $services->defaults()
        ->autowire()
        ->autoconfigure();
        //->bind('$storagePath', '%kernel.project_dir%/public/storage/');

    $services->load('App\\', __DIR__ . '/../src/')
        ->exclude([
        __DIR__ . '/../src/DependencyInjection/',
        __DIR__ . '/../src/Entity/',
        __DIR__ . '/../src/Kernel.php',
    ]);

     $services->set(TwigExtension::class)->tag('twig.extension');
};
