<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\includes;

class helper
{
	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Helper constructor.
	 *
	 * @param string $root_path
	 * @param string $php_ext
	 *
	 * @return void
	 */
	public function __construct($root_path, $php_ext)
	{
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * Insert template variables in ACP.
	 *
	 * @param array		$display_vars
	 * @param string	$mode
	 *
	 * @return array
	 */
	public function acp_configuration($display_vars = [], $mode = '')
	{
		if (empty($display_vars) || empty($display_vars['vars']) || empty($mode))
		{
			return [];
		}

		// Common field options
		$options = [
			'validate' => 'bool',
			'type' => 'radio:yes_no',
			'explain' => false
		];

		if (!function_exists('phpbb_insert_config_array'))
		{
			include($this->root_path . 'includes/functions_acp.' . $this->php_ext);
		}

		switch ($mode)
		{
			case 'features':
				$display_vars['vars'] = phpbb_insert_config_array(
					$display_vars['vars'],
					[
						'allow_markdown' => array_merge(
							$options,
							['lang' => 'ALLOW_MARKDOWN']
						)
					],
					['before' => 'allow_bbcode']
				);
			break;

			case 'post':
				$display_vars['vars'] = phpbb_insert_config_array(
					$display_vars['vars'],
					[
						'allow_post_markdown' => array_merge(
							$options,
							['lang' => 'ALLOW_POST_MARKDOWN']
						)
					],
					['before' => 'allow_bbcode']
				);
			break;

			case 'message':
				$display_vars['vars'] = phpbb_insert_config_array(
					$display_vars['vars'],
					[
						'allow_pm_markdown' => array_merge(
							$options,
							['lang' => 'ALLOW_PM_MARKDOWN']
						)
					],
					['before' => 'auth_bbcode_pm']
				);
			break;

			case 'signature':
				$display_vars['vars'] = phpbb_insert_config_array(
					$display_vars['vars'],
					[
						'allow_sig_markdown' => array_merge(
							$options,
							['lang' => 'ALLOW_SIG_MARKDOWN']
						)
					],
					['before' => 'allow_sig_bbcode']
				);
			break;
		}

		return $display_vars;
	}
}
