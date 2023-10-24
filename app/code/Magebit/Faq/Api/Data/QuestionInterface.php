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
    public const ID = 'id';
    public const QUESTION = 'question';
    public const ANSWER = 'answer';
    public const STATUS = 'status';
    public const POSITION = 'position';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get the ID.
     *
     * @return mixed
     */
    public function getId(): mixed;

    /**
     * Get the question.
     *
     * @return string
     */
    public function getQuestion(): string;

    /**
     * Get the answer.
     *
     * @return string
     */
    public function getAnswer(): string;

    /**
     * Get the status.
     *
     * @return int
     */
    public function getStatus(): int;

    /**
     * Get the position.
     *
     * @return int
     */
    public function getPosition(): int;

    /**
     * Get the updated_at timestamp.
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set question.
     *
     * @param string $question
     * @return $this
     */
    public function setQuestion(string $question): self;

    /**
     * Set answer.
     *
     * @param string $answer
     * @return $this
     */
    public function setAnswer(string $answer): self;

    /**
     * Set status.
     *
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status): self;

    /**
     * Set position.
     *
     * @param int $position
     * @return $this
     */
    public function setPosition(int $position): self;
}
