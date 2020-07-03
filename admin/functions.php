<?php

function get_template_part($string){
    require_once( dirname(__FILE__). '/' .$string . '.php');
}