<?php

namespace app\interfaces;

interface ISearchChildrenOfNodes {

    public function setSubnodeName($subnode_name);

    public function setParentNodeKey($parent_node);

    public function getChildrenNodesList($tree, $id_parent_node);

}