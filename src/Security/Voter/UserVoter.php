<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    public const UPDATE = 'USER_UPDATE';
    public const VIEW = 'POST_VIEW';

    protected function supports(string $attribute, $userSubject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::UPDATE ])
            && $userSubject instanceof \App\Entity\User;
    }

    protected function voteOnAttribute(string $attribute, $userSubject, TokenInterface $token): bool
    {
        $connectedUser = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$connectedUser instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::UPDATE:
                if ($userSubject->getRole() === 'ROLE_ADMIN' || $userSubject->getRole() === 'ROLE_MANAGER')
                {
                    // et que l'utilisateur connecté a le role Manager
                    if (in_array('ROLE_MANAGER', $connectedUser->getRoles()))
                    {
                        // alors on limite l'accès
                        return false;
                    }
                }
                return true;
                break;
            case self::VIEW:
                // logic to determine if the user can VIEW
                // return true or false
                break;
        }
  
        return false;
    }
}
