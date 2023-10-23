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

namespace Magebit\Faq\Api\Data;

interface QuestionInterface
{
    const ID = 'id';
    const QUESTION = 'question';
    const ANSWER = 'answer';
    const STATUS = 'status';
    const POSITION = 'position';
    const UPDATED_AT = 'updated_at';

    /**
     * Get the ID.
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get the question.
     *
     * @return string
     */
    public function getQuestion();

    /**
     * Get the answer.
     *
     * @return string
     */
    public function getAnswer();

    /**
     * Get the status.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Get the position.
     *
     * @return int
     */
    public function getPosition();

    /**
     * Get the updated_at timestamp.
     *
     * @return string
     */
    public function getUpdatedAt();

    /**
     * Set ID.
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set question.
     *
     * @param string $question
     * @return $this
     */
    public function setQuestion($question);

    /**
     * Set answer.
     *
     * @param string $answer
     * @return $this
     */
    public function setAnswer($answer);

    /**
     * Set status.
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Set position.
     *
     * @param int $position
     * @return $this
     */
    public function setPosition($position);
}
