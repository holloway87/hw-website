<?php declare(strict_types=1);

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * App kernel.
 *
 * @since 2021.12.07
 */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
