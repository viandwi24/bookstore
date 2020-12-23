<?php
function HookLoad($files = [], $base, $params = []) {
    for ($i = 0; $i < count($files); $i++)
    {
        foreach ($params as $key => $value) {
            ${$key} = $value;
        }
        require $base . '/' . $files[$i] . 'Hook.php';
        foreach ($params as $key => $value) {
            unset(${$key});
        }
    }
}