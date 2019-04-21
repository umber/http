<?php

declare(strict_types=1);

namespace Umber\Http\Framework\Symfony;

use Umber\Http\Framework\Symfony\DependencyInjection\UmberHttpExtension;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * {@inheritdoc}
 */
final class UmberHttpBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension(): ExtensionInterface
    {
        return new UmberHttpExtension();
    }
}
