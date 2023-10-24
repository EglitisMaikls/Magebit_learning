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

use Magebit\Faq\Api\QuestionManagementInterface;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magebit\Faq\Api\QuestionRepositoryInterface;

class QuestionManagement implements QuestionManagementInterface
{
    /**
     * Question management constructor
     *
     * @param QuestionRepositoryInterface $repository
     * @param QuestionResource $resource
     */
    public function __construct(
        protected readonly QuestionRepositoryInterface $repository,
        protected readonly QuestionResource $resource
    ) {
    }

    /**
     * Enable question method
     *
     * @param int $questionId
     * @return void
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function enableQuestion(int $questionId): void
    {
        $question = $this->repository->getById($questionId);
        $question->setStatus(1);
        $this->repository->save($question);
    }

    /**
     * Disable question method
     *
     * @param int $questionId
     * @return void
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function disableQuestion(int $questionId): void
    {
        $question = $this->repository->getById($questionId);
        $question->setStatus(0);
        $this->repository->save($question);
    }
}
