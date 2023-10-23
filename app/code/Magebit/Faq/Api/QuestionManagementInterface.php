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

interface QuestionManagementInterface
{
    /**
     * Enable a question by ID.
     *
     * @param int $questionId
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function enableQuestion($questionId);

    /**
     * Disable a question by ID.
     *
     * @param int $questionId
     * @return void
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function disableQuestion($questionId);
}
