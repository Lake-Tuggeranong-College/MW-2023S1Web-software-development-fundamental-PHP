footer()
$filename = basename($_SERVER["SCRIPT_FILENAME"]);
$footer = "this page was last modified: " . date("F d Y H:i:s.", filetime($filename));
return $footer