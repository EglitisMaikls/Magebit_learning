<?php
/**
 * @copyright Copyright (c) 2023 Magebit (https://magebit.com/)
 * @author    <maikls.eglitis@magebit.com>
 * @license   GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Magebit\Faq\Model;

use Exception;
use Magebit\Faq\Api\Data\QuestionInterfaceFactory;
use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\AlreadyExistsException;

class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * Question repository construct
     *
     * @param QuestionResource $resource
     * @param QuestionInterfaceFactory $questionFactory
     * @param QuestionCollectionFactory $questionCollectionFactory
     */
    public function __construct(
        private readonly QuestionResource $resource,
        private readonly QuestionInterfaceFactory $questionFactory,
        private readonly QuestionCollectionFactory $questionCollectionFactory
    ) {
    }

    /**
     * Gets item by its ID
     *
     * @param int $questionId
     * @return false|QuestionInterface
     */
    public function getById($questionId)
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $questionId);
        if (!$question->getId()) {
            return false;
        }
        return $question;
    }

    /**
     * Save method
     *
     * @param QuestionInterface $question
     * @return void
     * @throws AlreadyExistsException
     */
    public function save(QuestionInterface $question)
    {
        $this->resource->save($question);
    }

    /**
     * Delete method
     *
     * @param QuestionInterface $question
     * @return void
     * @throws Exception
     */
    public function delete(QuestionInterface $question)
    {
        $this->resource->delete($question);
    }

    /**
     * Method for massDelete
     *
     * @param int $questionId
     * @return void
     * @throws Exception
     */
    public function deleteById($questionId)
    {
        $question = $this->getById($questionId);
        if ($question) {
            $this->delete($question);
        }
    }

    /**
     * To list the questions on frontend
     *
     * @param array $options
     *    - filterField: string
     *    - filterCondition: int (number)
     *    - orderField: string
     *    - orderSort: string (ASC or DESC)
     * @return DataObject []
     */
    public function getList(array $options): array
    {
        $collection = $this->questionCollectionFactory->create();
        $collection->addFieldToFilter($options['filterField'], $options['filterCondition']);
        $collection->addOrder($options['orderField'], $options['orderSort']);
        return $collection->getItems();
    }
}
