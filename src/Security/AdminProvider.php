<?php declare(strict_types=1);

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * User provider for admin.
 *
 * @since 2024.02.28
 */
class AdminProvider implements UserProviderInterface
{
    /**
     */
    #[\Override]
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return new Admin();
    }

    /**
     */
    #[\Override]
    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    /**
     */
    #[\Override]
    public function supportsClass(string $class): bool
    {
        return Admin::class === $class || is_subclass_of($class, Admin::class);
    }
}
