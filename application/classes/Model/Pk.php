<?php

defined('SYSPATH') OR die('No direct access allowed.');

class Model_Pk extends Model {
     public function pk($table) {
        $q = "SELECT (max(id)) as max_id FROM ".$table;
        $id = DB::query(Database::SELECT, $q)
                ->execute()
                ->as_array();
        $id = $id[0]['max_id'];
        return $id;
     }
}
?>