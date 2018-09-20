<?php define('PASSWORD', 'iszpsqgf37&w%iy'); ?>
<?php define('KICKSTARTVERSION','2.4'); ?>
<?php
/**
 * @package JoomlaPack
 * @subpackage Kickstart
 * @author JoomlaPack Developers
 * @copyright Copyright (c)2008-2009 JoomlaPack Developers
 * @license GNU General Public License, version 2 or later
 *
 * A script to help you extract a JoomlaPack-generated (split or single part) ZIP
 * or JPA archive and perform some pre- and post-installation housekeeping for you.
 */

define('SCRIPTNAME',	'kickstart.php');
//define('SCRIPTNAME',	basename(__FILE__));// If you have renamed this script, please update this!
// Note on SCRIPTNAME: Normally, it should pick up the correct filename automatically. However,
// on some *broken* hosts, you'll have to change the line above to something like:
// define('SCRIPTNAME',	'kickstart.php');

/*
 * Uncomment the following line and set the password value to something more
 * secret to enable Kickstart's Password Protection feature. If enabled, it
 * asks for the password before showing the main page (archive selection and
 * options).
 *
 * WARNING! This is not a very secure measure. If an attacker knows the
 * archive's name, she will be able to bypass this protection scheme. The
 * whole idea is to prevent the attacker from figuring out the archive file
 * name.
 */
//define('PASSWORD', '1234');					// Password to access the main page

/*
 * The following options control Kickstart's Auto Mode which is deprecated since
 * 2.4.b1. Please read Kickstart's section of the JoomlaPack User Guide and
 * the JoomlaPack Installer 4 section of the same User Guide for more
 * information.
 * 
 * Kickstart in manual mode (what 95% of people will ever use) is still compatible
 * with all JoomlaPack Installer versions.
 * 
 * -----------------------------------------------------------------------------
 * WARNING! WARNING! WARNING! WARNING! WARNING! WARNING! WARNING! WARNING!
 * -----------------------------------------------------------------------------
 * This works ONLY with JPI3! Automation for JPI4 will use an INI file when
 * implemented and this section will be obsoleted. IN OTHER WORDS, THIS
 * W I L L   N O T   W O R K   W I T H   J P I 4   (JoomlaPack 2.3.b1 and above)  
 * -----------------------------------------------------------------------------
 * WARNING! WARNING! WARNING! WARNING! WARNING! WARNING! WARNING! WARNING!  
 * -----------------------------------------------------------------------------
 * 
 * The following section enables and configures Kickstart's "single-click
 * restoration" feature, officially known as "Auto Mode". When enabled,
 * the backup archive will be extracted, JPI3 will be launched automatically
 * and it will step through the whole restoration procedure without any
 * further operator intervention.
 * 
 * THIS ONLY WORKS WITH JPI3!!! IT WILL *FAIL* WITH JPI4! DO NOT ASK FOR HELP
 * IF YOU TRY TO USE THIS WITH JPI4 AS IT SUPPOSED TO NOT WORK, BY DESIGN!
 *
 * WARNING! THIS FEATURE IS DESIGNED TO BE USED BY WEB PROFESSIONALS AND
 * ONLY IN CONJUNCTION WITH ARCHIVES EMBEDDING JOOMLAPACK INSTALLER 3.
 * ANY OTHER INSTALLER WILL CAUSE INSTALLATION FAILURE. YOU SHOULD ALSO
 * NOTE THAT THIS CAN POTENTIALLY DAMAGE YOUR SITE IF USED WITHOUT CAUTION!
 *
 * Did I stress that enough? I hope so. OK, that being said, here you go...
 */
define('AUTOMODE', 0); 		 // Change this to 1 to enable "Auto Mode"
define('DBhostname',	''); // Database server host name
define('DBname',		''); // Database name
define('DBPrefix',		''); // Database prefix, e.g. jos_
define('DBuserName',	''); // Username of database user
define('DBpassword',	''); // Password of database user
define('DBfilename',	'joomla.sql'); // Filename of site's database dump; it should not be changed for now

define('_JEXEC', 1);
?><?php
// ==========================================================================================
// KS: Translate - Translation engine for Kickstart
// ==========================================================================================

class Language
{
	/**
	 * The default (en_GB) translation used when no other translation is available
	 * @var array
	 */
	var $_default_translation = array(
	// application.php
		'UNEXPECTED_EXTENSION'			=> 'Unexpected file type %s encountered; this should never happen!',
		'UNLINKING_FILE'				=> "Unlinking file %s<br/>",
	// ftp.php
		'WRONG_FTP_HOST'				=> 'Wrong FTP host or port',
		'WRONG_FTP_USER'				=> 'Wrong FTP username or password',
		'WRONG_FTP_PATH1'				=> 'Wrong FTP initial directory; the directory doesn\'t exist',
		'WRONG_FTP_PATH2'				=> 'Wrong FTP initial directory; the directory is not the one %s resides in!',
		'FTP_CANT_CREATE_DIR'			=> 'Could not create directory %s',
		'FTP_COULDNT_UPLOAD'			=> 'Could not upload %s',
	// model.php
		'NO_ARCHIVES'					=> "There are no ZIP/JPA files in the current directory?!",
		'SELECT_ARCHIVE'				=> 'Please select a ZIP/JPA file below and press the &quot;Start&quot; button.',
	// unjpa.php & unzip.php
		'COULDNT_CREATE_DIR'			=> "Could not create %s folder",
		'COULDNT_WRITE_FILE'			=> "Could not open %s for writing.",
		'COULDNT_READ_FILE'				=> "Could not open %s for reading. Check permissions?",
		'NOT_EXISTS'					=> "File %s does not exist.",
	// view.php
		'AUTH_REQ'						=> 'Authentication Required',
		'SUPPLY_PASS'					=> 'Please supply the password to proceed with backup extraction and restoration',
		'AUTHENTICATE'					=> 'Authenticate',
		'BACKUP_ARCHIVE'				=> 'Backup Archive',
		'START'							=> 'Start',
		'OPERATION_MODE'				=> 'Operation Method',
		'MODE_AJAX'						=> 'AJAX (refreshless)',
		'MODE_REDIRECTS'				=> 'JavaScript Redirects',
		'EXTRACTION_METHOD'				=> 'Extraction Method',
		'METHOD_FILES'					=> 'Write directly to files',
		'METHOD_FTP'					=> 'Use FTP',
		'FTP_OPTIONS'					=> 'FTP Options',
		'FTP_HOST'						=> 'Host',
		'FTP_PORT'						=> 'Port',
		'FTP_USER'						=> 'Username',
		'FTP_PASSWORD'					=> 'Password',
		'FTP_DIRECTORY'					=> 'Initial Directory',
		'BYTES_READ'					=> 'Read',
		'BYTES_WRITTEN'					=> 'Written',
		'FILES_PROCESSED'				=> 'Processed',
		'HTML_HERE'						=> 'here',
		'HTML_CLICK1'					=> 'Please click %s to open JoomlaPack Installer restore script in a new window.',
		'HTML_DONT_CLOSE'				=> 'DO NOT CLOSE THIS WINDOW!!',
		'HTML_CLICK2'					=> 'When you have finished restoring your site please click %s to activate your .htaccess (if you had one in the first place) and delete the backup archive and this script.',
		'HTML_AUTO1'					=> "&quot;Auto-mode&quot; is in use. JPI3 will be automatically launched, your site's database restored and configuration.php updated. When JPI3 is done it will close its window and you'll get back here. At that point, please click %s to activate your .htaccess (if you had one in the first place) and delete the backup archive and this script.",
		'HTML_AUTO2'					=> 'DO NOT CLOSE THIS WINDOW BEFORE JPI3 IS DONE!!',
		'HTML_AUTO3'					=> 'If the browser fails to open the window automatically, please click the button below.',
		'HTML_AUTO4'					=> 'Open the window manually',
		'ALL_DONE'						=> 'All Done',
		'KICKSTART_FINISHED'			=> 'Kickstart has finished',
		'COPYRIGHT'						=> 'Copyright',
		'LICENSE'						=> 'JoomlaPack KickStart is Free Software, distributed under the terms of the <a href="http://www.gnu.org/licenses/old-licenses/gpl-2.0.html">GNU General Public License, version 2</a> or later.',
		'RESTOREPERMS'					=> 'Restore file/directory permissions (JPA archives only)',
		'STEALTHMODEHEAD'				=> 'Stealth Mode',
		'STEALTHMODE'					=> 'Stealth mode (restrict access only to your IP while restoring)',
		'STEALTHURL'					=> 'Stealth Mode redirection URL<br />(or leave blank to display a 403 Forbidden message to non authorized users)',
		'FINETUNING'					=> 'Fine Tuning',
		'MAXBATCHSIZE'					=> 'Maximum archive chunk to process per step (Bytes)',
		'MAXBATCHFILES'					=> 'Maximum number of files to process at once',
		'MINEXECTIME'					=> 'Minimum execution time per step (milliseconds)',
		'TEMPDIR'					=> 'Temporary directory',
		'CHUNKSIZE'					=> 'Pass-through chunk size while extracting large files (bytes)',
	);

		/**
		 * The array holding the translation keys
		 * @var array
		 */
		var $_strings;

		/**
		 * The currently detected language (ISO code)
		 * @var string
		 */
		var $_language;

		/*
		 * Initializes the translation engine
		 * @return Language A Language object
		 */
		function Language()
		{
			$this->_getBrowserLanguage();
			if(!is_null($this->_language))
			{
				$this->_loadTranslation();
			}
			else
			{
				$this->_strings = $this->_default_translation;
			}
		}

		/**
		 * Singleton pattern for Language
		 * @return Language The global Language instance
		 */
		function &getInstance()
		{
			static $instance;

			if(!is_object($instance))
			{
				$instance = new Language();
			}

			return $instance;
		}

		function _($string)
		{
			$key = strtoupper($string);
			$key = substr($key, 0, 1) == '_' ? substr($key, 1) : $key;

			if (isset ($this->_strings[$key]))
			{
				$string = $this->_strings[$key];
			}
			else
			{
				if (defined($string))
				{
					$string = constant($string);
				}
			}

			return $string;
		}

		function sprintf($key)
		{
			$args = func_get_args();
			if (count($args) > 0) {
				$args[0] = $this->_($args[0]);
				return @call_user_func_array('sprintf', $args);
			}
			return '';
		}

		function dumpLanguage()
		{
			$out = '';
			foreach($this->_strings as $key => $value)
			{
				$out .= "$key=$value\n";
			}
			return $out;
		}

		function resetTranslation()
		{
			$this->_strings = $this->_default_translation;
		}

		function _getBrowserLanguage()
		{
			// Detection code from Full Operating system language detection, by Harald Hope
			// Retrieved from http://techpatterns.com/downloads/php_language_detection.php
			$user_languages = array();
			//check to see if language is set
			if ( isset( $_SERVER["HTTP_ACCEPT_LANGUAGE"] ) )
			{
				$languages = strtolower( $_SERVER["HTTP_ACCEPT_LANGUAGE"] );
				// $languages = ' fr-ch;q=0.3, da, en-us;q=0.8, en;q=0.5, fr;q=0.3';
				// need to remove spaces from strings to avoid error
				$languages = str_replace( ' ', '', $languages );
				$languages = explode( ",", $languages );

				foreach ( $languages as $language_list )
				{
					// pull out the language, place languages into array of full and primary
					// string structure:
					$temp_array = array();
					// slice out the part before ; on first step, the part before - on second, place into array
					$temp_array[0] = substr( $language_list, 0, strcspn( $language_list, ';' ) );//full language
					$temp_array[1] = substr( $language_list, 0, 2 );// cut out primary language
					if( (strlen($temp_array[0]) == 5) && ( (substr($temp_array[0],2,1) == '-') || (substr($temp_array[0],2,1) == '_') ) )
					{
						$langLocation = strtoupper(substr($temp_array[0],3,2));
						$temp_array[0] = $temp_array[1].'-'.$langLocation;
					}
					//place this array into main $user_languages language array
					$user_languages[] = $temp_array;
				}
			}
			else// if no languages found
			{
				$user_languages[0] = array( '','' ); //return blank array.
			}

			$this->_language = null;
			// First scan for full languages
			$basename=basename(__FILE__, '.php') . '.ini';
			foreach($user_languages as $languageStruct)
			{
				if (@file_exists($languageStruct[0].'.'.$basename) && is_null($this->_language)) {
					$this->_language = $languageStruct[0];
				}
			}

			// If we matched a full filename, there's no point going on
			if(!is_null($this->_language)) return;

			// Try to match main language part of the filename, irrespective of the location, e.g. de_DE will do if de_CH doesn't exist.
			$fs = new JoomlapackListerAbstraction();
			$iniFiles = $fs->getDirContents( '.', '*.'.$basename );
			if (!is_array($iniFiles)) return; // Get out of here if no Kickstart Translation INI's were found

			foreach($user_languages as $languageStruct)
			{
				if(is_null($this->_language))
				{
					// Get files matching the main lang part
					$iniFiles = $fs->getDirContents( '.', $languageStruct[1].'-??.'.$basename );
					if (count($iniFiles) > 0) {
						$this->_language = substr(basename($iniFiles[0]['name']), 0, 5);
					}
					else
					$this->_language = null;
				}
			}
		}

		function _loadTranslation()
		{
			$basename=basename(__FILE__, '.php') . '.ini';
			$this->_strings = $this->_parse_ini_file($this->_language.'.'.$basename, false);
			if(count($this->_strings) != count($this->_default_translation))
			{
				$this->_strings = array_merge($this->_default_translation, $this->_strings);
			}
		}

