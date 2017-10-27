@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../vendor/peridot-php/webdriver-manager/bin/manager
php "%BIN_TARGET%" %*
