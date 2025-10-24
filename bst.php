<?php
class Node {
    public $data, $left, $right;
    function __construct($data) {
        $this->data = $data;
    }
}

class BinarySearchTree {
    private $root;
    public function insert($data) {
        $this->root = $this->insertNode($this->root, $data);
    }
    private function insertNode($node, $data) {
        if ($node === null) return new Node($data);
        if (strcasecmp($data, $node->data) < 0)
            $node->left = $this->insertNode($node->left, $data);
        else
            $node->right = $this->insertNode($node->right, $data);
        return $node;
    }
    public function inorderTraversal($node = null, &$result = []) {
        if ($node === null) $node = $this->root;
        if ($node->left) $this->inorderTraversal($node->left, $result);
        $result[] = $node->data;
        if ($node->right) $this->inorderTraversal($node->right, $result);
        return $result;
    }
    public function search($data) {
        return $this->searchNode($this->root, $data);
    }
    private function searchNode($node, $data) {
        if (!$node) return false;
        $cmp = strcasecmp($data, $node->data);
        if ($cmp === 0) return true;
        return $cmp < 0 ? $this->searchNode($node->left, $data)
                        : $this->searchNode($node->right, $data);
    }
}
?>
