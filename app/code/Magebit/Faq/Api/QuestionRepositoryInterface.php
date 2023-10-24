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

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface QuestionRepositoryInterface
{
    /**
     * Retrieve a question by its ID.
     *
     * @param mixed $questionId
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function getById(mixed $questionId): QuestionInterface;

    /**
     * Save a question.
     *
     * @param QuestionInterface $question
     * @return void
     * @throws LocalizedException
     */
    public function save(QuestionInterface $question): void;

    /**
     * Delete a question.
     *
     * @param QuestionInterface $question
     * @return void
     * @throws LocalizedException
     */
    public function delete(QuestionInterface $question): void;

    /**
     * Delete a question by its ID.
     *
     * @param mixed $questionId
     * @return void
     * @throws NoSuchEntityException
     */
    public function deleteById(mixed $questionId): void;

    /**
     * Get a list of questions matching given search criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuestionSearchResultsInterface;
}
