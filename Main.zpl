declare
  @package {:HelloWorld:}
, @date    {:2014/12/26:}.

variable
  $hello <- "Hello World!"
, $font  <- False
, $test  <- True.

do
  :field-origin [20, 10]
, :font-config  [D, $font, 90, 50]
, :field-data   [$hello], /.