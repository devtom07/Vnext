<?php
namespace Vnext\Training\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface StudentInterface extends ExtensibleDataInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const GENDER = 'gender';
    const DOB = 'dob';
    const ADDRESS = 'address';

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     * @return string
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getGender();

    /**
     * @param $name
     * @return string
     */
    public function setGender($gender);

    /**
     * @return string
     */
    public function getDob();

    /**
     * @param $name
     * @return string
     */
    public function setDob($dob);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param $name
     * @return string
     */
    public function setAddress($address);

    /**
     * @return string
     */
    // public function getExtensionAttributes();

    // /**
    //  * @param \Vnext\Training\Api\Data\StudentExtensionInterface $extensionAttributes
    //  * @return mixed
    //  */
    // public function setExtensionAttributes(StudentExtensionInterface $extensionAttributes);
}