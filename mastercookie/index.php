<?php
/**
 * 2024 Addingwell
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@[yourdomain].com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade [Your Module Name] to newer
 * versions in the future. If you wish to customize [Your Module Name] for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    Simon Camus
 * @copyright Addingwell
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License (GPL 3.0)
 */
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

header('Location: ../');
exit;
