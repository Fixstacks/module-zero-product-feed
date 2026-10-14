<?php
/**
 * Copyright © 2026 Roman Pasichnyk
 * SPDX-License-Identifier: OSL-3.0 OR AFL-3.0
 */

declare(strict_types=1);

namespace Zero\ProductFeed\Controller\Prom;

use Zero\ProductFeed\Controller\AbstractFeed;

/**
 * {store URL}/productfeed/prom
 */
class Index extends AbstractFeed
{
    protected const CODE = 'prom';
}
