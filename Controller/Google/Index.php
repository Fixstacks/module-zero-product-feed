<?php
/**
 * Copyright © 2026 Roman Pasichnyk
 * SPDX-License-Identifier: OSL-3.0 OR AFL-3.0
 */

declare(strict_types=1);

namespace Zero\ProductFeed\Controller\Google;

use Zero\ProductFeed\Controller\AbstractFeed;

/**
 * {store URL}/productfeed/google: Google Merchant Center, Meta catalogs.
 */
class Index extends AbstractFeed
{
    protected const CODE = 'google';
}
