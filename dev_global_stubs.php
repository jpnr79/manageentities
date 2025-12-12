<?php
// Expanded development stubs for static analysis (dporegister-focused).
// These are permissive no-op implementations used only to reduce analyzer noise.

if (!defined('GLPI_ROOT')) {
    define('GLPI_ROOT', '/var/www/glpi');
}

// GLPI version constant
if (!defined('GLPI_VERSION')) { define('GLPI_VERSION', '11.0.0'); }

// i18n helpers
if (!function_exists('__')) { function __($s, $d = null) { return $s; } }
if (!function_exists('_n')) { function _n($one, $many, $n, $d = null) { return ($n > 1) ? $many : $one; } }
if (!function_exists('_sx')) { function _sx($a, $b) { return $b; } }
if (!function_exists('_x')) { function _x($c, $s) { return $s; } }
if (!function_exists('__s')) { function __s($s) { return $s; } }

if (!function_exists('countElementsInTable')) { function countElementsInTable($table, $criteria = []) { return 0; } }

// Lightweight core classes
if (!class_exists('CommonGLPI')) {
    class CommonGLPI { public $fields = []; public function getID() { return $this->fields['id'] ?? 0; } public static function getTypeName($n = 0) { return ''; } public static function getTabNameForItem(\CommonGLPI $item, int $withtemplate = 0): array|string { return []; } }
}

if (!class_exists('CommonDBTM')) {
    class CommonDBTM extends CommonGLPI {
        public $fields = [];
        public $input = [];
        public function getFromDB($id = 0) { return false; }
        public function getFromDBByCrit(array $crit) { return false; }
        public function getEmpty() { $this->fields = []; }
        public function add(array $input, $history = null): bool { return true; }
        public function update(array $input, $history = null, $options = null): bool { return true; }
        public static function getTable() { return ''; }
        public static function getForeignKeyField() { return 'id'; }
        public static function dropdown(...$a) { return ''; }
        public static function getTypeName($n=0) { return ''; }
        public static function createTabEntry(...$args) { return $args[0] ?? ''; }
        public static function getForbiddenStandardMassiveActionStatic() { return []; }
        public function showMassiveActionsSubForm($ma = null): ?bool { return true; }
        public static function showMassiveActionsSubFormStatic($ma = null) { return true; }
        public function __construct(...$a) { }
        public function __destruct(...$a) { }
        public static function processMassiveActionsForOneItemtype(\MassiveAction $ma, \CommonDBTM $item, array $ids): void { return; }
        public static function getSpecificValueToDisplay(...$a) { return ''; }
        public static function getSpecificValueToSelect(...$a) { return ''; }
        public function __call($name, $args) { return null; }
        public static function __callStatic($name, $args) { return null; }
    }
}

if (!class_exists('CommonDropdown')) {
    class CommonDropdown extends CommonDBTM {
        public static function getForeignKeyField() { return 'items_id'; }
        public function canUpdateItem() { return true; }
        public function canDeleteItem() { return true; }
        public function canPurgeItem() { return true; }
    }
}
if (!class_exists('CommonTreeDropdown')) { class CommonTreeDropdown extends CommonDropdown {} }
if (!class_exists('CommonDBRelation')) {
    class CommonDBRelation extends CommonDBTM {
        public static function getForbiddenStandardMassiveAction() { return []; }
    }
}

if (!class_exists('MassiveAction')) { class MassiveAction { const CLASS_ACTION_SEPARATOR = '::'; const ACTION_OK = 1; const ACTION_KO = 0; public function getItemtype($a=false){return ''; } public function getAction(){return ''; } public function getInput(){return []; } public function itemDone($type,$key,$status){} public function addMessage($m){} } }

// Session, Html, Ajax, Toolbox minimal helpers used in many plugins
/**
 * Session helper stubs used by plugins
 *
 * @method static bool checkLoginUser()
 * @method static bool haveRight($n, $r)
 * @method static bool haveRightsOr(...$a)
 * @method static bool haveAccessToEntity($id)
 * @method static int getPluralNumber()
 * @method static string getCurrentInterface()
 * @method static void addMessageAfterRedirect($msg, $type = 'info')
 * @method static bool checkRight(...$a)
 * @method static int getLoginUserID()
 * @method static mixed getNewIDORToken(...$a)
 */
