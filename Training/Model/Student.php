<?php

namespace Vnext\Training\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Vnext\Training\Api\Data\StudentExtensionInterface;
use Vnext\Training\Api\Data\StudentInterface;

class Student extends AbstractExtensibleModel implements StudentInterface
{

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return parent::getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getGender()
    {
        return parent::getData(self::GENDER);
    }

    /**
     * @inheritDoc
     */
    public function setGender($gender)
    {
        return $this->setData(self::GENDER, $gender);
    }

    /**
     * @inheritDoc
     */
    public function getDob()
    {
        return parent::getData(self::DOB);
    }

    /**
     * @inheritDoc
     */
    public function setDob($dob)
    {
        return $this->setData(self::DOB, $dob);
    }

    /**
     * @inheritDoc
     */
    public function getAddress()
    {
        return parent::getData(self::ADDRESS);
    }

    /**
     * @inheritDoc
     */
    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    /**
     * @inheritDoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritDoc
     */
    public function setExtensionAttributes(
        StudentExtensionInterface $extensionAttributes
    )
    {
        $this->_setExtensionAttributes($extensionAttributes);
    }

    protected function _construct()
    {
        $this->_init(ResourceModel\Student::class);
    }
}