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

use Magebit\Faq\Api\Data\QuestionInterfaceFactory as QuestionInterface;
use Magebit\Faq\Api\QuestionManagementInterface;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class QuestionManagement implements QuestionManagementInterface
{
    /**
     * Question management constructor
     *
     * @param QuestionResource $resource
     * @param QuestionInterface $questionFactory
     */
    public function __construct(
        protected readonly QuestionResource $resource,
        protected readonly QuestionInterface $questionFactory
    ) {
    }

    /**
     * Enable question method
     *
     * @param int $questionId
     * @return void
     * @throws AlreadyExistsException
     */
    public function enableQuestion($questionId)
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $questionId);
        $question->setStatus(1);
        $this->resource->save($question);
    }

    /**
     * Disable question method
     *
     * @param int $questionId
     * @return void
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     */
    public function disableQuestion($questionId)
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $questionId);
        $question->setStatus(0);
        $this->resource->save($question);
    }
}
