<?php 

class Layout {
    public static function renderDefaultLayout($title, $data = []) {
        $capitalizedTitle = ucwords(strtolower($title));
        
        $urlData = $data;
        
        ob_start();
        include CLIENT_PAGES . $title . '.php';
        $mainContent = ob_get_clean();
        
        ob_start();
        include CLIENT_COMMON_FILES . 'Navigation.php';
        $navigationContent = ob_get_clean();
        
        ob_start();
        include CLIENT_COMMON_FILES . 'Head.php';
        $headContent = ob_get_clean();
        
        include CLIENT_LAYOUT . "Default.php";
    }
    
    public static function renderLoggedInLayout() {
        include CLIENT_LAYOUT . "Layout.php";
    }
}