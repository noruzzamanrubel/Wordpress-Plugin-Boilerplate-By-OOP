<?php

namespace Noruzzaman\BoomDevs\frontend;

/**
 * Shortcode handler class
 */
class Shortcode {
    /**
     * Initializes the class
     */
    function __construct() {
        add_shortcode( 'boomdevs', [$this, 'render_shortcode'] );
    }

    /**
     * Shortcode handler class
     *
     * @param  array $atts
     * @param  string $content
     *
     * @return string
     */
    public function render_shortcode( $atts, $content = '' ) {
        return 'hello from shoetcode';
    }

}
