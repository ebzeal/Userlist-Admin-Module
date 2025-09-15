<?php
/**
 * Default layout for mod_userlist_admin
 *
 * @var array $users
 * @var Joomla\Registry\Registry $params
 */

use Joomla\CMS\Language\Text;
use Joomla\CMS\Date\Date;

defined('_JEXEC') or die;

$showUsername = (bool) $params->get('show_username', 1);
$showEmail = (bool) $params->get('show_email', 1);

?>
<div class="mod-userlist-admin">
    <?php if (empty($users)) : ?>
        <div class="empty-state"><?php echo htmlspecialchars(Text::_('MOD_USERLIST_ADMIN_NO_USERS_FOUND'), ENT_QUOTES, 'UTF-8'); ?></div>
    <?php else : ?>
        <?php if (!$showUsername && !$showEmail) : ?>
            <div class="alert alert-info"><?php echo htmlspecialchars(Text::_('MOD_USERLIST_ADMIN_NO_COLUMNS_SELECTED'), ENT_QUOTES, 'UTF-8'); ?></div>
        <?php else : ?>
            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th><?php echo htmlspecialchars(Text::_('MOD_USERLIST_ADMIN_COL_ID'), ENT_QUOTES, 'UTF-8'); ?></th>
                        <th><?php echo htmlspecialchars(Text::_('MOD_USERLIST_ADMIN_COL_NAME'), ENT_QUOTES, 'UTF-8'); ?></th>
                        <?php if ($showUsername) : ?>
                            <th><?php echo htmlspecialchars(Text::_('MOD_USERLIST_ADMIN_COL_USERNAME'), ENT_QUOTES, 'UTF-8'); ?></th>
                        <?php endif; ?>
                        <?php if ($showEmail) : ?>
                            <th><?php echo htmlspecialchars(Text::_('MOD_USERLIST_ADMIN_COL_EMAIL'), ENT_QUOTES, 'UTF-8'); ?></th>
                        <?php endif; ?>
                        <th><?php echo htmlspecialchars(Text::_('MOD_USERLIST_ADMIN_COL_REGISTERED'), ENT_QUOTES, 'UTF-8'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $row) : ?>
                        <tr>
                            <td><?php echo (int) $row->id; ?></td>
                            <td><?php echo htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php if ($showUsername) : ?>
                                <td><?php echo htmlspecialchars($row->username, ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php endif; ?>
                            <?php if ($showEmail) : ?>
                                <td><?php echo htmlspecialchars($row->email, ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php endif; ?>
                            <td>
                                <?php
                                    if (!empty($row->registerDate) && $row->registerDate !== '0000-00-00 00:00:00') {
                                        $d = new Date($row->registerDate);
                                        echo htmlspecialchars($d->format('Y-m-d H:i'), ENT_QUOTES, 'UTF-8');
                                    } else {
                                        echo htmlspecialchars(Text::_('MOD_USERLIST_ADMIN_UNKNOWN'), ENT_QUOTES, 'UTF-8');
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>
</div>
