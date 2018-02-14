<?php

class N2SliderGeneratorFlickrConfiguration {

    private $configuration;

    public function __construct() {
        require_once(dirname(__FILE__) . "/api/DPZFlickr.php");
        $this->configuration = new N2Data(array(
            'apikey'       => '',
            'apisecret'    => '',
            'access_token' => ''
        ));

        $this->configuration->loadJSON(N2Base::getApplication('smartslider')->storage->get('flickr'));

        $this->wellConfigured();
    }

    public function wellConfigured() {
        if (!$this->configuration->get('api_key') || !$this->configuration->get('api_secret') || !$this->configuration->get('access_token')) {
            return false;
        }
        $api = $this->getApi();

        if ($api->call('flickr.test.login') === false) {
            return false;
        }

        return true;
    }


    public function getApi() {
        $api_key    = $this->configuration->get('api_key');
        $api_secret = $this->configuration->get('api_secret');

        $api = new DPZFlickr($api_key, $api_secret, N2Base::getApplication('smartslider')->router->createUrl(array(
            "generator/finishAuth",
            array(
                'group' => N2Request::getVar('group'),
                'type'  => N2Request::getVar('type')
            )
        )));

        $api->setOauthData(DPZFlickr::OAUTH_ACCESS_TOKEN, $this->configuration->get('access_token'));

        return $api;
    }

    public function getData() {
        return $this->configuration->toArray();
    }

    public function addData($data, $store = true) {
        $this->configuration->loadArray($data);
        if ($store) {
            N2Base::getApplication('smartslider')->storage->set('flickr', null, json_encode($this->configuration->toArray()));
        }
    }

    public function render() {
        $form = new N2Form();
        $form->loadArray($this->getData());

        $form->loadXMLFile(dirname(__FILE__) . '/configuration.xml');
        $api = $this->getApi();
        if ($api->call('flickr.test.login') === false) {
            N2Message::error(n2_('The key and secret is not valid!'));
        }

        echo $form->render('generator');
    }

    public function startAuth() {
        if (session_id() == "") {
            session_start();
        }
        $this->addData(N2Request::getVar('generator'), false);

        $_SESSION['data'] = $this->getData();

        return $this->getApi()
                    ->authenticate();
    }

    public function finishAuth() {
        if (session_id() == "") {
            session_start();
        }
        try {
            $api = $this->getApi();
            $api->authenticateStep2();

            $data                 = $this->getData();
            $data['access_token'] = $api->getOauthData(DPZFlickr::OAUTH_ACCESS_TOKEN);
            $this->addData($data);

            return true;
        } catch (Exception $e) {
            return $e;
        }
    }

}
