<?php
namespace App\Core;

/**
 * Bannière d'information
 */
class Banner {
    
    /**
     * Enregistre les informations de la bannière
     * 
     * @param string $type
     * @param string $message
     */
    public static function add(string $type, string $message): void {
        $_SESSION['banner'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    /**
     * Mets a disposition la bannière
     * 
     * @return array<string,string>|null 
     */
    public static function get(): array|null {
        if(!isset($_SESSION['banner'])) {
            return null;
        }

        $banner = $_SESSION['banner'];
        unset($_SESSION['banner']);
        
        return $banner;
    }

}