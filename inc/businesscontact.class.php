<?php
/*
 * @version $Id: HEADER 15930 2011-10-30 15:47:55Z tsmr $
 -------------------------------------------------------------------------
 Manageentities plugin for GLPI
 Copyright (C) 2014-2022 by the Manageentities Development Team.

 https://github.com/InfotelGLPI/manageentities
 -------------------------------------------------------------------------

 LICENSE

 This file is part of Manageentities.

 Manageentities is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Manageentities is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Manageentities. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access directly to this file");
}

class PluginManageentitiesBusinessContact extends CommonDBTM {

   static $rightname = 'plugin_manageentities';

   static function canView():bool {
      return Session::haveRight(self::$rightname, READ);
   }

   static function canCreate():bool {
      return Session::haveRightsOr(self::$rightname, [CREATE, UPDATE, DELETE]);
   }

   function addContactByDefault($users_id, $entities_id) {

      global $DB;

      $query  = "SELECT *
        FROM `" . $this->getTable() . "`
        WHERE `entities_id` = '" . $entities_id . "' ";
      $result = $DB->doQuery($query);
      $number = $DB->numrows($result);

      if ($number) {
         while ($data = $DB->fetchArray($result)) {

            $query_nodefault  = "UPDATE `" . $this->getTable() . "`
            SET `is_default` = '0' WHERE `id` = '" . $data["id"] . "' ";
            $result_nodefault = $DB->doQuery($query_nodefault);
         }
      }

      $query_default  = "UPDATE `" . $this->getTable() . "`
        SET `is_default` = '1' WHERE `id` ='" . $users_id . "' ";
      $result_default = $DB->doQuery($query_default);
   }

   function showBusiness($instID) {
      global $DB, $CFG_GLPI;

      $entitiesId = "'" . implode("', '", $instID) . "'";
      $query      = "SELECT  `glpi_users`.*, `" . $this->getTable() . "`.`id` as users_id, `" . $this->getTable() . "`.`is_default`, `glpi_useremails`.`email`
        FROM `" . $this->getTable() . "`, `glpi_users`, `glpi_useremails`
        WHERE `" . $this->getTable() . "`.`users_id`=`glpi_users`.`id`
        AND `glpi_users`.`id` = `glpi_useremails`.`users_id`
        AND `" . $this->getTable() . "`.`entities_id` IN ($entitiesId)
        GROUP BY `" . $this->getTable() . "`.`users_id`
        ORDER BY `glpi_users`.`name`";

      $result = $DB->doQuery($query);
      $number = $DB->numrows($result);
      echo "<br>";
      if ($number) {
         echo "<form method='post' action=\"./entity.php\">";
         echo "<div align='center'><table class='tab_cadre_me center'>";
         echo "<tr><th colspan='6'>";
         echo "<h3><div class='alert alert-secondary' role='alert'>";
         echo _n('Associated commercial', 'Associated business', 2, 'manageentities');
         echo "</div></h3>";
         echo "</th></tr>";

         echo "<tr><th>" . __('Name') . "</th>";
         echo "<th>" . __('Phone') . "</th>";
         echo "<th>" . __('Phone') . " 2</th>";
         echo "<th>" . __('Mobile phone') . "</th>";
         echo "<th>" . __('Email address') . "</th>";
         if ($this->canCreate() && sizeof($instID) == 1)
            echo "<th>&nbsp;</th>";
         echo "</tr>";

         while ($data = $DB->fetchArray($result)) {
            $ID = $data["users_id"];
            echo "<tr class='tab_bg_1'>";
            echo "<td class='left'><a href='" . $CFG_GLPI["root_doc"] . "/front/user.form.php?id=" . $data["id"] . "'>" . $data["realname"] . " " . $data["firstname"] . "</a></td>";
            echo "<td class='center'>" . $data["phone"] . "</td>";
            echo "<td class='center'>" . $data["phone2"] . "</td>";
            echo "<td class='center'>" . $data["mobile"] . "</td>";
            echo "<td class='center'><a href='mailto:" . $data["email"] . "'>" . $data["email"] . "</a></td>";

            if ($this->canCreate() && sizeof($instID) == 1) {
               echo "<td class='center' class='tab_bg_2'>";
               Html::showSimpleForm(PLUGIN_MANAGEENTITIES_WEBDIR . '/front/entity.php',
                                    'deletebusiness',
                                    _x('button', 'Delete permanently'),
                                    ['id' => $ID],
                                    'fa-times-circle');
               echo "</td>";
            }
            echo "</tr>";

         }

         if ($this->canCreate() && sizeof($instID) == 1) {
            echo "<tr class='tab_bg_1'><td colspan='5' class='center'>";
            echo Html::hidden('entities_id', ['value' => $_SESSION["glpiactive_entity"]]);
            $rand = User::dropdown(['right' => 'interface']);
            echo "<a href='" . $CFG_GLPI['root_doc'] . "/front/user.form.php' target='_blank'>";
            echo "<i title=\"" . _sx('button', 'Add') . "\" class=\"far fa-plus-square\" style='cursor:pointer; margin-left:2px;'></i>";
            echo "</a>";
            echo "</td><td class='center'>";
            echo Html::submit(_x('button', 'Add'), ['name' => 'addbusiness', 'class' => 'btn btn-primary']);
            echo "</td>";
            echo "</tr>";
         }
         echo "</table></div>";
         Html::closeForm();

      } else {

         if ($this->canCreate() && sizeof($instID) == 1) {
            echo "<form method='post' action=\"./entity.php\">";
            echo "<div align='center'><table class='tab_cadre_me center'>";
            echo "<tr><th colspan='2'>";
            echo "<h3><div class='alert alert-secondary' role='alert'>";
            echo _n('Associated commercial', 'Associated business', 2, 'manageentities');
            echo "</div></h3>";
            echo "</th></tr>";

            echo "<tr><td class='tab_bg_2 center'>";
            echo Html::hidden('entities_id', ['value' => $_SESSION["glpiactive_entity"]]);
            $rand = User::dropdown(['right' => 'interface']);
            echo "<a href='" . $CFG_GLPI['root_doc'] . "/front/user.form.php' target='_blank'>";
            echo "<i title=\"" . _sx('button', 'Add') . "\" class=\"far fa-plus-square\" style='cursor:pointer; margin-left:2px;'></i>";
            echo "</a>";
            echo "</td><td class='center tab_bg_2'>";
            echo Html::submit(_x('button', 'Add'), ['name' => 'addbusiness', 'class' => 'btn btn-primary']);
            echo "</td></tr>";

            echo "</table></div>";
            Html::closeForm();
         }
      }
   }
}
