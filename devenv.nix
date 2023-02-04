{ pkgs, lib, ... }:

{
  languages.php.enable = lib.mkDefault true;
  languages.php.package = lib.mkDefault pkgs.php81;

  env.KEYCLOAK_BASE_URL = lib.mkDefault "http://localhost:8080";
}
