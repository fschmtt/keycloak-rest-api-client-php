{ pkgs, lib, ... }:

{
  packages = [
    pkgs.php81
  ];

  languages.php.enable = lib.mkDefault true;

  env.KEYCLOAK_BASE_URL = lib.mkDefault "http://localhost:8080";
}
