<?php
/**
 * @copyright Copyright (c) 2023 Magebit (https://magebit.com/)
 * @author    <info@magebit.com>
 * @license   GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
declare(strict_types=1);

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Cms\Api\Data\PageInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template\Context;

class PageList extends Template implements BlockInterface
{
    /**
     * Template file for the Page List widget block.
     *
     * @var string
     */
    protected $_template = 'page-list.phtml';

    /**
     * @param Context $context
     * @param PageRepositoryInterface $pageRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        private readonly PageRepositoryInterface $pageRepository,
        private readonly SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get the display mode value.
     *
     * @return int 1 for "All Pages", 0 for "Specific Pages"
     */
    public function getDisplayMode(): int
    {
        return (int) $this->getData('display_mode');
    }

    /**
     * Get the selected page IDs.
     *
     * @return array
     */
    public function getSelectedPageIds(): array
    {
        return explode(',', $this->getData('selected_pages'));
    }

    /**
     * Get a CMS page by ID.
     *
     * @param string $pageId
     * @return PageInterface
     * @throws LocalizedException
     */
    public function getCmsPageById(string $pageId): PageInterface
    {
        return $this->pageRepository->getById($pageId);
    }

    /**
     * Get a list of all CMS pages.
     *
     * @return array
     * @throws LocalizedException
     */
    public function getCmsPages(): array
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $pages = $this->pageRepository->getList($searchCriteria);
        return $pages->getItems();
    }
}
