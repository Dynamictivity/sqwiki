<?php
/**
 * Sqwiki configuration
 */
$config = array(
    'Sqwiki' => array(
        'title' => getenv('SQWIKI_TITLE'),
        'slogan' => getenv('SQWIKI_SLOGAN'),
        'auto_activate_pending_revisions' => getenv('SQWIKI_AUTO_ACTIVATE_PENDING_REVISIONS'),
        'allow_user_theme_switching' => getenv('SQWIKI_ALLOW_USER_THEME_SWITCHING'),
        'default_theme' => getenv('SQWIKI_DEFAULT_THEME'),
        'google-analytics-id' => getenv('SQWIKI_GOOGLE_ANALYTICS_ID'),
        'url' => getenv('SQWIKI_URL'),
    )
);