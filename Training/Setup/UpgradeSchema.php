<?php
namespace Vnext\Training\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;

        $installer->startSetup();

        if(version_compare($context->getVersion(), '1.0.1', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable( 'students' ),

//                 'update_at',
//                [
//                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
//                    'nullable' => true,
//                    'comment' => 'update_at',
//                ],
//                'slug',
//                [
//                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
//                    'nullable' => false,
//                    'comment' => 'update_at',
//                ],
                'email',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable' => false,
                    'comment' => 'update_at',
                ]
            );
        }



        $installer->endSetup();
    }
}