if (!class_exists('Session')) {
    /**
     * Session helper stubs used by plugins (attached to class for PHPStan)
     *
     * @method static bool checkLoginUser()
     * @method static bool haveRight($n, $r)
     * @method static bool haveRightsOr(...$a)
     * @method static bool haveAccessToEntity($id)
     * @method static int getPluralNumber()
     * @method static string getCurrentInterface()
     * @method static void addMessageAfterRedirect($msg, $type = 'info')
     * @method static bool checkRight(...$a)
     * @method static int getLoginUserID()
     * @method static mixed getNewIDORToken(...$a)
     */
    class Session {
        public static function checkLoginUser() { return true; }
        public static function haveRight($n, $r) { return true; }
        public static function haveRightsOr(...$a) { return true; }
        public static function haveAccessToEntity($id) { return true; }
        public static function getPluralNumber() { return 2; }
        public static function getCurrentInterface() { return 'central'; }
        public static function addMessageAfterRedirect($msg, $type = 'info') { return; }
        public static function checkRight(...$a) { return true; }
        public static function getLoginUserID() { return 1; }
        public static function getNewIDORToken() { return null; }
    }
}

/**
 * Html helper stubs used by plugins
 *
 * @method static void header_nocache()
 * @method static string header(string $title = '', string $self = '', string $tab = '', $plugin = '', $extras = '')
 * @method static string footer()
 * @method static string helpHeader($t = '')
 * @method static string helpFooter()
 * @method static string back()
 * @method static string cleanId(string $id)
 * @method static string jsAjaxDropdown(...$a)
 * @method static string convDateTime($t = null)
 * @method static string hidden($name, $opts = [])
 * @method static string submit($label, $opts = [])
 * @method static void closeForm()
 */
if (!class_exists('Html')) {
    /**
     * Html helper stubs used by plugins (attached to class for PHPStan)
     *
     * @method static void header_nocache()
     * @method static string header(string $title = '', string $self = '', string $tab = '', $plugin = '', $extras = '')
     * @method static string footer()
     * @method static string helpHeader($t = '')
     * @method static string helpFooter()
     * @method static string back()
     * @method static string cleanId(string $id)
     * @method static string jsAjaxDropdown(...$a)
     * @method static string convDateTime($t = null)
     * @method static string hidden($name, $opts = [])
     * @method static string submit($label, $opts = [])
     * @method static void closeForm()
     */
    class Html {
        public static function back() { return ''; }
        public static function footer() { return ''; }
        public static function header_nocache() { return ''; }
        public static function popHeader() { return ''; }
        public static function popFooter() { return ''; }
        public static function closeForm() { return; }
        public static function openMassiveActionsForm() { return ''; }
        public static function showMassiveActions() { return ''; }
        public static function getCheckAllAsCheckbox() { return ''; }
        public static function showMassiveActionCheckBox(...$a) { return ''; }
        public static function resume_text($t) { return $t; }
        public static function nullHeader() { return ''; }
        public static function image(...$a) { return ''; }
        public static function scriptBlock($s) { echo $s; }
        public static function jsShow($s) { echo $s; }
        public static function setSimpleTextContent($s) { return $s; }
        public static function displayErrorAndDie($m) { }
        public static function redirect($u) { }
        public static function displayNotFoundError() { }
        public static function cleanInputText($s) { return $s; }
        public static function header($title = '', $self = '', $tab = '', $plugin = '', $extras = '') { return ''; }
        public static function ajaxFooter() { return ''; }
        public static function convDateTime($t = null) { return is_scalar($t) ? (string)$t : ''; }
        public static function hidden($name, $opts = []) { return ''; }
        public static function submit($label, $opts = []) { return ''; }
        public static function displayRightError($s = '') { return ''; }
        public static function helpHeader() { return ''; }
        public static function helpFooter() { return ''; }
        public static function cleanId(string $id) { return preg_replace('/[^a-z0-9_\-]/i','',$id); }
        public static function jsAjaxDropdown() { return ''; }
        public static function autocompletionTextField(...$a) { return ''; }
        public static function input($name, $opts = []) { return ''; }
        public static function link($label, $url = '') { return "<a href='$url'>$label</a>"; }
        public static function css($url = '') { return ''; }
        public static function script($s = '') { return ''; }
        public static function showSimpleForm(...$a) { return ''; }
    }
}

