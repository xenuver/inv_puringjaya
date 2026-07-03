<?php

$sql = file_get_contents('laravelinventoripermintaan (2).sql');

// Extract CREATE TABLE
preg_match_all('/CREATE TABLE `(.*?)` \((.*?)\) ENGINE=InnoDB/s', $sql, $matches);

$migration = "<?php\n\nuse Illuminate\Database\Migrations\Migration;\nuse Illuminate\Support\Facades\DB;\nuse Illuminate\Support\Facades\Schema;\n\nreturn new class extends Migration\n{\n    public function up(): void\n    {\n";

foreach ($matches[0] as $match) {
    // Add IF NOT EXISTS
    $tableSql = str_replace('CREATE TABLE `', 'CREATE TABLE IF NOT EXISTS `', $match);
    $tableSql .= " DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
    $tableSql = str_replace("'", "\'", $tableSql);
    
    $migration .= "        DB::unprepared('$tableSql');\n\n";
}

// Extract ALTER TABLE ADD PRIMARY KEY and AUTO_INCREMENT
preg_match_all('/ALTER TABLE `(.*?)`\s+ADD PRIMARY KEY(.*?);/s', $sql, $pkMatches);
foreach ($pkMatches[0] as $match) {
    $migration .= "        // Add Primary Key\n";
    $migration .= "        try { DB::unprepared('$match'); } catch (\\Exception \$e) {}\n\n";
}

preg_match_all('/ALTER TABLE `(.*?)`\s+MODIFY `id`(.*?);/s', $sql, $aiMatches);
foreach ($aiMatches[0] as $match) {
    $migration .= "        // Add Auto Increment\n";
    $migration .= "        try { DB::unprepared('$match'); } catch (\\Exception \$e) {}\n\n";
}


$migration .= "    }\n\n    public function down(): void\n    {\n        // \n    }\n};\n";

file_put_contents('database/migrations/2026_01_01_000000_create_base_tables_from_sql.php', $migration);
echo "Base migration generated successfully with primary keys!\n";
