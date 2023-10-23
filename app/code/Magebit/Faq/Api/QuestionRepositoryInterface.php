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
use Magento\Framework\DataObject;

interface QuestionRepositoryInterface
{
    /**
     * Retrieve a question by its ID.
     *
     * @param int $questionId
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($questionId);

    /**
     * Save a question.
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(QuestionInterface $question);

    /**
     * Delete a question.
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(QuestionInterface $question);

    /**
     * Delete a question by its ID.
     *
     * @param int $questionId
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById($questionId);

    /**
     * Get a list of questions matching given search criteria.
     *
     * @param array $options
     *     - filterField: string
     *     - filterCondition: mixed
     *     - orderField: string
     *     - orderSort: string (ASC or DESC)
     * @return DataObject []
     */
    public function getList(array $options): array;
}
