<?php
class Plugin_dribbble extends Plugin {

    var $meta = array(
        'name'       => 'Dribbble',
        'version'    => '1.0',
        'author'     => 'Jack McDade',
        'author_url' => 'http://jackmcdade.com'
    );

    public function shots()
    {
        $limit  = $this->fetch_param('limit', 5, 'is_numeric');
        $player = $this->fetch_param('player', null);

        $params = "players/$player/shots?per_page=$limit";

        if ($response = $this->dribbble_curl($params)) {
            return object_to_array($response);
        }

        return false;
    }

    public function players()
    {
        $player = $this->fetch_param('player', null);
        $params = "players/$player";

        if ($player = $this->dribbble_curl($params))
            return (array)$player;

        return false;
    }

    public function lists()
    {
        $limit  = $this->fetch_param('limit', 5, 'is_numeric');
        $list = $this->fetch_param('list', 'everyone');

        $params = "shots/$list?per_page=$limit";

        if ($response = $this->dribbble_curl($params)) {
            return object_to_array($response);
        }

        return false;
    }

    public function api()
    {
        $params = $this->fetch_param('request', false);

        if ($params) {
            if ($response = $this->dribbble_curl($params)) {
                return object_to_array($response);
            }            
        }

        return false;
    }

    function dribbble_curl($params)
    {        
        $request = curl_init('http://api.dribbble.com/'.$params);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

        $contents = curl_exec($request);
        
        if ($contents)
            return json_decode($contents);
        
        echo "Dribbble requires the CURL library to be installed."; // else
    }
}

# Magic function
function object_to_array($d) {
    if (is_object($d)) {
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        return array_map(__FUNCTION__, $d);
    }
    else {
        return $d;
    }
}