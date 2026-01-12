Clear-Host
Write-Host "==========================================" -ForegroundColor Cyan
Write-Host "     HOTELCRN - GESTOR DE SERVICIOS"
Write-Host "==========================================" -ForegroundColor Cyan

function Show-Menu {
    Write-Host ""
    Write-Host "1) Iniciar servicios Docker" -ForegroundColor Yellow
    Write-Host "2) Apagar servicios Docker" -ForegroundColor Yellow
    Write-Host "3) Reiniciar todo (down + up)" -ForegroundColor Yellow
    Write-Host "4) Restaurar Base de Datos (ventana)" -ForegroundColor Green
    Write-Host "5) Crear Backup de Base de Datos" -ForegroundColor Green
    Write-Host "6) Ver contenedores activos" -ForegroundColor Cyan
    Write-Host "7) Abrir PgAdmin en navegador" -ForegroundColor Magenta
    Write-Host "8) Ejecutar migraciones Symfony" -ForegroundColor Blue
    Write-Host "9) Limpiar caché Symfony" -ForegroundColor Blue
    Write-Host "0) Salir" -ForegroundColor Red
}

function Start-Services {
    Write-Host ""
    Write-Host "Iniciando servicios..." -ForegroundColor Green
    docker compose up -d
    Write-Host "Servicios en ejecución." -ForegroundColor Green
}

function Stop-Services {
    Write-Host ""
    Write-Host "Deteniendo servicios..." -ForegroundColor Red
    docker compose down
    Write-Host "Servicios detenidos." -ForegroundColor Red
}

function Restart-Services {
    Write-Host ""
    Write-Host "Reiniciando contenedores..." -ForegroundColor Yellow
    docker compose down
    docker compose up -d
    Write-Host "Reinicio completado." -ForegroundColor Green
}

function Restore-DB {
    Write-Host ""
    Write-Host "Restaurar base de datos..." -ForegroundColor Green

    Add-Type -AssemblyName System.Windows.Forms

    $OpenFileDialog = New-Object System.Windows.Forms.OpenFileDialog
    $OpenFileDialog.Filter = "SQL Files (*.sql)|*.sql"
    $OpenFileDialog.Title = "Selecciona tu archivo SQL"

    if ($OpenFileDialog.ShowDialog() -ne "OK") {
        Write-Host "Operación cancelada." -ForegroundColor Yellow
        return
    }

    $FilePath = $OpenFileDialog.FileName
    Write-Host "Archivo seleccionado: $FilePath" -ForegroundColor Cyan

    Write-Host "Eliminando base de datos actual..." -ForegroundColor Red
    docker exec -it hotelcrn-db psql -U postgres -c "DROP DATABASE IF EXISTS apphotelcrn;"
    docker exec -it hotelcrn-db psql -U postgres -c "CREATE DATABASE apphotelcrn;"

    Write-Host "Restaurando backup..." -ForegroundColor Yellow
    Get-Content $FilePath | docker exec -i hotelcrn-db psql -U postgres apphotelcrn

    Write-Host "Restauración completada." -ForegroundColor Green
}

function Backup-DB {
    $BackupName = "backup_$(Get-Date -Format 'yyyyMMdd_HHmmss').sql"
    $BackupPath = "$PSScriptRoot\$BackupName"

    Write-Host ""
    Write-Host "Creando backup..." -ForegroundColor Cyan
    docker exec hotelcrn-db pg_dump -U postgres apphotelcrn > $BackupPath

    Write-Host "Backup creado: $BackupPath" -ForegroundColor Green
}

function Show-Containers {
    Write-Host ""
    Write-Host "Contenedores activos:" -ForegroundColor Cyan
    docker ps
}

function Open-PgAdmin {
    Write-Host ""
    Write-Host "Abriendo PgAdmin..." -ForegroundColor Magenta
    Start-Process "http://localhost:5050"
}

function Run-Migrations {
    Write-Host ""
    Write-Host "Ejecutando migraciones Symfony..." -ForegroundColor Blue
    docker exec -it hotelcrn-php php bin/console doctrine:migrations:migrate --no-interaction
    Write-Host "Migraciones ejecutadas." -ForegroundColor Green
}

function Clear-Cache {
    Write-Host ""
    Write-Host "Limpiando caché de Symfony..." -ForegroundColor Blue
    docker exec -it hotelcrn-php php bin/console cache:clear
    Write-Host "Caché limpiada." -ForegroundColor Green
}

do {
    Show-Menu
    $option = Read-Host "`nSelecciona una opción"

    switch ($option) {
        "1" { Start-Services }
        "2" { Stop-Services }
        "3" { Restart-Services }
        "4" { Restore-DB }
        "5" { Backup-DB }
        "6" { Show-Containers }
        "7" { Open-PgAdmin }
        "8" { Run-Migrations }
        "9" { Clear-Cache }
        "0" { Write-Host "Saliendo..." -ForegroundColor Red }
        default { Write-Host "Opción no válida." -ForegroundColor Red }
    }

} while ($option -ne "0")
