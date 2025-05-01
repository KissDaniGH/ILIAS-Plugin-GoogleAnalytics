<?php
declare(strict_types=1);

class ilGoogleAnalyticsConfigGUI extends ilPluginConfigGUI
{
    public const PLUGIN_CLASS_NAME = ilGoogleAnalyticsPlugin::class;
    public const TAB_CONFIGURATION = "configuration";
    public const CMD_CONFIGURE = "configure";
    public const CMD_SAVE = "save";

    private ilGoogleAnalyticsPlugin $pl;
    private $dic;
    private $tpl;

    public function __construct()
    {
        global $DIC;
        $this->dic = $DIC;
        $this->pl = ilGoogleAnalyticsPlugin::getInstance();
        $this->tpl = $DIC['tpl'];
    }

    public function performCommand(string $cmd): void
    {
        $this->setTabs();
        $next_class = $this->dic->ctrl()->getNextClass($this);

        switch (strtolower($next_class)) {
            default:
                $cmd = $this->dic->ctrl()->getCmd();

                switch ($cmd) {
                    case self::CMD_CONFIGURE:
                    case self::CMD_SAVE:
                        $this->{$cmd}();
                        break;

                    default:
                        break;
                }
                break;
        }
    }


    protected function setTabs(): void
    {
        $this->dic->tabs()->addTab(self::TAB_CONFIGURATION, $this->pl->txt("plugin_configuration"), $this->dic->ctrl()->getLinkTargetByClass(self::class, self::CMD_CONFIGURE));
    }

	public function configure()
	{
		global $tpl, $ilDB;

		$plugin = $this->getPluginObject();
		$form = $this->initConfigurationForm($plugin);

		// get measurement_id
		$measurement_id = $plugin->getMeasurementId();
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

		$plugin = $this->getPluginObject();
		$form = $this->initConfigurationForm($plugin);

		if ($form->checkInput())
		{
			$plugin->setMeasurementId($_POST["measurement_id"]);
			$tpl->setOnScreenMessage('success', $lng->txt("saved_successfully"), true);
			$ilCtrl->redirect($this, "configure");
		}
		else
		{
			$form->setValuesByPost();
			$tpl->setContent($form->getHtml());
		}
	}

	private function initConfigurationForm($plugin)
	{
		global $lng, $ilCtrl;

		// form
		$this->dic->tabs()->activateTab(self::TAB_CONFIGURATION);
		$form = new ilPropertyFormGUI();
		$form->setTableWidth("50%");
		$form->setTitle($plugin->txt("plugin_configuration"));
		$form->setFormAction($ilCtrl->getFormAction($this));

		// measurement_id
		$input = new ilTextInputGUI($plugin->txt("measurement_id"), "measurement_id");
		$input->setRequired(true);
		$input->setValue($plugin->getMeasurementId());
		$input->setInfo($plugin->txt("measurement_id_info"));
		$form->addItem($input);

		// save
		$form->addCommandButton("save", $lng->txt("save"));

		return $form;
	}
}
?>
