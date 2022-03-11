<?php declare(strict_types=1);

namespace App\Validator;

use App\Component\PhotosComponent;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Validator for a project name.
 *
 * @since 2022.03.11
 */
class ValidPhotoProjectValidator extends ConstraintValidator
{
    /**
     * Set all needed services.
     *
     * @param PhotosComponent $photos_component
     */
    public function __construct(private PhotosComponent $photos_component) {}

    /**
     * @inheritDoc
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!($constraint instanceof ValidPhotoProject)) {
            throw new UnexpectedTypeException($constraint, ValidPhotoProject::class);
        }

        if (!$value) {
            return;
        }

        if (!$this->photos_component->isValidProject($value)) {
            $this->context->addViolation($constraint->message);
        }
    }
}
