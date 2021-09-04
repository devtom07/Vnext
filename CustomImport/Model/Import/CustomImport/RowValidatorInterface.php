<?php
namespace Vnext\CustomImport\Model\Import\CustomImport;

interface RowValidatorInterface extends \Magento\Framework\Validator\ValidatorInterface
{
    const ERROR_INVALID_TITLE= 'InvalidValueTITLE';
    const ERROR_MESSAGE_IS_EMPTY = 'EmptyMessage';
    const ERROR_TITLE_IS_EMPTY = 'EmptyMessageTitle';
    /**
     * Initialize validator
     *
     * @return $this
     */
    public function init($context);
}