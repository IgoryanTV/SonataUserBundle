<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\UserBundle\Security\RolesBuilder;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @author Silas Joisten <silasjoisten@hotmail.de>
 */
final class MatrixRolesBuilder implements MatrixRolesBuilderInterface
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private AdminRolesBuilderInterface $adminRolesBuilder,
        private ExpandableRolesBuilderInterface $securityRolesBuilder,
    ) {
    }

    public function getRoles(?string $domain = null): array
    {
        if (null === $this->tokenStorage->getToken()) {
            return [];
        }

        return array_merge(
            $this->securityRolesBuilder->getRoles($domain),
            $this->adminRolesBuilder->getRoles($domain)
        );
    }

    public function getExpandedRoles(?string $domain = null): array
    {
        if (null === $this->tokenStorage->getToken()) {
            return [];
        }

        return array_merge(
            $this->securityRolesBuilder->getExpandedRoles($domain),
            $this->adminRolesBuilder->getRoles($domain)
        );
    }

    public function getPermissionLabels(): array
    {
        return $this->adminRolesBuilder->getPermissionLabels();
    }
}
