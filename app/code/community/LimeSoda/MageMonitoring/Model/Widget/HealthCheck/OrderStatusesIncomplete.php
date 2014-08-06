<?php

/**
 * Displays the order counts group by Order Status (excluding orders with a complete state).
 */
class LimeSoda_MageMonitoring_Model_Widget_HealthCheck_OrderStatusesIncomplete
    extends Hackathon_MageMonitoring_Model_Widget_Abstract
    implements Hackathon_MageMonitoring_Model_Widget
{
    protected $_DEF_START_COLLAPSED = 1;

    /**
     * @see Hackathon_MageMonitoring_Model_Widget::getName()
     */
    public function getName()
    {
        return 'Order Statuses (excluding orders with Complete statuses)';
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
     * @see Hackathon_MageMonitoring_Model_Widget::isActive()
     */
    public function isActive()
    {
        return true;
    }

    public function getOutput()
    {
        $block = $this->newMultiBlock();
        /** @var Hackathon_MageMonitoring_Block_Widget_Multi_Renderer_Barchart $renderer */
        $renderer = $block->newContentRenderer('barchart');

        Varien_Profiler::start('HEALTHCHECK ORDER_STATUSES');

        $completeStatuses = array_keys(Mage::getModel('sales/order_config')->getStateStatuses(Mage_Sales_Model_Order::STATE_COMPLETE));

        $resourceModel = Mage::getResourceModel('sales/order');
        $connection = $resourceModel->getReadConnection();
        $sql = $connection
            ->select()
            ->from(array('sfo' => $resourceModel->getTable('sales/order')), array('status', 'count' => 'count(*)'))
            ->where('status NOT IN (?)', $completeStatuses)
            ->group('sfo.status');

        $items = $connection->fetchAll($sql);

        foreach($items as $item) {
            $renderer->addValue($item['status'], $item['count']);
        }

        Varien_Profiler::stop('HEALTHCHECK ORDER_STATUSES');

        $this->_output[] = $block;

        return $this->_output;
    }
}