		/**
		 * A PHP based INI file parser.
		 *
		 * Thanks to asohn ~at~ aircanopy ~dot~ net for posting this handy function on
		 * the parse_ini_file page on http://gr.php.net/parse_ini_file
		 *
		 * @param string $file Filename to process
		 * @param bool $process_sections True to also process INI sections
		 * @return array An associative array of sections, keys and values
		 * @access private
		 */
		function _parse_ini_file($file, $process_sections = false)
		{
			$process_sections = ($process_sections !== true) ? false : true;

			$ini = @file($file);
			if (count($ini) == 0) {return array();}

			$sections = array();
			$values = array();
			$result = array();
			$globals = array();
			$i = 0;
			foreach ($ini as $line) {
				$line = trim($line);
				$line = str_replace("\t", " ", $line);

				// Comments
				if (!preg_match('/^[a-zA-Z0-9[]/', $line)) {continue;}

				// Sections
				if ($line{0} == '[') {
					$tmp = explode(']', $line);
					$sections[] = trim(substr($tmp[0], 1));
					$i++;
					continue;
				}

				// Key-value pair
				list($key, $value) = explode('=', $line, 2);
				$key = trim($key);
				$value = trim($value);
				if (strstr($value, ";")) {
					$tmp = explode(';', $value);
					if (count($tmp) == 2) {
						if ((($value{0} != '"') && ($value{0} != "'")) ||
						preg_match('/^".*"\s*;/', $value) || preg_match('/^".*;[^"]*$/', $value) ||
						preg_match("/^'.*'\s*;/", $value) || preg_match("/^'.*;[^']*$/", $value) ){
							$value = $tmp[0];
						}
					} else {
						if ($value{0} == '"') {
							$value = preg_replace('/^"(.*)".*/', '$1', $value);
						} elseif ($value{0} == "'") {
							$value = preg_replace("/^'(.*)'.*/", '$1', $value);
						} else {
							$value = $tmp[0];
						}
					}
				}
				$value = trim($value);
				$value = trim($value, "'\"");

				if ($i == 0) {
					if (substr($line, -1, 2) == '[]') {
						$globals[$key][] = $value;
					} else {
						$globals[$key] = $value;
					}
				} else {
					if (substr($line, -1, 2) == '[]') {
						$values[$i-1][$key][] = $value;
					} else {
						$values[$i-1][$key] = $value;
					}
				}
			}

			for($j = 0; $j < $i; $j++) {
				if ($process_sections === true) {
					$result[$sections[$j]] = $values[$j];
				} else {
					$result[] = $values[$j];
				}
			}

			return $result + $globals;
		}
}

class Text
{
	function _($string)
	{
		$lang =& Language::getInstance();
		return $lang->_($string);
	}

	function sprintf($key, $value)
	{
		$args = func_get_args();
		if (count($args) > 1) {
			$args[0] = Text::_($args[0]);
			return call_user_func_array('sprintf', $args);
		}
		return '';
	}
}

class JText
{
	function _($string)
	{
		return Text::_($string);
	}
	
	function sprintf($key, $value)
	{
		return Text::sprintf($key, $value);
	}
}
?><?php
// ==========================================================================================
// KS: IIS missing REQUEST_URI workaround
// ==========================================================================================

/*
 * Based REQUEST_URI for IIS Servers 1.0 by NeoSmart Technologies
 * The proper method to solve IIS problems is to take a look at this:
 * http://neosmart.net/dl.php?id=7
 */

//This file should be located in the same directory as php.exe or php5isapi.dll

