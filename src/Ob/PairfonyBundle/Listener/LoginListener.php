<?php

namespace Ob\PairfonyBundle\Listener;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\ORM\EntityManager;
use Github\Client;

class LoginListener
{
    private $securityContext;
    private $entityManager;
    private $github;

    /**
     * @param SecurityContext $securityContext
     * @param EntityManager   $entityManager
     * @param Client          $github
     */
    public function __construct(SecurityContext $securityContext, EntityManager $entityManager, Client $github)
    {
        $this->securityContext = $securityContext;
        $this->entityManager = $entityManager;
        $this->github = $github;
    }

    /**
     * Update user informations on login-in
     *
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            /** @var \Ob\PairfonyBundle\Entity\User $user */
            $user = $this->securityContext->getToken()->getUser();

            /** @var \Github\Api\User $api */
            $api = $this->github->api('user');
            $userData = $api->show($user->getUsername());

            $user->setGithubUrl($userData['html_url'])
                ->setAvatarUrl($userData['avatar_url'])
                ->setLocation($userData['location']);

            $this->entityManager->flush();
        }
    }
}