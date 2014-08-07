<?php

class LimeSoda_MageMonitoring_Model_Widget_Sales_Check extends Hackathon_MageMonitoring_Model_Widget_Abstract
    implements Hackathon_MageMonitoring_Model_Widget
{
    /**
     * @return Mage_Sales_Model_Resource_Order_Collection
     */
    protected function _getIncorrectStateStatusCollection()
    {
        $collection = Mage::getModel('sales/order')->getCollection();
        $config = Mage::getModel('sales/order_config');

        $adapter = $collection->getSelect()->getAdapter();
        foreach (array_keys($config->getStates()) as $state) {
            $statuses = $config->getStateStatuses($state, false);
            $where = $adapter->quoteInto('state = ?', $state);
            if (!empty($statuses)) {
                $where .= $adapter->quoteInto(' AND status NOT IN (?)', $statuses);
            }
            $collection->getSelect()->orWhere($where);
        }

        return $collection;
    }

    /**
     * (non-PHPdoc)
     * @see Hackathon_MageMonitoring_Model_Widget::getName()
     */
    public function getName()
    {
        return 'Sales Check';
    }

    /**
     * (non-PHPdoc)
     * @see Hackathon_MageMonitoring_Model_Widget::getVersion()
     */
    public function getVersion()
    {
        return '1.0';
    }

    /**
     * (non-PHPdoc)
     * @see Hackathon_MageMonitoring_Model_Widget::getOutput()
     */
    public function getOutput()
    {
        $helper = Mage::helper('magemonitoring');
        $block = $this->newMonitoringBlock();

        $incorrectStateStatusCount = $this->_getIncorrectStateStatusCollection()->getSize();
        if ($incorrectStateStatusCount === 0) {
            $status = 'success';
        } else {
            $status = 'warning';
        }
        $block->addRow($status, 'Orders with incorrect state / status combination', $incorrectStateStatusCount);

        $this->_output[] = $block;
        return $this->_output;
    }

}
