<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src');

$config = new PhpCsFixer\Config();

return $config
    ->setFinder($finder)
    ->setRules([
    'strict_param' => true,
    'modernize_strpos' => true,
    'no_alias_functions' => true,
    'set_type_to_cast' => true,
    'encoding' => true,
    'constant_case' => 'lower',
    'lowercase_keywords' => true,
    'lowercase_static_reference' => true,
    'magic_constant_casing' => true,
    'magic_method_casing' => true,
    'native_function_casing' => true,
    'cast_spaces' => true,
    'lowercase_cast' => true,
    'simplified_if_return' => true,
    'modernize_types_casting' => true,
    'no_useless_sprintf' => true,
    'fully_qualified_strict_types' => true,
    'global_namespace_import' => true,
    'no_unused_imports' => true,
    'ordered_imports' => true,
    'single_import_per_statement' => true,
    'single_line_after_imports' => true,
    'list_syntax' => 'short',
    'blank_line_after_namespace' => true,
    'no_homoglyph_names' => true,
    'new_with_braces' => true,
    'no_closing_tag' => true,
    'linebreak_after_opening_tag' => true,
    'phpdoc_no_access' => true,
    'phpdoc_no_package' => true,
    'declare_strict_types' => true,
    'strict_comparison' => true,
    'array_indentation' => true,
    'braces' => [
        'position_after_functions_and_oop_constructs' => 'next'
    ],
    'array_syntax' => [
        'syntax' => 'short'
    ],
]);