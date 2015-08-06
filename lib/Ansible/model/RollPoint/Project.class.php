<?php

require_once(dirname(dirname(__FILE__)) .'/Local.class.php');

class Ansible__RollPoint__Project extends Ansible__ORM__Local {
    protected $__table       = 'rlpt_project';
    protected $__primary_key = array( 'rlpp_id' );
    protected $__schema = array( 'rlpp_id' => array(),
                               'rlpt_id' => array(),
                               'project' => array(),
							   );
    protected $__relations = array();
    public static function get_where($where = null, $limit_or_only_one = false, $order_by = null) { return parent::get_where($where, $limit_or_only_one, $order_by); }

	public function project() {
		require_once(dirname(dirname(dirname(__FILE__))). '/Project.class.php');

		$project = new Ansible__Project( $this->project, $GLOBALS['controller']->stage, false );
		
		return( $project->exists() ? $project : null );
	}
}