if (!isset($_SERVER['REQUEST_URI']))
{
	if (isset($_SERVER['HTTP_REQUEST_URI']))
	{
		$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_REQUEST_URI'];
		//Good to go!
	}
	else
	{
		//Someone didn't follow the instructions!
		if(isset($_SERVER['SCRIPT_NAME']))
		$_SERVER['HTTP_REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
		else
		$_SERVER['HTTP_REQUEST_URI'] = $_SERVER['PHP_SELF'];
		if($_SERVER['QUERY_STRING']){
			$_SERVER['HTTP_REQUEST_URI'] .=  '?' . $_SERVER['QUERY_STRING'];
		}
		//WARNING: This is a workaround!
		//For guaranteed compatibility, HTTP_REQUEST_URI *MUST* be defined!
		//See product documentation for instructions!
		$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_REQUEST_URI'];
	}
}
?><?php

// Protect from direct execution
defined('_JEXEC') or die('Restricted Access');

/**
 * The parent class of JoomlaPack's archive extraction classes
 * @author Nicholas K. Dionysopoulos
 */
class UnarchiverParent
{
	// Variables set in the configuration
	
	/** @var string The archive's filename */
	var $_filename;
	
	/** @var bool Should we try to restore permissions? */
	var $_flagRestorePermissions = false;
	
	/** @var bool Should we attempt to use FTP mode? If so, we need the FTP class to be set as well */
	var $_flagUseFTP = false;
	
	/** @var string A path to prepend to all stored names */
	var $_addPath = '';
	
	/** @var object An FTP class used for FTP operations */
	var $_ftp = null;
	
	/** @var Array An associative array holding mappings of filenames which should be renamed */
	var $_renameFiles = array();
	
	/** @var Array An indexed array of files which should be skipped during extraction */
	var $_skipFiles = array();
	
	/** @var bool Should I use the JText translation class? */
	var $_flagTranslate = false;
	
	/** @var int Chunk size for uncompressed file copying operations */
	var $_chunkSize = 524288;
	
	// Internal variables
	
	/** @var int The current part number we are reading from */
	var $_currentPart = '';
	
	/** @var bool Did we encounter an error? */
	var $_isError = false;
	
	/** @var string The latest error message */
	var $_error = '';
	
	/** @var Array A hash array of archive parts and their sizes */
	var $_archiveList = array();
	
	/** @var int Total size of archive's parts */
	var $_totalSize = 0;
	
	/** @var resource File pointer to the current part we are reading from */
	var $_fp;
	
	/**
	 * Object constructor for PHP 4 installations
	 * @return UnarchiverAbstract
	 */
	function UnarchiverParent()
	{
		$args = func_get_args();
		call_user_func_array(array(&$this, '__construct'), $args);		
	}
	
	function Extract( $offset = null )
	{
		// Placeholder; implemented in descending classes
		return false;
	}
	
	function getError()
	{
		if(!empty($this->_error))
		{
			return $this->_error;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Public constructor. Takes an associative array of parameters as input.
	 * @param $options An array of options
	 * @return UnarchiverAbstract
	 */
	function __construct( $options = array() )
	{
		if( count($options) > 0 )
		{
			foreach($options as $key => $value)
			{
				switch($key)
				{
					case 'filename': // Archive's absolute filename
						$this->_filename = $value;
						break;
						
					case 'restore_permissions': // Should I restore permissions?
						$this->_flagRestorePermissions = $value;
						break;
						
					case 'use_ftp': // Should I use FTP?
						$this->_flagUseFTP = $value;
						break;
						
					case 'add_path': // Path to prepend
						$this->_addPath = $value;
						break;

					case 'ftp': // The FTP obejct
						$this->_ftp = $value;
						break;
						
					case 'rename_files': // Which files to rename (hash array)
						$this->_renameFiles = $value;
						break;

					case 'skip_files': // Which files to skip (indexed array)
						$this->_skipFiles = $value;
						break;
						
					case 'translate': // SHould I use the JText translation class?
						$this->_flagTranslate = $value;
						break;
				}				
			}
		}
		
		// Get information about the parts
		$this->_scanArchives();
	}
	
	/**
	 * Returns the base extension of the archive file
	 * @return string The base extension, e.g. '.zip'
	 */
	function _getBaseExtension()
	{
		static $baseextension;
		
		if(empty($baseextension))
		{
			$basename = basename($this->_filename);
			$lastdot = strrpos($basename,'.');
			$baseextension = substr($basename, $lastdot);
		}
		
		return $baseextension;
	}
	
	/**
	 * Scans for multiple parts of an archive set
	 */
	function _scanArchives()
	{
		// Get the components of the archive filename
		$dirname = dirname($this->_filename);
		$base_extension = $this->_getBaseExtension();
		$basename = basename($this->_filename, $base_extension);

		// Scan for multiple parts until we don't find any more of them
		$count = 0;
		$found = true;
		$this->_archiveList = array();
		$totalsize = -1;
		while($found)
		{
			$count++;
			$extension = substr($base_extension, 0, 2).sprintf('%02d', $count);
			$filename = $dirname.DIRECTORY_SEPARATOR.$basename.$extension;
			$found = file_exists($filename);
			if($found)
			{
				// Add yet another part, with a numeric-appended filename
				$rec['name'] = $filename;
				$rec['size'] = @filesize($filename);
			}
			else
			{
				// Add the last part, with the regular extension
				$rec['name'] = $this->_filename;
				$rec['size'] = @filesize($this->_filename);
			}
			$rec['start'] = $totalsize + 1;
			$rec['end'] = $rec['start'] + $rec['size'] - 1;
			$totalsize = $rec['end'];
			$this->_archiveList[$count] = $rec;
		}
		
		$this->_totalSize = $totalsize;
		$this->_currentPart = 1; // Default to start reading from the first part
	}
	
	/**
	 * Makes sure that the _fp variable points to the correct file for a given
	 * offset (relative to the beginning of the first file in a split archive set)
	 * and sets the _currentPart accordingly and skips to the correct offset
	 * @return bool True if we could skip to the offset, false otherwise
	 */
	function _skipToOffset( $offset )
	{
		// Let's find in which archive this offset starts
		$found = false;
		$count = 0;
		while( (!$found) && ($count < count($this->_archiveList)) )
		{
			$count++;
			$found = ($this->_archiveList[$count]['start'] <= $offset) &&
					 ($this->_archiveList[$count]['end'] >= $offset);
		}
		
		// Do we have the correct part set?
		if($this->_currentPart != $count)
		{
			// No, set it and mark that we should open the file pointer
			$this->_currentPart = $count;
			$mustOpen = true;	
		}
		else
		{
			// We are on the correct part. Is it open yet?
			$mustOpen = !is_resource($this->_fp);
		}
		
		// Open the part if we have to
		if($mustOpen)
		{
			if(is_resource($this->_fp)) @fclose($this->_fp);
			$this->_fp = @fopen($this->_archiveList[$this->_currentPart]['name'], 'rb');
			if($this->_fp === false) return false;
		}
		
		// Calculate the relative offset
		$relative_offset = $offset - $this->_archiveList[$this->_currentPart]['start'];
		@fseek($this->_fp, $relative_offset);
		
		return true;
	}
	
	/**
	 * Returns the absolute offset (relative to the start of the first part) or
	 * false if this value is not recoverable
	 * @return int|bool The absolute offset, or false if it failed
	 */
	function _getOffset()
	{
		if(is_resource($this->_fp))
		{
			clearstatcache();
			$relative_offset = @ftell($this->_fp);
			if($relative_offset === false) return false;
			return $relative_offset + $this->_archiveList[$this->_currentPart]['start'];
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Sets the _fp file pointer reference to the next file of a split archive
	 * set and updates the _currentPart accordingly
	 * 
	 * @return bool True if successful, false otherwise
	 */
	function _getNextFile()
	{
		if($this->_currentPart < count($this->_archiveList) )
		{
			return $this->_skipToOffset( $this->_archiveList[$this->_currentPart]['end'] + 1 );
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Returns true if we have reached the end of file
	 * @param $local bool True to return EOF of the local file, false (default) to return if we have reached the end of the archive set
	 * @return bool True if we have reached End Of File
	 */
	function _isEOF($local = false)
	{
		$eof = @feof($this->_fp);
		if($local)
		{
			return $eof;
		}
		else
		{
			return $eof && ($this->_currentPart == count($this->_archiveList) );
		}
	}
	
	/**
	 * Tries to make a directory user-writable so that we can write a file to it
	 * @param $path string A path to a file
	 */
	function _setCorrectPermissions($path)
	{
		$directory = dirname($path);

		if(!$this->_flagUseFTP)
		{
			// Direct file writes mode
			if(!is_dir($directory)) return; // Catch not-a-directory cases
			// Get directories and modify owner permissions to read-write-execute
			$perms = decoct(@fileperms($directory));
			$digit = strlen($perms) == 3 ? 0 : (strlen($perms) == 4 ? 1 : 2);
			$perms = substr_replace($perms, '7', $digit, 1);
			@chmod( $directory, octdec($perms) );
			// Also try to chmod the file itself to 0777 if it exists (in order to allow overwriting)
			@chmod( $path, 0777 );
		}
		else
		{
			// FTP mode
			// As a crappy workaround, I default to 0755 permissions. Oh, well...
			$this->_ftp->chmod($directory, 0755);
			$this->_ftp->chmod($path, 0777);
		}
	}
	
	/**
	 * Tries to recursively create the directory $dirName
	 *
	 * @param string $dirName The directory to create
	 * @return boolean TRUE on success, FALSE on failure
	 * @access private
	 */
	function _createDirRecursive( $dirName )
	{
		$dirArray = explode('/', $dirName);
		$path = '';
		foreach( $dirArray as $dir )
		{
			$path .= $dir . '/';
			$ret = is_dir($path) ? true : @mkdir($path);
			if( !$ret ) {
				$this->_isError = true;
				if($this->_flagTranslate)
				{
					$this->_error = JText::sprintf('COULDNT_CREATE_DIR',$path);
				}
				else
				{
					$this->_error = 'Could not create directory '.$path;
				}
				return false;
			}
			// Try to set new directory permissions to 0755
			@chmod($path, 0755);
		}
		return true;
	}
}
?><?php
// Protect from direct execution
defined('_JEXEC') or die('Restricted Access');

class CSimpleUnzip extends UnarchiverParent
{
	/**
	 * Extracts a file from the ZIP archive
	 *
	 * @param integer $offset The offset to start extracting from. If ommited, or set to null,
	 * it continues from the ZIP file's current location.
	 * @return array|boolean A return array or FALSE if an error occured
	 */
	
	function Extract( $offset = null )
	{
		global $ftp;

		// This flag is set to true when a "banned" filename is detected
		$isBannedFile = false;
		
		// Generate a return array
		$retArray = array(
			"file"				=> '',		// File name extracted
			"compressed"		=> 0,		// Compressed size
			"uncompressed"		=> 0,		// Uncompressed size
			"type"				=> "file",	// File type (file | dir | link)
			"offset"			=> 0,		// Offset in ZIP file
			"done"				=> false	// Are we done with extracting files?
		);
		
		if( is_null($offset) ) $offset = 0;
		$this->_skipToOffset($offset);
		
		// Get and decode Local File Header
		$headerBinary = fread($this->_fp, 30);
		$headerData = unpack('Vsig/C2ver/vbitflag/vcompmethod/vlastmodtime/vlastmoddate/Vcrc/Vcompsize/Vuncomp/vfnamelen/veflen', $headerBinary);
		
		// If the signature is 
		$multiPartSigs = array( 0x08074b50, 0x30304b50 );
		if( in_array($headerData['sig'], $multiPartSigs) )
		{
			// Skip four bytes ahead and re-read the header
			$this->_skipToOffset($offset + 4);
			$headerBinary = fread($this->_fp, 30);
			$headerData = unpack('Vsig/C2ver/vbitflag/vcompmethod/vlastmodtime/vlastmoddate/Vcrc/Vcompsize/Vuncomp/vfnamelen/veflen', $headerBinary);
		}
		
		if( $headerData['sig'] == 0x04034b50 )
		{
			// This is a file header. Get basic parameters.
			$retArray['compressed']		= $headerData['compsize'];
			$retArray['uncompressed']	= $headerData['uncomp'];
			$nameFieldLength			= $headerData['fnamelen'];
			$extraFieldLength			= $headerData['eflen'];
			
			// Read filename field
			$retArray['file']			= fread( $this->_fp, $nameFieldLength );

			// Handle file renaming
			if(is_array($this->_renameFiles) && (count($this->_renameFiles) > 0) )
			{
				if(array_key_exists($retArray['file'], $this->_renameFiles))
				{
					$retArray['file'] = $this->_renameFiles[$retArray['file']];
				}
			}
			
			// Read extra field if present
			if($extraFieldLength > 0) $extrafield = fread( $this->_fp, $extraFieldLength );

			// Decide filetype -- Check for directories
			if( strrpos($retArray['file'], '/') == strlen($retArray['file']) - 1 ) $retArray['type'] = 'dir';
			// Decide filetype -- Check for symbolic links
			
			if( ($headerData['ver1'] == 10) && ($headerData['ver2'] == 3) ) $retArray['type'] = 'link';
			
			// Do we need to create the directory?
			if(strpos($retArray['file'], '/') !== false) {
				$lastSlash = strrpos($retArray['file'], '/');
				$dirName = substr( $retArray['file'], 0, $lastSlash);
				if(!$this->_flagUseFTP)
				{
					if( $this->_createDirRecursive($dirName) == false ) {
						$this->_isError = true;
						if($this->_flagTranslate)
						{
							$this->_error = JText::sprintf('COULDNT_CREATE_DIR', $dirName);
						}
						else
						{
							$this->_error = 'Could not create directory '.$dirName;
						}
						return false;
					}
				}
				else
				{
					if( $this->_ftp->makeDirectory($dirName) == false ) {
						$this->_isError = true;
						if($this->_flagTranslate)
						{
							$this->_error = JText::sprintf('COULDNT_CREATE_DIR', $dirName);
						}
						else
						{
							$this->_error = 'Could not create directory '.$dirName;
						}
						return false;
					}
				}
			}

			// Find hard-coded banned files (. and .. MUST NOT be attempted to be restored!)
			if( (basename($retArray['file']) == ".") || (basename($retArray['file']) == "..") )
			{
				$isBannedFile = true;
			}
			
			// Also try to find banned files passed in class configuration
			if(count($this->_skipFiles) > 0)
			{
				if(in_array($retArray['file'], $this->_skipFiles))
				{
					$isBannedFile = true;
				}
			}
			
			// If we have a banned file, let's skip it
			if($isBannedFile)
			{
				$retArray['offset'] = $this->_getOffset() + $retArray['uncompressed'];
				return $retArray;
			}
			
			// Last chance to prepend a path to the filename
			if(!empty($this->_addPath))
			{
				$last_addpath_char = substr($this->_addPath, -1);
				if( ($last_addpath_char == '\\') || $last_addpath_char == '/' )
				{
					$this->_addPath = substr($this->_addPath, 0, -1);
				}
				$retArray['file'] = $this->_addPath.'/'.$retArray['file'];
			}
			
			if( $headerData['compmethod'] == 8 )
			{
				// DEFLATE compression
				$zipData = fread( $this->_fp, $retArray['compressed'] );
				while( strlen($zipData) < $retArray['compressed'] )
				{
					// End of local file before reading all data, but have more archive parts?
					if($this->_isEOF(true) && !$this->_isEOF(false))
					{
						// Yeap. Read from the next file
						$this->_getNextFile();
						$bytes_left = $retArray['compressed'] - strlen($zipData);
						$zipData .= fread( $this->_fp, $bytes_left );
					}
					else
					{
						// Crap... this archive is corrupt
						// @todo Translate!
						$this->_error = 'Corrupt archive detected; can\'t continue';
						return false;
					}
				}
				$unzipData = gzinflate( $zipData );
				unset($zipData);

				// Try writing to the output file
				if(!$this->_flagUseFTP)
				{
					$outfp = @fopen( $retArray['file'], 'w' );
				}
				else
				{
					$tmpLocal = tempnam(TEMPDIR,'jpks');
					$outfp = @fopen( $tmpLocal, 'w' );
				}
				
				if( $outfp === false ) {
					// An error occured
					$this->_isError = true;
					// @todo Translate!
					$this->_error = "Could not open " . $retArray['file'] . " for writing.";
					return false;
				} else {
					// No error occured. Write to the file.
					fwrite( $outfp, $unzipData, $retArray['uncompressed'] );
					fclose( $outfp );
					if($this->_flagUseFTP)
					{
						$this->_ftp->uploadAndDelete($retArray['file'], $tmpLocal);
					}
					else
					{
						// Try to change file permissions to 0755
						@chmod($retArray['file'], 0755);
					}
				}
				unset($unzipData);
			}
			else
			{
				// Uncompressed data. Action depends on what type it is
				if( $retArray['type'] == "file" )
				{
					// No compression
					if( $retArray['uncompressed'] > 0 )
					{
						if(!$this->_flagUseFTP)
						{
							$outfp = @fopen( $retArray['file'], 'w' );
						}
						else
						{
							$tmpLocal = tempnam(TEMPDIR,'jpks');
							$outfp = @fopen( $tmpLocal, 'w' );
						}
						if( $outfp === false ) {
							// An error occured
							$this->_isError = true;
							if($this->_flagTranslate)
							{
								$this->_error = JText::sprintf('COULDNT_WRITE_FILE', $retArray['file']);
							}
							else
							{
								$this->_error = 'Could not write to file '.$retArray['file'];
							}
							
							return false;
						} else {
							$readBytes = 0;
							$toReadBytes = 0;
							$leftBytes = $retArray['compressed'];

							while( $leftBytes > 0)
							{
								$toReadBytes = ($leftBytes > $this->_chunkSize) ? $this->_chunkSize : $leftBytes;
								$data = fread( $this->_fp, $toReadBytes );
								$reallyReadBytes = strlen($data);
								$leftBytes -= $reallyReadBytes;
								if($reallyReadBytes < $toReadBytes)
								{
									// We read less than requested! Why? Did we hit local EOF?
									if( $this->_isEOF(true) && !$this->_isEOF(false) )
									{
										// Yeap. Let's go to the next file
										$this->_getNextFile();
									}
									else
									{
										// Nope. The archive is corrupt
										// @todo Translate!
										$this->_error = 'Corrupt archive detected; can\'t continue';
										return false;
									}
								}
								
								fwrite( $outfp, $data );
							}
							fclose($outfp);
							if($this->_flagUseFTP)
							{
								$this->_ftp->uploadAndDelete($retArray['file'], $tmpLocal);
							}
							else
							{
								// Try to change file permissions to 0755
								@chmod($retArray['file'], 0755);
							}
						}

					} else {
						// 0 byte file, just touch it
						if(!$this->_flagUseFTP)
						{
							$outfp = @fopen( $retArray['file'], 'w' );
						}
						else
						{
							$tmpLocal = tempnam(TEMPDIR,'jpks');
							$outfp = @fopen( $tmpLocal, 'w' );
						}
						if( $outfp === false ) {
							// An error occured
							$this->_isError = true;
							if($this->_flagTranslate)
							{
								$this->_error = Text::sprintf('COULDNT_WRITE_FILE', $retArray['file']);
							}
							else
							{
								$this->_error = 'Could not write to file '.$retArray['file'];
							}
							return false;
						} else {
							fclose($outfp);
							if($this->_flagUseFTP)
							{
								$ftp->uploadAndDelete($retArray['file'], $tmpLocal);
							}
							else
							{
								// Try to change file permissions to 0755
								@chmod($retArray['file'], 0755);
							}
						}

					}
				} else if( $retArray['type'] == "dir" ) {
					// Directory entry
					if(!$this->_flagUseFTP)
					{
						$result = $this->_createDirRecursive($dirName);
					}
					else
					{
						$result = $this->_ftp->makeDirectory($dirName);
					}
					if( !$result ) {
						return false;
					}
				} else if( $retArray['type'] == "link" ) {
					// Symbolic link
					$readBytes = 0;
					$toReadBytes = 0;
					$leftBytes = $retArray['compressed'];
					$data = '';

					while( $leftBytes > 0)
					{
						$toReadBytes = ($leftBytes > $this->_chunkSize) ? $this->_chunkSize : $leftBytes;
						$data .= fread( $this->_fp, $toReadBytes );
						$reallyReadBytes = strlen($data);
						$leftBytes -= $reallyReadBytes;
						if($reallyReadBytes < $toReadBytes)
						{
							// We read less than requested! Why? Did we hit local EOF?
							if( $this->_isEOF(true) && !$this->_isEOF(false) )
							{
								// Yeap. Let's go to the next file
								$this->_getNextFile();
							}
							else
							{
								// Nope. The archive is corrupt
								// @todo Translate!
								$this->_error = 'Corrupt archive detected; can\'t continue';
								return false;
							}
						}
					}

					// Try to remove an existing file or directory by the same name
					if(file_exists($retArray['file'])) { @unlink($retArray['file']); @rmdir($retArray['file']); }
					// Remove any trailing slash
					if(substr($retArray['file'], -1) == '/') $retArray['file'] = substr($retArray['file'], 0, -1);
					// Create the symlink
					@symlink($data, $retArray['file']);
				}
			}
			$retArray['offset'] = $this->_getOffset();
			return $retArray;
		} else {
			// This is not a file header. This means we are done.
			$retArray['done'] = true;
			return $retArray;
		}
		
	}
}
?><?php

class CUnJPA extends UnarchiverParent
{
	/**
	 * Data read from archive's header
	 * @var array
	 */
	var $headerData = array();

	/**
	 * Extracts a file from the JPA archive
	 *
	 * @param integer $offset The offset to start extracting from. If ommited, or set to null,
	 * it continues from the JPA file's current location.
	 * @return array|boolean A return array or FALSE if an error occured
	 */
	function Extract( $offset = null )
	{
		global $ftp;
		
		// This flag is set to true when a "banned" filename is detected
		$isBannedFile = false;
		
		// Generate a return array
		$retArray = array(
			"file"				=> '',		// File name extracted
			"compressed"		=> 0,		// Compressed size
			"uncompressed"		=> 0,		// Uncompressed size
			"type"				=> "file",	// File type (file | dir)
			"compression"		=> "none",	// Compression type (none | gzip | bzip2)
			"offset"			=> 0,			// Offset in JPA file
			"permissions"		=> 0,		// UNIX permissions stored in the archive
			"done"				=> false	// Are we done with extracting files?
		);
		
		$offset = is_null($offset) ? 0 : $offset;
		
		$this->_skipToOffset($offset);
		if($offset == 0) $this->_ReadHeader();
		
		// Get and decode Entity Description Block
		$signature = fread($this->_fp, 3);

		// Check signature
		if( $signature == 'JPF' )
		{
			// This a JPA Entity Block. Process the header.
				
			// Read length of EDB and of the Entity Path Data
			$length_array = unpack('vblocksize/vpathsize', fread($this->_fp, 4));
			// Read the path data
			$file = fread( $this->_fp, $length_array['pathsize'] );
				
			// Handle file renaming
			if(is_array($this->_renameFiles) && (count($this->_renameFiles) > 0) )
			{
				if(array_key_exists($file, $this->_renameFiles))
				{
					$file = $this->_renameFiles[$file];
				}
			}
			
			// Read and parse the known data portion
			$bin_data = fread( $this->_fp, 14 );
			$header_data = unpack('Ctype/Ccompression/Vcompsize/Vuncompsize/Vperms', $bin_data);
			// Read any unknwon data
			$restBytes = $length_array['blocksize'] - (21 + $length_array['pathsize']);
			if( $restBytes > 0 ) $junk = fread($this->_fp, $restBytes);
				
			$compressionType = $header_data['compression'];
				
			// Populate the return array
			$retArray['file'] = $file;
			$retArray['compressed'] = $header_data['compsize'];
			$retArray['uncompressed'] = $header_data['uncompsize'];
			switch($header_data['type'])
			{
				case 0:
					$retArray['type'] = 'dir';
					break;
		
				case 1:
					$retArray['type'] = 'file';
					break;		

				case 2:
					$retArray['type'] = 'link';
					break;		
			}
			switch( $compressionType )
			{
				case 0:
					$retArray['compression'] = 'none';
					break;
				case 1:
					$retArray['compression'] = 'gzip';
					break;
				case 2:
					$retArray['compression'] = 'bzip2';
					break;
			}
			$retArray['permissions'] = $header_data['perms'];
				
			// Find hard-coded banned files
			if( (basename($file) == ".") || (basename($file) == "..") )
			{
				$isBannedFile = true;
			}
			
			// Also try to find banned files passed in class configuration
			if(count($this->_skipFiles) > 0)
			{
				if(in_array($retArray['file'], $this->_skipFiles))
				{
					$isBannedFile = true;
				}
			}
			
			// If we have a banned file, let's skip it
			if($isBannedFile)
			{
				$retArray['offset'] = $this->_getOffset() + $retArray['uncompressed'];
				return $retArray;
			}

			// Last chance to prepend a path to the filename
			if(!empty($this->_addPath))
			{
				$last_addpath_char = substr($this->_addPath, -1);
				if( ($last_addpath_char == '\\') || $last_addpath_char == '/' )
				{
					$this->_addPath = substr($this->_addPath, 0, -1);
				}
				$retArray['file'] = $this->_addPath.'/'.$retArray['file'];
			}
			
			// Do we need to create the directory?
			if(strpos($retArray['file'], '/') !== false) {
				$lastSlash = strrpos($retArray['file'], '/');
				$dirName = substr( $retArray['file'], 0, $lastSlash);
				if(!$this->_flagUseFTP)
				{
					$perms = $this->_flagRestorePermissions ? $retArray['permissions'] : 0755;
					if( $this->_createDirRecursive($dirName, $perms) == false ) {
						$this->_isError = true;
						if($this->_flagTranslate)
						{
							$this->_error = JText::sprintf('COULDNT_CREATE_DIR', $dirName);
						}
						else
						{
							$this->_error = 'Could not create directory '.$dirName;
						}
						return false;
					}
				}
				else
				{
					if( $this->_ftp->makeDirectory($dirName) == false ) {
						$this->_isError = true;
						if($this->_flagTranslate)
						{
							$this->_error = JText::sprintf('COULDNT_CREATE_DIR', $dirName);
						}
						else
						{
							$this->_error = 'Could not create directory '.$dirName;
						}
						return false;
					}
				}
			}

			switch( $retArray['type'] )
			{
				case "dir":
					if(!$this->_flagUseFTP)
					{
						$perms = $this->_flagRestorePermissions ? $retArray['permissions'] : 0755;
						$result = $this->_createDirRecursive($dirName, $perms);
					}
					else
					{
						$perms = $this->_flagRestorePermissions ? $retArray['permissions'] : 0755;
						$result = $this->_ftp->makeDirectory($dirName, $perms);
					}
					if( !$result ) {
						return false;
					}
					break;
						
				case "file":
					switch( $compressionType )
					{
						case 0: // No compression
							if(!$this->_flagUseFTP)
							{
								$outfp = @fopen( $retArray['file'], 'w' );
							}
							else
							{
								$tmpLocal = tempnam(TEMPDIR,'jpks');
								$outfp = @fopen( $tmpLocal, 'w' );
							}
							// Magic permissions handling attempt
							if( ($outfp === false) )
							{
								if(!$this->_flagUseFTP)
								{
									$this->_setCorrectPermissions($retArray['file']);
									$outfp = @fopen( $retArray['file'], 'w' );
								}
								else
								{
									$this->_setCorrectPermissions($tmpLocal);
									$outfp = @fopen( $tmpLocal, 'w' );
								}
							}
							// Re-test
							if( $outfp === false ) {
								// An error occured
								$this->_isError = true;
								if($this->_flagTranslate)
								{
									$this->_error = JText::sprintf('COULDNT_WRITE_FILE', $retArray['file']);
								}
								else
								{
									$this->_error = 'Could not write to file '.$retArray['file'];
								}
								return false;
							}
								
							if( $retArray['uncompressed'] > 0 )
							{
								$readBytes = 0;
								$toReadBytes = 0;
								$leftBytes = $retArray['compressed'];


								while( $leftBytes > 0)
								{
									$toReadBytes = ($leftBytes > $this->_chunkSize) ? $this->_chunkSize : $leftBytes;
									$data = fread( $this->_fp, $toReadBytes );
									$reallyReadBytes = strlen($data);
									$leftBytes -= $reallyReadBytes;
									if($reallyReadBytes < $toReadBytes)
									{
										// We read less than requested! Why? Did we hit local EOF?
										if( $this->_isEOF(true) && !$this->_isEOF(false) )
										{
											// Yeap. Let's go to the next file
											$this->_getNextFile();
										}
										else
										{
											// Nope. The archive is corrupt
											// @todo Translate!
											$this->_error = 'Corrupt archive detected; can\'t continue';
											return false;
										}
									}
								
									fwrite( $outfp, $data );
								}
							}
								
							fclose($outfp);
							if($this->_flagUseFTP)
							{
								$perms = $this->_flagRestorePermissions ? $retArray['permissions'] : 0755;
								$this->_ftp->uploadAndDelete($retArray['file'], $tmpLocal, $perms);
							}
							else
							{
								// Try to change file permissions to 0755
								$perms = $this->_flagRestorePermissions ? $retArray['permissions'] : 0755;
								@chmod($retArray['file'], $perms);
							}
								
							break;
								
						case 1: // GZip compression
						case 2: // BZip compression
							$zipData = fread( $this->_fp, $retArray['compressed'] );
							while( strlen($zipData) < $retArray['compressed'] )
							{
								// End of local file before reading all data, but have more archive parts?
								if($this->_isEOF(true) && !$this->_isEOF(false))
								{
									// Yeap. Read from the next file
									$this->_getNextFile();
									$bytes_left = $retArray['compressed'] - strlen($zipData);
									$zipData .= fread( $this->_fp, $bytes_left );
								}
								else
								{
									// Crap... this archive is corrupt
									// @todo Translate!
									$this->_error = 'Corrupt archive detected; can\'t continue';
									return false;
								}
							}
							if($compressionType == 1)
							{
								$unzipData = gzinflate( $zipData );
							}
							elseif($compressionType == 2)
							{
								$unzipData = bzdecompress( $zipData );
							}
							unset($zipData);

							// Try writing to the output file
							if(!$this->_flagUseFTP)
							{
								$outfp = @fopen( $retArray['file'], 'w' );
							}
							else
							{
								$tmpLocal = tempnam(TEMPDIR,'jpks');
								$outfp = @fopen( $tmpLocal, 'w' );
							}
							// Magic permissions handling attempt
							if( ($outfp === false) )
							{
								if(!$this->_flagUseFTP)
								{
									$this->_setCorrectPermissions($retArray['file']);
									$outfp = @fopen( $retArray['file'], 'w' );
								}
								else
								{
									$this->_setCorrectPermissions($tmpLocal);
									$outfp = @fopen( $tmpLocal, 'w' );
								}
							}
							// Re-test
							if( $outfp === false ) {
								// An error occured
								$this->_isError = true;
								if($this->_flagTranslate)
								{
									$this->_error = JText::sprintf('COULDNT_WRITE_FILE', $retArray['file']);
								}
								else
								{
									$this->_error = 'Could not write to file '.$retArray['file'];
								}
								return false;
							} else {
								// No error occured. Write to the file.
								fwrite( $outfp, $unzipData, $retArray['uncompressed'] );
								fclose( $outfp );
								if($this->_flagUseFTP)
								{
									$perms = $this->_flagRestorePermissions ? $retArray['permissions'] : 0755;
									$ftp->uploadAndDelete($retArray['file'], $tmpLocal, $perms);
								}
								else
								{
									// Try to change file permissions to 0755
									$perms = $this->_flagRestorePermissions ? $retArray['permissions'] : 0755;
									@chmod($retArray['file'], $perms);
								}
							}
							unset($unzipData);
							break;
					}
					break;
					
				case 'link':
					// Symbolic link
					$readBytes = 0;
					$toReadBytes = 0;
					$leftBytes = $retArray['compressed'];
					$data = '';

					while( $leftBytes > 0)
					{
						$toReadBytes = ($leftBytes > $this->_chunkSize) ? $this->_chunkSize : $leftBytes;
						$data .= fread( $this->_fp, $toReadBytes );
						$reallyReadBytes = strlen($data);
						$leftBytes -= $reallyReadBytes;
						if($reallyReadBytes < $toReadBytes)
						{
							// We read less than requested! Why? Did we hit local EOF?
							if( $this->_isEOF(true) && !$this->_isEOF(false) )
							{
								// Yeap. Let's go to the next file
								$this->_getNextFile();
							}
							else
							{
								// Nope. The archive is corrupt
								// @todo Translate!
								$this->_error = 'Corrupt archive detected; can\'t continue';
								return false;
							}
						}
					}
					
					// Try to remove an existing file or directory by the same name
					if(file_exists($retArray['file'])) { @unlink($retArray['file']); @rmdir($retArray['file']); }
					// Remove any trailing slash
					if(substr($retArray['file'], -1) == '/') $retArray['file'] = substr($retArray['file'], 0, -1);
					// Create the symlink
					@symlink($data, $retArray['file']);
					break; 
			}

			$retArray['offset'] = $this->_getOffset();
			return $retArray;
		} else {
			// This is not a file header. This means we are done.
			$retArray['done'] = true;
			return $retArray;
		}
	}
	
	/**
	 * Reads the files header
	 * @access private
	 * @return boolean TRUE on success
	 */
	function _ReadHeader()
	{
		// Initialize header data array
		$this->headerData = array();
		
		// Fail for unreadable files
		if( $this->_fp === false ) return false;

		// Read the signature
		$sig = fread( $this->_fp, 3 );

		if ($sig != 'JPA') return false; // Not a JoomlaPack Archive?

		// Read and parse header length
		$header_length_array = unpack( 'v', fread( $this->_fp, 2 ) );
		$header_length = $header_length_array[1];

		// Read and parse the known portion of header data (14 bytes)
		$bin_data = fread($this->_fp, 14);
		$header_data = unpack('Cmajor/Cminor/Vcount/Vuncsize/Vcsize', $bin_data);

		// Load any remaining header data (forward compatibility)
		$rest_length = $header_length - 19;
		if( $rest_length > 0 )
		$junk = fread($this->_fp, $rest_length);
		else
		$junk = '';

		$this->headerData = array(
			'signature' => 			$sig,
			'length' => 			$header_length,
			'major' => 				$header_data['major'],
			'minor' => 				$header_data['minor'],
			'filecount' => 			$header_data['count'],
			'uncompressedsize' => 	$header_data['uncsize'],
			'compressedsize' => 	$header_data['csize'],
			'unknowndata' => 		$junk
		);

		return true;
	}
	
}
?><?php
/**
 * @package		SAJAX
 * @copyright	Copyright (C) 2006 ModernMethod, http://www.modernmethod.com/sajax/
 * @version		0.12, patch level JoomlaPack 1.2.1
 * @license 	BSD
 *
 * NOTE: The original SAJAX library has been modified to fit JoomlaPack's needs. This is a
 *       derivative version. No license banners were on the original code. No license text
 *       was found on their site, except a vague notice on being distributed under a BSD
 *       license. I hope this modification is legal.
 **/

// ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

if (!isset($SAJAX_INCLUDED)) {

	/*
	 * GLOBALS AND DEFAULTS
	 *
	 */
	$GLOBALS['sajax_version'] = '0.12';
	$GLOBALS['sajax_debug_mode'] = 0;
	$GLOBALS['sajax_export_list'] = array();
	$GLOBALS['sajax_request_type'] = 'POST';
	$GLOBALS['sajax_remote_uri'] = '';
	$GLOBALS['sajax_remote_uri_params'] = '';
	$GLOBALS['sajax_failure_redirect'] = '';

	/*
	 * CODE
	 *
	 */

	//
	// Initialize the Sajax library.
	//
	function sajax_init() {
	}

	// Since str_split used in sajax_get_my_uri is only available on PHP 5, we have
	// to provide an alternative for those using PHP 4.x
	if(!function_exists('str_split')){
		function str_split($string,$split_length=1){
			$count = strlen($string);
			if($split_length < 1){
				return false;
			} elseif($split_length > $count){
				return array($string);
			} else {
				$num = (int)ceil($count/$split_length);
				$ret = array();
				for($i=0;$i<$num;$i++){
					$ret[] = substr($string,$i*$split_length,$split_length);
				}
				return $ret;
			}
		}
	}

	//
	// Helper function to return the script's own URI.
	//
	function sajax_get_my_uri() {
		//return str_replace('\\','%5c', JURI::root()).'administrator/index2.php';
		return $_SERVER["REQUEST_URI"];
	}

	global $sajax_remote_uri, $sajax_remote_uri_params;
	$sajax_remote_uri = sajax_get_my_uri();
	$sajax_remote_uri_params = "option=com_joomlapack&view=ajax&format=raw";

	/**
	 * Forces SAJAX to user per-page AJAX proxy URLs. Call it to make AJAX calls be processed by the
	 * page class processAJAX() method.
	 *
	 */
	function sajax_force_page_ajax($view = null)
	{
		global $sajax_remote_uri_params;
		if(is_null($view)) $view = JRequest::getCmd('view','ajax');
		$sajax_remote_uri_params = "option=com_joomlapack&view=$view&format=raw";
	}

	//
	// Helper function to return an eval()-usable representation
	// of an object in JavaScript.
	//
	function sajax_get_js_repr($value) {
		$type = gettype($value);

		if ($type == "boolean") {
			return ($value) ? "Boolean(true)" : "Boolean(false)";
		}
		elseif ($type == "integer") {
			return "parseInt($value)";
		}
		elseif ($type == "double") {
			return "parseFloat($value)";
		}
		elseif ($type == "array" || $type == "object" ) {
			//
			// Arrays with non-numeric indices are not
			// permitted according to ECMAScript, yet everyone
			// uses them.. We'll use an object.
			//
			$s = "{ ";
			if ($type == "object") {
				$value = get_object_vars($value);
			}
			foreach ($value as $k=>$v) {
				$esc_key = sajax_esc($k);
				if (is_numeric($k))
				$s .= "$k: " . sajax_get_js_repr($v) . ", ";
				else
				$s .= "\"$esc_key\": " . sajax_get_js_repr($v) . ", ";
			}
			if (count($value))
			$s = substr($s, 0, -2);
			return $s . " }";
		}
		else {
			$esc_val = sajax_esc($value);
			$s = "'$esc_val'";
			return $s;
		}
	}

	function sajax_handle_client_request( ) {
		global $sajax_export_list;

		$mode = "";

		if (! empty($_GET["rs"]))
		$mode = "get";

		if (!empty($_POST["rs"]))
		$mode = "post";
		
		if( class_exists('JRequest') )
		$mode = "joomla";

		if (empty($mode))
		return;

		$target = "";

		ob_clean();

		if ($mode == "get") {
			// Bust cache in the head
			header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
			header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			// always modified
			header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
			header ("Pragma: no-cache");                          // HTTP/1.0
			$func_name = urldecode($_GET["rs"]);
			if (! empty($_GET["rsargs"]))
			{
				$args = array();
				foreach($_GET["rsargs"] as $key => $value)
				{
					$args[$key] = html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($value)),null,'UTF-8');
				}
				//$args = $_GET["rsargs"];
			}
			else
			$args = array();
		}
		else if ($mode == "post") {
			$func_name = $_POST["rs"];
			if (! empty($_POST["rsargs"]))
			{
				$ISPHP4 = (version_compare(PHP_VERSION,'5.0.0') < 0) ? true : false;
				$args = array();
				foreach($_POST["rsargs"] as $key => $value)
				{
					if($ISPHP4)
					$args[$key] = html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($value)));
					else
					$args[$key] = html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($value)),null,'UTF-8');
				}
				//$args = $_POST["rsargs"];
				//$args = JRequest::getVar('rsargs',Array());
			}
			else
			$args = array();
		}
		else if( $mode == 'joomla' ) {
			// Bust cache in the head
			header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
			header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			// always modified
			header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
			header ("Pragma: no-cache");                          // HTTP/1.0
			$func_name = JRequest::getString('rs');
			$args = JRequest::getVar('rsargs', array(), 'default', 'array', 4);
		}

		if (! in_array($func_name, $sajax_export_list))
		echo "-:$func_name not callable";
		else {
			echo "+:";
			ob_flush();
			$result = call_user_func_array($func_name, $args);
			echo "var res = " . trim(sajax_get_js_repr($result)) . "; res;";
			ob_flush();
			flush();
		}
		exit;
	}

	function sajax_get_common_js() {
		global $sajax_debug_mode;
		global $sajax_request_type;
		global $sajax_remote_uri;
		global $sajax_failure_redirect;
		global $sajax_remote_uri_params;

		$t = strtoupper($sajax_request_type);
		if ($t != "" && $t != "GET" && $t != "POST")
		return "// Invalid type: $t.. \n\n";

		$sdb = $sajax_debug_mode ? "true" : "false";
		$fullurl = $sajax_remote_uri.'?'.$sajax_remote_uri_params;

		// Create a query suffix for the global variables
		$suffix = 'CHUNKSIZE='.CHUNKSIZE.'&'.
			'MAXBATCHSIZE='.MAXBATCHSIZE.'&'.
			'MAXBATCHFILES='.MAXBATCHFILES.'&'.
			'TEMPDIR='.urlencode(TEMPDIR).'&'.
			'MINEXECTIME='.MINEXECTIME;
		
		$html = <<<ENDOFHTML

		// remote scripting library
		// (c) copyright 2005 modernmethod, inc
		// Modifications to suit JoomlaPack needs, (c)2006-2009 JoomlaPack Developers / Nicholas K. Dionysopoulos

		var sajax_debug_mode = $sdb;
		var sajax_request_type = "$t";
		var sajax_target_id = "";
		var sajax_failure_redirect = "$sajax_failure_redirect";
		var sajax_failed_eval = "";
		var sajax_fail_handle = "";
		var sajax_junk_handle = "";
		var sajax_profiling = false;

		function sajax_debug(text) {
			if (sajax_debug_mode)
				alert(text);
		}

 		function sajax_init_object() {
 			sajax_debug("sajax_init_object() called..")

 			var A;

 			var msxmlhttp = new Array(
				'Msxml2.XMLHTTP.5.0',
				'Msxml2.XMLHTTP.4.0',
				'Msxml2.XMLHTTP.3.0',
				'Msxml2.XMLHTTP',
				'Microsoft.XMLHTTP');
			for (var i = 0; i < msxmlhttp.length; i++) {
				try {
					A = new ActiveXObject(msxmlhttp[i]);
				} catch (e) {
					A = null;
				}
			}

			if(!A && typeof XMLHttpRequest != "undefined")
				A = new XMLHttpRequest();
			if (!A)
				sajax_debug("Could not create connection object.");
			return A;
		}

		var sajax_requests = new Array();

		function sajax_cancel() {
			for (var i = 0; i < sajax_requests.length; i++)
				sajax_requests[i].abort();
		}

		function sajax_do_call(func_name, args) {
			var i, x, n;
			var uri;
			var post_data;
			var target_id;

			sajax_debug("in sajax_do_call().." + sajax_request_type + "/" + sajax_target_id);
			target_id = sajax_target_id;
			if (typeof(sajax_request_type) == "undefined" || sajax_request_type == "")
				sajax_request_type = "GET";

			uri = "$fullurl";
			if (sajax_request_type == "GET") {

				if (uri.indexOf("?") == -1)
					//XXX uri += "?rs=" + escape(func_name);
					uri += "?rs=" + encodeURIComponent(func_name);
				else
					//XXX uri += "&rs=" + escape(func_name);
					uri += "&rs=" + encodeURIComponent(func_name);
				//XXX uri += "&rst=" + escape(sajax_target_id);
				//XXX uri += "&rsrnd=" + new Date().getTime();
				uri += "&rst=" + encodeURIComponent(sajax_target_id);
				uri += "&rsrnd=" + encodeURIComponent(new Date().getTime());
				uri += "&$suffix";

				for (i = 0; i < args.length-1; i++)
					//XXX uri += "&rsargs[]=" + escape(args[i]);
					uri += "&rsargs[]=" + encodeURI(args[i]);

				if(sajax_profiling) uri += "&XDEBUG_PROFILE";
				
				post_data = null;
			}
			else if (sajax_request_type == "POST") {
				uri = "$sajax_remote_uri";
				post_data = "$sajax_remote_uri_params";
				//XXX post_data += "&rs=" + escape(func_name);
				//XXX post_data += "&rst=" + escape(sajax_target_id);
				//XXX post_data += "&rsrnd=" + new Date().getTime();

				post_data += "&rs=" + encodeURIComponent(func_name);
				post_data += "&rst=" + encodeURIComponent(sajax_target_id);
				post_data += "&rsrnd=" + encodeURIComponent(new Date().getTime());
				post_data += "&$suffix";
				
				for (i = 0; i < args.length-1; i++)
				{
					//XXX post_data = post_data + "&rsargs[]=" + escape(args[i]);
					post_data = post_data + "&rsargs[]=" + encodeURIComponent(args[i]);
				}
					
				if(sajax_profiling) post_data += "&XDEBUG_PROFILE";
			}
			else {
				alert("Illegal request type: " + sajax_request_type);
			}

			x = sajax_init_object();
			if (x == null) {
				if (sajax_failure_redirect != "") {
					location.href = sajax_failure_redirect;
					return false;
				} else {
					sajax_debug('NULL sajax object for user agent:' + navigator.userAgent);
					return false;
				}
			} else {
				x.open(sajax_request_type, uri, true);
				// window.open(uri);

				sajax_requests[sajax_requests.length] = x;

				if (sajax_request_type == "POST") {
					x.setRequestHeader("Method", "POST " + uri + " HTTP/1.1");
					x.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				}

				x.onreadystatechange = function() {
					if (x.readyState != 4)
						return;

					sajax_debug("received " + x.responseText);

					var status;
					var data;
					var txt = x.responseText.replace(/^\s*|\s*$/g,"");
					status = txt.charAt(0);
					data = txt;

					if (status == "") {
						// let's just assume this is a pre-response bailout and let it slide for now
					} else if (status == "-")
						alert("Error: " + data.substring(2));
					else {
						// # Fix Sep 2009 (JP2.4): Filtering of non-AJAX response content
						try {
							var valid_pos = data.indexOf('+:var res = ');
							if( valid_pos == -1 ) {
								// Test for interjected junk data
								var start_of_data = data.indexOf('+:');
								var continued_data = data.indexOf('var res = ');
								if( (start_of_data != 0) || (continued_data == -1) )
								{
									// Only invalid data received
									sajax_failed_eval = data;
									sajax_fail_handle(data);
									return;
								}
								else
								{
									// Isolate the junk portion
									var junk_data = data.substr(2, continued_data - 2);
									var value = eval(data.substr(continued_data)); 
								}
							} else if( valid_pos == 0 ) {
								// No junk data
								var junk_data = null;
								var value = eval(data.substr(2));
							} else {
								// Some invalid data received; the callback will be handled by sajax_junk_handler
								var junk_data = data.substr(0, valid_pos);
								var value = eval( data.substr(valid_pos+2, data.length - valid_pos - 1) );
								return;
							}
						} catch (e) {
							sajax_debug("Caught error " + e + ": Could not eval " + data );
							sajax_failed_eval = data;
							sajax_fail_handle(data);
						}
												
						if (target_id != "")
							document.getElementById(target_id).innerHTML = value;
						else {
							var callback;
							var extra_data = false;
							if (typeof args[args.length-1] == "object") {
								callback = args[args.length-1].callback;
								extra_data = args[args.length-1].extra_data;
							} else {
								callback = args[args.length-1];
							}
							if( junk_data != null ) {
								// Handle partial non-AJAX response content
								sajax_junk_handle(junk_data, callback, value, extra_data);
								return;
							}
							else
							{
								// Handle full-compliant AJAX content
								callback(value, extra_data);
							}
						}
					}
				}
			}

			sajax_debug(func_name + " uri = " + uri + "/post = " + post_data);
			x.send(post_data);
			sajax_debug(func_name + " waiting..");
			delete x;
			return true;
		}
ENDOFHTML;
		return $html;
	}

	function sajax_show_common_js() {
		echo sajax_get_common_js();
	}

	// javascript escape a value
	function sajax_esc($val)
	{
		$val = str_replace("\\", "\\\\", $val);
		$val = str_replace("\r", "\\r", $val);
		$val = str_replace("\n", "\\n", $val);
		$val = str_replace("'", "\\'", $val);
		return str_replace('"', '\\"', $val);
	}

	function sajax_get_one_stub($func_name) {
		$html = <<<ENDSTUB

		// wrapper for $func_name

		function x_$func_name() {
			sajax_do_call("$func_name",
				x_$func_name.arguments);
		}
ENDSTUB;
		return $html;
	}

	function sajax_show_one_stub($func_name) {
		echo sajax_get_one_stub($func_name);
	}

	function sajax_export() {
		global $sajax_export_list;

		$n = func_num_args();
		for ($i = 0; $i < $n; $i++) {
			$sajax_export_list[] = func_get_arg($i);
		}
	}

	$sajax_js_has_been_shown = 0;
	function sajax_get_javascript()
	{
		global $sajax_js_has_been_shown;
		global $sajax_export_list;

		$html = "";
		if (! $sajax_js_has_been_shown) {
			$html .= sajax_get_common_js();
			$sajax_js_has_been_shown = 1;
		}
		foreach ($sajax_export_list as $func) {
			$html .= sajax_get_one_stub($func);
		}
		return $html;
	}

	function sajax_show_javascript()
	{
		echo sajax_get_javascript();
	}


	$SAJAX_INCLUDED = 1;
}
?><?php
// ==========================================================================================
// KS: Filesystem abstraction layer
// ==========================================================================================
/**
 * Filesystem Abstraction Module
 *
 * Provides filesystem handling functions in a compatible manner, depending on server's capabilities
 */
class JoomlapackListerAbstraction {

	/**
	 * Should we use glob() ?
	 * @var boolean
	 */
	var $_globEnable;

	/**
	 * Public constructor for JoomlapackListerAbstraction class. Does some heuristics to figure out the
	 * server capabilities and setup internal variables
	 */
	function JoomlapackListerAbstraction()
	{
		// Don't use glob if it's disabled or if opendir is available
		$this->_globEnable = function_exists('glob');
		if( function_exists('opendir') && function_exists('readdir') && function_exists('closedir') )
		$this->_globEnable = false;
	}

	/**
	 * Searches the given directory $dirName for files and folders and returns a multidimensional array.
	 * If the directory is not accessible, returns FALSE
	 *
	 * @param string $dirName
	 * @param string $shellFilter
	 * @return array See function description for details
	 */
	function getDirContents( $dirName, $shellFilter = null )
	{
		if ($this->_globEnable) {
			return $this->_getDirContents_glob( $dirName, $shellFilter );
		} else {
			return $this->_getDirContents_opendir( $dirName, $shellFilter );
		}
	}

	// ============================================================================
	// PRIVATE SECTION
	// ============================================================================

	/**
	 * Searches the given directory $dirName for files and folders and returns a multidimensional array.
	 * If the directory is not accessible, returns FALSE. This function uses the PHP glob() function.
	 * @return array See function description for details
	 */
	function _getDirContents_glob( $dirName, $shellFilter = null )
	{
		if (is_null($shellFilter)) {
			// Get folder contents
			$allFilesAndDirs1 = @glob($dirName . "/*"); // regular files
			$allFilesAndDirs2 = @glob($dirName . "/.*"); // *nix hidden files

			// Try to merge the arrays
			if ($allFilesAndDirs1 === false) {
				if ($allFilesAndDirs2 === false) {
					$allFilesAndDirs = false;
				} else {
					$allFilesAndDirs = $allFilesAndDirs2;
				}
			} elseif ($allFilesAndDirs2 === false) {
				$allFilesAndDirs = $allFilesAndDirs1;
			} else {
				$allFilesAndDirs = @array_merge($allFilesAndDirs1, $allFilesAndDirs2);
			}

			// Free unused arrays
			unset($allFilesAndDirs1);
			unset($allFilesAndDirs2);

		} else {
			$allFilesAndDirs = @glob($dirName . "/$shellFilter"); // filtered files
		}

		// Check for unreadable directories
		if ( $allFilesAndDirs === FALSE ) {
			return FALSE;
		}

		// Populate return array
		$retArray = array();

		foreach($allFilesAndDirs as $filename) {
			$filename = JoomlapackListerAbstraction::TranslateWinPath( $filename );
			$newEntry['name'] = $filename;
			$newEntry['type'] = filetype( $filename );
			if ($newEntry['type'] == "file") {
				$newEntry['size'] = filesize( $filename );
			} else {
				$newEntry['size'] = 0;
			}
			$retArray[] = $newEntry;
		}

		return $retArray;
	}

	function TranslateWinPath( $p_path )
	{
		if (DIRECTORY_SEPARATOR == '\\'){
			// Change potential windows directory separator
			if ((strpos($p_path, '\\') > 0) || (substr($p_path, 0, 1) == '\\')){
				$p_path = strtr($p_path, '\\', '/');
			}
		}
		return $p_path;
	}

	function _getDirContents_opendir( $dirName, $shellFilter = null )
	{
		$handle = @opendir( $dirName );

		// If directory is not accessible, just return FALSE
		if ($handle === FALSE) {
			return FALSE;
		}

		// Initialize return array
		$retArray = array();

		while( !( ( $filename = readdir($handle) ) === false) ) {
			$match = is_null( $shellFilter );
			$match = (!$match) ? fnmatch($shellFilter, $filename) : true;
			if ($match) {
				$filename = JoomlapackListerAbstraction::TranslateWinPath( $dirName . "/" . $filename );
				$newEntry['name'] = $filename;
				$newEntry['type'] = @filetype( $filename );
				if ($newEntry['type'] !== FALSE) {
					// FIX 1.1.0 Stable - When open_basedir restrictions are in effect, an attempt to read <root>/.. could result into failure of the backup. This fix is a simplistic workaround.
					if ($newEntry['type'] == 'file') {
						$newEntry['size'] = @filesize( $filename );
					} else {
						$newEntry['size'] = 0;
					}
					$retArray[] = $newEntry;
				}
			}
		}

		closedir($handle);
		return $retArray;
	}
}

// fnmatch not available on non-POSIX systems
// Thanks to soywiz@php.net for this usefull alternative function [http://gr2.php.net/fnmatch]
if (!function_exists('fnmatch')) {
	function fnmatch($pattern, $string) {
		return @preg_match(
			'/^' . strtr(addcslashes($pattern, '/\\.+^$(){}=!<>|'),
		array('*' => '.*', '?' => '.?')) . '$/i', $string
		);
	}
}
?><?php
// ==========================================================================================
// KS: FTP
// ==========================================================================================

class myFTP
{
	var $error;
	var $_handle;

	function myFTP()
	{
		// Get FTP parameters
		$ftphost = getVar('ftphost', 'localhost');
		$ftpport = getVar('ftpport', '21');
		$ftpuser = getVar('ftpuser', '');
		$ftppass = getVar('ftppass', '');
		$ftpdir  = getVar('ftpdir', '/');

		// Connect to server
		$this->_handle = @ftp_connect($ftphost, $ftpport);
		if($this->_handle === false)
		{
			$this->error=Text::_('WRONG_FTP_HOST');
			return;
		}

		// Login
		if(! @ftp_login($this->_handle, $ftpuser, $ftppass))
		{
			$this->error=Text::_('WRONG_FTP_USER');
			@ftp_close($this->_handle);
			return;
		}

		// Change to initial directory
		if(! @ftp_chdir($this->_handle, $ftpdir))
		{
			$this->error=Text::_('WRONG_FTP_PATH1');
			@ftp_close($this->_handle);
			return;
		}

		// Search for kickstart.php
		$dirlist = @ftp_nlist($this->_handle,'.');
		if(!in_array(SCRIPTNAME, $dirlist))
		{
			// Try harder (raw listing)
			$dirlist_harder = @ftp_rawlist($this->_handle, '.');
			$found = false;
			foreach($dirlist_harder as $aFile)
			{
				$found = $found || (strpos($aFile, SCRIPTNAME) !== false);
			}
			if(!$found)
			{
				$this->error=Text::sprintf('WRONG_FTP_PATH2', SCRIPTNAME);
				@ftp_close($this->_handle);
				return;
			}
		}

		// Use passive mode
		@ftp_pasv($this->_handle, true);
	}

	function close()
	{
		@ftp_close($this->_handle);
	}

	function is_dir( $dir )
	{
		return @ftp_chdir( $this->_handle, $dir );
	}

	function makeDirectory( $dir, $perms = 0755 )
	{
		$check = '/'.trim(getVar('ftpdir', '/'),'/').'/'.$dir;
		if($this->is_dir($check)) return true;

		$alldirs = explode('/', $dir);
		$previousDir = '/'.trim(getVar('ftpdir', '/'));
		foreach($alldirs as $curdir)
		{
			$check = $previousDir.'/'.$curdir;
			if(!$this->is_dir($check))
			{
				if(@ftp_mkdir($this->_handle, $check) === false)
				{
					// If we couldn't create the directory, attempt to fix the permissions in the PHP level and retry!
					$this->fixPermissions($check);
					if(@ftp_mkdir($this->_handle, $check) === false)
					{
						// Can we fall back to pure PHP mode, sire?
						if(!@mkdir($check))
						{
							$this->error = Text::sprintf('FTP_CANT_CREATE_DIR', $dir);
							return false;
						}
						else
						{
							// Since the directory was built by PHP, change its permissions
							@chmod($check, "0777");
							return true;
						}
					}
				}
				@ftp_chmod($this->_handle, $perms, $check);
			}
			$previousDir = $check;
		}

		return true;
	}

	function uploadAndDelete($remoteName, $localName, $perms = 0755)
	{
		$remoteName = '/'.trim( getVar('ftpdir','/'), '/' ).'/'.$remoteName;
		$ret = @ftp_put($this->_handle, $remoteName, $localName, FTP_BINARY);
		if(!$ret)
		{
			// If we couldn't create the file, attempt to fix the permissions in the PHP level and retry!
			$this->fixPermissions($remoteName);
			$ret = @ftp_put($this->_handle, $remoteName, $localName, FTP_BINARY);
		}
		@ftp_chmod($this->_handle, $perms, $remoteName);
		@unlink($localName);
		if(!$ret) $this->error=Text::sprintf('FTP_COULDNT_UPLOAD', $remoteName);
		return $ret;
	}

	/*
	 * Tries to fix directory/file permissions in the PHP level, so that
	 * the FTP operation doesn't fail.
	 * @param $path string The full path to a directory or file
	 */
	function fixPermissions( $path )
	{
		// Turn off error reportingg
		$oldErrorReporting = @error_reporting(E_NONE);

		$dirArray = explode('/', $path);
		$pathBuilt = '';
		foreach( $dirArray as $dir )
		{
			$oldPath = $pathBuilt;
			$pathBuilt .= $dir . '/';
			if(is_dir($pathBuilt))
			{
				@chmod($pathBuilt, 0777);
			}
			else
			{
				@chmod($oldPath.$dir, 0777);
			}
		}

		// Restore error reporting
		@error_reporting($oldErrorReporting);
	}

	function chmod($path, $perms)
	{
		return @ftp_chmod($this->_handle, $perms, $path);
	}
}
?><?php
// ==========================================================================================
// KS: CSS
// ==========================================================================================

function echoCSS()
{
	global $automation;
	?>
body { font-family: Arial, Helvetica, sans-serif; font-size: 10pt;
color: #000000; background-color: #666666; } h1 { font-family: Arial,
Helvetica, sans-serif; font-size: 18pt; display: block; height: 22pt;
padding: 2pt 5pt; background-color: #000000; color: #ffffff; margin:
0px; } h2 { font-family: Arial, Helvetica, sans-serif; font-size: 14pt;
margin: 1em 0px 0px 0px; border-bottom: thin solid navy; color: navy; }

h3 { font-family: Arial, Helvetica, sans-serif; font-size: 12pt;
font-style: italic; color: #666666; margin: 1em 0px 0px 0px; }

#maincontainer { display: block; background-color: #ffffff; border-left:
3pt solid black; border-right: 3pt solid black; } #maincontainer p {
margin: 0px; } #errorbox { background-color: #ffffaa; border: 3pt solid
#ff0000; margin: 0pt 5pt; padding: 5pt; color: #990000; display: none; }

#process { background-color: #eeeeee; border: 3px solid #333333; margin:
0pt 5pt; padding: 5pt; color: #000000; display: none; } #select {
padding: 5px; } #footer { background-color: #000000; color: #aaaaaa;
font-size: 8pt; } #footer p { padding: 2pt; margin: 0px; text-align:
center; } #footer a { color: #aaaabb; } .startbutton { display: block;
width: 300px; height: 50px; border: thin solid green; margin: 0.5em;
background-color: #00ff00; font-size: 18pt; } #authentication { margin:
1em; padding: 1em; background-color: #ffffcc; border: 2px solid #999900;
} #authentication p { padding-top: 1em; } #authentication h2 { color:
green; border-bottom: thin solid green; }
	<?php

	#automode {
	if((AUTOMODE == 1) || $automation) {
		?>
font-size: 13pt; color: red; margin: 5px; padding: 5px;
background-color: yellow;
		<?php
	} else {
		?>
display: none;
		<?php
	}
	?>
}
	<?php

}
?><?php
// ==========================================================================================
// KS: Model files
// ==========================================================================================

