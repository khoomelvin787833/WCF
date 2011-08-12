<?php
namespace wcf\system\user\authentication;
use wcf\system\SingletonFactory;

/**
 * Provides an abstract implementation of the user authentication.
 * 
 * @author	Marcel Werk
 * @copyright	2001-2011 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	com.woltlab.wcf
 * @subpackage	system.user.authentication
 * @category 	Community Framework
 */
abstract class AbstractUserAuthentication extends SingletonFactory implements IUserAuthentication {}
