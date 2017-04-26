<?php
namespace Piimega\MaksuturvaInvoice\Block\Form;
class Invoice extends \Piimega\Maksuturva\Block\Form\Maksuturva
{
    protected $_objectManager;
    protected $_paymentConfig;
    protected $_template; 
    protected $_maksuturvaModel;

	const FORMTYPE_DROPDOWN = 0;
	const FORMTYPE_ICONS = 1;
    
    public function __construct( 
    		\Magento\Framework\View\Element\Template\Context $context,
    		\Magento\Payment\Model\Config $paymentConfig,
    		\Magento\Framework\ObjectManager\ObjectManager $objectManager,
    		\Piimega\MaksuturvaInvoice\Model\Invoice $maksuturvaModel,
    		array $data = []
	)
    {
    	$this->_objectManager = $objectManager;
    	$this->method = $maksuturvaModel;
		$this->setData('method', $this->method);
		$preselect = intval($this->getMethod()->getConfigData('preselect_payment_method'));
		if ($preselect) {
			switch ($this->getFormType()) {
				case self::FORMTYPE_DROPDOWN:
					$this->setTemplate('Piimega_MaksuturvaInvoice::form_select.phtml');
					break;
				case self::FORMTYPE_ICONS:
					$this->setTemplate('Piimega_MaksuturvaInvoice::form_icons.phtml');
					break;
				default:
					throw new Exception('unknown form type');
			}
		}else{
			$this->setTemplate('Piimega_MaksuturvaInvoice::icon.phtml');
		}

        parent::__construct($context, $paymentConfig, $objectManager, $maksuturvaModel, $data);
    }
}