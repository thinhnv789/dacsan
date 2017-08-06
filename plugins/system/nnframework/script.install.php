<?php
/**
 * @package         NoNumber Framework
 * @version         16.12.3209
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2016 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

if (!class_exists('PlgSystemNNFrameworkInstallerScript'))
{
	class PlgSystemNNFrameworkInstallerScript
	{
		public function preflight($route, JAdapterInstance $adapter)
		{
			if (!in_array($route, array('install', 'update')))
			{
				return;
			}

			if (!$this->isNewer())
			{
				return false;
			}
		}

		public function postflight($route, JAdapterInstance $adapter)
		{
			$this->removeGlobalLanguageFiles();
			$this->removeUnusedLanguageFiles();

			JFactory::getLanguage()->load('plg_system_nnframework', $this->getMainFolder());

			if (!in_array($route, array('install', 'update')))
			{
				return;
			}

			$this->removeNoNumberCache();

			if ($route == 'install')
			{
				$this->publishExtension();
			}

			JFactory::getCache()->clean('_system');
		}

		private function getMainFolder()
		{
			return JPATH_SITE . '/plugins/system/nnframework';
		}

		private function getInstalledXMLFile()
		{
			return $this->getMainFolder() . '/nnframework.xml';
		}

		private function getCurrentXMLFile()
		{
			return __DIR__ . '/nnframework.xml';
		}

		private function publishExtension()
		{
			$this->publishPlugin();
		}

		private function publishPlugin()
		{
			$db = JFactory::getDbo();

			$query = $db->getQuery(true)
				->update('#__extensions')
				->set($db->quoteName('enabled') . ' = 1')
				->where($db->quoteName('type') . ' = ' . $db->quote('plugin'))
				->where($db->quoteName('folder') . ' = ' . $db->quote('system'))
				->where($db->quoteName('element') . ' = ' . $db->quote('nnframework'));

			$db->setQuery($query);
			$db->execute();
		}

		private function getVersion($file = '')
		{
			$file = $file ?: $this->getCurrentXMLFile();

			if (!is_file($file))
			{
				return '';
			}

			$xml = JApplicationHelper::parseXMLInstallFile($file);

			if (!$xml || !isset($xml['version']))
			{
				return '';
			}

			return $xml['version'];
		}

		private function isNewer()
		{
			if (!$installed_version = $this->getVersion($this->getInstalledXMLFile()))
			{
				return true;
			}

			$package_version = $this->getVersion();

			return version_compare($installed_version, $package_version, '<=');
		}

		private function deleteFolders($folders = array())
		{
			foreach ($folders as $folder)
			{
				if (!is_dir($folder))
				{
					continue;
				}

				JFolder::delete($folder);
			}
		}

		private function removeNoNumberCache()
		{
			$this->deleteFolders(array(JPATH_ADMINISTRATOR . '/cache/nonumber'));
		}

		private function removeGlobalLanguageFiles()
		{
			$language_files = JFolder::files(JPATH_ADMINISTRATOR . '/language', '\.plg_system_nnframework\.', true, true);

			// Remove override files
			foreach ($language_files as $i => $language_file)
			{
				if (strpos($language_file, '/overrides/') === false)
				{
					continue;
				}

				unset($language_files[$i]);
			}

			if (empty($language_files))
			{
				return;
			}

			JFile::delete($language_files);
		}

		private function removeUnusedLanguageFiles()
		{
			$installed_languages = array_merge(
				JFolder::folders(JPATH_SITE . '/language'),
				JFolder::folders(JPATH_ADMINISTRATOR . '/language')
			);

			$languages = array_diff(
				JFolder::folders(__DIR__ . '/language'),
				$installed_languages
			);

			$delete_languages = array();

			foreach ($languages as $language)
			{
				$delete_languages[] = $this->getMainFolder() . '/language/' . $language;
			}

			if (empty($delete_languages))
			{
				return;
			}

			// Remove folders
			$this->deleteFolders($delete_languages);
		}
	}
}
