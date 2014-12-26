<?php
  # Copyright (c) 2014 Marcelo Camargo <marcelocamargo@linuxmail.org>
  #
  # Permission is hereby granted, free of charge, to any person
  # obtaining a copy of this software and associated documentation files
  # (the "Software"), to deal in the Software without restriction,
  # including without limitation the rights to use, copy, modify, merge,
  # publish, distribute, sublicense, and/or sell copies of the Software,
  # and to permit persons to whom the Software is furnished to do so,
  # subject to the following conditions:
  #
  # The above copyright notice and this permission notice shall be
  # included in all copies or substantial of portions the Software.
  #
  # THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
  # EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  # MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
  # NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
  # LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
  # OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
  # WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

  require_once 'Linker.php';
  require_once 'Declaration.php';
  require_once 'Variable.php';
  require_once 'Call.php';

  abstract class Parser {
    public $source, $lookahead;

    public function __construct(Tokenizer $source) {
      $this->source = $source;
      $this->consume();
    }

    public function match() {
      $args = func_get_args();
      foreach ($args as $x)
        if ($this->lookahead->key == $x) {
          $this->consume();
          return;
        }

      $expecting = "";
      foreach ($args as $x)
        $expecting .= $this->source->tokenName($x) . " or ";

      throw new Exception("Expecting token " .
        substr($expecting, 0, strlen($expecting) - 4) . ". Instead got " .
        $this->source->tokenName($this->lookahead->key));
    }

    public function consume() {
      $this->lookahead = $this->source->nextToken();
    }

    public function listDeclarations() {
      foreach (Linker :: $declarations as $decl)
        echo "{$decl->key} = {$decl->value}\n";
    }

    public function listVariables() {
      foreach (Linker :: $variables as $var)
        echo "{$var->key} = {$var->value}\n";
    }

    public function listCalls() {
      foreach (Linker :: $calls as $call)
        var_dump($call);
    }
  }
  