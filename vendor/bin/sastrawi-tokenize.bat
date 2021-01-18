@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../sastrawi/tokenizer/bin/sastrawi-tokenize
php "%BIN_TARGET%" %*
