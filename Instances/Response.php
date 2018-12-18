<?php

namespace Common\Traits\Instances;

class Response
{
    use \Common\Traits\Response;

    private static $_instance;

    public static function respond( $data=[] ){
        if ( ! isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return (self::$_instance)->getResponse ( $data );
    }
}
