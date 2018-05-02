<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 03.04.2018
 * Time: 22:21
 */

namespace app\traits;

trait TBuildTree {

    private $nameSubNodes = 'children';
    private $parentColumn = 'id_parent';
    private $idColumn = 'id';

    public function buildTreeArray(array $data) : array {
        $tree = [];
        foreach ($data as $id => &$node) {
            if ($node[$this->parentColumn] === '0') {
                $tree[$id] = &$node;
            }
            $data[$node[$this->parentColumn]] [$this->nameSubNodes][$node['id']] = &$node;
        }return $tree;
    }

    public function setNameSubnodes(string $nameSubNodes) {
        $this->nameSubNodes = $nameSubNodes;
        return $this;
    }

    public function setParentColumn(string $parentColumn) {
        $this->parentColumn = $parentColumn;
        return $this;
    }

    public function setIdColumn(string $idColumn) {
        $this->idColumn = $idColumn;
        return $this;
    }
}