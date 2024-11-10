<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Config {
    public $API_ID;
    public $API_HASH;
    public $SESSION;
    public $BOT_TOKEN;
    public $SUDOERS;
    public $SPOTIFY = false;
    public $QUALITY;
    public $PREFIXES;
    public $LANGUAGE;
    public $STREAM_MODE;
    public $ADMINS_ONLY;
    public $SPOTIFY_CLIENT_ID;
    public $SPOTIFY_CLIENT_SECRET;

    public function __construct() {
        $this->API_ID = getenv("API_ID");
        $this->API_HASH = getenv("API_HASH");
        $this->SESSION = getenv("SESSION");
        $this->BOT_TOKEN = getenv("BOT_TOKEN");
        
        // Parse SUDOERS as a list of integers
        $sudoers = getenv("SUDOERS");
        $this->SUDOERS = array_map('intval', array_filter(explode(' ', $sudoers), 'is_numeric'));

        // Check required variables
        if (!$this->SESSION || !$this->API_ID || !$this->API_HASH) {
            die("ERROR: SESSION, API_ID, and API_HASH are required!");
        }

        // Additional configurations
        $this->QUALITY = strtolower(getenv("QUALITY") ?: "high");
        $this->PREFIXES = explode(' ', getenv("PREFIX") ?: "!");
        $this->LANGUAGE = strtolower(getenv("LANGUAGE") ?: "en");
        $this->STREAM_MODE = (strtolower(getenv("STREAM_MODE") ?: "audio") === "audio") ? "audio" : "video";
        $this->ADMINS_ONLY = filter_var(getenv("ADMINS_ONLY"), FILTER_VALIDATE_BOOLEAN);
        $this->SPOTIFY_CLIENT_ID = getenv("SPOTIFY_CLIENT_ID");
        $this->SPOTIFY_CLIENT_SECRET = getenv("SPOTIFY_CLIENT_SECRET");
    }
}

$config = new Config();
?>
