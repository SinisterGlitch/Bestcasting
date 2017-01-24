<?php

namespace UserBundle\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;

/**
 * Class UserAuthenticator
 * @package UserBundle\Security
 */
class UserAuthenticator implements SimplePreAuthenticatorInterface
{
    /**
     * @param Request $request
     * @param $providerKey
     * @return PreAuthenticatedToken
     */
    public function createToken(Request $request, $providerKey)
    {
        $token = $request->headers->get('authorization');
        if (!$token) {
            $token = $request->query->get('authorization');
        }

        if (!$token) {
            throw new UnauthorizedHttpException('Token not found');
        }

        return new PreAuthenticatedToken('anon.', $token, $providerKey);
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return AuthenticationException
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return $exception;
    }

    /**
     * @param TokenInterface $token
     * @param UserProviderInterface $userProvider
     * @param $providerKey
     * @return PreAuthenticatedToken
     */
    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        try {
            $token = $token->getCredentials();
            $username = $userProvider->getUsernameByToken($token);

            if (!$username) {
                throw new UsernameNotFoundException('authorization header does not exist');
            }

            $user = $userProvider->loadUserByUsername($username);
        } catch (\Exception $e) {
            throw new UnauthorizedHttpException('Token not found');
        }

        return new PreAuthenticatedToken(
            $user,
            $token,
            $providerKey,
            $user->getRoles()
        );
    }

    /**
     * @param TokenInterface $token
     * @param $providerKey
     * @return bool
     */
    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token->getProviderKey() === $providerKey;
    }
}