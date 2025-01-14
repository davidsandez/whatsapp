<?php

namespace Usuario\Prueba;

use nicoSWD\Rule\Rule;
use Rule\Constants;
use Rule\Highlighter\Highlighter;
use Rule\Tokenizer;

class Rules
{
    protected $ruleStr;
    protected $ruleStrBasic;
    protected $variables;
    protected $rule;

    public function __construct()
    {
        $this->ruleStr = '
        // This is true
        2 < 3 && (
            // This is false
            foo in [4, 6, 7] ||
            // True
            [1, 4, 3].join("") === "143"
        ) && (
            // True
            "foo|bar|baz".split("|" /* uh oh */) === ["foo", /* what */ "bar", "baz"] &&
            // True
            bar > 6
        )';
        $this->ruleStrBasic = 'foo in [4, 6, 7]';

        $this->variables = ['foo' => 6, 'bar' => 7];

        $this->rule = new Rule($this->ruleStr, $this->variables);
    }

    public function apply()
    {
        if (!$this->rule->isValid()) {
            echo 'Invalid rule: ' . $this->rule->getError();
            exit;
        }

        var_dump($this->rule->isTrue()); // bool(true)
    }

}
