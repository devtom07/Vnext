<?php

namespace Vnext\Training\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable('students');
        if ($setup->getConnection()->isTableExists($tableName) == true) {
            $data = [
                [
                    'name' => 'Manh',
                    'gender' => 'nam',
                    'dob' => '2000-6-7',
                    'address' => 'hoang ha - hoang hoa - thanh hoa',
                    'created_at' => date('Y-m-d H:i:s')

                ],
                [
                    'name' => 'Hoanh',
                    'gender' => 'nam',
                    'dob' => '2000-6-19',
                    'address' => 'hoang son - hoang hoa - thanh hoa',
                    'created_at' => date('Y-m-d H:i:s')

                ],
                [
                    'name' => 'Tien',
                    'gender' => 'nam',
                    'dob' => '19-9-2000',
                    'address' => 'hoang son - hoang hoa - hai duong',
                    'created_at' => date('Y-m-d H:i:s')

                ],
                [
                    'name' => 'Huyền',
                    'gender' => 'nu',
                    'dob' => '2000-3-18',
                    'address' => 'hoang son - hoang hoa - thai binh',
                    'created_at' => date('Y-m-d H:i:s')

                ],
                [
                    'name' => 'Tùng',
                    'gender' => 'nam',
                    'dob' => '1998-6-17',
                    'address' => 'hoang Đại - hoang hoa - thanh hoa',
                    'created_at' => date('Y-m-d H:i:s')

                ],
                [
                    'name' => 'Hai',
                    'gender' => 'nam',
                    'dob' => '2000-6-19',
                    'address' => 'hoang son - hoang hoa - thanh hoa',
                    'created_at' => date('Y-m-d H:i:s')


                ],
                [
                    'name' => 'Huế',
                    'gender' => 'nữ',
                    'dob' => '2002-9-2',
                    'address' => 'Thị trấn Phong Sơn - Cẩm Thủy - thanh hoa',
                    'created_at' => date('Y-m-d H:i:s')

                ],
                [
                    'name' => 'Long',
                    'gender' => 'nam',
                    'dob' => '2000-1-19',
                    'address' => 'hoang son - hoang hoa - thanh hoa',
                    'created_at' => date('Y-m-d H:i:s')

                ],
                [
                    'name' => 'Giang',
                    'gender' => 'nam',
                    'dob' => '2000-10-18',
                    'address' => 'hoang son - hoang hoa - thanh hoa',
                    'created_at' => date('Y-m-d H:i:s')

                ],
                [
                    'name' => 'Toàn',
                    'gender' => 'nam',
                    'dob' => '1990-8-19',
                    'address' => 'hoang son - hoang hoa - thanh hoa',
                    'created_at' => date('Y-m-d H:i:s')

                ],
                [
                    'name' => 'Hoàng',
                    'gender' => 'nam',
                    'dob' => '2000-6-9',
                    'address' => 'hoang son - hoang hoa - thanh hoa',
                    'created_at' => date('Y-m-d H:i:s')

                ],
                [
                    'name' => 'Sinh',
                    'gender' => 'nam',
                    'dob' => '2000-8-19',
                    'address' => 'hoang son - hoang hoa - thanh hoa',
                    'created_at' => date('Y-m-d H:i:s')

                ],
                [
                    'name' => 'Liên',
                    'gender' => 'nữ',
                    'dob' => '2000-8-29',
                    'address' => 'hoang son - hoang hoa - thanh hoa',
                    'created_at' => date('Y-m-d H:i:s')
                ],
            ];
            foreach ($data as $item){
                $setup->getConnection()->insert($tableName, $item);
            }
     }
        $setup->endSetup();
    }
}