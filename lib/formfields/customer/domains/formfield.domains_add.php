<?php

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2010 the Froxlor Team (see authors).
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at http://files.froxlor.org/misc/COPYING.txt
 *
 * @copyright  (c) the authors
 * @author     Froxlor team <team@froxlor.org> (2010-)
 * @license    GPLv2 http://files.froxlor.org/misc/COPYING.txt
 * @package    Formfields
 *
 */
return array(
	'domain_add' => array(
		'title' => $lng['domains']['subdomain_add'],
		'image' => 'fa-solid fa-plus',
		'sections' => array(
			'section_a' => array(
				'title' => $lng['domains']['subdomain_add'],
				'image' => 'icons/domain_add.png',
				'fields' => array(
					'subdomain' => array(
						'label' => $lng['domains']['domainname'],
						'type' => 'text',
						'next_to' => [
							'domain' => [
								'next_to_prefix' => '.',
								'type' => 'select',
								'select_var' => $domains
							]
						]
					),
					'alias' => array(
						'label' => $lng['domains']['aliasdomain'],
						'type' => 'select',
						'select_var' => $aliasdomains
					),
					'path' => array(
						'label' => $lng['panel']['path'],
						'desc' => (\Froxlor\Settings::Get('panel.pathedit') != 'Dropdown' ? $lng['panel']['pathDescriptionSubdomain'] : null),
						'type' => $pathSelect['type'],
						'select_var' => $pathSelect['select_var'] ?? '',
						'value' => $pathSelect['value'],
						'note' => $pathSelect['note'] ?? '',
					),
					'url' => array(
						'visible' => (\Froxlor\Settings::Get('panel.pathedit') == 'Dropdown' ? true : false),
						'label' => $lng['panel']['urloverridespath'],
						'type' => 'text'
					),
					'redirectcode' => array(
						'visible' => (\Froxlor\Settings::Get('customredirect.enabled') == '1' ? true : false),
						'label' => $lng['domains']['redirectifpathisurl'],
						'desc' => $lng['domains']['redirectifpathisurlinfo'],
						'type' => 'select',
						'select_var' => isset($redirectcode) ? $redirectcode : null
					),
					'selectserveralias' => array(
						'label' => $lng['admin']['selectserveralias'],
						'desc' => $lng['admin']['selectserveralias_desc'],
						'type' => 'label',
						'value' => $lng['customer']['selectserveralias_addinfo']
					),
					'openbasedir_path' => array(
						'label' => $lng['domain']['openbasedirpath'],
						'type' => 'select',
						'select_var' => $openbasedir
					),
					'phpsettingid' => array(
						'visible' => (((int) \Froxlor\Settings::Get('system.mod_fcgid') == 1 || (int) \Froxlor\Settings::Get('phpfpm.enabled') == 1) && count($phpconfigs) > 0 ? true : false),
						'label' => $lng['admin']['phpsettings']['title'],
						'type' => 'select',
						'select_var' => $phpconfigs,
						'selected' => (int) Settings::Get('phpfpm.enabled') == 1) ? Settings::Get('phpfpm.defaultini') : Settings::Get('system.mod_fcgid_defaultini')
					)
				)
			),
			'section_bssl' => array(
				'title' => $lng['admin']['webserversettings_ssl'],
				'image' => 'icons/domain_add.png',
				'visible' => \Froxlor\Settings::Get('system.use_ssl') == '1' ? ($ssl_ipsandports ? true : false) : false,
				'fields' => array(
					'sslenabled' => array(
						'label' => $lng['admin']['domain_sslenabled'],
						'type' => 'checkbox',
						'value' => '1',
						'checked' => true
					),
					'ssl_redirect' => array(
						'label' => $lng['domains']['ssl_redirect']['title'],
						'desc' => $lng['domains']['ssl_redirect']['description'],
						'type' => 'checkbox',
						'value' => '1',
						'checked' => false
					),
					'letsencrypt' => array(
						'visible' => (\Froxlor\Settings::Get('system.leenabled') == '1' ? true : false),
						'label' => $lng['customer']['letsencrypt']['title'],
						'desc' => $lng['customer']['letsencrypt']['description'],
						'type' => 'checkbox',
						'value' => '1',
						'checked' => false
					),
					'http2' => array(
						'visible' => ($ssl_ipsandports ? true : false) && \Froxlor\Settings::Get('system.webserver') != 'lighttpd' && \Froxlor\Settings::Get('system.http2_support') == '1',
						'label' => $lng['admin']['domain_http2']['title'],
						'desc' => $lng['admin']['domain_http2']['description'],
						'type' => 'checkbox',
						'value' => '1',
						'checked' => false
					),
					'hsts_maxage' => array(
						'label' => $lng['admin']['domain_hsts_maxage']['title'],
						'desc' => $lng['admin']['domain_hsts_maxage']['description'],
						'type' => 'number',
						'min' => 0,
						'max' => 94608000, // 3-years
						'value' => 0
					),
					'hsts_sub' => array(
						'label' => $lng['admin']['domain_hsts_incsub']['title'],
						'desc' => $lng['admin']['domain_hsts_incsub']['description'],
						'type' => 'checkbox',
						'value' => '1',
						'checked' => false
					),
					'hsts_preload' => array(
						'label' => $lng['admin']['domain_hsts_preload']['title'],
						'desc' => $lng['admin']['domain_hsts_preload']['description'],
						'type' => 'checkbox',
						'value' => '1',
						'checked' => false
					)
				)
			)
		)
	)
);