class KickstartModel
{
	/**
	 * Gets the ZIP files present in the current directory and returns a hefty selection box
	 *
	 * @return unknown
	 */
	function getZIPList()
	{
		$html = "";

		$fs = new JoomlapackListerAbstraction();
		$partialListZIP = $fs->getDirContents( '.', '*.zip' );
		$partialListJPA = $fs->getDirContents( '.', '*.jpa' );
		$allZIPs = array_merge( $partialListJPA, $partialListZIP );

		if( count($allZIPs) == 0 ) {
			$html = "<p>".Text::_('NO_ARCHIVES')."</p>";
		} else {
			$html = '<p id="select">'.Text::_('SELECT_ARCHIVE').'<br /><select name="zipselect" id="zipselect">';
			foreach( $allZIPs as $thisFile )
			{
				$html .= '<option value="' . $thisFile['name'] . '">' . $thisFile['name'] . '</option>';
			}
			$html .= '</select>&nbsp;';
			$html .= '</p>';
		}

		return $html;
	}
}
?><?php
// ==========================================================================================
// KS: View files
// ==========================================================================================

class KickstartView
{
	var $ret;

	function renderPassword()
	{
		$scriptname=SCRIPTNAME;
		$html = <<<ENDHTML
<form method="POST" action="$scriptname">
	<div id="authentication">
	<h2>
ENDHTML;
		$html .= Text::_('AUTH_REQ') . <<<ENDHTML
	</h2>
	<p>
ENDHTML;
		$authText = Text::_('AUTHENTICATE');
		$html .= Text::_('SUPPLY_PASS') . <<<ENDHTML
	</p>
	<p>
	<input type="password" name="password" value="" /><br />
	<input type="submit" value="$authText" />
	</p>
	</div>
</form>		
ENDHTML;

		$this->_renderPage('',$html);
	}

