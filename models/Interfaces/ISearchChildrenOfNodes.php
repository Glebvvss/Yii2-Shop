<?php

namespace app\interfaces;

interface ISearchChildrenOfNodes {

    public function setSubnodeName($subnode_name);

    public function getChildrenNodesList($tree, $id_parent_node);

}