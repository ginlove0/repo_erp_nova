<?php

namespace Ipsupply\WhTransferItemPackedResourceTool;

use Laravel\Nova\ResourceTool;

class WhTransferItemPackedResourceTool extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Wh_Transfer_Item_Packed_Resource_Tool';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'wh_transfer_item_packed_resource_tool';
    }
}