	/**
	 * Renders the main page (archive selection and options page)
	 *
	 */
	function renderMain()
	{
		$model = new KickstartModel();
		$zipselectHTML = $model->getZIPList();

		$zipselect = getVar('zipselect', '');
		$method = getVar('method', 'ajax');
		$extract = getVar('extract', 'direct');
		$ftphost = getVar('ftphost', 'localhost');
		$ftpport = getVar('ftpport', '21');
		$ftpuser = getVar('ftpuser', '');
		$ftppass = getVar('ftppass', '');
		$ftpdir  = getVar('ftpdir', '/');

		if ($ftphost == '')
		{
			// Try to find a configuration.php in the same path
			if(@file_exists('configuration.php'))
			{
				// Try importing the configuration.php
				include_once('configuration.php');
				if(class_exists('JConfig'))
				{
					// It looks like a Joomla! 1.5.x configuration file...
					$confVars	= get_class_vars('JConfig');
					$ftphost	= $confVars['ftp_host'];
					$ftpport	= $confVars['ftp_port'];
					$ftpuser	= $confVars['ftp_user'];
					$ftppass	= $confVars['ftp_pass'];
					$ftpdir		= $confVars['ftp_root'];
				}
			}
		}

		if($method == 'ajax')
		{
			$op1 = 'checked';
			$op2 = '';
		}
		else
		{
			$op1 = '';
			$op2 = 'checked';
		}

		if($extract == 'direct')
		{
			$ex1 = 'checked';
			$ex2 = '';
		}
		else
		{
			$ex1 = '';
			$ex2 = 'checked';
		}

		$scriptname=SCRIPTNAME;

		$textBackup 	= Text::_('BACKUP_ARCHIVE');
		$textStart		= Text::_('START');
		$textOpMode		= Text::_('OPERATION_MODE');
		$textAjax		= Text::_('MODE_AJAX');
		$textJSRedir	= Text::_('MODE_REDIRECTS');
		$textExtMethod	= Text::_('EXTRACTION_METHOD');
		$textFiles		= Text::_('METHOD_FILES');
		$textFTP		= Text::_('METHOD_FTP');
		$textFTPOpt		= Text::_('FTP_OPTIONS');
		$textHost		= Text::_('FTP_HOST');
		$textPort		= Text::_('FTP_PORT');
		$textUser		= Text::_('FTP_USER');
		$textPass		= Text::_('FTP_PASSWORD');
		$textDir		= Text::_('FTP_DIRECTORY');
		$restoreperms	= Text::_('RESTOREPERMS');
		$stealthhead	= Text::_('STEALTHMODEHEAD');
		$stealth		= Text::_('STEALTHMODE');
		$stealthurl		= Text::_('STEALTHURL');
		$finetuning		= Text::_('FINETUNING');
		$maxbatchsize	= Text::_('MAXBATCHSIZE');
		$maxbatchfiles	= Text::_('MAXBATCHFILES');
		$minexectime 	= Text::_('MINEXECTIME');
		$tempdir 		= Text::_('TEMPDIR');
		$chunksize		= Text::_('CHUNKSIZE');

		$tempdir_default = dirname(__FILE__);
		$html = <<<ENDHTML
<form method="POST" action="$scriptname">
	<input type="hidden" name="task" value="extract" />
	<h2>$textBackup</h2>
	$zipselectHTML
	<p><input type="submit" value="$textStart" class="startbutton" /></p>
	<h2>$textOpMode</h2>
	<input type="radio" name="method" value="ajax" $op1 />$textAjax
	<input type="radio" name="method" value="js" $op2 />$textJSRedir
	<h2>$textExtMethod</h2>
	<p>
		<input type="radio" name="extract" value="direct" $ex1 />$textFiles
		<input type="radio" name="extract" value="ftp" $ex2 />$textFTP
	</p>
	<p>
		<input type="checkbox" name="restoreperms" />$restoreperms
	</p>
	<h3>$textFTPOpt</h3>
	<table border="0">
		<tr>
			<td>$textHost</td>
			<td><input type="text" name="ftphost" value="$ftphost" /></td>
		</tr>
		<tr>
			<td>$textPort</td>
			<td><input type="text" name="ftpport" value="$ftpport" /></td>
		</tr>
		<tr>
			<td>$textUser</td>
			<td><input type="text" name="ftpuser" value="$ftpuser" /></td>
		</tr>
		<tr>
			<td>$textPass</td>
			<td><input type="text" name="ftppass" value="$ftppass" /></td>
		</tr>
		<tr>
			<td>$textDir</td>
			<td><input type="text" name="ftpdir" value="$ftpdir" /></td>
		</tr>
	</table>
	<h2>$stealthhead</h2>
	<p style="font-size: small;">
		<table border="0">
			<tr>
				<td>$stealth</td>
				<td><input type="checkbox" name="stealth" /></td>
			</tr>
			<tr>
				<td>$stealthurl</td>
				<td><input type="text" name="stealthurl" value="" /></td>
			</tr>
			</table>
	</p>
	<h2>$finetuning</h2>
	<p style="font-size: small;">
		<table border="0">
			<tr>
				<td>$maxbatchsize</td>
				<td><input type="text" name="MAXBATCHSIZE" value="1048756" /></td>
			</tr>
			<tr>
				<td>$maxbatchfiles</td>
				<td><input type="text" name="MAXBATCHFILES" value="40" /></td>
			</tr>
			<tr>
				<td>$minexectime</td>
				<td><input type="text" name="MINEXECTIME" value="1000" /></td>
			</tr>
			<tr>
				<td>$tempdir</td>
				<td><input type="text" name="TEMPDIR" value="$tempdir_default" /></td>
			</tr>
			<tr>
				<td>$chunksize</td>
				<td><input type="text" name="CHUNKSIZE" value="1048756" /></td>
			</tr>
		</table>
	</p>
</form>
ENDHTML;
	$this->_renderPage('',$html);
	}

