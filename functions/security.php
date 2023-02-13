<?php
declare(strict_types=1);


    /**
     * Cette fonction permet de vérifier si le jéton de sécurité provenant du formulaire est le même que celui généré par le système
     *
     * Elle retourne "true" si les jétons ne sont pas les mêmes, "false" dans le cas contraire.
     * @param string $form_token
     * @param string $system_token
     * @return boolean
     */
    function csrf_middleware(string $form_token, string $system_token) : bool
    {
        if( !isset($form_token) || !isset($system_token) )
        {
            return true;
        }

        if( !is_string($form_token) || !is_string($system_token) )
        {
            return true;
        }

        if( $form_token !== $system_token )
        {
            return true;
        }

        return false;
    }


    /**
     * Cette fonction vérifie la présence d'un robot spameur.
     * 
     * Elle retourne "true" si un robot est détecté, "false" dans le cas contraire.
     *
     * @param string $value
     * @return boolean
     */
    function honet_pot_middleware(string $value) : bool
    {
        if ( !isset($value) || !empty($value) ) 
        {
            return true;
        }
        return false;
    }