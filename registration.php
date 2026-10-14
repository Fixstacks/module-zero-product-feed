<?php
/**
 * Copyright © 2026 Roman Pasichnyk
 * SPDX-License-Identifier: OSL-3.0 OR AFL-3.0
 *
 * Zero_ProductFeed: the store's catalog as XML feeds that marketplaces,
 * price comparison sites and ad platforms fetch by URL: Rozetka and Prom.ua
 * (YML), Hotline, Google Merchant Center (which Meta catalogs read too). One
 * feed per store view, in its own language and currency, at
 * {store URL}/productfeed/{rozetka|prom|hotline|google}.
 */
use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(ComponentRegistrar::MODULE, 'Zero_ProductFeed', __DIR__);
