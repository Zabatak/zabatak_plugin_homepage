<?php

class Markdown_Core {

    public function parse($text) {
        if ( !function_exists('Markdown')) {
            // Load SwiftMailer
            require 'vendor/markdown.php';

            // Register the Swift ClassLoader as an autoload
            //spl_autoload_register(array('Swift_ClassLoader', 'load'));
        }
        
        return Markdown( $text);
    }

}