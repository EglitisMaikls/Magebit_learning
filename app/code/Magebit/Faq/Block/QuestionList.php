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

use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magento\Framework\View\Element\Template;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Api\SortOrderBuilder;

class QuestionList extends Template
{
    /**
     * Constructor for list
     *
     * @param Context $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        private readonly QuestionRepositoryInterface $questionRepository,
        private readonly SearchCriteriaBuilder $searchCriteriaBuilder,
        private readonly SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get questions matching the criteria
     *
     * @return QuestionSearchResultsInterface
     */
    public function getFaqQuestions(): QuestionSearchResultsInterface
    {
        $sortOrder = $this->sortOrderBuilder->setAscendingDirection()->setField('position')->create();
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(QuestionInterface::STATUS, 1)
            ->addSortOrder($sortOrder)
            ->create();
        return $this->questionRepository->getList($searchCriteria);
    }
}
