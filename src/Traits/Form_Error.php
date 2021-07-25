<?php

namespace Noruzzaman\BoomDevs\Traits;

/**
 * Error Handler Trait
 */
trait Form_Error {
    
    /**
     * Holds the Error
     *
     * @var array
     */
    public $errors = [];
    
    /**
     * Check the form has any errors
     *
     * @param  string $key
     * @return ture | false
     */
    public function has_error( $key ) {

        if ( isset( $this->errors[$key] ) ) {
            return $this->errors[$key];
        }

        return false;
    }

    /**
     * Get the form errors
     *
     * @param  string $key
     * @return true | false
     */
    public function get_error( $key ) {

        if ( isset( $this->errors[$key] ) ) {
            return $this->errors[$key];
        }

        return false;
    }

}
