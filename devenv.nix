{ pkgs, lib, ... }:

{
  packages = [
    pkgs.php81
  ];

  languages.php.enable = lib.mkDefault true;
}