	/**
	 * Show the extraction page for AJAX and JS modes
	 *
	 */
	function extract()
	{
		$zipselect = getVar('zipselect', '');
		$method = getVar('method', 'ajax');
		$extract = getVar('extract', 'direct');
		$ftphost = getVar('ftphost', 'localhost');
		$ftpport = getVar('ftpport', '21');
		$ftpuser = getVar('ftpuser', '');
		$ftppass = getVar('ftppass', '');
		$ftpdir  = getVar('ftpdir', '/');
		$offset = getVar('offset', 0);
		$bytesin = getVar('bytesin', 0);
		$bytesout = getVar('bytesout', 0);
		$files = getVar('files', 0);
		$restoreperms = getVar('restoreperms', '') == 'on' ? '<input type="hidden" name="restoreperms" value="on" />' : '';
		$restorepermsBool = getVar('restoreperms', '') == 'on';

		if($method == 'ajax')
		{
			$scriptname=SCRIPTNAME;
			
$inputs = '';
$inputs .= "<input type=\"hidden\" name=\"CHUNKSIZE\" value=\"".CHUNKSIZE."\" />";
$inputs .= "<input type=\"hidden\" name=\"MAXBATCHSIZE\" value=\"".MAXBATCHSIZE."\" />";
$inputs .= "<input type=\"hidden\" name=\"MAXBATCHFILES\" value=\"".MAXBATCHFILES."\" />";
$inputs .= "<input type=\"hidden\" name=\"TEMPDIR\" value=\"".TEMPDIR."\" />";
$inputs .= "<input type=\"hidden\" name=\"MINEXECTIME\" value=\"".MINEXECTIME."\" />";
			
			$html = <<<END
<form name="step" id="step" method="post" action="$scriptname">
	<input type="hidden" name="zipselect" value="$zipselect" />
	<input type="hidden" name="method" value="$method" />
	<input type="hidden" name="extract" value="$extract" />
	<input type="hidden" name="ftphost" value="$ftphost" />
	<input type="hidden" name="ftpport" value=$ftpport"" />
	<input type="hidden" name="ftpuser" value="$ftpuser" />
	<input type="hidden" name="ftppass" value="$ftppass" />
	<input type="hidden" name="ftpdir" value="$ftpdir" />
	<input type="hidden" name="task" value="done" />
	$inputs
	$restoreperms
</form>
END;

	if(!get_magic_quotes_gpc())
	{
		$zipselect = addslashes($zipselect);
		$ftphost = addslashes($ftphost);
		$ftpuser = addslashes($ftpuser);
		$ftppass = addslashes($ftppass);
	}
		
	sajax_init();
	sajax_export('doextract', 'getProgressHTML');
	$sajaxJS = sajax_get_javascript();
		
	$restorepermsBoolText = $restorepermsBool ? '1' : '0';
	
	$minexectime = MINEXECTIME;
	$html2 = <<<ENDHEAD
	<script type="text/javascript">
	$sajaxJS
			var BytesIn = 0;
			var BytesOut = 0;
			var Files = 0;
			var FileName = '$zipselect';
			var Offset = '';
			
			var time_start;
			var time_end;
			
			sajax_fail_handle = myhandle;
			sajax_junk_handle = junkhandle;
			
			function pausecomp(millis)
			{
				// www.sean.co.uk
				var date = new Date();
				var curDate = null;
				do { curDate = new Date(); }
				while(curDate-date < millis);
			}
			
			function myhandle(error)
			{
				alert('Error: '+error);
			}
			
			function junkhandle(junk_data, callback, value, extra_data)
			{
				ojd_callback = callback;
				ojd_value = value;
				ojd_extra_data = extra_data;
				alert(junk_data);
				ojd_callback(ojd_value, ojd_extra_data);
			}
			
			function start()
			{
				BytesIn = 0;
				BytesOut = 0;
				Files = 0;
				Offset = 0;
				pausecomp($minexectime);
				do_Extract();
			}
			
			function do_Extract()
			{
				var myDate = new Date();
				time_start = myDate.getTime();
				x_doextract( FileName, '$extract', '$ftphost', '$ftpport', '$ftpuser', '$ftppass', '$ftpdir', Offset, '$restorepermsBoolText', cb_Extract );
			}

			function cb_Extract( myRet )
			{
				var myDate = new Date();
				time_end = myDate.getTime();
				
				var myHTML = '';
				document.getElementById('process').style.display = 'block';
				
				if( myRet['error'] ) {
					document.getElementById('process').style.display = 'none';
					document.getElementById('errorbox').style.display = 'block';
					document.getElementById('errorbox').innerHTML = myRet['error'];
				} else {
					if( myRet['done'] ) {
						pausecomp($minexectime);
						document.forms.step.submit();
					} else {
						// Continue extracting
						BytesIn += myRet['bytesin'];
						BytesOut += myRet['bytesout'];
						Files += myRet['files'];
						Offset = myRet['offset'];
						
						// Pause if required
						elapsed_time = time_end - time_start;
						if(elapsed_time < $minexectime)
						{
							pausecomp($minexectime - elapsed_time);
						}
						do_getProgressHTML(BytesIn, BytesOut, Files);
						pausecomp($minexectime);						
						do_Extract();
					}
				}
			}
			
			function do_getProgressHTML( bytesin, bytesout, files )
			{
				x_getProgressHTML( bytesin, bytesout, files, do_getProgressHTML_cb );
			}
			
			function do_getProgressHTML_cb( myRet )
			{
				document.getElementById('process').innerHTML = myRet;
			}
	</script>
ENDHEAD;
	$html = $html2 .$html;
	unset($html2);

	$html .= <<<END
<script type="text/javascript">
	do_Extract();
</script>
END;
	$this->_renderPage('', $html);
		}
		else
		{
			$offset = $this->ret['offset'];
			$bytesin += $this->ret['bytesin'];
			$bytesout += $this->ret['bytesout'];
			$files += $this->ret['files'];
				
			$task = 'extract';
			if($this->ret['error']) $task = 'error';
			if($this->ret['done']) $task = 'done';
			$error = $this->ret['error'];
				
			$scriptname=SCRIPTNAME;
			$inputs = '';
			$inputs .= "<input type=\"hidden\" name=\"CHUNKSIZE\" value=\"".CHUNKSIZE."\" />";
			$inputs .= "<input type=\"hidden\" name=\"MAXBATCHSIZE\" value=\"".MAXBATCHSIZE."\" />";
			$inputs .= "<input type=\"hidden\" name=\"MAXBATCHFILES\" value=\"".MAXBATCHFILES."\" />";
			$inputs .= "<input type=\"hidden\" name=\"TEMPDIR\" value=\"".TEMPDIR."\" />";
			$inputs .= "<input type=\"hidden\" name=\"MINEXECTIME\" value=\"".MINEXECTIME."\" />";
			$html = <<<ENDHTML
<form name="step" id="step" method="post" action="$scriptname">
	<input type="hidden" name="zipselect" value="$zipselect" />
	<input type="hidden" name="method" value="$method" />
	<input type="hidden" name="extract" value="$extract" />
	<input type="hidden" name="ftphost" value="$ftphost" />
	<input type="hidden" name="ftpport" value="$ftpport"" />
	<input type="hidden" name="ftpuser" value="$ftpuser" />
	<input type="hidden" name="ftppass" value="$ftppass" />
	<input type="hidden" name="ftpdir" value="$ftpdir" />
	<input type="hidden" name="offset" value="$offset" />
	<input type="hidden" name="bytesin" value="$bytesin" />
	<input type="hidden" name="bytesout" value="$bytesout" />
	<input type="hidden" name="files" value="$files" />
	<input type="hidden" name="task" value="$task" />
	<input type="hidden" name="error" value="$error" />
	$inputs
	$restoreperms
</form>
ENDHTML;
	$progresshtml = $this->getProgressHTML($bytesin, $bytesout, $files);
	$html .= <<<ENDHTML
<script type="text/javascript" language="Javascript">
	document.forms.step.submit();
</script>			
ENDHTML;
	$this->_renderPage('', $html, '', $progresshtml);
		}
	}