// Enrich Html with many UI helpers used by plugins
if (!class_exists('Html')) {
    class Html {
        public static function displayRightError($s) { echo $s; }
        public static function displayTitle($s) { echo $s; }
        public static function autocompletionTextField(...$a) { return ''; }
        public static function input($name, $opts = []) { return ''; }
        public static function link($label, $url = '') { return "<a href='$url'>$label</a>"; }
        public static function css($url) { return ''; }
        public static function script($s) { return ''; }
        public static function showSimpleForm(...$a) { return ''; }
        public static function showMassiveActionCheckBox(...$a) { return ''; }
        public static function getCheckAllAsCheckbox($id = '') { return ''; }
        public static function resume_text($t, $len = 100) { return $t; }
        public static function jsShow($s) { return ""; }
        public static function nullHeader($t, $u = '') { return ''; }
    }
}

if (!class_exists('Ajax')) { class Ajax { public static function updateItemJsCode(...$a) {} public static function updateItemOnSelectEvent(...$a) {} public static function createIframeModalWindow(...$a) {} public static function updateItemOnEvent(...$a) {} } }

if (!class_exists('Toolbox')) { class Toolbox { public static function getHtmlToDisplay($s) { return $s; } public static function getItemTypeFormURL($c) { return ''; } } }

if (!class_exists('Dropdown')) {
    class Dropdown {
        public const EMPTY_VALUE = '';
        public static function showFromArray($a) { return ''; }
        public static function showYesNo() { return ''; }
        public static function getDropdownName($table, $id) { return ''; }
        public static function showSelectItemFromItemtypes(...$a) { return ''; }
        public static function addNewCondition(...$a) { return; }
    }
}

// Generic helper functions that many plugins use
if (!function_exists('getFirstDayOfMonth')) { function getFirstDayOfMonth($m, $y = null) { return date('Y-m-01'); } }
if (!function_exists('getLastDayOfMonth')) { function getLastDayOfMonth($m, $y = null) { return date('Y-m-t'); } }
if (!function_exists('autoName')) { function autoName(...$a) { return ''; } }
if (!function_exists('getAllDataFromTable')) { function getAllDataFromTable($table, $criteria = []) { return []; } }
if (!function_exists('unclean_cross_side_scripting_deep')) { function unclean_cross_side_scripting_deep(...$a) { return false; } }

// Simple Rule class constants used by some plugins
if (!class_exists('Rule')) { class Rule { const PATTERN_END = 1; const REGEX_MATCH = 2; const REGEX_NOT_MATCH = 3; const PATTERN_EXISTS = 4; const PATTERN_DOES_NOT_EXISTS = 5; } }

if (!class_exists('Plugin')) {
    class Plugin {
        public static function getPhpDir($p) { return __DIR__ . '/' . $p; }
        public static function getWebDir($p, $full = false) { return 'plugins/' . $p; }
        public static function registerClass($c, $o = []) { return true; }
        public static function load() { return true; }
        public static function isPluginActive($p = '') { return true; }
        public static function messageIncompatible($m) { return; }
    }
}

if (!class_exists('Event')) { class Event { public static function log(...$a) {} } }

if (!class_exists('Profile')) { class Profile { public static function createTabEntry(...$a) { return $a[0] ?? ''; } } }
if (!class_exists('ProfileRight')) { class ProfileRight { public static function addProfileRights($a) { return true; } public static function getProfileRights($profile = null) { return []; } } }

