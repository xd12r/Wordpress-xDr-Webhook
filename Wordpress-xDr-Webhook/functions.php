<?php

function webhook_plugin_menu() {
    add_options_page('xDr Webhook Plugin Settings', 'xDr Webhook Plugin', 'manage_options', 'xdr-webhook-plugin', 'xdr_webhook_plugin_settings_page');
}

add_action('admin_menu', 'webhook_plugin_menu');

function xdr_webhook_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h1>xDr Webhook Plugin</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('xdr-webhook-plugin-settings');
            do_settings_sections('xdr-webhook-plugin-settings');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Webhook URL</th>
                    <td><input type="text" name="webhook_url" value="<?php echo esc_attr(get_option('webhook_url')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function xdr_register_webhook_plugin_settings() {
    register_setting('xdr-webhook-plugin-settings', 'webhook_url');
}

add_action('admin_init', 'xdr_register_webhook_plugin_settings');

function xdr_send_webhook_on_publish( $ID, $post ) {
    // Ensure the webhook_url is defined.
    $webhook_url = get_option('webhook_url');
	$post_url = get_permalink($post);
	$thumbnail_url = get_the_post_thumbnail_url($post);

    // Ensure the body is defined and contains the data you want to send.
    $body = array(
        'id' => $ID,
        'title' => $post->post_title,
        'content' => $post->post_content,
        'status' => $post->post_status,
        'author' => $post->post_author,
		'url' => $post_url,
		'thumbnail_url' => $thumbnail_url,
        // include any other details you want
    );

    $response = wp_remote_post( $webhook_url, array(
        'method' => 'POST',
        'headers' => array(
            'Content-Type' => 'application/json; charset=utf-8'
        ),
        'body' => json_encode($body),
    ));
}

add_action( 'publish_post', 'xdr_send_webhook_on_publish', 10, 2 );

function xdr_hook_post_updated_send_webhook($post_id) {
    $post = get_post($post_id);
    $url = get_permalink($post_id);
    $title = $post->post_title;
    $content = $post->post_content;
    $author = $post->post_author;
    $status = $post->post_status;
    $thumbnail_url = get_the_post_thumbnail_url($post_id, 'full');

    $webhook_url = get_option('webhook_url_option');

    // only send a webhook if the post is published
    if($status == 'publish') {
        $body = json_encode(array(
            'id' => $post_id,
            'title' => $title,
            'content' => $content,
            'status' => $status,
            'author' => $author,
            'url' => $url,
            'thumbnail_url' => $thumbnail_url
        ), JSON_UNESCAPED_SLASHES);

        // Send a POST request to the webhook URL
        wp_remote_post($webhook_url, array(
            'headers' => array('Content-Type' => 'application/json; charset=utf-8'),
            'body' => $body,
            'method' => 'POST',
            'data_format' => 'body',
        ));
    }
}

add_action('save_post', 'xdr_hook_post_updated_send_webhook', 10, 1);
