<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        /** var User $user */
        if (!$user instanceof User) {
            return;
        }

        if ($user->isEnabled() != 1) {
            throw new CustomUserMessageAuthenticationException(
                'Ce compte n\'a pas encore été validé par les Administrateurs. Veuillez patienter jusqu\'à validation.'
            );
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        $this->checkPreAuth($user);
    }
}