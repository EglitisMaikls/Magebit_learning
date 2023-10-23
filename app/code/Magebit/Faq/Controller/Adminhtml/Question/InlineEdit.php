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

use Magebit\Faq\Api\QuestionRepositoryInterface;
use \Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context as Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory as JsonFactory;
use Magento\Framework\Controller\ResultInterface;

class InlineEdit extends Action
{
    /**
     * Json constructor
     *
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        private readonly JsonFactory $jsonFactory,
        private readonly QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Json edit function
     *
     * @var Json $resultJson
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);

            if (!empty($postItems)) {
                foreach ($postItems as $entityId => $data) {
                    try {
                        $question = $this->questionRepository->getById($entityId);
                        $question->setData($data);
                        $this->questionRepository->save($question);
                    } catch (\Exception $e) {
                        $messages[] = "[Error:] " . $e->getMessage();
                        $error = true;
                    }
                }
            } else {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
