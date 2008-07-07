<?php
/**
 * package.xml parsing class, package.xml version 2.0
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This source file is subject to version 3.0 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_0.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   pear
 * @package    PEAR
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    CVS: $Id: v2.php,v 1.1 2005/07/02 21:12:31 lux Exp $
 * @link       http://pear.php.net/package/PEAR
 * @since      File available since Release 1.4.0a1
 */
/**
 * base xml parser class
 */
require_once 'PEAR/XMLParser.php';
require_once 'PEAR/PackageFile/v2.php';
/**
 * Parser for package.xml version 2.0
 * @category   pear
 * @package    PEAR
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @PEAR-VER@
 * @link       http://pear.php.net/package/PEAR
 * @since      Class available since Release 1.4.0a1
 */
class PEAR_PackageFile_Parser_v2 extends PEAR_XMLParser
{
    var $_config;
    var $_logger;
    var $_registry;

    function setConfig(&$c)
    {
        $this->_config = &$c;
        $this->_registry = &$c->getRegistry();
    }

    function setLogger(&$l)
    {
        $this->_logger = &$l;
    }

    /**
     * @param string
     * @param string file name of the package.xml
     * @param string|false name of the archive this package.xml came from, if any
     * @param string class name to instantiate and return.  This must be PEAR_PackageFile_v2 or
     *               a subclass
     * @return PEAR_PackageFile_v2
     */
    function parse($data, $file, $archive = false, $class = 'PEAR_PackageFile_v2')
    {
        $test = $this->preProcessStupidSaxon($data);
        if (PEAR::isError($err = parent::parse($data, $file))) {
            return $err;
        }
        $ret = new $class;
        if ($test != $data) {
            $ret->_stack->push('_warningNonIsoChars', 'warning', array(),
                'Non-ISO-8859-1 character detected, validation may fail');
        }
        $ret->setConfig($this->_config);
        if (isset($this->_logger)) {
            $ret->setLogger($this->_logger);
        }
        $ret->fromArray($this->_unserializedData);
        $ret->setPackagefile($file, $archive);
        return $ret;
    }
}
?>