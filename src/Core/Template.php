<?php

namespace VOHTMLSitemap\Core;

class Template
{
    public static function render(string $templateName, array $data = []): void
    {
        $templatePath = self::getTemplatePath($templateName);

        if (file_exists($templatePath)) {
            extract($data);
            require_once $templatePath;
        }
    }

    private static function getTemplatePath(string $templateName): string
    {
        return realpath(VOHTMLSITEMAP_RESOURCES_PATH . 'views/' . $templateName . '.php');
    }

    public static function get(string $templateName, array $data = []): string
    {
        $templatePath = self::getTemplatePath($templateName);

        if (file_exists($templatePath)) {
            ob_start();
            extract($data);
            require $templatePath;
            return ob_get_clean();
        }

        return '';
    }
}
