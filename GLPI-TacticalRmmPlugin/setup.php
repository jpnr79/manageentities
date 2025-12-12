<?php
declare(strict_types=1);

function plugin_init_gplitacticalrmmplugin() {
    global $PLUGIN_HOOKS;
    $PLUGIN_HOOKS['csrf_compliant']['gplitacticalrmmplugin'] = true;
}

function plugin_version_gplitacticalrmmplugin() {
    return [
        'name'           => 'GLPI-TacticalRmmPlugin',
        'version'        => '1.0.0',
        'author'         => 'JP Ros',
        'license'        => 'GPLv2+',
        'homepage'       => 'https://github.com/ericferon/GLPI-TacticalRmmPlugin',
        'minGlpiVersion' => '11.0.0',
        'maxGlpiVersion' => '11.999.999',
    ];
}

function plugin_activate_gplitacticalrmmplugin() {
    return true;
}

function plugin_deactivate_gplitacticalrmmplugin() {
    return true;
}
