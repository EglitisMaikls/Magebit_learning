<?php

namespace Magebit\PageListWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

/**
 * Class PageList
 * @package Vendor\Module\Block\Widget
 */
class PageList extends Template implements BlockInterface
{
    protected $_template = "page-list.phtml";

    protected $pageRepository;
    protected $searchCriteriaBuilder;

    public function __construct(
        Template\Context $context,
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Get the display mode value.
     *
     * @return int 1 for "All Pages", 0 for "Specific Pages"
     */
    public function getDisplayMode()
    {
        return $this->getData('display_mode');
    }

    /**
     * Get the selected page IDs.
     *
     * @return array
     */
    public function getSelectedPageIds()
    {
        return explode(',', $this->getData('selected_pages'));
    }

    /**
     * Get a CMS page by ID.
     *
     * @param int $pageId
     * @return \Magento\Cms\Api\Data\PageInterface
     */
    public function getCmsPageById($pageId)
    {
        return $this->pageRepository->getById($pageId);
    }

    /**
     * Get a list of all CMS pages.
     *
     * @return array
     */
    public function getCmsPages()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $pages = $this->pageRepository->getList($searchCriteria);
        return $pages->getItems();
    }
}
