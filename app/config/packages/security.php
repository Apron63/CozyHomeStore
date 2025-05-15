<?php

declare(strict_types=1);

use App\Security\AuthenticationEntryPoint;
use App\Security\UserAuthenticator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('security', [
        'password_hashers' => [
            PasswordAuthenticatedUserInterface::class => 'auto',
        ],
        'providers' => [
            'app_user_provider' => [
                'entity' => [
                    'class' => 'App\Entity\User',
                    'property' => 'login',
                ],
            ],
        ],
        'firewalls' => [
            'dev' => [
                'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
                'security' => false,
            ],
            'main' => [
                'lazy' => true,
                'provider' => 'app_user_provider',
                'custom_authenticator' => UserAuthenticator::class,
                'entry_point' => AuthenticationEntryPoint::class,
                'logout' => [
                    'path' => 'app_logout',
                ],
            ],
        ],
        'role_hierarchy' => [
            'ROLE_ADMIN' => 'ROLE_USER',
            'ROLE_SUPER_ADMIN' => [
                'ROLE_ADMIN',
                'ROLE_USER',
                'ROLE_ALLOWED_TO_SWITCH',
            ],
        ],
        'access_control' => [
            [
                'path' => '^/login/',
                'roles' => 'PUBLIC_ACCESS',
            ],
            [
                'path' => '^/cabinet/',
                'roles' => 'ROLE_USER',
            ],
            [
                'path' => '^/manager_account/',
                'roles' => 'ROLE_AUTHORIZED_USER',
            ],
            [
                'path' => '^/',
                'roles' => 'PUBLIC_ACCESS',
            ],
        ],
    ]);
    
    if ($containerConfigurator->env() === 'test') {
        $containerConfigurator->extension('security', [
            'password_hashers' => [
                PasswordAuthenticatedUserInterface::class => [
                    'algorithm' => 'auto',
                    'cost' => 4,
                    'time_cost' => 3,
                    'memory_cost' => 10,
                ],
            ],
        ]);
    }
};
