<?php

namespace Vnext\Training\Api;
use \Vnext\Training\Api\Data\StudentInterface;
interface StudentRepositoryInterface
{

      /**
     * @param int $id
     * @return \Vnext\Training\Api\Data\StudentInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Vnext\Training\Api\Data\StudentInterface $student
     * @return \Vnext\Training\Api\Data\StudentInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Vnext\Training\Api\Data\StudentInterface $student);

    /**
     * @param \Vnext\Training\Api\Data\StudentInterface $student
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Vnext\Training\Api\Data\StudentInterface $student);

     /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vnext\Training\Api\Data\StudentSearchResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
