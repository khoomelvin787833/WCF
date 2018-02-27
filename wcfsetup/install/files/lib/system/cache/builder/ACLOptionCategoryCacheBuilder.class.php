<?php
declare(strict_types=1);
namespace wcf\system\cache\builder;
use wcf\data\acl\option\category\ACLOptionCategoryList;

/**
 * Caches the acl categories for a certain package.
 * 
 * @author	Matthias Schmidt
 * @copyright	2001-2018 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	WoltLabSuite\Core\System\Cache\Builder
 */
class ACLOptionCategoryCacheBuilder extends AbstractCacheBuilder {
	/**
	 * @inheritDoc
	 */
	public function rebuild(array $parameters) {
		$list = new ACLOptionCategoryList();
		$list->readObjects();
		
		$data = [];
		foreach ($list as $aclOptionCategory) {
			if (!isset($data[$aclOptionCategory->objectTypeID])) {
				$data[$aclOptionCategory->objectTypeID] = [];
			}
			
			$data[$aclOptionCategory->objectTypeID][$aclOptionCategory->categoryName] = $aclOptionCategory;
		}
		
		return $data;
	}
}
