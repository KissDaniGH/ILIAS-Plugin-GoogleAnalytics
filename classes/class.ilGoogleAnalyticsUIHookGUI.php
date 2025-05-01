<?php
declare(strict_types=1);
class ilGoogleAnalyticsUIHookGUI extends ilUIHookPluginGUI
{
    function getHTML(string $a_comp, string $a_part, $a_par=array()): array
    {
        $this->plugin = ilGoogleAnalyticsPlugin::getInstance();
        if ($a_part == "template_load")
        {
            if ($a_par['tpl_id'] == "components/ILIAS/UI/src/templates/default/MainControls/tpl.footer.html")
            {
                $measurement_id = $this->plugin_object->getMeasurementId();
                if ($measurement_id != null)
                {
                        $html = $a_par['html'];
                        $tmpl = new \ilTemplate('tpl.gtag_script.html', true, true, $this->plugin->getDirectory());
                        $tmpl->setVariable("MEASUREMENT_ID", $measurement_id);
                        return array("mode" => ilUIHookPluginGUI::APPEND, "html" => $tmpl->get());
                }
            }
        }
        return array("mode" => ilUIHookPluginGUI::KEEP, "html" => "");
    }
}
?>
