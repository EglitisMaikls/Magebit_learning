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

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel implements QuestionInterface
{
    /**
     * @inheritdoc
     */
    protected function _construct(): void
    {
        $this->_init(QuestionResource::class);
    }

    /**
     * @inheritdoc
     */
    public function getId(): mixed
    {
        return $this->_getData(self::ID);
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion(): string
    {
        return (string) $this->_getData(self::QUESTION);
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer(): string
    {
        return (string) $this->_getData(self::ANSWER);
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus(): int
    {
        return (int) $this->_getData(self::STATUS);
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition(): int
    {
        return (int) $this->_getData(self::POSITION);
    }

    /**
     * Return update info string
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->_getData(self::UPDATED_AT);
    }

    /**
     * Set a question
     *
     * @param string $question
     * @return Question
     */
    public function setQuestion(string $question): QuestionInterface
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * Set an answer
     *
     * @param string $answer
     * @return Question
     */
    public function setAnswer(string $answer): QuestionInterface
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Set status for an entry
     *
     * @param int $status
     * @return Question
     */
    public function setStatus(int $status): QuestionInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set a position
     *
     * @param int $position
     * @return Question
     */
    public function setPosition(int $position): QuestionInterface
    {
        return $this->setData(self::POSITION, $position);
    }
}
