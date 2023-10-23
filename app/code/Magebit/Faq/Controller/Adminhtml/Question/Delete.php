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

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Controller\Result\Redirect;

class Delete extends Action
{

    /**
     * Delete constructor
     *
     * @param Context $context
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        private readonly QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            try {
                $question = $this->questionRepository->getById($id);
                $this->questionRepository->delete($question);
                $this->messageManager->addSuccessMessage(__('Question has been deleted.'));

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('An error occurred while deleting the question.'));
            }
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }
}
