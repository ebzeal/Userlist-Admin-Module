<?php
/**
 * Helper for mod_userlist_admin
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Date\Date;

defined('_JEXEC') or die;

class ModUserListAdminHelper
{
    /**
     * Get a list of users
     *
     * @param int $limit
     * @param string $orderBy
     * @param string $orderDir
     *
     * @return array
     */
    public static function getUsers($limit = 20, $orderBy = 'id', $orderDir = 'ASC')
    {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // Map friendly names to actual columns (and handle registerDate separately)
        $colMap = [
            'id' => $db->quoteName('id'),
            'name' => $db->quoteName('name'),
            'username' => $db->quoteName('username'),
            'email' => $db->quoteName('email'),
            'registerDate' => $db->quoteName('registerDate'),
        ];

        $orderCol = isset($colMap[$orderBy]) ? $colMap[$orderBy] : $colMap['id'];

        $query->select($db->quoteName(['id','name','username','email','registerDate']))
            ->from($db->quoteName('#__users'))
            ->order($orderCol . ' ' . $orderDir);

        $db->setQuery($query, 0, (int) $limit);

        try {
            $rows = $db->loadObjectList();
        } catch (RuntimeException $e) {
            // On DB error, return empty array
            return [];
        }

        return $rows;
    }
}
