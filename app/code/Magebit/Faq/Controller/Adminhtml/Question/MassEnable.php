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
use Magento\Framework\Controller\ResultFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;

class MassEnable extends Action
{
    /**
     * MassDelete constructor.
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
     * Execute action
     *
     * @return ResultFactory
     */
    public function execute(): ResultFactory
    {
        $questionIds = $this->getRequest()->getParam('selected');

        if (!is_array($questionIds)) {
            $this->messageManager->addErrorMessage(__('Please select item(s) to delete.'));
        } else {
            try {
                foreach ($questionIds as $questionId) {
                    $question = $this->questionRepository->getById((int) $questionId);
                    $question->setStatus(1);
                    $this->questionRepository->save($question);
                }
                $this->messageManager->addSuccessMessage(__('Selected item(s) have been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('An error occurred while deleting selected item(s).'));
            }
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }
}