// Plugin-specific light stubs used by dporegister and others
if (!class_exists('PluginDporegisterProcessing')) {
    class PluginDporegisterProcessing extends CommonDBTM {
        public $fields = [];
        public const INCOMING = 1;
        public const QUALIFICATION = 2;
        public const EVALUATION = 3;
        public const APPROVAL = 4;
        public const ACCEPTED = 5;

        public static function getTable() { return 'glpi_plugin_dporegister_processings'; }
        public static function getForeignKeyField() { return 'plugin_dporegister_processing_id'; }
        public static function getStatusIcon($s = null) { return ''; }
        public static function getStatus($s = null) { return ''; }
        public static function canView() { return true; }
        public static function canUpdate() { return true; }
        public static function canDelete() { return true; }
        public static function canPurge() { return true; }
        public static function getSearchURL() { return ''; }
        public static function getFormURLWithID($id) { return ''; }
        public static function dropdownStatus() { return []; }
        public static function getType() { return self::class; }
        public static function getTypeName($n = 0) { return 'Processing'; }
        public static function getActorIcon($t = null) { return ''; }
        public static function getActorFieldNameType($t = null) { return ''; }
        public static function getForeignKeyFieldName() { return 'plugin_dporegister_processing_id'; }
        public static function getValueToSelect() { return []; }
        public function initForm($id = 0, $opts = []) { }
        public function showFormHeader($opts = []) { }
        public function showFormButtons($opts = []) { }
        public static function showUsersAssociated() { return ''; }
        public static function showSuppliersAssociated() { return ''; }
        public static function showSupplierAddFormOnCreate() { return ''; }
    }
}
if (!class_exists('PluginDporegisterProcessing_User')) { class PluginDporegisterProcessing_User extends CommonDBRelation { public static $itemtype_1 = null, $items_id_1 = null, $itemtype_2 = null, $items_id_2 = null; public static function getTable(){ return 'glpi_plugin_dporegister_processings_users'; } public static function getForeignKeyField(){ return 'plugin_dporegister_processing_user_id'; } } }
if (!class_exists('PluginDporegisterProcessing_Supplier')) { class PluginDporegisterProcessing_Supplier extends CommonDBRelation { public static $itemtype_1 = null, $items_id_1 = null, $itemtype_2 = null, $items_id_2 = null; public static function getTable(){ return 'glpi_plugin_dporegister_processings_suppliers'; } public static function getForeignKeyField(){ return 'plugin_dporegister_processing_supplier_id'; } } }
if (!class_exists('PluginDporegisterIndividualsCategory')) { class PluginDporegisterIndividualsCategory extends CommonDropdown { public static function getTable(){ return 'glpi_plugin_dporegister_individualscategories'; } public static function getForeignKeyField(){ return 'plugin_dporegister_individualscategory_id'; } public static function dropdown(...$a) { return ''; } } }
if (!class_exists('PluginDporegisterSecurityMesure')) { class PluginDporegisterSecurityMesure extends CommonDropdown { public static function getTable(){ return 'glpi_plugin_dporegister_securitymesures'; } public static function getForeignKeyField(){ return 'plugin_dporegister_securitymesure_id'; } public static function dropdown(...$a) { return ''; } } }

if (!class_exists('User')) { class User extends CommonDBTM { public static function getForeignKeyField() { return 'users_id'; } public static function dropdown(...$a) { return ''; } } }

if (!class_exists('Software')) { class Software extends CommonDBTM { public static function getTable() { return ''; } public static function dropdown(...$args) { return ''; } public static function getForeignKeyField() { return 'software_id'; } public static function getFormURLWithID($id) { return ''; } public static function canView() { return true; } } }
// Alias HTML to Html for plugins using the uppercase variant
if (!class_exists('HTML') && class_exists('Html')) { class HTML extends Html {} }

