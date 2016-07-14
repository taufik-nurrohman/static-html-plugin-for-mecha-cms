<?php

function do_static_html_replace() {
    $config = Mecha::A(Config::get());
    if(isset($config[$config['page_type']]['content_raw'])) {
        $content = $config[$config['page_type']]['content_raw'];
        if(strpos($content, '{{') !== false) {
            $content = preg_replace_callback('#\{\{(config|speak|this)\.([\w.]+?)\}\}#', function($m) use($config) {
                if($m[1] === 'config') {
                    $s = Mecha::GVR($config, $m[2], $m[0]);
                    return is_array($s) ? json_encode($s) : $s;
                } else if($m[1] === 'speak') {
                    $s = Mecha::GVR($config['speak'], $m[2], $m[0]);
                    return is_array($s) ? json_encode($s) : $s;
                }
                $s = Mecha::GVR($config[$config['page_type']], $m[2], $m[0]);
                return is_array($s) ? json_encode($s) : $s;
            }, $content);
        }
        $s = strtolower($content);
        if(substr($s, -7) === '</html>' && (strpos($s, '<!doctype ') === 0 || strpos($s, '<html>') === 0 || strpos($s, '<html ') === 0)) {
            echo $content;
            exit;
        }
    }
}

Weapon::add('shield_before', 'do_static_html_replace');