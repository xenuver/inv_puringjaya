<?php
$sql = file_get_contents('laravelinventoripermintaan (2).sql');

// Extract all INSERT INTO statements
preg_match_all('/INSERT INTO `([^`]+)` \(([^)]+)\) VALUES\s*(.*?);/s', $sql, $matches);

$output = "<?php\n\nnamespace Database\Seeders;\n\nuse Illuminate\Database\Seeder;\nuse Illuminate\Support\Facades\DB;\n\nclass DatabaseSeeder extends Seeder\n{\n    public function run(): void\n    {\n";
$output .= "        if (DB::table('users')->count() > 0) {\n            \$this->command->info('Tabel users sudah berisi data. Seeder dilewati.');\n            return;\n        }\n\n";

for ($i = 0; $i < count($matches[0]); $i++) {
    $table = $matches[1][$i];
    
    // Skip system tables
    if (in_array($table, ['cache', 'cache_locks', 'failed_jobs', 'jobs', 'job_batches', 'migrations', 'password_reset_tokens', 'sessions'])) {
        continue;
    }

    $columns = str_replace(['`', ' '], '', $matches[2][$i]);
    $colsArray = explode(',', $columns);
    
    $valuesStr = $matches[3][$i];
    
    // Simple parsing of values
    // Split by ),( or similar
    $valuesStr = trim($valuesStr);
    
    $output .= "        DB::table('$table')->insert([\n";
    
    // This regex matches a single row of values: (val1, val2, ...)
    preg_match_all('/\((.*?)\)(?:,\s*|$)/sm', $valuesStr, $valMatches);
    
    foreach ($valMatches[1] as $valRow) {
        // Split by comma, but respect single quotes
        $vals = str_getcsv($valRow, ',', "'");
        
        $output .= "            [\n";
        foreach ($colsArray as $index => $colName) {
            $val = trim($vals[$index]);
            if (strtoupper($val) === 'NULL') {
                $output .= "                '$colName' => null,\n";
            } elseif (is_numeric($val)) {
                $output .= "                '$colName' => $val,\n";
            } else {
                // escape single quotes
                $val = str_replace("'", "\'", $val);
                $output .= "                '$colName' => '$val',\n";
            }
        }
        $output .= "            ],\n";
    }
    
    $output .= "        ]);\n\n";
}

$output .= "        \$this->command->info('Data manual berhasil di-seed.');\n    }\n}\n";

file_put_contents('database/seeders/DatabaseSeeder.php', $output);
echo "DatabaseSeeder generated successfully!\n";
