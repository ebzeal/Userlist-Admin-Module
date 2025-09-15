<?php
/**
 * @package     Olusola.project
 * @subpackage  mod_userlist_admin
 *
 * Simple Administrator module to list users with configurable columns.
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Html\HTMLHelper;
use Joomla\CMS\Date\Date;
use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die;

require_once __DIR__ . '/src/Helper/helper.php';

$moduleId = $module->id ?? 0;

$user = Factory::getUser();

// Permission: require manage (administrator) permission to view the list
if (!$user->authorise('core.manage')) {
    // show a simple unauthorized message
    echo '<div class="alert alert-warning">' . htmlspecialchars(Text::_('MOD_USERLIST_ADMIN_NOT_AUTHORIZED'), ENT_QUOTES, 'UTF-8') . '</div>';
    return;
}

$showUsername = (bool) $params->get('show_username', 1);
$showEmail = (bool) $params->get('show_email', 1);
$limit = (int) $params->get('limit', 20);

$orderBy = $params->get('order_by', 'id');
$orderDir = strtoupper($params->get('order_dir', 'ASC')) === 'DESC' ? 'DESC' : 'ASC';

// Allowed order columns for safety
$allowedOrder = ['id', 'name', 'username', 'email', 'registerDate'];
if (!in_array($orderBy, $allowedOrder, true)) {
    $orderBy = 'id';
}

// Fetch users via helper
$users = ModUserListAdminHelper::getUsers($limit, $orderBy, $orderDir);

require ModuleHelper::getLayoutPath('mod_userlist_admin', $params->get('layout', 'default'));
