<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Initialize the twillio service so we can use it within the rest of the application
     *
     * @return Services_Twilio
     */
    protected function _initTwilio()
    {
        $config = $this->getOption('twilio');
        $twilio = new Services_Twilio($config['sid'], $config['token']);
        return $twilio;
    }

}

