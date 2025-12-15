# Code Citations

## License: GPL-2.0
https://github.com/InfotelGLPI/financialreports/blob/034f5c3b803c53d0bc0e44131e584e2a05e8daa6/inc/profile.class.php

```
in new ones
      foreach ($DB->request("SELECT `id` FROM `glpi_profiles`") as $prof) {
         self::migrateOneProfile($prof['id']);
      }
      foreach ($DB->request("SELECT *
                           FROM `glpi_profilerights` 
                           WHERE `profiles_id`='" . $_SESSION['glpiactiveprofile']['id'] . "' 
                              AND `name` LIKE '%plugin_financialreports%'") as $prof) {
         $_SESSION['glpiactiveprofile'][$prof['name']] = $prof['rights'];
      }
```


## License: GPL-2.0
https://github.com/elitelinux/glpi-smartcities/blob/8ea385bcf3ddfdbaa257d99463d5917b85736619/plugins/manufacturersimports/inc/profile.class.php

```
in new ones
      foreach ($DB->request("SELECT `id` FROM `glpi_profiles`") as $prof) {
         self::migrateOneProfile($prof['id']);
      }
      foreach ($DB->request("SELECT *
                           FROM `glpi_profilerights` 
                           WHERE `profiles_id`='" . $_SESSION['glpiactiveprofile']['id'] . "' 
                              AND `name` LIKE '%plugin_financialreports%'") as $prof) {
         $_SESSION['glpiactiveprofile'][$prof['name']] = $prof['rights'];
      }
```

