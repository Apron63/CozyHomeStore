<?php

declare (strict_types=1);

namespace App\Security;

use App\Entity\Manager;
use App\Entity\User;
use App\Repository\ManagerRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;

class SecurityService
{
    private const string MANAGER_SIGNATURE = '@medfarmu.ru';

    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly ManagerRepository $managerRepository,
        private readonly Security $security,
    ) {}

    public function userLogon(string $login, string $password): ?string
    {
        $authError = null;
        $loadedPassword = null;

        if (str_contains($login, self::MANAGER_SIGNATURE)) {
            $user = $this->managerRepository->findOneBy(['login' => $login]);

            if ($user instanceof Manager) {
                $loadedPassword = $user->getPswd();
            }
        }
        else {
            $user = $this->userRepository->findOneBy(['login' => $login]);

            if (
                ! $user instanceof User
                || $user->isDeleted()
                || $user->isVirtual()
            ) {
               return 'Данный пользователь неактивирован';
            }

            $result = $this->security->login($user, UserAuthenticator::class, 'main');
        }

        return $authError;
    }

    public function userLogout(): void
    {
        $response = $this->security->logout();
        $qq  = 1;
    }
}
