<?php
/**
 * Copyright © 2026 Roman Pasichnyk
 * SPDX-License-Identifier: OSL-3.0 OR AFL-3.0
 */

declare(strict_types=1);

namespace Zero\ProductFeed\Model;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use Zero\ProductFeed\Model\Format\FormatInterface;

/**
 * The current store view's feed in one format, when that feed is on
 * (Stores > Configuration > Zero > Product Feeds). Built at most once an
 * hour per store view and format, and again when products or categories
 * change (the cache entry carries their tags).
 */
class Feed
{
    private const LIFETIME = 3600;

    /**
     * @param array<string, FormatInterface> $formats By code: rozetka, prom, hotline (etc/di.xml)
     */
    public function __construct(
        private readonly Catalog $catalog,
        private readonly StoreManagerInterface $storeManager,
        private readonly ScopeConfigInterface $scopeConfig,
        private readonly CacheInterface $cache,
        private readonly array $formats = []
    ) {
    }

    /**
     * The feed's XML, or null when it is off (or unknown) in this store view.
     */
    public function get(string $code): ?string
    {
        /** @var Store $store */
        $store = $this->storeManager->getStore();
        $storeId = (int) $store->getId();
        if (!isset($this->formats[$code]) || !$this->isEnabled($code, $storeId)) {
            return null;
        }
        $key = 'zero_product_feed_' . $code . '_' . $storeId;
        $xml = $this->cache->load($key);
        if ($xml !== false) {
            return (string) $xml;
        }
        $xml = $this->formats[$code]->render($this->catalog->build($store), [
            'firm_id' => (string) $this->scopeConfig->getValue(
                'zero_product_feed/hotline/firm_id',
                ScopeInterface::SCOPE_STORE,
                $storeId
            ),
        ]);
        $this->cache->save($xml, $key, [Product::CACHE_TAG, Category::CACHE_TAG], self::LIFETIME);

        return $xml;
    }

    public function isEnabled(string $code, int $storeId): bool
    {
        return $this->scopeConfig->isSetFlag(
            'zero_product_feed/' . $code . '/enabled',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
