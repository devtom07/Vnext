<?php

namespace Vnext\Training\ViewModel\Student;

use Vnext\Training\Api\Data\StudentInterface;
use Vnext\Training\Model\StudentFactory;
use Vnext\Training\Model\StudentRepository;
use Vnext\Training\Model\ResourceModel\Student\CollectionFactory;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Student implements ArgumentInterface
{
    protected $studentFactory;
    protected $studentRepository;
    protected $studentModel;
    protected $studentCollectionFactory;
    protected $searchCriteriaBuilder;

    public function __construct(
        StudentFactory $studentFactory,
        StudentInterface $studentModel,
        StudentRepository $studentRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->studentFactory = $studentFactory;
        $this->studentModel = $studentModel;
        $this->studentRepository = $studentRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getDataStudent()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->studentRepository->getList($searchCriteria);
        $items = $searchResult->getItems();

        return $items;
    }

//    public function getTitle()
//    {
//        return 'Hello World';
//    }
}