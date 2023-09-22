<?php

declare (strict_types=1);

namespace IlliaNova\CheckoutDiscount\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Cms\Model\GetBlockByIdentifier;
use Magento\Store\Model\Store;

class AdditionalConfigVars implements ConfigProviderInterface
{
    public const CMS_BLOCK_IDENTIFIER = 'extra_basket_discount_information';

    public function __construct(
        protected GetBlockByIdentifier $blockByIdentifier
    ) {
    }

    private function getStaticCmsBlock(): string
    {
        $block = $this->blockByIdentifier->execute(self::CMS_BLOCK_IDENTIFIER, Store::DEFAULT_STORE_ID);

        return (string) $block->getContent();
    }

    public function getConfig(): array
    {
        $additionalVariables['discountInfoCmsBlock'] = $this->getStaticCmsBlock();

        return $additionalVariables;
    }
}
