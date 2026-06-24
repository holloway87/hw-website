<?php declare(strict_types=1);

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Button link twig component.
 *
 * @since 2026.06.24
 */
#[AsTwigComponent]
class ButtonLink
{
    /**
     * URL where the button leads to.
     */
    public string $url;

    /**
     * Variant key for styles.
     *
     * Possible values: primary, error
     */
    public string $variant = 'primary';

    /**
     * Calculate the css classes from the variant property.
     */
    public function getClasses(): string
    {
        $classes = 'inline-block border-b-4 hover:border-t-1 hover:border-b-3 active:border-t-1 active:border-b-3 text-text rounded-md text-center px-3 py-1.5 cursor-pointer';

        switch ($this->variant) {
            case 'error':
                $classes .= ' bg-error border-b-error-shadow hover:border-t-error active:border-t-error';
                break;
            default:
                $classes .= ' bg-primary border-b-primary-shadow hover:border-t-primary active:border-t-primary';
        }

        return $classes;
    }
}
