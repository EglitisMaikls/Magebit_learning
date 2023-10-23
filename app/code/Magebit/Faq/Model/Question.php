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

/**
 * Model for frequently asked questions.
 */
class Question extends AbstractModel implements QuestionInterface
{
    /**
     * Question resource construct
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(QuestionResource::class);
    }

    /**
     * Get entry ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->_getData(self::QUESTION);
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->_getData(self::ANSWER);
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->_getData(self::STATUS);
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->_getData(self::POSITION);
    }

    /**
     * Return update info string
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->_getData(self::UPDATED_AT);
    }

    /**
     * Set a question
     *
     * @param string $question
     * @return Question
     */
    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * Set an answer
     *
     * @param string $answer
     * @return Question
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Set status for an entry
     *
     * @param string $status
     * @return Question
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set a position
     *
     * @param int $position
     * @return Question
     */
    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }
}
