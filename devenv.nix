{ pkgs, lib, ... }:

{
  languages.php.enable = lib.mkDefault true;
  languages.php.version = lib.mkDefault "8.2";
  languages.php.extensions = ["pcov"];
  languages.php.ini = ''
    memory_limit = 2G
  '';

  env.KEYCLOAK_BASE_URL = lib.mkDefault "http://localhost:8080";
  env.XDEBUG_MODE = "coverage";
}
