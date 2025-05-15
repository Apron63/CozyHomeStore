<?php

declare (strict_types=1);

namespace App\Controller\Security;

use App\Entity\User;
use App\Security\SecurityService;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Translation\TranslatorInterface;

final class SecurityController extends AbstractController
{
    public function __construct(
        private readonly SecurityService $securityService,
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly TranslatorInterface $translator,
    ) {}

    #[Route('/login/', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): RedirectResponse
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        if (null !== $error) {
            return new RedirectResponse(
                $this->urlGenerator->generate('app_homepage', [
                    'auth_error' => $error ? $this->translator->trans($error->getMessage(), domain: 'security') : null,
                ]
            ));
        }

        $userRole = current($this->getUser()?->getRoles());

        switch ($userRole) {
            case User::ROLE_USER:
            case User::ROLE_BRAND:
                return new RedirectResponse($this->urlGenerator->generate('cabinet_homepage'));
            case User::ROLE_MULTI:
                return new RedirectResponse($this->urlGenerator->generate('cabinet_homepage'));
        }

        return new RedirectResponse($this->urlGenerator->generate('app_homepage'));
    }

    #[Route('/logout/', name: 'app_logout')]
    public function logout(): RedirectResponse
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
