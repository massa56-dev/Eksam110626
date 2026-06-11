<?php
/**
 * Plugin Name: Tark Käsi – Tooted CPT
 * Description: Registreerib kohandatud sisutüübi "Tooted" ning ACF väljarühma hinna, koostisosade ja valmistamisajaga.
 * Version:     1.0.0
 * Author:      Marek Maasikmets
 * Text Domain: tark-kasi-cpt
 */

defined('ABSPATH') || exit;

/* ----------------------------------------------------------------
   Register custom post type: toode
   ---------------------------------------------------------------- */
add_action('init', function () {
    register_post_type('toode', [
        'labels' => [
            'name'               => 'Tooted',
            'singular_name'      => 'Toode',
            'add_new'            => 'Lisa toode',
            'add_new_item'       => 'Lisa uus toode',
            'edit_item'          => 'Muuda toodet',
            'new_item'           => 'Uus toode',
            'view_item'          => 'Vaata toodet',
            'search_items'       => 'Otsi tooteid',
            'not_found'          => 'Tooteid ei leitud',
            'not_found_in_trash' => 'Prügikastis tooteid ei ole',
            'menu_name'          => 'Tooted',
        ],
        'public'            => true,
        'show_in_menu'      => true,
        'menu_icon'         => 'dashicons-food',
        'supports'          => ['title', 'editor', 'thumbnail', 'excerpt'],
        'has_archive'       => true,
        'rewrite'           => ['slug' => 'tooted'],
        'show_in_rest'      => true,
    ]);
});

/* ----------------------------------------------------------------
   Register ACF field group (requires ACF plugin to be active)
   ---------------------------------------------------------------- */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key'    => 'group_tark_kasi_toode',
        'title'  => 'Toote andmed',
        'fields' => [
            [
                'key'          => 'field_toode_hind',
                'label'        => 'Hind',
                'name'         => 'hind',
                'type'         => 'text',
                'instructions' => 'Sisesta hind koos valuutaga, nt "4.50€"',
                'required'     => 0,
                'placeholder'  => 'nt. 4.50€',
            ],
            [
                'key'          => 'field_toode_koostisosad',
                'label'        => 'Koostisosad',
                'name'         => 'koostisosad',
                'type'         => 'textarea',
                'instructions' => 'Loetle koostisosad komadega eraldatult',
                'required'     => 0,
                'rows'         => 3,
            ],
            [
                'key'          => 'field_toode_valmistamisaeg',
                'label'        => 'Valmistamisaeg',
                'name'         => 'valmistamisaeg',
                'type'         => 'text',
                'instructions' => 'Küpsetamis- või käärimisaeg, nt "26 tundi"',
                'required'     => 0,
                'placeholder'  => 'nt. 26 tundi',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'toode',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
    ]);
});

/* ----------------------------------------------------------------
   Fallback meta box if ACF is not installed
   ---------------------------------------------------------------- */
add_action('add_meta_boxes', function () {
    if (function_exists('acf_add_local_field_group')) {
        return; // ACF handles the fields
    }
    add_meta_box(
        'tark_kasi_toode_meta',
        'Toote andmed',
        'tark_kasi_render_meta_box',
        'toode',
        'normal',
        'default'
    );
});

function tark_kasi_render_meta_box(WP_Post $post): void {
    wp_nonce_field('tark_kasi_save_toode_meta', 'tark_kasi_toode_nonce');

    $hind           = get_post_meta($post->ID, 'hind', true);
    $koostisosad    = get_post_meta($post->ID, 'koostisosad', true);
    $valmistamisaeg = get_post_meta($post->ID, 'valmistamisaeg', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="toode_hind">Hind</label></th>
            <td><input type="text" id="toode_hind" name="toode_hind"
                       value="<?php echo esc_attr($hind); ?>"
                       placeholder="nt. 4.50€" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="toode_koostisosad">Koostisosad</label></th>
            <td><textarea id="toode_koostisosad" name="toode_koostisosad"
                          rows="3" class="large-text"><?php echo esc_textarea($koostisosad); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="toode_valmistamisaeg">Valmistamisaeg</label></th>
            <td><input type="text" id="toode_valmistamisaeg" name="toode_valmistamisaeg"
                       value="<?php echo esc_attr($valmistamisaeg); ?>"
                       placeholder="nt. 26 tundi" class="regular-text"></td>
        </tr>
    </table>
    <?php
}

add_action('save_post_toode', function (int $post_id): void {
    if (
        !isset($_POST['tark_kasi_toode_nonce']) ||
        !wp_verify_nonce($_POST['tark_kasi_toode_nonce'], 'tark_kasi_save_toode_meta') ||
        defined('DOING_AUTOSAVE') && DOING_AUTOSAVE
    ) {
        return;
    }

    $fields = ['hind', 'koostisosad', 'valmistamisaeg'];
    foreach ($fields as $field) {
        $key = 'toode_' . $field;
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $field, sanitize_textarea_field(wp_unslash($_POST[$key])));
        }
    }
});
