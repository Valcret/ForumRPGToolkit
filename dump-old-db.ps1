# dump-old-db.ps1

$oldHost     = "db.3wa.io"
$oldUser     = "amaurycre"
$oldPassword = "67929f265095d834f533f78a44e8708b"
$oldDatabase = "amaurycre_trieur"

$dumpFile = "dump_$(Get-Date -Format 'yyyyMMdd_HHmmss').sql"

Write-Host "Dump de $oldDatabase vers $dumpFile ..."
mysqldump `
    --host=$oldHost `
    --user=$oldUser --password=$oldPassword `
    --single-transaction --routines --triggers --no-tablespaces `
    $oldDatabase | Out-File -FilePath $dumpFile -Encoding utf8

if ($LASTEXITCODE -ne 0) {
    Write-Host "Échec du dump." -ForegroundColor Red
    exit 1
}

Write-Host "Dump terminé : $dumpFile ($([math]::Round((Get-Item $dumpFile).Length / 1MB, 2)) Mo)." -ForegroundColor Green
