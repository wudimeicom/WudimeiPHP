<?php

/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */

namespace Wudimei\Session;

class File extends BasicSession {

    public function __construct($config) {
        parent::__construct($config);
    }

    function loadSession() {
        $id = $this->session_id;

        $this->gc();
        $file = $this->getSessionFileName();

        $content = '';
        if (file_exists($file)) {
            $this->tryGcFile($file);
            $content = (string) @file_get_contents($file);
        }
        $dt = unserialize($content);
        if( !empty($dt)){
            $this->session_data = $dt['session_data'];
            $this->flash_flags = $dt['flash_flags'];
        }
    }

    function saveSession() {
        $data = serialize(['session_data' => $this->session_data, 'flash_flags' => $this->flash_flags]);
        $filePath = $this->getSessionFileName();
        $dir = dirname($filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return file_put_contents($filePath, $data) === false ? false : true;
    }

    public function getSessionFileName() {
        $folder = substr($this->session_id, 0, 2);
        $filePath = $this->config["files"] . "/" . $folder . "/" . $this->session_id;
        return $filePath;
    }

    function gc() {
        $last_gc_time_filename = $this->config["files"] . "/last_gc_time.txt";
        $last_gc_time = @file_get_contents($last_gc_time_filename);
        $last_gc_time = intval($last_gc_time);
        // !-----------uncoment the line below to debug
        //$last_gc_time = 0;
        if ($last_gc_time + $this->config["gc_maxlifetime"] < time()) {
            $this->gcDir($this->config["files"]);
            file_put_contents($last_gc_time_filename, time());
        }

        return true;
    }

    function gcDir($dir) {

        $dir = realpath($dir);

        if (strlen($dir) < 3) { //protect file system
            return false;
        }

        $dirObj = dir($dir);
        while (($file = $dirObj->read()) !== false) {

            if ($file != "." && $file != "..") {
                $path = $dir . "/" . $file;
                if (is_dir($path)) {
                    $this->gcDir($path);
                } else {
                    $this->gcFile($path);
                }
            }
        }
        $dirObj->close();
    }

    public function gcFile($file) {
        $lifetime = $this->config["lifetime"];
        $gc_maxlifetime = $this->config['gc_maxlifetime'];
        if ($lifetime > 0) { //if lifetime equals 0,will expire on close
            $gc_maxlifetime = $lifetime;
        }
        if (filemtime($file) + $gc_maxlifetime < time() && file_exists($file)) {
            if (strpos($file, "last_gc_time.txt") === false) {
                unlink($file);
            }
        }
    }

    public function tryGcFile($file) {
        $this->gcFile($file);
    }

}
