<?php declare(strict_types=1);

namespace App\Controller;

use App\Security\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

/**
 * Admin controller.
 *
 * @since 2024.02.27
 */
class AdminController extends AbstractController
{
    /**
     * Admin login api point.
     *
     * @param Admin|null $user
     * @return JsonResponse
     */
    #[Route('/admin-login', name: 'admin_login', methods: ['POST'])]
    public function login(#[CurrentUser] ?Admin $user): JsonResponse
    {
        if (!$user) {
            return $this->json([
                'message' => 'missing credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'success' => true
        ]);
    }
}
