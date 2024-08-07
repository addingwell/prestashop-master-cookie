<?php
/**
 * 2024 [Addingwell]
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@addingwell.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade [Your Module Name] to newer
 * versions in the future. If you wish to customize [Your Module Name] for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    [Simon Camus]
 * @copyright [Addingwell]
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License (GPL 3.0)
 **/

namespace mastercookie;
use Module;

if (!defined('_PS_VERSION_')) {
    exit;
}

class MasterCookie extends Module
{
    public function __construct()
    {
        $this->name = 'mastercookie';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Addingwell';
        $this->need_instance = 0;
        $this->bootstrap = false;

        parent::__construct();

        $this->displayName = $this->l('Master Cookie');
        $this->description = $this->l('This module create a master uuid cookie from your server for each visitor during 13 months. The name of this cookie is "_aw_master_id"');
        $this->ps_versions_compliancy = ['min' => '1.7.0.0', 'max' => _PS_VERSION_];
    }

    public function install()
    {
        return parent::install() && $this->registerHook('displayHeader');
    }

    public function uninstall()
    {
        return parent::uninstall() && $this->unregisterHook('displayHeader');
    }

    public function hookDisplayHeader()
    {
        $this->setMasterCookie();
    }

    private function setMasterCookie()
    {
        $cookieName = '_aw_master_id';
        $cookieLifetime = time() + (60 * 60 * 24 * 30 * 13);
        if ($_SERVER['SERVER_NAME'] === 'localhost') {
            $cookieDomain = 'localhost';
        } else {
            $cookieDomain = $this->getMainDomain($_SERVER['HTTP_HOST']);
        }

        if (!isset($_COOKIE[$cookieName])) {
            $cookieValue = $this->generateUUID();
        } else {
            $cookieValue = $_COOKIE[$cookieName];
        }
        setcookie($cookieName, $cookieValue, $cookieLifetime, '/', $cookieDomain, true, true);
    }

    private function generateUUID()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xFFFF), mt_rand(0, 0xFFFF),
            mt_rand(0, 0xFFFF),
            mt_rand(0, 0x0FFF) | 0x4000,
            mt_rand(0, 0x3FFF) | 0x8000,
            mt_rand(0, 0xFFFF), mt_rand(0, 0xFFFF), mt_rand(0, 0xFFFF)
        );
    }

    private function getMainDomain($url)
    {
        $composedTlds = [
            'co.uk', 'gov.uk', 'ac.uk', 'org.uk', 'net.uk', 'sch.uk', 'nhs.uk', 'police.uk',
            'com.au', 'net.au', 'org.au', 'edu.au', 'gov.au', 'asn.au', 'id.au',
            'co.jp', 'ac.jp', 'ne.jp', 'or.jp', 'go.jp', 'ed.jp', 'ad.jp', 'gr.jp',
            'com.cn', 'net.cn', 'gov.cn', 'org.cn', 'edu.cn', 'mil.cn', 'ac.cn',
            'com.br', 'net.br', 'org.br', 'gov.br', 'edu.br', 'mil.br', 'art.br', 'coop.br',
            'co.in', 'net.in', 'org.in', 'gov.in', 'ac.in', 'res.in', 'edu.in', 'mil.in', 'nic.in',
            'gc.ca', 'gov.ca',
            'com.de', 'net.de', 'org.de',
            'gov.it', 'edu.it',
            'asso.fr', 'nom.fr', 'prd.fr', 'presse.fr', 'tm.fr', 'com.fr', 'gouv.fr',
            'com.es', 'nom.es', 'org.es', 'gob.es', 'edu.es',
            'co.za', 'net.za', 'gov.za', 'org.za', 'edu.za',
            'com.mx', 'net.mx', 'org.mx', 'edu.mx', 'gob.mx',
            'com.ru', 'net.ru', 'org.ru', 'edu.ru', 'gov.ru',
            'co.kr', 'ne.kr', 'or.kr', 're.kr', 'pe.kr', 'go.kr', 'mil.kr',
            'com.sg', 'net.sg', 'org.sg', 'edu.sg', 'gov.sg', 'per.sg',
            'com.my', 'net.my', 'org.my', 'gov.my', 'edu.my', 'mil.my',
            'com.hk', 'net.hk', 'org.hk', 'gov.hk', 'edu.hk', 'idv.hk',
            'com.ar', 'net.ar', 'org.ar', 'gov.ar', 'edu.ar', 'int.ar',
            'com.tr', 'net.tr', 'org.tr', 'gov.tr', 'edu.tr', 'mil.tr',
        ];
        // Remove protocol if present
        $domain = preg_replace('/^https?:\/\//', '', $url);
        // Remove www. if present
        $domain = preg_replace('/^www\./', '', $domain);
        // Split the domain into parts
        $parts = explode('.', $domain);
        $count = count($parts) - 1;

        for ($i = 0; $i < $count; $i++) {
            $possibleTld = implode('.', array_slice($parts, $i));

            if (in_array($possibleTld, $composedTlds)) {
                return '.' . implode('.', array_slice($parts, $i - 1));
            }
        }
        // Default to last two parts if no composed TLD matches
        return '.' . implode('.', array_slice($parts, -2));
    }
}
