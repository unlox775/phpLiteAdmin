<?php

/**
 *  Base Repo Class -
 */
class Ansible__Repo {
    public $repo_cache = array();
    public $display_name = 'Generic';

    ///  Logging Function
    public function log_repo_action( $command, $project, $user ) {
        $project_name = is_string( $project ) ? '**'. $project .'**' : $project->project_name;
        $log_line = join(',', array(time(), getmypid(), date(DATE_RFC822,time()), $user, $project_name, $command)). "\n";
        
        $file = $this->stage->config('safe_base') ."/project_svn_log_". $this->stage->env .".csv";
        file_put_contents($file, $log_line, FILE_APPEND);
    }


    ###########################
    ###   Database-based tag storage

    ###  These methods will be overridden by versioning systems like CVS that have built in per-file tagging systems
    
    public function get_tag_rev($file, $tag) {
        $sth = dbh_query_bind("SELECT revision FROM file_tag WHERE file = ? AND tag = ?", $file, $tag);
        $row = $sth->fetch(PDO::FETCH_NUM);
        $sth->closeCursor();

        $tag_rev = null;
        if ( ! empty( $row ) )
            list( $tag_rev ) = $row;
        return $tag_rev;
    }

}
