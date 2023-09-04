@echo off
title Release

rem navigate to batch file directory
cd /D "%~dp0"

cls
set /p vernum=<tools/release/version
set /a vernum=%vernum% + 1
echo %vernum% > tools/release/version

call grunt
call py tools/release/release.py %vernum%


rem start "" http://localhost/edumonsters/release/index.html

rem @echo off
rem echo.
rem echo.
rem echo Would you like to publish this ? y/n default(n)
rem set /p publish_me=



rem if "%publish_me%" == "y" (
rem call publish.bat
rem ) else (
rem timeout 5
rem )


