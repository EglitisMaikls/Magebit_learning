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
use Magebit\Faq\Api\Data\QuestionSearchResultsInterfaceFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * Question repository construct
     *
     * @param CollectionProcessorInterface $collectionProcessor
     * @param QuestionResource $resource
     * @param QuestionInterfaceFactory $questionFactory
     * @param QuestionCollectionFactory $questionCollectionFactory
     * @param QuestionSearchResultsInterfaceFactory $questionSearchResultsInterfaceFactory
     */
    public function __construct(
        private readonly CollectionProcessorInterface $collectionProcessor,
        private readonly QuestionResource $resource,
        private readonly QuestionInterfaceFactory $questionFactory,
        private readonly QuestionCollectionFactory $questionCollectionFactory,
        private readonly QuestionSearchResultsInterfaceFactory $questionSearchResultsInterfaceFactory
    ) {
    }

    /**
     * Gets item by its ID
     *
     * @param mixed $questionId
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function getById(mixed $questionId): QuestionInterface
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $questionId);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('Question with id "%1" does not exist.', $questionId));
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
    public function save(QuestionInterface $question): void
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
    public function delete($question): void
    {
        $this->resource->delete($question);
    }

    /**
     * Method for massDelete (or more effective delete)
     *
     * @param mixed $questionId
     * @return void
     * @throws NoSuchEntityException
     * @throws Exception
     */
    public function deleteById(mixed $questionId): void
    {
        $question = $this->getById($questionId);
        if ($question) {
            $this->resource->delete($question);
        } else {
            throw new NoSuchEntityException(__('Question with id "%1" does not exist.', $questionId));
        }
    }

    /**
     * Load Page data collection by given search criteria
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuestionSearchResultsInterface
    {
        $collection = $this->questionCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->questionSearchResultsInterfaceFactory->create();
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setSearchCriteria($searchCriteria);
        return $searchResults;
    }
}
