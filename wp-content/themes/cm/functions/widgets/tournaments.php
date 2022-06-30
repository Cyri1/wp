<?php
add_action('widgets_init', 'register_widget_tournaments');

function register_widget_tournaments()
{
    register_widget('widget_tournaments');
}

class widget_tournaments extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'widget_tournaments',
            esc_html__('Widget Tournois', 'textdomain'),
            array('description' => esc_html__('Affiche les prochains tournois', 'textdomain'),)
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        $curl = curl_init();
        $startDate = date('c', strtotime('now'));
        $endDate = date('c', strtotime('+60 days'));

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://myffbad.fr/api/search/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"type":"TOURNAMENT","text":"","offset":0,"postalCode":"29290","distance":1000, "leagueId": 7, "sublevels":[],"categories":[],"dateFrom":"' . $startDate . '","dateTo":"' . $endDate . '","sort":"dateFrom-ASC"}',
            CURLOPT_HTTPHEADER => array(
                'sec-ch-ua: " Not;A Brand";v="99", "Google Chrome";v="97", "Chromium";v="97"',
                'sec-ch-ua-mobile: ?0',
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',
                'Content-Type: application/json;charset=UTF-8',
                'Accept: application/json, text/plain, */*',
                'Verify-Token: 718cc98ad986c7746cab0aa664703e0c3094d7997e596b9ce10fa07f9dd5b65d.1642513096963',
                'Caller-URL: /api/search/',
                'sec-ch-ua-platform: "Windows"'
            ),
        ));

        $response = json_decode(curl_exec($curl), true);

        curl_close($curl);
        echo '<div class="mt-2"><strong>Tournois à venir dans la région : </strong></div>';
        echo '<table class="table table-sm table-hover table-responsive-sm">';
        echo '
        <thead class="table-light">
        <tr>
        <th>Date</th>
        <th>Lieu</th>
        <th>Détails</th>
        </tr>
        <thead>';

        foreach ($response['tournaments'] as $value) {
            echo '
                    <tr>
                        <td>' . $value['startDate'] . '</td>
                        <td>' . $value['location'] . '</td>
                        <td><a target="_blank" href="https://myffbad.fr/tournoi/details/' . $value['number'] . '">Détails</a></td>
                    </tr>';
        }
        echo '</table>';

        echo $args['after_widget'];
    }
}
