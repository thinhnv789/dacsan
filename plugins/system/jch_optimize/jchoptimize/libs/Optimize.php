<?php

namespace JchOptimize;

/**
 * JCH Optimize - Aggregate and minify external resources for optmized downloads
 * 
 * @author Samuel Marshall <sdmarshall73@gmail.com>
 * @copyright Copyright (c) 2010 Samuel Marshall
 * @license GNU/GPLv3, See LICENSE file
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * If LICENSE file missing, see <http://www.gnu.org/licenses/>.
 */
class Optimize
{

        //regex for double quoted strings
        const DOUBLE_QUOTE_STRING = '"(?>(?:\\\\.)?[^\\\\"]*+)+?(?:"|(?=$))';
        //regex for single quoted string
        const SINGLE_QUOTE_STRING = "'(?>(?:\\\\.)?[^\\\\']*+)+?(?:'|(?=$))";
        //regex for block comments
        const BLOCK_COMMENTS = '/\*(?>[^/\*]++|//|\*(?!/)|(?<!\*)/)*+\*/';
        //regex for line comments
        const LINE_COMMENTS = '//[^\r\n]*+';

        protected $_debug    = false;
        protected $_regexNum = -1;

        /**
         * 
         * @param type $rx
         * @param type $code
         * @param type $regexNum
         * @param type $pstamp
         * @return boolean
         */
        protected function _debug($rx, $code, $regexNum = 0, $pstamp = false)
        {
                if (!$this->_debug) return false;

                $nstamp = microtime(true);

                if ($pstamp !== false)
                {
                        print 'num=' . $regexNum . "\n";
                        print 'time=' . ($nstamp - $pstamp) . "\n\n";
                }

                if ($regexNum == $this->_regexNum)
                {
                        print $rx . "\n";
                        print $code . "\n\n";
                }

                return $nstamp;
        }

        /**
         * 
         * @staticvar type $tm
         * @param type $rx
         * @param type $code
         * @param type $replacement
         * @param type $regex_num
         * @return type
         */
        protected function _replace($rx, $replacement, $code, $regex_num, $callback=null)
        {
                static $tm = 0;

                if($tm === 0)
                {
                       $tm = $this->_debug('', ''); 
                }
                
                if(empty($callback))
                {
                        $op_code = preg_replace($rx, $replacement, $code);
                }
                else
                {
                        $op_code = preg_replace_callback($rx, $callback, $code);
                }
                
                $tm      = $this->_debug($rx, $code, $regex_num, $tm);
                if (preg_last_error() != PREG_NO_ERROR) return $code;

                return $op_code;
        }

}
