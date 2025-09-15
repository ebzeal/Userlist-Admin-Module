# mod_userlist_admin

Administrator module for Joomla 5.x to display a configurable list of site users.

## Joomla version used
Tested against Joomla 5.x (built using Joomla CMS APIs).

## Files
- mod_userlist_admin.php (entry)
- helper.php
- tmpl/default.php
- mod_userlist_admin.xml (manifest)
- /language/en-GB/en-GB.mod_userlist_admin.ini
- README.md

## Install
1. Zip the module folder `mod_userlist_admin` (this package) into `mod_userlist_admin.zip`.
2. In Joomla Administrator, go to **System → Extensions → Manage → Install** and upload the ZIP.
3. After install, go to **System → Extensions → Modules**, filter by **site: Administrator** (or search `mod_userlist_admin`), and assign to a suitable admin position (e.g., `debug` or `cpanel`).

## Suggested module position
- `debug` or `cpanel` or any Administrator template position that is visible in the backend.

## Configuration
Module parameters:
- **Show Username**: Yes/No (default: Yes)
- **Show Email**: Yes/No (default: Yes)
- **Limit**: integer (default: 20)
- **Order By**: ID, Name, Username, Email, Registered Date
- **Order Direction**: ASC/DESC

If both **Show Username** and **Show Email** are disabled, the module will display a message asking to enable at least one column.

## Permissions
Only users with `core.manage` permission can view the user list. Others see a 'not authorized' message.

## Assumptions & Limits
- Read-only listing (no create/update/delete).
- Uses Joomla core `#__users` table; custom user plugins or extra profile tables are not read.
- No pagination; uses `limit` parameter.
- Strings are in `language/en-GB/en-GB.mod_userlist_admin.ini`.

## Optional improvements
- Add CSV export (nice-to-have). Will work on this in future commits
- Add pagination.
- Add filtering by group or search.

