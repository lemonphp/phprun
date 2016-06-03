<?php

$header = <<<EOF
This file is part of `oanhnn/slim-skeleton` project.

(c) OanhNN <oanhnn.bk@gmail.com>

This source file is subject to the MIT license that is bundled
with this source code in the file LICENSE.
EOF;

Symfony\CS\Fixer\Contrib\HeaderCommentFixer::setHeader($header);

return Symfony\CS\Config\Config::create()
    // use default PSR-2 and extra fixers:
    ->level('psr2')
    ->fixers(array(
        'header_comment',
        'short_array_syntax',
        'ordered_use',
        'php_unit_construct',
        'php_unit_strict',
        'strict',
        'strict_param',
        'array_element_no_space_before_comma',
        'array_element_white_space_after_comma',
        'duplicate_semicolon',
        'multiline_array_trailing_comma',
    ))
    ->finder(
        Symfony\CS\Finder\DefaultFinder::create()
            ->in(__DIR__)
    )
;