// Ensure Software has canView helper
if (!class_exists('Software')) { class Software extends CommonDBTM { public static function canView() { return true; } } }
if (!class_exists('SoftwareCategory')) { class SoftwareCategory extends CommonDBTM { public static function getTable() { return 'glpi_softwarecategories'; } } }
if (!class_exists('Entity')) { class Entity extends CommonDBTM { public static function dropdown(...$a) { return ''; } } }
if (!class_exists('Manufacturer')) { class Manufacturer extends CommonDBTM { public static function dropdown(...$a) { return ''; } } }
if (!class_exists('Supplier')) { class Supplier extends CommonDBTM { public static function getForeignKeyField() { return 'suppliers_id'; } public static function dropdown(...$a) { return ''; } } }

if (!class_exists('Notification')) { class Notification { const USER_TYPE = 1; const ASSIGN_TECH = 2; const SUPERVISOR_ASSIGN_GROUP = 3; public static function getNotificationsByEventAndType(...$args) { return []; } } }
if (!class_exists('NotificationTarget')) { class NotificationTarget { const TAG_LANGUAGE = 'language'; } }
if (!class_exists('NotificationEvent')) { class NotificationEvent { public static function raiseEvent(...$args) { return; } } }
// Small missing classes referenced by plugins
if (!class_exists('Group_User')) { class Group_User extends CommonDBTM { public static function getUserGroups($user) { return []; } } }
if (!class_exists('Alert')) { class Alert extends CommonDBTM {} }
if (!class_exists('DisplayPreference')) { class DisplayPreference extends CommonDBTM {} }
if (!class_exists('Document_Item')) { class Document_Item extends CommonDBTM {} }
if (!class_exists('DropdownTranslation')) { class DropdownTranslation extends CommonDBTM {} }
if (!class_exists('ImpactItem')) { class ImpactItem extends CommonDBTM {} }
if (!class_exists('Item_Ticket')) { class Item_Ticket extends CommonDBTM {} }
if (!class_exists('Link_Itemtype')) { class Link_Itemtype extends CommonDBTM {} }
if (!class_exists('Notepad')) { class Notepad extends CommonDBTM {} }
if (!class_exists('SavedSearch')) { class SavedSearch extends CommonDBTM {} }

if (!class_exists('CommonITILValidation')) { class CommonITILValidation { const WAITING = 1; } }

if (!class_exists('Migration')) { class Migration { public function __construct(...$a) {} public static function displayMessage($m) {} } }
if (!class_exists('TCPDF')) { class TCPDF { public function __construct(...$a) {} } }

// End of expanded stubs
// Additional utilities used by plugins
if (!function_exists('getUserName')) { function getUserName($id, $withLink = 0) { return (string)$id; } }

if (!class_exists('Search')) {
    class Search {
        public static function show() { return ''; }
        public static function manageParams(...$a) { return []; }
        public static function showList(...$a) { return ''; }
    }
}

if (!class_exists('CommonITILActor')) { class CommonITILActor extends CommonDBTM { const ASSIGN = 1; } }
if (!class_exists('CommonITILObject')) {
    class CommonITILObject extends CommonDBTM {
        public function post_addItem() { return; }
        public function getValueToSelect($field_id_or_search_options, $name = '', $values = '', $options = array()) { return []; }
    }
}
// (removed duplicate CommonITILObject static block)

if (!class_exists('CommonITILValidation')) {
    class CommonITILValidation {
        const REFUSED = 0;
        const ACCEPTED = 1;
        const WAITING = 2;
        public static function getStatusColor($s) { return '#fff'; }
        public static function getStatus($s) { return (string)$s; }
    }
}

// Enrich Html with a few more helpers
if (!class_exists('Html')) {
    class Html {
        public static function back() { return ''; }
        public static function footer() { return ''; }
        public static function header($title = '', $self = '', $tab = '', $plugin = '', $extras = '') { return ''; }
        public static function convDateTime($t = null) { return is_scalar($t) ? (string)$t : ''; }
        public static function ajaxFooter() { return ''; }
        public static function hidden($name, $opts = []) { return ''; }
        public static function submit($label, $opts = []) { return ''; }
    }
}

// Namespaced stubs for plugin-specific or GLPI core namespaced symbols
if (!class_exists('\\GlpiPlugin\\Servicecatalog\\Main')) {
    eval('namespace GlpiPlugin\\Servicecatalog; class Main { public static function showDefaultHeaderHelpdesk(...$a) { return ""; } public static function showNavBarFooter(...$a) { return ""; } }');
}

