<?php
class CustomMetaBox
{
    const META_KEY = 'tm_custom_metabox';
    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add']);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add()
    {
        add_meta_box(self::META_KEY, 'Title metabox', [self::class, 'render'], 'post', 'side');
    }

    public static function render()
    {
?>
            <span class="components-checkbox-control__input-container">
                <input type="hidden" value="0" name="<?= self::META_KEY ?>">
                <input class="components-checkbox-control__input" type="checkbox" value="1" name="<?= self::META_KEY ?>" id="<?= self::META_KEY ?>">
            </span>
            <label class="components-checkbox-control__label" for="<?= self::META_KEY ?>">Custom metabox</label>
<?php
    }

    public static function save($post_id)
    {
        if (array_key_exists(self::META_KEY, $_POST) && current_user_can('edit_post', $post_id)) {
            if ($_POST[self::META_KEY] === '0') {
                delete_post_meta($post_id, self::META_KEY);
            } else {
                update_post_meta($post_id, self::META_KEY, 1);
            }
        }
    }
}
?>