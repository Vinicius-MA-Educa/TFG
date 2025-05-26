@echo off
set mensaje=Actualización automática
if not "%1"=="" set mensaje=%1

git add .
git commit -m "%mensaje%"
git push origin master

pause