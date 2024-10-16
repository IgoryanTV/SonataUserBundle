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

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Sonata\UserBundle\Action\CheckLoginAction;
use Sonata\UserBundle\Action\LoginAction;
use Sonata\UserBundle\Action\LogoutAction;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->services()

        ->set('sonata.user.action.login', LoginAction::class)
            ->public()
            ->args([
                service('twig'),
                service('router'),
                service('security.authentication_utils'),
                service('sonata.admin.pool'),
                service('sonata.admin.global_template_registry'),
                service('security.token_storage'),
                service('translator'),
                service('security.csrf.token_manager')->nullOnInvalid(),
                true,
            ])

        ->set('sonata.user.action.check_login', CheckLoginAction::class)
            ->public()

        ->set('sonata.user.action.logout', LogoutAction::class)
            ->public();
};