if (!interface_exists('\\Glpi\\Helpdesk\\Tile\\TileInterface')) {
    eval('namespace Glpi\\Helpdesk\\Tile; interface TileInterface { public function getWeight(): int; public function getLabel(): string; public function canCreate(): bool; public function canPurge(): bool; public function getTitle(): string; public function getDescription(): string; public function getIllustration(): string; public function getTileUrl(): string; public function isAvailable(): bool; public function getDatabaseId(): ?int; public function getConfigFieldsTemplate(): string; public function cleanDBonPurge(); }');
}
if (!class_exists('NotificationTarget')) { class NotificationTarget { const TAG_LANGUAGE = 'language'; public $data = []; public $tag_descriptions = []; public $obj = null; public function addTagToList($a) {} public function addTarget($a,$b) {} } }

if (!interface_exists('\\Glpi\\ItemTranslation\\Context\\ProvideTranslationsInterface')) {
    eval('namespace Glpi\\ItemTranslation\\Context; interface ProvideTranslationsInterface { public function listTranslationsHandlers(): array; }');
}

if (!class_exists('\\Glpi\\Helpdesk\\Tile\\Item_Tile')) {
    eval('namespace Glpi\\Helpdesk\\Tile; class Item_Tile {}');
}

if (!class_exists('\\Glpi\\Helpdesk\\HelpdeskTranslation')) {
    eval('namespace Glpi\\Helpdesk; class HelpdeskTranslation {}');
}

if (!class_exists('\\Glpi\\UI\\IllustrationManager')) {
    eval('namespace Glpi\\UI; class IllustrationManager { const DEFAULT_ILLUSTRATION = ""; }');
}

// TranslationHandler stub used by item translation code in plugins
if (!class_exists('\\Glpi\\ItemTranslation\\Context\\TranslationHandler')) {
    eval('namespace Glpi\\ItemTranslation\\Context; class TranslationHandler { public function __construct(...$a) {} }');
}

// (removed namespaced NotificationTargetRequest stub to avoid colliding with plugin class)

// Provide simple namespaced shims inside the plugin namespace so unqualified
// references inside namespaced plugin files resolve to the global stubs above.
if (!class_exists('GlpiPlugin\\Consumables\\Html')) {
    eval('namespace GlpiPlugin\\Consumables; class Html extends \\Html {}');
}
if (!class_exists('GlpiPlugin\\Consumables\\Session')) {
    eval('namespace GlpiPlugin\\Consumables; class Session extends \\Session {}');
}
if (!class_exists('GlpiPlugin\\Consumables\\Plugin')) {
    eval('namespace GlpiPlugin\\Consumables; class Plugin extends \\Plugin {}');
}
if (!class_exists('GlpiPlugin\\Consumables\\Dropdown')) {
    eval('namespace GlpiPlugin\\Consumables; class Dropdown extends \\Dropdown {}');
}
if (!class_exists('GlpiPlugin\\Consumables\\NotificationTarget')) {
    eval('namespace GlpiPlugin\\Consumables; class NotificationTarget extends \\NotificationTarget {}');
}
if (!class_exists('GlpiPlugin\\Consumables\\CommonITILValidation')) {
    eval('namespace GlpiPlugin\\Consumables; class CommonITILValidation extends \\CommonITILValidation {}');
}

// Minimal stubs for stockcontrol plugin to reduce analyzer noise
if (!class_exists('PluginStockcontrolStock')) {
    class PluginStockcontrolStock extends CommonDBTM { public static function canView() { return true; } public static function canCreate() { return true; } }
}
if (!class_exists('PluginStockControlStock')) {
    class PluginStockControlStock extends PluginStockcontrolStock {}
}
if (!class_exists('PluginStockcontrolMenu')) {
    class PluginStockcontrolMenu { public function display() { return ''; } }
}
if (!class_exists('PluginStockControlMenu')) {
    class PluginStockControlMenu extends PluginStockcontrolMenu {}
}
if (!class_exists('PluginMyExampleMyObject')) {
    class PluginMyExampleMyObject extends CommonDBTM {
        public function check(...$a) { return true; }
        public function add(array $input, $history = null): bool { return true; }
        public function update(array $input, $history = null, $options = null): bool { return true; }
        public function delete(array $input, $purge = 0): bool { return true; }
        public function redirectToList() { return; }
        public function display($opts = []) { return; }
    }
}

