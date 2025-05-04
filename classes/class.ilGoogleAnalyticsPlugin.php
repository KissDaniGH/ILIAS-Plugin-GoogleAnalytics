<?php

declare(strict_types=1);
class ilGoogleAnalyticsPlugin extends ilUserInterfaceHookPlugin
{
    private static ?ilGoogleAnalyticsPlugin $instance = null;

    public const CTYPE = 'components/ILIAS';
    public const CNAME = 'UIComponent';
    public const SLOT_ID = 'uihk';
    public const PNAME = 'GoogleAnalytics';
    public const PID = 'ga4gtag';

    private $settings = null;
    private $measurement_id = null;

    public function getPluginName(): string
    {
        return self::PNAME;
    }

    public static function getInstance(): self
    {
        global $DIC;

        if (self::$instance instanceof self) {
            return self::$instance;
        }

        $component_repository = $DIC['component.repository'];
        $component_factory = $DIC['component.factory'];

        $plugin_info = $component_repository->getComponentByTypeAndName(
            self::CTYPE,
            self::CNAME
        )->getPluginSlotById(self::SLOT_ID)->getPluginByName(self::PNAME);

        self::$instance = $component_factory->getPlugin($plugin_info->getId());

        return self::$instance;
    }

	protected function init(): void
	{
		$this->settings = new ilSetting("ui_uihk_".self::PID);
		$this->measurement_id = $this->settings->get("measurement_id", null);
	}

	protected function afterActivation(): void
	{
		// saving
		$this->setMeasurementId($this->getMeasurementId());
	}

	public function setMeasurementId(string $a_value): void
	{
		$this->measurement_id = strlen($a_value) > 0 ? $a_value : null;
		$this->settings->set('measurement_id', $this->measurement_id ?? '');
	}

	public function getMeasurementId(): string
	{
		return $this->measurement_id ?? '';
	}
}
?>
