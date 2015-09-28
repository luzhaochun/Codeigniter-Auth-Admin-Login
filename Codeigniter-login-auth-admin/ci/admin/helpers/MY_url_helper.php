<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/url_helper.html
 */
// ------------------------------------------------------------------------
// ------------------------------------------------------------------------

if (!function_exists('base_url')) {

    /**
     * Base URL
     *
     * Create a local URL based on your basepath.
     * Segments can be passed in as a string or an array, same as site_url
     * or a URL to a file can be passed in, e.g. to an image file.
     *
     * @param	string	$uri
     * @param	string	$protocol
     * @return	string
     */
    function base_url($uri = '', $protocol = NULL) {
        return get_instance()->config->base_url($uri, $protocol);
    }

}


if (!function_exists('css_url')) {
    function css_url($uri = '') {
        $CI = & get_instance();
        $css_string = "<link rel='stylesheet' type='text/css' href='" . $CI->config->base_url("/../public/admin/css" . $uri) . "' media='all'>";
        return $css_string;
    }
}

if (!function_exists('javascript_url')) {
    function javascript_url($uri = '') {
        $CI = & get_instance();
        $javascript_string = "<script type='text/javascript' src='" . base_url("/../public/admin/javascript" . $uri) . "'></script>";
        return $javascript_string;
    }
}

if (!function_exists('bootstrap_url')) {
    function bootstrap_url($uri = '',$type = 'css') {
        $CI = & get_instance();
        if($type == 'css'){
            $return_string = "<link rel='stylesheet' type='text/css' href='" . $CI->config->base_url("/../public/admin/bootstrap" . $uri) . "' media='all'>";
        }elseif($type == 'javascript'){
            $return_string = "<script type='text/javascript' src='" . base_url("/../public/admin/bootstrap" . $uri) . "'></script>";
        }else{
            $return_string = "<link rel='stylesheet' type='text/css' href='" . $CI->config->base_url("/../public/admin/bootstrap" . $uri) . "' media='all'>";
        }
        
        return $return_string;
    }
}