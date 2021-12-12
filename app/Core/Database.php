<?php

namespace Core;

use Core\DotEnv;

class Database
{
    /**
     * @var \Core\DotEnv
     */
    protected $db;

    /**
     * db
     */
    function __construct(
    ) {
        $this->db = self::getConnection();
    }

    /**
     * @return \mysqli
     */
    public static function getConnection() : \mysqli
    {
        (new DotEnv(dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env'))->load();

        $mysqli =  new \mysqli(getenv(
            'DATABASE_HOST'), getenv('DATABASE_USER'), getenv('DATABASE_PASSWORD'), getenv('DATABASE_NAME'));

        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        return $mysqli;
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = array_slice(scandir(dirname(__DIR__, 2) . '/database/migrations'), 2);
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            require_once dirname(__DIR__, 2) . '/database/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        }
    }

    protected function createMigrationsTable()
    {
        $this->db->prepare("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;")
            ->execute();
    }

    protected function getAppliedMigrations()
    {
        $statement = $this->db->prepare("SELECT migration FROM migrations");
        $statement->execute();
        $migrations = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

        return array_column($migrations, 'migration');
    }

    protected function saveMigrations(array $newMigrations)
    {
        $str = implode(',', array_map(fn($m) => "('$m')", $newMigrations));
        $statement = $this->db->prepare("INSERT INTO migrations (migration) VALUES 
            $str
        ");
        $statement->execute();
    }

    public function deleteMigrations()
    {
        $files = array_slice(scandir(dirname(__DIR__, 2) . '/database/migrations'), 2);
        foreach ($files as $migration) {
            require_once dirname(__DIR__, 2) . '/database/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $instance->down();
            $this->log("Deleted migration $migration");

            $statement = $this->db->prepare("TRUNCATE migrations");
            $statement->execute();
        }

        return 'Migrations are deleted';
    }

    protected function log($message)
    {
        if (file_exists(dirname(__DIR__, 2) . '/var/log') == false){
            mkdir(dirname(__DIR__, 2) . '/var/log', 0777, true);
        }
        file_put_contents(dirname(__DIR__, 2) . '/var/log/log_' . $this->getCurrentDate() . '.txt',
            PHP_EOL . $this->getCurrentDate() . '-' . $message, FILE_APPEND);
    }

    protected function getCurrentDate()
    {
        return date("j.n.Y");
    }

}