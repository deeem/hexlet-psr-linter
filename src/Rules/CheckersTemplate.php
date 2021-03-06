<?php

namespace PsrLinter\Rules;

abstract class CheckersTemplate implements RulesInterface
{
    protected $errors = [];

    protected function addError(\PhpParser\Node $node, $type, $reason, $where = false)
    {
        $where = $where ? $where : $node->name;
        $this->errors[] = [
            'line'    => $node->getAttribute('startLine'),
            'type'    => $type,
            'fixable' => false,
            'where'   => $where,
            'reason'  => $reason,
        ];
    }

    public function flushErrors()
    {
        $errors = $this->errors;
        $this->errors = [];
        return empty($errors) ? false : $errors;
    }

    abstract public function check(\PhpParser\Node $node);
}
