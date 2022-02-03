<?php
declare(strict_types=1);

namespace Jadob\Objectable\Renderer;

/**
 * @internal
 * @author pizzaminded <miki@calorietool.com>
 * @license MIT
 */
class PhpTemplateRenderer
{
    public function renderNoResultsTemplate(): string
    {
        return file_get_contents(__DIR__ . '/../resources/templates/php_default/no_results_found.php');
    }


    public function renderTable(array $rows, array $headers): string
    {
        ob_start();
        include __DIR__ . '/../resources/templates/php_default/table.php';
        return ob_get_clean();
    }

    public function renderActionField(string $fieldLabel, string $fieldName, string $actionUrl): string
    {
        ob_start();
        include __DIR__ . '/../resources/templates/php_default/action_field.php';
        return ob_get_clean();
    }

    public function renderSingleObject(array $row, array $headers): string
    {
        ob_start();
        include __DIR__ . '/../resources/templates/php_default/single.php';
        return ob_get_clean();
    }
}