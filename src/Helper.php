<?php

namespace Aidias\GelbCore;

class Helper 
{
    /**
     * Recursive copy all file from a directory, including the directory
     * 
     * @return void
     */
    static function xcopy($from, $to)
    {
        $dir = opendir($from); 

        @mkdir($to); 
        
        while(false !== ($file = readdir($dir)))
        { 
            if (($file != '.') && ($file != '..'))
            { 
                if (is_dir($from . '/' . $file))
                { 
                    self::xcopy($from . '/' . $file, $to . '/' . $file); 
                } 
                else { 
                    copy($from . '/' . $file, $to . '/' . $file); 
                } 
            } 
        }

        closedir($dir);
    }
}