// Generic QueryExpression stub used by plugin DB requests
if (!class_exists('QueryExpression')) {
    class QueryExpression {
        public function __construct(...$a) {}
        public function __toString() { return ''; }
    }
}

// Namespaced exception used by stockcontrol
if (!class_exists('GlpiPlugin\\Stockcontrol\\Exception')) {
    eval('namespace GlpiPlugin\\Stockcontrol; class Exception extends \\Exception {}');
}

// CommonGLPI helper expected by some plugins
if (!class_exists('CommonGLPI')) {
    class CommonGLPI { public static function getTabNameForItem($item, $with = null) { return ''; } }
}

// namespaced event class used in some plugins (created via eval to avoid top-level namespace restriction)
if (!class_exists('\\Glpi\\Event')) {
    eval('namespace Glpi { class Event { public static function log(...$a) { } } }');
}

// Small missing classes referenced by some plugins
if (!class_exists('UserEmail')) { class UserEmail extends CommonDBTM { public static function getTable() { return 'glpi_useremails'; } } }
if (!class_exists('Location')) { class Location extends CommonDBTM { public static function getTable() { return 'glpi_locations'; } } }

// Ensure CommonDropdown/Relation helper methods exist
if (!class_exists('CommonDropdown')) {
    class CommonDropdown extends CommonDBTM {
        public static function getForeignKeyField() { return 'items_id'; }
        public static function canUpdateItem() { return true; }
        public static function canDeleteItem() { return true; }
        public static function canPurgeItem() { return true; }
    }
}
if (!class_exists('CommonDBRelation')) {
    class CommonDBRelation extends CommonDBTM {
        public static function getForbiddenStandardMassiveAction() { return []; }
    }
}

// Static-analysis-only definitive prototypes for commonly-used static helpers
if (false) {
    class Html {
        public static function header_nocache() {}
        public static function header($title = '', $self = '', $tab = '', $plugin = '', $extras = '') {}
        public static function footer() {}
        public static function helpHeader($t = '') {}
        public static function helpFooter() {}
        public static function back() {}
        public static function cleanId(string $id) {}
        public static function jsAjaxDropdown(...$a) {}
        public static function convDateTime($t = null) {}
        public static function hidden($name, $opts = []) {}
        public static function submit($label, $opts = []) {}
        public static function closeForm() {}
    }

    class Session {
        public static function checkLoginUser() {}
        public static function checkRight(...$a) {}
        public static function checkRightOr(...$a) {}
        public static function getNewIDORToken(...$a) {}
        public static function getCurrentInterface() {}
        public static function haveRightsOr(...$a) {}
    }

    class Plugin { public static function isPluginActive($p = '') {} }

    class CommonITILValidation { const WAITING = 2; const REFUSED = 0; const ACCEPTED = 1; }
}

