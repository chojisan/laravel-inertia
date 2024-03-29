<?php

/**
 * Add name prefix to tree.
 *
 * @param [type] $nodes
 * @param [type] $name
 * @param string $prefix
 * @return void
 */
function traverseName(&$nodes, $name, $prefix = '-')
{
    foreach ($nodes as $node) {
        $node->$name = PHP_EOL.$prefix.' '.$node->$name;

        traverseName($node->children, $name, $prefix.'-');
    }
}

/**
 * Add name prefix and flatten the tree.
 *
 * @param [type] $nodes
 * @param [type] $name
 * @param string $prefix
 * @return void
 */
function traverseFlatten($nodes, $name, $prefix = '-')
{
    $flatten = [];
    foreach ($nodes as $node) {
        $node->name = PHP_EOL.$prefix.' '.$node->$name;
        $flatten[] = $node;

        if($node->children)
        {
            $flatten = array_merge($flatten, traverseFlatten($node->children, $name, $prefix.'-'));
        }

    }

    return $flatten;
}
