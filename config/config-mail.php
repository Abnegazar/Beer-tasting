return array(
    'mail' => array(
        'transport' => array(
            // Utilisation du transport SMTP
            'type' => 'Smtp',
            // Information de connexion au serveur SMTP
            'options' => array(
                // Informations pour atteindre le serveur
                'name' => '',
                'host' => '',
                'port' => 25,
            ),
        ),
        'addFrom' => 'portail.idg@orange.com',
    ),
);
