<?php

namespace App\Security\Voter;

use App\Entity\Evenement;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class EvenementVoter extends Voter
{
    public const EDIT = 'EVENEMENT_EDIT';
    public const DELETE = 'EVENEMENT_DELETE';

    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, [self::EDIT, self::DELETE])
            && $subject instanceof Evenement;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Evenement $evenement */
        $evenement = $subject;

        
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return true;
        }

        
        return match ($attribute) {
            self::EDIT, self::DELETE => $evenement->getOrganisateur() === $user,
            default => false,
        };
    }
}
