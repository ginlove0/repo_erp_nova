<?php

namespace Ipsupply\ItemTransferResourceTool;

use Laravel\Nova\ResourceTool;

class ItemTransferResourceTool extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Item Transfer Resource Tool';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'item-transfer-resource-tool';
    }
}
