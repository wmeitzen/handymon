<?php

echo "Distributing documentation file into separate files\n";

define('MAIN_FILE', 'single-documentation-file.htm');
echo "Files distributed:\n";

split_template_file(MAIN_FILE, "header.htm", "header.htm");
split_template_file(MAIN_FILE, "footer.htm", "footer.htm");
split_template_file(MAIN_FILE, "index.htm", "index.htm");
split_template_file(MAIN_FILE, "first_time_setup.htm", "first_time_setup.htm");
split_template_file(MAIN_FILE, "configure.htm", "configure.htm");
split_template_file(MAIN_FILE, "credentials.htm", "credentials.htm");
split_template_file(MAIN_FILE, "configuration_values.htm", "configuration_values.htm");
split_template_file(MAIN_FILE, "add_monitors.htm", "add_monitors.htm");
split_template_file(MAIN_FILE, "add_win_monitors.htm", "add_win_monitors.htm");
split_template_file(MAIN_FILE, "add_disk_monitors.htm", "add_disk_monitors.htm");
split_template_file(MAIN_FILE, "add_mssql_monitors.htm", "add_mssql_monitors.htm");
split_template_file(MAIN_FILE, "edit_monitor.htm", "edit_monitor.htm");
split_template_file(MAIN_FILE, "alert_rules.htm", "alert_rules.htm");
split_template_file(MAIN_FILE, "alert_rule_examples.htm", "alert_rule_examples.htm");
split_template_file(MAIN_FILE, "alert_rule_reference.htm", "alert_rule_reference.htm");
split_template_file(MAIN_FILE, "import_monitors.htm", "import_monitors.htm");
split_template_file(MAIN_FILE, "features.htm", "features.htm");
split_template_file(MAIN_FILE, "disk_alert_thresholds.htm", "disk_alert_thresholds.htm");
split_template_file(MAIN_FILE, "setting_timezone.htm", "setting_timezone.htm");
split_template_file(MAIN_FILE, "setting_org_name.htm", "setting_org_name.htm");
split_template_file(MAIN_FILE, "configuring_email.htm", "configuring_email.htm");
split_template_file(MAIN_FILE, "configuring_slack.htm", "configuring_slack.htm");
split_template_file(MAIN_FILE, "sql_server_login_permissions.htm", "sql_server_login_permissions.htm");
split_template_file(MAIN_FILE, "troubleshoot_mssql_instance_monitoring.htm", "troubleshoot_mssql_instance_monitoring.htm");
split_template_file(MAIN_FILE, "preparing_windows_monitoring.htm", "preparing_windows_monitoring.htm");
split_template_file(MAIN_FILE, "poll_interval_configuration.htm", "poll_interval_configuration.htm");

function split_template_file($strTemplateFilename, $strTemplateName, $strDestinationFilename) {
    $MAX_FILE_INSERTS = 10; // arbitrary maximum; in case there's an error

    if (!file_exists($strTemplateFilename)) {
        echo "Unable to find file " . $strTemplateFilename . "\n";
        return;
    }

    $strFile = file_get_contents($strTemplateFilename);

    if (stripos($strFile, "<!--[<" . strtolower($strTemplateName) . ">]-->") === false) {
        echo "Unable to find <!--[<" . $strTemplateName . ">]--> in " . $strTemplateFilename . "\n";
        return;
    }

    if (stripos($strFile, "<!--[</" . strtolower($strTemplateName) . ">]-->") === false) {
        echo "Unable to find <!--[</" . $strTemplateName . ">]--> in " . $strTemplateFilename . "\n";
        return;
    }

    if (stripos($strFile, "<!--[</" . strtolower($strTemplateName) . ">]-->") < stripos($strFile, "<!--[<" . strtolower($strTemplateName) . ">]-->")) {
        echo "Syntax error in " . $strTemplateFilename . "\n";
        echo "<!--[</" . $strTemplateName . ">]--> was found before <!--[<" . $strTemplateName . ">]-->\n";
        return;
    }

    $strTemplateCode = $strFile;
    $strTemplateCode = substr($strTemplateCode, 0, stripos($strTemplateCode, "<!--[</" . strtolower($strTemplateName) . ">]-->"));
    $strTemplateCode = substr($strTemplateCode, stripos($strTemplateCode, "<!--[<" . strtolower($strTemplateName) . ">]-->") + strlen("<!--[<" . strtolower($strTemplateName) . ">]-->") + 1);

    echo $strDestinationFilename . ":\n";

    $intInsert = 0;
    while ($intInsert <= $MAX_FILE_INSERTS && strpos($strTemplateCode, "<!--<<") > 0) {
        $intInsert++;
        $strFilenameToInsert = substr($strTemplateCode, strpos($strTemplateCode, "<!--<<") + strlen("<!--<<"));
        $strFilenameToInsert = substr($strFilenameToInsert, 0, strpos($strFilenameToInsert, ">>-->"));

        if (!file_exists($strFilenameToInsert)) {
            echo "Unable to find file " . $strFilenameToInsert . " to insert\n";
            return;
        }

        $strInsertFile = file_get_contents($strFilenameToInsert);
        $strTemplateCode = str_replace("<!--<<" . $strFilenameToInsert . ">>-->", $strInsertFile, $strTemplateCode);
        echo "  (" . $strFilenameToInsert . " inserted)\n";
    }

    file_put_contents($strDestinationFilename, $strTemplateCode);

    // process replace markup: <!-- begin replace [href="#] [href="] -->
    $strTemplateCode = file_get_contents($strDestinationFilename);

    $pattern = '/<!--\s*begin replace \[([^]]+)\] \[([^]]+)\]\s*-->(.*?)<!--\s*end replace\s*-->/s';
    
    preg_match_all($pattern, $strTemplateCode, $matches, PREG_SET_ORDER);
    
    foreach ($matches as $match) {
        $search = $match[1];
        $replace = $match[2];
        $content = $match[3];
        
        // Replace the first occurrence of the search text with the replace text
        $updatedContent = str_replace($search, $replace, $content);
        
        // Reconstruct the full match string with the updated content
        $fullMatch = $match[0];
        $updatedMatch = "<!-- begin replace [{$search}] [{$replace}] -->" . $updatedContent . "<!-- end replace -->";
        
        // Replace the full match in the original string with the updated match
        $strTemplateCode = str_replace($fullMatch, $updatedMatch, $strTemplateCode);
    }
    
    file_put_contents($strDestinationFilename, $strTemplateCode);
    
}

?>
