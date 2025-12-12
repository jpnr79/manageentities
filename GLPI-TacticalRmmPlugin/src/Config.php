<?php
namespace GlpiPlugin\TacticalRmm;

declare(strict_types=1);

class Config
{
    public static function canView(): bool
    {
        // Add GLPI rights check here if needed
        return true;
    }

    public static function canUpdate(): bool
    {
        // Add GLPI rights check here if needed
        return true;
    }

    public static function getUrl(): string
    {
        return (string)\Config::get('plugin_tacticalrmm_url', '');
    }

    public static function setUrl(string $url): void
    {
        \Config::set('plugin_tacticalrmm_url', $url);
    }

    public static function getField(): string
    {
        return (string)\Config::get('plugin_tacticalrmm_field', 'name');
    }

    public static function setField(string $field): void
    {
        \Config::set('plugin_tacticalrmm_field', $field);
    }
}
