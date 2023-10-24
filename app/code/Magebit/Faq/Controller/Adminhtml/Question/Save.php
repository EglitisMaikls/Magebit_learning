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
use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\ResultFactory;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * Constructor for save function
     *
     * @param Context $context
     * @param QuestionFactory $questionFactory
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        private readonly QuestionFactory $questionFactory,
        private readonly QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $data = $this->getRequest()->getPostValue();
        $id = $this->getRequest()->getParam('id');
        if (empty($data['id'])) {
            $data['id'] = null;
        }
        if ($data) {
            try {
                if ($id) {
                    $question = $this->questionRepository->getById($id);
                } else {
                    $question = $this->questionFactory->create();
                }
                $question->setData($data);
                $this->questionRepository->save($question);
                $this->messageManager->addSuccessMessage(__('Question has been saved.'));

                if ($this->getRequest()->getParam('back', false) === 'save') {
                    // Redirect to the listing page if 'save_and_close' is true
                    $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                    return $resultRedirect->setPath('*/*/');
                }
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e);
            } catch (\Throwable $e) {
                $this->messageManager->addErrorMessage(__('An error occurred while saving the question.'));
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/new', ['id' => null]);
    }
}
