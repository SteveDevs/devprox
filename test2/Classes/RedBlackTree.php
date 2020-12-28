<?php 
namespace Classes;

use Classes\CSV;
use Classes\Random;
use Classes\RBT\Node;
use Classes\RBT\Tree;
use Classes\RBT\Visualisation\Cli;


class RedBlackTree {
    /**
     * Root of the tree
     * @var TreeNode
     */
    public $tree;

    public function __construct($number_of_nodes)
    {
        $this->generateTree($number_of_nodes);
    }

    public function generateTree($number_of_nodes){
        $random = new Random();

            $tree = new Tree();
            $random->generate();
            $key = $random->days . ',' . $random->surname . ',' . $random->name;
            $node = new Node($key, NULL);
            $tree->insert($node);
            set_time_limit(999999999);
            ini_set('memory_limit', '-1');
            //$time_start = microtime(true); 
            $num = 0;
            for($x = 0; $x < $number_of_nodes; $x++) {
                $num ++;
                $random->generate();

                //unique date + surname  + name
                $key = $random->days . ',' . $random->surname . ',' . $random->name;
                //check if unique
                $node = new Node($key, NULL);
                while($tree->insert($node) === 0){
                    $random->generate();
                    $key = $random->days . ',' . $random->surname . ',' . $random->name;
                    $node = new Node($key, NULL);
                }


            } 
        $visualisation = new Cli();
        $visualisation->getTree($tree->getRoot());
            
        $csv = new CSV();
        $csv->generateCsv($visualisation->tree_arr);
    }
}