	function getProgressHTML($bytesin, $bytesout, $files)
	{
		$textRead = Text::_('BYTES_READ');
		$textWritten = Text::_('BYTES_WRITTEN');
		$textProcessed = Text::_('FILES_PROCESSED');
		return <<<ENDHTML
	<p>
	$textRead: $bytesin bytes<br />
	$textWritten: $bytesout bytes<br />
	$textProcessed: $files files<br />
	</p>
ENDHTML;
	}

	function error()
	{
		$error = getVar('error');
		$this->_renderPage('','',$error);
	}

	function done()
	{
		global $automation;
		
		$filename = urlencode(getVar('zipselect'));

		if((AUTOMODE != 1) && !$automation) { $mode = 'manual'; } else { $mode = $automation ? 'jpi4' : 'jpi3'; }
		switch($mode)
		{
			case 'jpi3':
				// JPI3 Auto Mode - Call the db restoration step directly
				$DBname = DBname;
				$DBhostname = DBhostname;
				$DBPrefix = DBPrefix;
				$DBuserName = DBuserName;
				$DBpassword = DBpassword;
				$DBfilename = DBfilename;
				$scriptname=SCRIPTNAME;
	
				$textHere1		= '<a href="'.$scriptname.'?task=finalize&zipselect='.$filename.'">' . Text::_('HTML_HERE') . '</a>';
				$textAuto1		= Text::sprintf('HTML_AUTO1', $textHere1);
				$textAuto2		= Text::_('HTML_AUTO2');
				$textAuto3		= Text::_('HTML_AUTO3');
				$textAuto4		= Text::_('HTML_AUTO4');
					
				$html = <<<ENDHTML
				<p>$textAuto1</p>
				<p><b>$textAuto2</b></p>
				
				<p>$textAuto3</p>
				<form action="installation/index.php" method="post" target="_blank" id="autoform">
					<input type="hidden" name="task" value="dbconfig" />
					<input type="hidden" name="vars[auto]" value="1" />
					<input type="hidden" name="vars[DBname]" value="$DBname" />
					<input type="hidden" name="vars[DBhostname]" value="$DBhostname" />
					<input type="hidden" name="vars[DBPrefix]" value="$DBPrefix" />
					<input type="hidden" name="vars[DBuserName]" value="$DBuserName" />
					<input type="hidden" name="vars[DBpassword]" value="$DBpassword" />
					<input type="hidden" name="vars[DBfilename]" value="$DBfilename" />
					<input type="submit" value="$textAuto4" />
				</form>
				
				<script type="text/javascript">
					document.autoform.submit();
				</script>
ENDHTML;
				break;

			case 'jpi4':
				// JPI4 Automation Mode
				// Redirect to the installation page
				$redirectURL = 'installation/index.php';
				$pos = strpos($_SERVER['REQUEST_URI'],SCRIPTNAME);
				if($pos !== FALSE)
				{
					$siteURL = substr($_SERVER['REQUEST_URI'],0,$pos);
					$redirectURL = $siteURL.$redirectURL;
				}
	
				$html = <<<ENDHTML2
<script type="text/javascript">
	top.location.href = '$redirectURL';
</script>
ENDHTML2;
				break;

			case 'manual':
			default:
				$scriptname=SCRIPTNAME;
				$textHere1		= '<a href="installation/index.php" target="_blank">' . Text::_('HTML_HERE') . '</a>';
				$textHere2		= '<a href="'.$scriptname.'?task=finalize&zipselect='.$filename.'">' . Text::_('HTML_HERE') . '</a>';
				$textClick1		= Text::sprintf('HTML_CLICK1', $textHere1);
				$textClose		= Text::_('HTML_DONT_CLOSE');
				$textClick2		= Text::sprintf('HTML_CLICK2', $textHere2);
					
				$html = <<<ENDHTML
				<p>$textClick1<br />
				<b>$textClose</b>
				<br />$textClick2</p>
ENDHTML;
				break;

		}
		
		$this->_renderPage('', $html);
	}

	function finalize()
	{
		$filename=getVar('zipselect');
		renameHtaccess(false);
		deleteLeftovers($filename);

		$html = '<h2>'.Text::_('ALL_DONE').'</h2><p>'.Text::_('KICKSTART_FINISHED').'</p>';
		$this->_renderPage('',$html);
	}

	function _renderPage($headHTML, $interfaceHTML, $errorHTML = '', $processHTML = '')
	{
		global $automation;

		$errorStyle = empty($errorHTML) ? 'display : none' : 'display : block';
		$processStyle = empty($processHTML) ? 'display : none' : 'display : block';
		$interfaceStyle = empty($interfaceHTML) ? 'display : none' : 'display : block';
		header('Pragma: NO-CACHE');
		header('Cache-Control: disable');
		?>
<html>
<head>
<title>JoomlaPack Kickstart <?php echo KICKSTARTVERSION; ?></title>
<link rel="stylesheet" href="<?php echo SCRIPTNAME ?>?task=css"
	type="text/css" />
		<?php echo $headHTML; ?>
</head>
<body>
<h1>JoomlaPack Kickstart <?php echo KICKSTARTVERSION; ?></h1>
<div id="maincontainer"><?php if ( (AUTOMODE == 1) || $automation ) { ?>
<p id="automode">&quot;Auto mode&quot; is enabled.</p>
<p>&nbsp;</p>
		<?php } ?>
<div id="errorbox" style="<?php echo $errorStyle ?>"><?php echo $errorHTML ?>
</div>
<div id="process" style="<?php echo $processStyle ?>"><?php echo $processHTML ?>
</div>
<div id="interface" style="<?php echo $interfaceStyle ?>"><?php echo $interfaceHTML; ?>
</div>
<p>&nbsp;</p>
</div>
<div id="footer">
<p><?php echo Text::_('COPYRIGHT'); ?> &copy;2008-2009 <a
	href="http://www.joomlapack.net">JoomlaPack Developers</a>. <?php echo Text::_('LICENSE'); ?></p>
</div>
</body>
</html>
		<?php
	}
}
?><?php
// ==========================================================================================
// KS: Controller files
// ==========================================================================================

class KickstartController
{
	function display()
	{
		$view = new KickstartView();

		// Password feature handling; used in conjuction with Restore mode, or when
		// the password protection feature is in effect
		if(defined('PASSWORD'))
		{
			if(is_null( getVar('password') ) || ( getVar('password','') != PASSWORD ) )
			{
				$view->renderPassword();
				return;
			}
		}
		$view->renderMain();
	}

	function error()
	{
		$view = new KickstartView();
		$view->error();
	}

	function done()
	{
		//renameHtaccess(true);
		$view = new KickstartView();
		$view->done();
	}

	function finalize()
	{
		$view = new KickstartView();
		$view->finalize();
	}

	function extract()
	{
		global $ftp;

		$method = getVar('method','ajax');
		$extract = getVar('extract','direct');
		$restoreperms = getVar('restoreperms', '') == 'on' ? true : false;

		$view = new KickstartView();

		$offset = getVar('offset', 0);
		$stealth = getVar('stealth', '') == 'on' ? true : false;
		$stealthurl = getVar('stealthurl', null);
		if( ($offset == 0) && ($stealth) )
		{
			stealthHtaccess( $stealthurl );
		}
		
		if($method != 'ajax')
		{
			$filename = getVar('zipselect','');
			$offset = getVar('offset', 0);
				
			if(($extract == 'ftp') && ($ftp->error))
			{
				$ret = array('error' => $ftp->error);
			}
			else
			{
				$ret = myExtract($filename, $offset, $restoreperms);
			}
				
			$view->ret = $ret;
		}

		$view->extract();
	}

