<?php

declare(strict_types=1);

namespace IlliaNova\CheckoutDiscount\Setup\Patch\Data;

use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use IlliaNova\CheckoutDiscount\Model\AdditionalConfigVars;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Store\Model\Store;

class CreateBasketDiscountBlock implements DataPatchInterface, PatchRevertableInterface
{
    public function __construct(
        private ModuleDataSetupInterface $moduleDataSetup,
        private BlockFactory $blockFactory
    ) {
    }

    /**
     * @inheritDoc
     */
    public function apply(): static
    {
        $this->moduleDataSetup->startSetup();

        $this->blockFactory->create()
            ->setTitle('Extra Basket Discount Information')
            ->setIdentifier(AdditionalConfigVars::CMS_BLOCK_IDENTIFIER)
            ->setIsActive(true)
            ->setStores([Store::DEFAULT_STORE_ID])
            ->save();

        $this->moduleDataSetup->endSetup();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function revert(): void
    {
        $basketDiscountCmsBlock = $this->blockFactory
            ->create()
            ->load(AdditionalConfigVars::CMS_BLOCK_IDENTIFIER, 'identifier');

        if ($basketDiscountCmsBlock->getId()) {
            $basketDiscountCmsBlock->delete();
        }
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
