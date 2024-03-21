<?php
function myFunction() {
    if ( is_home() ) {
        echo '<form>
                <input type="text" name="email" id="email" placeholder="Your Email" />
                <button type="submit">Subscribe</button>
              </form>';
    }
}
// add_action( 'wp_footer', 'myFunction' );
?>