	function css()
	{
		echoCSS();
	}

	function dump()
	{
		header('Content-type: text/plain');
		header('Content-Disposition: attachment; filename="en-GB.kickstart.ini"');
		$lang =& Language::getInstance();
		$lang->resetTranslation();
		echo $lang->dumpLanguage();
	}
}
?><?php
// ==========================================================================================
// KS: Main application
// ==========================================================================================

/**
 * Handles the parsing of any jpi4automation.ini file being around
 * @return bool True if there is a jpi4automation.ini and contains a Kickstart section
 */
function automation()
{
	if( @file_exists('jpi4automation.ini') )
	{
		// Load and parse
		$automation = Language::_parse_ini_file('jpi4automation.ini', true);
		if( isset($automation['kickstart']) )
		{
			// Import the contents of the Kickstart section to the $_REQUEST superglobal
			foreach( $automation['kickstart'] as $variable => $value )
			{
				$_REQUEST[$variable] = $value;
			}
			return true;
		}
		else
		{
			// No Kickstart section found
			return false;
		}
	}
	else
	{
		// jpi4automation.ini wasn't found
		return false;
	}
}

/**
 * Returns the contents of a request variable
 * @param string $name The request variable to look for
 * @param mixed $default [optional] The default value to return if the variable doesn't exist, defaults to null
 * @return mixed The value of the request variable 
 */
function getVar($name, $default = null)
{
	if(isset($_REQUEST[$name]))
	{
		return $_REQUEST[$name];
	}
	else
	{
		return $default;
	}
}

/**
 * Extracts a bacth of files from the ZIP file
 *
 * @param string $filename The ZIP file to extract from
 * @param integer $offset Offset to start unzipping from
 * @return array A return array
 */
function myExtract( $filename, $offset = 0, $restoreperms = false )
{
	$config = array(
		'filename' => $filename,
		'rename_files' => array(
				'.htaccess' => 'htaccess.bak',
				'htaccess.bak' => 'htaccess.bak~'
			),
		'translate' => true
	);
	
	$extract = getVar('extract','direct');
	if($extract == 'ftp')
	{
		global $ftp;
		$config['use_ftp'] = true;
		$config['ftp'] =& $ftp;
	}
	
	if($restoreperms)
	{
		$config['restore_permissions'] = true;
	}
	
	$extension = array_pop(explode('.', $filename));
	switch( $extension )
	{
		case 'zip':
			$zip = new CSimpleUnzip( $config );
			$isJPA = false;
			break;
				
		case 'jpa':
			$zip = new CUnJPA( $config );
			$isJPA = true;
			break;
				
		default:
			return array("iserror"=>true,'error'=>Text::sprintf('UNEXPECTED_EXTENSION', $extension));
			break;
	}

	$filesRead	= 1;
	$bytesRead	= 0;
	$bytesOut	= 0;

	// Process up to MAXBATCHFILES files in a row, or a maximum of MAXBATCHSIZE bytes
	while( ($filesRead <= MAXBATCHFILES) && ($bytesRead <= MAXBATCHSIZE) )
	{
		$result = $zip->Extract( $offset );
		if( $result === false )
		{
			$retArray = array(
				'offset'	=> $offset,
				'bytesin'	=> 0,
				'bytesout'	=> 0,
				'files' 	=> 0,
				'iserror'	=> true,
				'error'		=> $zip->getError(),
				'done'		=> false
			);
			return $retArray;
		} else {
			if( $result['done'] == false )
			{
				// Increase read counter by ammount of bytes read and increase file read count
				$bytesRead		+= $result['compressed'];
				$bytesOut		+= $result['uncompressed'];
				$filesRead		+= 1;
				// Update next offset
				$offset			= $result['offset'];
			} else {
				// We are just done extracting!
				$retArray = array(
					'offset'	=> $offset,
					'bytesin'	=> $bytesRead,
					'bytesout'	=> $bytesOut,
					'files' 	=> $filesRead,
					'iserror'	=> false,
					'error'		=> '',
					'done'		=> true
				);
				return $retArray;
			}
		}
	}
	$retArray = array(
		'offset'	=> $offset,
		'bytesin'	=> $bytesRead,
		'bytesout'	=> $bytesOut,
		'files'		=> $filesRead,
		'iserror'	=> false,
		'error'		=> '',
		'done' => false
	);

	return $retArray;
}

function getProgressHTML($bytesin, $bytesout, $files)
{
	$view = new KickstartView();
	return $view->getProgressHTML($bytesin, $bytesout, $files);
}

/**
 * Renames the .htaccess file (if it exists) to htaccess.txt or vice versa
 *
 * @param boolean $isPreInstall If TRUE, renames .htaccess to htaccess.bak. If FALSE performs the inverse.
 * @return unknown
 */
function renameHtaccess( $isPreInstall = true )
{
	if( $isPreInstall ) {
		// Rename old .htaccess
		if( @file_exists('.htaccess') ) @rename('.htaccess', 'htaccess.bak');
	} else {
		if( @file_exists('htaccess.bak') ) return @rename('htaccess.bak', '.htaccess');
	}
}


/**
 * Returns the extension of a file
 * @param $filename
 * @return unknown_type
 */
function _getBaseExtension($filename)
{
	static $baseextension;
	
	if(empty($baseextension))
	{
		$basename = basename($filename);
		$lastdot = strrpos($basename,'.');
		$baseextension = substr($basename, $lastdot);
	}
	
	return $baseextension;
}

/**
 * Removes all parts of a split archive
 * @param $zipFile
 * @return unknown_type
 */
function deleteMultiparts( $zipFile )
{
	// Get the components of the archive filename
	$dirname = dirname($zipFile);
	$base_extension = _getBaseExtension($zipFile);
	$basename = basename($zipFile, $base_extension);

	// Scan for multiple parts until we don't find any more of them
	$found = true;
	$count = 0;
	while($found)
	{
		$count++;
		$extension = substr($base_extension, 0, 2).sprintf('%02d', $count);
		$filename = $dirname.DIRECTORY_SEPARATOR.$basename.$extension;
		$found = @file_exists($filename);
		if($found)
		{
			@unlink($filename);
		}
		else
		{
			@unlink($zipFile);
		}
	}
}

function deleteLeftovers( $zipFile )
{
	// Delete the archive (all of its parts)
	deleteMultiparts($zipFile);
	// Remove the installation directory
	@_unlinkRecursive('installation');
	// Delete this Kickstart PHP file
	@unlink(__FILE__);
	// Delete any automation INI file
	if(@file_exists('jpi4automation.ini')) @unlink('jpi4automation.ini');
	// Try to delete any Kickstart language files
	$FS = new JoomlapackListerAbstraction();
	$basename=basename(__FILE__, '.php') . '.ini';
	$fileList = $FS->getDirContents( @dirname(__FILE__), '*.'.$basename );
	if ($fileList !== false) {
		foreach($fileList as $fileDescriptor) {
			@unlink($fileDescriptor['name']);
		}
	}
}

function _unlinkRecursive( $dirName ) {
	$FS = new JoomlapackListerAbstraction();

	if (is_file( $dirName )) {
		echo Text::sprintf('UNLINKING_FILE', $dirName);
		@unlink( $dirName );
	} elseif (is_dir( $dirName )) {
		$fileList = $FS->getDirContents( $dirName );
		if ($fileList === false) {
		} else {
			foreach($fileList as $fileDescriptor) {
				switch($fileDescriptor['type']) {
					case "dir":
						if( !((substr($fileDescriptor['name'], -1, 1) == '.') || (substr($fileDescriptor['name'], -1, 2) == '..') ) )
						{
							_unlinkRecursive( $fileDescriptor['name'] );
						}
						break;
					case "file":
						@unlink( $fileDescriptor['name'] );
						break;
						// All other types (links, character devices etc) are ignored.
				}
			}
			@rmdir($dirName);
		}
	}
}

/**
 * AJAX method for archive extraction
 *
 */
function doextract($zipselect, $extract, $ftphost, $ftpport, $ftpuser, $ftppass, $ftpdir, $offset, $restoreperms)
{
	global $ftp;

	// Pass on the parameters
	$_REQUEST['zipselect'] = $zipselect;
	$_REQUEST['extract'] = $extract;
	$_REQUEST['ftphost'] = $ftphost;
	$_REQUEST['ftpport'] = $ftpport;
	$_REQUEST['ftpuser'] = $ftpuser;
	$_REQUEST['ftppass'] = $ftppass;
	$_REQUEST['ftpdir'] = $ftpdir;
	if($restoreperms) $_REQUEST['restoreperms'] = 'on';

	if($extract == 'ftp')
	{
		$ftp = new myFTP();
		if( $ftp->error )
		{
			return array("iserror"=>true, 'error' => $ftp->error);
		}
	}

	// Perform extraction
	$restoreperms = ($restoreperms == 1);
	$ret = myExtract($zipselect, $offset, $restoreperms);

	if(($extract == 'ftp') && is_object($ftp))
	{
		$ftp->close();
	}

	// Return result array
	return $ret;
}

/**
 * Attempts to generate a "stealth" .htaccess file, allowing access only from our own IP
 * @return unknown_type
 */
function stealthHtaccess( $redirectURL = null )
{
	$userIP = $_SERVER['REMOTE_ADDR'];
	
	if(empty($redirectURL))
	{
		// Simple .htaccess rule set script to allow access only from user's IP
		$htaccess = "deny from all\nallow from $userIP";
	} else {
		// Complex .htaccess rule set to redirect everything to a URL, except if the request comes from the user's IP 
		if( !( (substr($redirectURL, 0, 7) == 'http://') || (substr($redirectURL, 0, 8) == 'https://') ) )
		{
			// Prepend site URL
			$pos = strpos($_SERVER['REQUEST_URI'],SCRIPTNAME);
			if($pos !== FALSE)
			{
				$siteURL = substr($_SERVER['REQUEST_URI'],0,$pos);
				$redirectURL = $siteURL.$redirectURL;
			}
		}
		$userIP = str_replace('.', '\.', $userIP);
		$htaccess = <<<ENDHTACCESS
RewriteEngine On
RewriteRule \.jpg$ - [L]
RewriteRule \.png$ - [L]
RewriteRule \.gif$ - [L]
RewriteRule \.css$ - [L]
RewriteRule \.ini$ - [L]
RewriteRule \.js - [L]
RewriteRule \.htm$ - [L]
RewriteRule \.html$ - [L]
RewriteCond %{REMOTE_HOST} !^$userIP.*
RewriteRule .* $redirectURL [R]

ENDHTACCESS;
	}
	
	@unlink('.htaccess');
	@file_put_contents('.htaccess', $htaccess);
}

/**
 * Enforces the minimum execution time per step, if such a thing is set up
 * @param bool $starting True when starting timing the script, false otherwise
 */
function _enforce_minexectime($starting)
{
	static $start_time, $end_time;

	if($starting)
	{		
		list($usec, $sec) = explode(" ", microtime());
		$start_time = ((float)$usec + (float)$sec);
	}
	else
	{
		// Try to get a sane value for PHP's maximum_execution_time INI parameter
		if(@function_exists('ini_get'))
		{
			$php_max_exec = @ini_get("maximum_execution_time");
		}
		else
		{
			$php_max_exec = 10;
		}
		if ( ($php_max_exec == "") || ($php_max_exec == 0) ) {
			$php_max_exec = 10;
		}
		// Decrease $php_max_exec time by 500 msec we need (approx.) to tear down
		// the application, as well as another 500msec added for rounding
		// error purposes. Also make sure this is never gonna be less than 0.
		$php_max_exec = max($php_max_exec * 1000 - 1000, 0);

		// Get the "minimum execution time per step" configuration constant
		$minexectime = MINEXECTIME;
		if(!is_numeric($minexectime)) $minexectime = 0;
		
		// Make sure we are not over PHP's time limit! 
		if($minexectime > $php_max_exec) $minexectime = $php_max_exec;

		// Get current timestamp and calculate how much time has passed
		list($usec, $sec) = explode(" ", microtime());
		$end_time = ((float)$usec + (float)$sec);
		$elapsed_time = 1000 * ($end_time - $start_time);
		
		// Only run a sleep delay if we haven't reached the minexectime execution time
		if( ($minexectime > $elapsed_time) && ($elapsed_time > 0) )
		{
			$sleep_msec = $minexectime - $elapsed_time;
			if(function_exists('usleep'))
			{
				usleep(1000 * $sleep_msec);
			}
			elseif(function_exists('time_nanosleep'))
			{
				$sleep_sec = round($sleep_msec / 1000);
				$sleep_nsec = 1000000 * ($sleep_msec - ($sleep_sec * 1000));
				time_nanosleep($sleep_sec, $sleep_nsec);
			}
			elseif(function_exists('time_sleep_until'))
			{
				$until_timestamp = time() + $sleep_msec / 1000;
				time_sleep_until($until_timestamp);
			}
			elseif(function_exists('sleep'))
			{
				$sleep_sec = ceil($sleep_msec/1000);
				sleep( $sleep_sec );	
			}
		}
		elseif( $elapsed_time > 0 )
		{
			// No sleep required, even if user configured us to be able to do so.
		}
	}
}

// Enforce minimum execution time (startup)
_enforce_minexectime(true);

// Get task to run
$task = getVar('task','display');

// Apply some global variables as constants
define('CHUNKSIZE',		(int)getVar('CHUNKSIZE',1048576));
define('MAXBATCHSIZE',	(int)getVar('MAXBATCHSIZE',1048576));
define('MAXBATCHFILES', (int)getVar('MAXBATCHFILES',40));
define('TEMPDIR', 		getVar('TEMPDIR',dirname(__FILE__)));
define('MINEXECTIME',	(int)getVar('MINEXECTIME',1000));

// Load automation
global $automation;
$automation = automation();

// In automation mode, skip the first page
if($automation && ($task == 'display') ) $task = 'extract';

// Get the extraction mode
$extract = getVar('extract','direct');

if($extract == 'ftp')
{
	global $ftp;
	$ftp = new myFTP();
}

if(!isset($_REQUEST['rs']))
{
	/* Non AJAX mode */

	// Instanciate the controller
	$controller = new KickstartController();

	// If the method doesn't exist, show an error
	if(!method_exists($controller, $task))
	{
		die('error');
	}

	// Execute the requested action
	$controller->$task();

}
else
{
	// Handle AJAX request
	sajax_init();
	sajax_export('doextract', 'getProgressHTML');
	sajax_handle_client_request();
}

if($extract == 'ftp')
{
	global $ftp;
	if(!$ftp->error) $ftp->close();
}

// Enforce minimum execution time (stopping)
_enforce_minexectime(false);

?>