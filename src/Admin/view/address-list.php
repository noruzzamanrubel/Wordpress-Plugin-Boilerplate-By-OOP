<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e( 'Address Book', 'boomdevs' );?></h1>
    <a href="<?php echo admin_url( 'admin.php?page=boomdevs&action=new' ); ?>" class="page-title-action"><?php _e( 'Add New', 'boomdevs' );?></a>

    <form action="" method="post">
        <?php
            $table= new Noruzzaman\BoomDevs\Admin\Address_List();
            $table->prepare_items();
            $table->search_box( 'search', 'search_id' );
            $table->display();
        ?>

    </form>
</div>