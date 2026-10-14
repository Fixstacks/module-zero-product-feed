<?php
/**
 * Copyright © 2026 Roman Pasichnyk
 * SPDX-License-Identifier: OSL-3.0 OR AFL-3.0
 */

declare(strict_types=1);

namespace Zero\ProductFeed\Controller;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\RawFactory;
use Zero\ProductFeed\Model\Feed;

/**
 * {store URL}/productfeed/{code}: the feed's XML, 404 when it is off.
 */
abstract class AbstractFeed implements HttpGetActionInterface
{
    protected const CODE = '';

    public function __construct(
        private readonly Feed $feed,
        private readonly RawFactory $rawFactory,
        private readonly ForwardFactory $forwardFactory
    ) {
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $xml = $this->feed->get(static::CODE);
        if ($xml === null) {
            return $this->forwardFactory->create()->forward('noroute');
        }
        $result = $this->rawFactory->create();
        $result->setHeader('Content-Type', 'application/xml; charset=UTF-8', true);
        $result->setHeader('Cache-Control', 'public, max-age=3600', true);
        $result->setHeader('X-Robots-Tag', 'noindex', true);
        $result->setContents($xml);

        return $result;
    }
}
