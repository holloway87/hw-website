<?php declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint to check for a valid photo project name.
 * @since 2022.03.11
 */
#[\Attribute]
class ValidPhotoProject extends Constraint
{
    /**
     * Error message.
     */
    public string $message = 'This project does not exist.';

    /**
     * @inheritDoc
     *
     * @param mixed|null $options
     * @param array|null $groups
     * @param mixed|null $payload
     * @param string|null $message
     */
    public function __construct(
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null,
        ?string $message = null
    ) {
        parent::__construct($options, $groups, $payload);

        if ($message) {
            $this->message = $message;
        }
    }
}
