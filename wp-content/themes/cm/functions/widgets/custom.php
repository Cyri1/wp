<?php
class CustomWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('custom_widget', 'Custom Widget');
    }

    public function widget($args, $instance)
    {
        wp_register_style('datatable', 'https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css', [], false);
        wp_register_script('datatable', 'https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js', [], false, true);
        wp_enqueue_script('custom_widget', get_template_directory_uri() . '/js/custom_widget.js', ['datatable'], false, true);
        wp_enqueue_style('datatable');

        echo $args['before_widget'];
        if (isset($instance['title'])) {
            $title = apply_filters('widget_title', $instance['title']);
            echo $args['before_title'] . $title . $args['after_title'];
        }
?>
        <table id="example" class="display compact">
            <thead>
                <tr>
                    <th>Test</th>
                    <th>Test</th>
                    <th>Test</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
            </tr>
            </tbody>
        </table>
    <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
    ?>
        <p>
            <label for="<?= $this->get_field_id('title') ?>">Title : </label>
            <input type="text" class="widefat" name="<?= $this->get_field_name('title') ?>" id="<?= $this->get_field_id('title') ?>" value="<?= esc_attr($title) ?>">
        </p>
<?php
    }
    public function update($newInstance, $oldInstance)
    {
        return $newInstance;
    }
}
?>