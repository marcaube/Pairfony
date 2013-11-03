<?php

namespace Ob\PairfonyBundle\Security;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider;

class UserProvider extends FOSUBUserProvider
{
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getNickname();
        $user = $this->userManager->findUserByUsername($username);

        if (null === $user) {
            $user = $this->userManager->findUserByEmail($response->getEmail());
        }

        if (null === $user) {
            $user = $this->userManager->createUser();
            $user->setUsername($username)
                ->setEmail($response->getEmail() ? : "")
                ->setEnabled(true)
                ->setPassword('')
                ->setGithubId($response->getUsername());

            $this->userManager->updateUser($user);

            return $user;
        }

        $this->connect($user, $response);

        return $user;
    }
}