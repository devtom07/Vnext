<?php
namespace Vnext\Training\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{
    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('students');
        if($conn->isTableExists($tableName) != true){
            $table = $conn->newTable($tableName)
                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'nullable' => false, 'primary' => true]
                ) ->addColumn(
                    'name',
                    Table::TYPE_TEXT, 255,
                    ['nullable' => true]
                ) ->addColumn(
                    'gender',
                    Table::TYPE_TEXT, 255,
                    ['nullable' => true]
                ) ->addColumn(
                    'dob',
                    Table::TYPE_DATE,
                    ['default' => '', 'nullable' => false]
                ) ->addColumn(
                    'address',
                    Table::TYPE_TEXT, 255,
                    ['nullable' => 'fales', 'default' => '']
                )
                ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
?>
