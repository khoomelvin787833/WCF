<?php
declare(strict_types=1);
namespace wcf\acp\action;
use wcf\action\AbstractAction;
use wcf\data\package\update\server\PackageUpdateServer;
use wcf\system\cache\CacheHandler;
use wcf\system\language\LanguageFactory;
use wcf\system\request\LinkHandler;
use wcf\system\style\StyleHandler;
use wcf\util\HeaderUtil;

/**
 * Clears the cache.
 * 
 * @author	Tim Duesterhus
 * @copyright	2001-2018 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	WoltLabSuite\Core\Acp\Action
 */
class CacheClearAction extends AbstractAction {
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['admin.management.canViewLog'];
	
	/**
	 * @inheritDoc
	 */
	public function execute() {
		parent::execute();
		
		// reset stylesheets
		StyleHandler::resetStylesheets();
		
		// delete language cache and compiled templates as well
		LanguageFactory::getInstance()->deleteLanguageCache();
		
		// get package dirs
		CacheHandler::getInstance()->flushAll();
		
		// reset package update servers and the package cache
		PackageUpdateServer::resetAll();
		
		$this->executed();
		
		if (!isset($_POST['noRedirect'])) {
			HeaderUtil::redirect(LinkHandler::getInstance()->getLink('CacheList'));
		}
		
		exit;
	}
}
