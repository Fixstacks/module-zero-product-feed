<?php
/**
 * Copyright © 2026 Roman Pasichnyk
 * SPDX-License-Identifier: OSL-3.0 OR AFL-3.0
 */

declare(strict_types=1);

namespace Zero\ProductFeed\Model\Format;

/**
 * One marketplace's feed: Model\Catalog's data as that marketplace's XML.
 */
interface FormatInterface
{
    /**
     * @param array{shop: array, categories: array, offers: array} $catalog Model\Catalog::build()
     */
    public function render(array $catalog, array $options = []): string;
}
