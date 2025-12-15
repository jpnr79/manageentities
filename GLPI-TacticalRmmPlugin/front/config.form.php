declare(strict_types=1);
/****************************************************************************************
 * GLPI TacticalRMM Plugin Config Form
 * Modernized for GLPI 11 and PHP 8.4
 ****************************************************************************************/
<?php
/****************************************************************************************
 **
 **      GLPI Plugin for TacticalRMM - Developed by JP Ros
 **
 ****************************************************************************************/


use GlpiPlugin\TacticalRmm\Config;
include('../../../inc/includes.php');


if (!empty($_POST['update'])) {
    Config::setUrl($_POST['url'] ?? '');
    Config::setField($_POST['field'] ?? 'name');
    Html::back();
}


function isSelected($field, $current): string {
    return $field === $current ? "selected='selected'" : '';
}

function getOption($selectedField, $name, $label): string {
    return "<option value='" . htmlspecialchars($name, ENT_QUOTES) . "' " . isSelected($selectedField, $name) . ">" . htmlspecialchars($label, ENT_QUOTES) . "</option>";
}


if (Config::canView()) {
    $url = Config::getUrl();
    $field = Config::getField();

    Html::header(__('TacticalRMM', 'plugintacticalrmm'), $_SERVER['PHP_SELF'], 'config', 'plugintacticalrmm', '');
    echo Html::displayTitle('', '', __('TacticalRMM Settings', 'plugintacticalrmm'));

    echo '<div>';
    echo '<form method="post" action="config.form.php">';
    echo "<table style='width:100%;'>";
    echo "<tr class='tab_bg_2'>";
    echo "<td> " . __('URL', 'plugintacticalrmm') . "</td>";
    echo "<td><input type='text' name='url' id='url' value='" . htmlspecialchars($url, ENT_QUOTES) . "' style='width: 100%'></td>";
    echo "</tr>";
    echo "<tr class='tab_bg_2'><td>&nbsp;</td></tr>";
    echo "<tr class='tab_bg_2'>";
    echo "<td> " . __('Relation field', 'plugintacticalrmm') . "</td><td>";
    echo "<select name='field' id='field' style='width:100%'>";
    echo getOption($field, "name", __('Name', 'plugintacticalrmm'));
    echo getOption($field, "serial", __('Serial number', 'plugintacticalrmm'));
    echo getOption($field, "otherserial", __('Inventory number', 'plugintacticalrmm'));
    echo getOption($field, "uuid", __('UUID', 'plugintacticalrmm'));
    echo "</select>";
    echo "</td></tr>";
    echo "<tr class='tab_bg_2'><td>&nbsp;</td></tr>";
    echo "<tr><td colspan='2'>";
    if (Config::canUpdate()) {
        echo Html::hidden('update', ['value' => 'now']);
        echo Html::submit(__('Save', 'plugintacticalrmm'));
    }
    echo "</td></tr></table>";
    echo Html::closeform();
    echo '</div>';
    Html::footer();
} else {
    Html::displayRightError();
}
