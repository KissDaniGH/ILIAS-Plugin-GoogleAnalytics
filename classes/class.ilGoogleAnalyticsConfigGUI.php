<?php
declare(strict_types=1);

/**
 * @ilCtrl_IsCalledBy ilGoogleAnalyticsConfigGUI: ilObjComponentSettingsGUI
 */
class ilGoogleAnalyticsConfigGUI extends ilPluginConfigGUI
{

    public function performCommand(string $cmd): void
    {

        global $DIC;
        $this->dic = $DIC;
        $this->pl = ilGoogleAnalyticsPlugin::getInstance();
        $this->tpl = $DIC['tpl'];


        $this->setTabs();
        $next_class = $this->dic->ctrl()->getNextClass($this);

        switch (strtolower($next_class)) {
            default:
                $cmd = $this->dic->ctrl()->getCmd();

            switch ($cmd) {
                case 'configure':
                case 'save':
                    $this->$cmd();
                    break;
                default:
                    break;
            }
        break;
        }
    }

    public function setTabs(): void
    {
        $this->dic->tabs()->addTab("configuration", $this->pl->txt("plugin_configuration"), $this->dic->ctrl()->getLinkTargetByClass(self::class, "configure"));
    }

    public function configure()
    {
        global $tpl;

        $pl = $this->getPluginObject();
        $form = $this->initConfigurationForm();

        // get measurement_id
        $measurement_id = $this->pl->getMeasurementId();
        if ($measurement_id == null) {
            $tpl->setOnScreenMessage('failure', $this->pl->txt("warning_no_measurement_id"), true);
         }
        // set measurement_id
        $val = array();
        $val["measurement_id"] = $measurement_id;
        $form->setValuesByArray($val);

        $tpl->setContent($form->getHTML());
    }


    public function save(): void
    {
        global $tpl, $lng, $ilCtrl;

        $pl = $this->getPluginObject();
        $form = $this->initConfigurationForm();

        if ($form->checkInput())
        {
            $pl->setMeasurementId($form->getInput("measurement_id"));
            $this->tpl->setOnScreenMessage('success', $lng->txt("saved_successfully"), true);
            $ilCtrl->redirect($this, "configure");
        }
        else
        {
            $form->setValuesByPost();
            $tpl->setContent($form->getHtml());
        }
    }

    public function initConfigurationForm()
    {
        global $lng, $ilCtrl;
        $pl = $this->getPluginObject();

        // form
        $this->dic->tabs()->activateTab("configuration");
        $form = new ilPropertyFormGUI();
        $form->setTableWidth("100%");
        $form->setTitle($pl->txt("plugin_configuration"));
        $form->setFormAction($ilCtrl->getFormAction($this));

        // measurement_id
        $input = new ilTextInputGUI($pl->txt("measurement_id"), "measurement_id");
        $input->setRequired(true);
        $input->setValue($pl->getMeasurementId());
        $input->setInfo($pl->txt("measurement_id_info"));
        $form->addItem($input);

        // save
        $form->addCommandButton("save", $lng->txt("save"));

        return $form;
    }
}
?>