<?php

class Layout {
    /**
     * All defined variables will be passed to all pages that are auto loaded via this method
     */
    public static function renderDefaultLayout($title, $data = []) {
        $capitalizedTitle = ucwords(strtolower($title));
        
        $urlData = $data;

        $mainContent = self::getMainContent($title);
    
        $navigationContent = self::getNavigationContent($title);

        $headContent = self::getHeadContent($capitalizedTitle);

        $bootstrapScript = self::getBootstrapScript();
        
        include CLIENT_LAYOUT . "Default.php";
    }

    public static function unallowedRoutesForNavigation() {
        return [
            "login",
            "register"
        ];
    }

    public static function getNavigationContent($currentPageTitle){
        $allowedRoutes = self::unallowedRoutesForNavigation();

        if(in_array(strtolower($currentPageTitle), $allowedRoutes)) {
            return "";
        }

        ob_start();
        include CLIENT_COMMON_FILES . 'Navigation.php';
        
        return ob_get_clean();
    }

    public static function getHeadContent($capitalizedTitle) {
        ob_start();
        include CLIENT_COMMON_FILES . 'Head.php';
        return ob_get_clean();
    }

    public static function getMainContent($title) {
        ob_start();
        include CLIENT_PAGES . $title . '.php';
        return ob_get_clean();
    }

    public static function getBootstrapScript() {
        ob_start();
        include CLIENT_LAYOUT . "BootstrapScript.php";
        return ob_get_clean();
    }
    
    public static function renderLoggedInLayout() {
        include CLIENT_LAYOUT . "Layout.php";
    }
}