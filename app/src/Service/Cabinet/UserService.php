<?php

declare (strict_types=1);

namespace App\Service\Cabinet;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;

class UserService
{
    public function __construct(
        private readonly Security $security,
        private readonly UserRepository $userRepository,
    ) {}

    public function getUser(): User
    {
        /** @var User $user */
        $user = $this->security->getUser();

        return $this->userRepository->find($user->getId());
    }
}
