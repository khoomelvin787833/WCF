<?php
declare(strict_types=1);
namespace wcf\system\package\plugin;
use wcf\data\acp\search\provider\ACPSearchProviderEditor;
use wcf\system\cache\builder\ACPSearchProviderCacheBuilder;
use wcf\system\devtools\pip\IIdempotentPackageInstallationPlugin;
use wcf\system\WCF;

/**
 * Installs, updates and deletes ACP search providers.
 * 
 * @author	Alexander Ebert
 * @copyright	2001-2018 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	WoltLabSuite\Core\System\Package\Plugin
 */
class ACPSearchProviderPackageInstallationPlugin extends AbstractXMLPackageInstallationPlugin implements IIdempotentPackageInstallationPlugin {
	/**
	 * @inheritDoc
	 */
	public $className = ACPSearchProviderEditor::class;
	
	/**
	 * @inheritDoc
	 */
	protected function handleDelete(array $items) {
		$sql = "DELETE FROM	wcf".WCF_N."_".$this->tableName."
			WHERE		providerName = ?
					AND packageID = ?";
		$statement = WCF::getDB()->prepareStatement($sql);
		
		WCF::getDB()->beginTransaction();
		foreach ($items as $item) {
			$statement->execute([
				$item['attributes']['name'],
				$this->installation->getPackageID()
			]);
		}
		WCF::getDB()->commitTransaction();
	}
	
	/**
	 * @inheritDoc
	 */
	protected function prepareImport(array $data) {
		// get show order
		$showOrder = isset($data['elements']['showorder']) ? $data['elements']['showorder'] : null;
		$showOrder = $this->getShowOrder($showOrder);
		
		return [
			'className' => $data['elements']['classname'],
			'providerName' => $data['attributes']['name'],
			'showOrder' => $showOrder
		];
	}
	
	/**
	 * @inheritDoc
	 */
	protected function findExistingItem(array $data) {
		$sql = "SELECT	*
			FROM	wcf".WCF_N."_".$this->tableName."
			WHERE	providerName = ?
				AND packageID = ?";
		$parameters = [
			$data['providerName'],
			$this->installation->getPackageID()
		];
		
		return [
			'sql' => $sql,
			'parameters' => $parameters
		];
	}
	
	/**
	 * @inheritDoc
	 */
	protected function cleanup() {
		ACPSearchProviderCacheBuilder::getInstance()->reset();
	}
	
	/**
	 * @see	\wcf\system\package\plugin\IPackageInstallationPlugin::getDefaultFilename()
	 * @since	3.0
	 */
	public static function getDefaultFilename() {
		return 'acpSearchProvider.xml';
	}
	
	/**
	 * @inheritDoc
	 */
	public static function getSyncDependencies() {
		return [];
	}
}