// Expand PluginDporegisterProcessing stub with common methods/props used by plugin
if (!class_exists('PluginDporegisterProcessing')) {
    class PluginDporegisterProcessing extends CommonITILObject {
        public static $fields = [];
        public const INCOMING = 1;
        public const QUALIFICATION = 2;
        public const EVALUATION = 3;
        public const APPROVAL = 4;
        public const ACCEPTED = 5;

        public static function getTable() { return 'glpi_plugin_dporegister_processings'; }
        public static function getForeignKeyField() { return 'plugin_dporegister_processing_id'; }
        public static function getStatusIcon($s = null) { return ''; }
        public static function getStatus($s = null) { return ''; }
        public static function canView() { return true; }
        public static function canUpdate() { return true; }
        public static function canDelete() { return true; }
        public static function canPurge() { return true; }
        public static function getSearchURL() { return ''; }
        public static function getFormURLWithID($id) { return ''; }
        public static function dropdownStatus() { return []; }
        public static function getType() { return self::class; }
        public static function getTypeName($n = 0) { return 'Processing'; }
        public static function getActorIcon($t = null) { return ''; }
        public static function getActorFieldNameType($t = null) { return ''; }
        public static function getForeignKeyFieldName() { return 'plugin_dporegister_processing_id'; }
        public static function getValueToSelect() { return []; }
        public function initForm($id = 0, $opts = []) { }
        public function showFormHeader($opts = []) { }
        public function showFormButtons($opts = []) { }
        public static function showUsersAssociated() { return ''; }
        public static function showSuppliersAssociated() { return ''; }
        public static function showSupplierAddFormOnCreate() { return ''; }
    }
}

// Permissive stubs for classes referenced by plugins/webapplications
if (!class_exists('Glpi\\Application\\View\\TemplateRenderer')) {
    eval('namespace Glpi\\Application\\View; class TemplateRenderer { public static function getInstance() { return new self(); } public function display($tpl, $vars = []) { return; } }');
}

if (!class_exists('DbUtils')) { class DbUtils { public static function getTableFromField($f) { return ''; } } }
if (!class_exists('Database')) { class Database extends CommonDBTM { public static function getTable() { return ''; } } }
if (!class_exists('Appliance')) { class Appliance extends CommonDBTM { public static function getTable() { return 'glpi_appliances'; } } }
if (!class_exists('Appliance_Item')) { class Appliance_Item extends CommonDBTM { public static function getTable() { return 'glpi_appliance_items'; } } }
if (!class_exists('Appliance_Item_Relation')) { class Appliance_Item_Relation extends CommonDBRelation { public static function getTable() { return ''; } } }
if (!class_exists('ImpactRelation')) { class ImpactRelation extends CommonDBTM {} }
if (!class_exists('Certificate')) { class Certificate extends CommonDBTM {} }
if (!class_exists('Certificate_Item')) { class Certificate_Item extends CommonDBTM {} }
if (!class_exists('Contract')) { class Contract extends CommonDBTM {} }
if (!class_exists('Contract_Item')) { class Contract_Item extends CommonDBTM {} }
if (!class_exists('Document')) { class Document extends CommonDBTM {} }
if (!class_exists('Document_Item')) { class Document_Item extends CommonDBTM {} }
if (!class_exists('ManualLink')) { class ManualLink extends CommonDBTM {} }
if (!class_exists('KnowbaseItem')) { class KnowbaseItem extends CommonDBTM {} }
if (!function_exists('getEntitiesRestrictCriteria')) { function getEntitiesRestrictCriteria(...$a) { return []; } }

// Additional stubs for missing global classes referenced by webapplications frontend
if (!class_exists('DatabaseInstance')) { class DatabaseInstance extends CommonDBTM { public static function getTable() { return ''; } } }
if (!class_exists('Impact')) { class Impact { public static function isEnabled($c = null) { return false; } public static function getEnabledItemtypes() { return []; } public static function buildGraph(...$a) { return []; } public static function prepareParams(...$a) { return []; } public static function makeDataForCytoscape(...$a) { return []; } public static function printHeader(...$a) {} public static function displayGraphView(...$a) {} public static function displayListView(...$a) {} public static function printAssetSelectionForm(...$a) {} }

// Glpi plugin hooks constants used in setup.php
if (!class_exists('Glpi\\Plugin\\Hooks')) {
    eval('namespace Glpi\\Plugin; class Hooks { const ADD_JAVASCRIPT = 1; const ADD_CSS = 2; }');
}

// Small missing classes referenced by webapplications
if (!class_exists('KnowbaseItem_Item')) { class KnowbaseItem_Item extends CommonDBTM {} }
if (!class_exists('Item_OperatingSystem')) { class Item_OperatingSystem extends CommonDBTM {} }
if (!class_exists('IPAddress')) { class IPAddress extends CommonDBTM {} }

}

