<?php declare(strict_types=1);

namespace App\Entity;

/**
 * Abstract media data.
 *
 * @since 2024.03.12
 */
abstract class AbstractMedia
{
    /**
     * Entry name.
     */
    private string $name;

    /**
     * Return the entry name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the entry name.
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
