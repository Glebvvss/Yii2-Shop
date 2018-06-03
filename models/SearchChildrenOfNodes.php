<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 01.05.2018
 * Time: 16:49
 */

namespace app\models;

use app\traits\TBuildTree;
use app\interfaces\ISearchChildrenOfNodes;

class SearchChildrenOfNodes implements ISearchChildrenOfNodes {

    private $children_list;
    private $subnode_name = 'children';
    private $selectedNodeWithChildren = [];

    public function setSubnodeName($subnode_name) {
        $this->subnode_name = $subnode_name;
        return $this;
    }

    public function getChildrenNodesList($tree, $id_parent_node) {
        $this->selectNodeWithChildrenById($tree, $id_parent_node);
        $this->addChildrenOfNodeToList($this->selectedNodeWithChildren);

        return $this->children_list;
    }

    private function selectNodeWithChildrenById($tree, $id_parent_node) {
        foreach ( $tree as $node ) {
            if ( $node['id'] == $id_parent_node ) {
                $adapt_node[] = $node;
                $this->selectedNodeWithChildren = $adapt_node;
                return;
            }
            if ( $node[$this->subnode_name] ) {
                $this->selectNodeWithChildrenById($node[$this->subnode_name], $id_parent_node);
            }
        }
        return null;
    }

    private function addChildrenOfNodeToList($tree) {
        foreach( $tree as $nodes ) {
            if ( $nodes[$this->subnode_name] ) {
                foreach ($nodes[$this->subnode_name] as $node) {
                    $this->children_list[] = $node['id'];
                }
                $this->addChildrenOfNodeToList( $nodes[$this->subnode_name] );
            }
        }
    }

}