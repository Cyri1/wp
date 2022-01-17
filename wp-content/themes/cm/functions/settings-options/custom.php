<?php
//create custom options menu in "Settings"
class CustomOptions
{
    const GROUP = 'custom_options';

    public static function register()
    {
        add_action('admin_menu', [self::class, 'addMenu']);
        add_action('admin_init', [self::class, 'registerSettings']);
    }

    public static function addMenu()
    {
        add_options_page('Menu Custom', 'Menu Custom', 'manage_options', self::GROUP, [self::class, 'render']);
    }

    public static function registerSettings()
    {
        add_settings_section('custom_options_section', 'title parameters', function () {
            echo 'description of parameters';
        }, self::GROUP);

        register_setting(self::GROUP, 'option1', ['default' =>  'default value1']);
        register_setting(self::GROUP, 'option2', ['default' =>  'default value2']);
        register_setting(self::GROUP, 'option3', ['default' =>  '']);

        add_settings_field(
            'custom_options_field1', //id
            'field label1', //label
            function () {
?>
            <textarea name="option1" class="w-100" cols="30" rows="10"><?= esc_html(get_option('option1')) ?></textarea>
        <?php
            },
            self::GROUP, // display page
            'custom_options_section' // section
        );

        add_settings_field(
            'custom_options_field2', //id
            'field label2', //label
            function () {
        ?>
            <textarea name="option2" class="w-100" cols="30" rows="10"><?= esc_attr(get_option('option2')) ?></textarea>
        <?php
            },
            self::GROUP, // display page
            'custom_options_section' // section
        );

        add_settings_field(
            'custom_options_field3', //id
            'field label3', //label
            function () {
        ?>
            <input type="text" class="tm_flatpickr" name="option3" value="<?= get_option('option3') ?>">
        <?php
            },
            self::GROUP, // display page
            'custom_options_section' // section
        );
    }

    public static function render()
    {
        ?>
        <h1>Custom Menu option :</h1>
        <form action="options.php" method="POST">
            <?php
            settings_fields(self::GROUP);
            do_settings_sections(self::GROUP);
            submit_button();
            ?>
        </form>
<?php
    }
}
CustomOptions::register();
?>