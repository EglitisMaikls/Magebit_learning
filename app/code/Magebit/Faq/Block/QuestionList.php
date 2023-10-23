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

namespace Magebit\Faq\Block;

use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\View\Element\Template\Context;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;

class QuestionList extends Template
{
    /**
     * Constructor for list
     *
     * @param Context $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param array $data
     */
    public function __construct(
        Context $context,
        private readonly QuestionRepositoryInterface $questionRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get questions matching the criteria
     *
     * @return array
     */
    public function getFaqQuestions()
    {
        $options = [
            'filterField' => 'status',
            'filterCondition' => 1,
            'orderField' => 'position',
            'orderSort' => 'ASC',
        ];
        return $this->questionRepository->getList($options);
    }
}
