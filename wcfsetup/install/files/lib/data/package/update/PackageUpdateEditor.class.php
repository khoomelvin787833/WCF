<?php
declare(strict_types=1);
namespace wcf\data\package\update;
use wcf\data\DatabaseObjectEditor;

/**
 * Provides functions to edit package updates.
 * 
 * @author	Alexander Ebert
 * @copyright	2001-2018 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	WoltLabSuite\Core\Data\Package\Update
 * 
 * @method static	PackageUpdate	create(array $parameters = [])
 * @method		PackageUpdate	getDecoratedObject()
 * @mixin		PackageUpdate
 */
class PackageUpdateEditor extends DatabaseObjectEditor {
	/**
	 * @inheritDoc
	 */
	protected static $baseClass = PackageUpdate::class;
}
