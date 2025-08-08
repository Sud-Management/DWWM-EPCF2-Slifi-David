<?php

namespace App\Security\Voter;

use App\Entity\Evenement;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class EvenementVoter extends Voter
{
    public const CREATE = 'EVENEMENT_CREATE';
    public const EDIT   = 'EVENEMENT_EDIT';
    public const DELETE = 'EVENEMENT_DELETE';

    protected function supports(string $attribute, $subject): bool
    {
        if ($attribute === self::CREATE) {
            return true;
        }

        return in_array($attribute, [self::EDIT, self::DELETE], true)
            && $subject instanceof Evenement;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false; 
        }


        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return true;
        }

        
        if (in_array('ROLE_USER', $user->getRoles(), true) && !in_array('ROLE_ORGA', $user->getRoles(), true)) {
            return false;
        }

        return match ($attribute) {
            self::CREATE => in_array('ROLE_ORGA', $user->getRoles(), true),
            self::EDIT, self::DELETE => 
                in_array('ROLE_ORGA', $user->getRoles(), true) 
                && $subject instanceof Evenement
                && $subject->getOrganisateur() 
                && $subject->getOrganisateur()->getId() === $user->getId(),
            default => false,
        };
    }
}
