<?php declare(strict_types=1);

namespace App\Security;

use OTPHP\TOTP;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\PreAuthenticatedUserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

/**
 * Admin authenticator for login.
 *
 * @since 2024.02.27
 */
class AdminAuthenticator extends AbstractAuthenticator
{
    /**
     * Set all needed parameters.
     *
     * @param AdminProvider $user_loader
     * @param string $totp_secret
     */
    public function __construct(private readonly AdminProvider $user_loader, private readonly string $totp_secret) {}

    /**
     */
    #[\Override]
    public function authenticate(Request $request): Passport
    {
        $data = json_decode($request->getContent(), true);
        if (!is_array($data)) {
            throw new BadRequestHttpException('invalid json data');
        }

        if (!array_key_exists('code', $data)) {
            throw new BadRequestHttpException('no code provided in json data');
        }

        $user_badge = new UserBadge('', $this->user_loader->loadUserByIdentifier(...));

        return new Passport($user_badge, new CustomCredentials([$this, 'checkCredentials'], $data['code']),
            [new PreAuthenticatedUserBadge()]);
    }

    /**
     * Check if the credentials are valid.
     *
     * @param string $code
     * @return bool
     */
    public function checkCredentials(string $code): bool
    {
        if (!$this->totp_secret) {
            throw new BadRequestHttpException('no secret set for TOTP');
        }
        $otp = TOTP::createFromSecret($this->totp_secret);

        return $otp->verify($code, null, 10);
    }

    /**
     */
    #[\Override]
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'message' => 'the provided code is not valid'
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     */
    #[\Override]
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    /**
     */
    #[\Override]
    public function supports(Request $request): bool
    {
        return str_contains($request->getContentTypeFormat() ?? '', 'json')
            && $request->isMethod('post')
            && 'admin_login' === $request->attributes->get('_route');
    }
}
