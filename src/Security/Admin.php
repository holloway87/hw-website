<?php declare(strict_types=1);

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Admin user data.
 *
 * @since 2024.02.27
 */
class Admin implements UserInterface
{
    /**
     * User roles.
     * @var list<string>
     */
    private array $roles = [];

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void {}

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return 'Admin';
    }

    /**
     * @param list<string> $roles
     * @return self
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
