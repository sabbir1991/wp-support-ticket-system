<?php
/**
 * Side navigation template
 *
 * @since 1.0.0
 *
 * @package wp-support-manager
 */

global $wp;

$navigations = wpsm_get_dashboard_nav();
$request     = $wp->request;
$active      = explode('/', $request );

unset( $active[0] );

if ( $active ) {
    $active_menu = implode( '/', $active );
} else {
    $active_menu = 'overview';
}

?>
<ul class="wpsm-side-nav">

    <?php foreach ( $navigations as $key => $nav ): ?>

        <li class="<?php echo ( $key == $active_menu ) ? 'active' : ''; ?>"><a href="<?php echo $nav['url'] ?>" class=""><span class="fa <?php echo $nav['icon'] ?>"></span> <?php echo $nav['title'] ?></a></li>

    <?php endforeach ?>

</ul>
